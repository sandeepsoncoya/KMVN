<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');
App::uses('Security', 'Utility'); 
App::uses('CakeEmail', 'Network/Email'); 
App::import('Helper', 'HtmlHelper');
use Dompdf\Dompdf;

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link https://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class BookingController   extends AppController {

    //public $components = array('RequestHandler');
    public $helpers = array('Pdf','Html', 'Text');


/**
 * This controller does not use a model
 *
 * @var array
 */
    public $uses = array();

/**
 * Displays a view
 *
 * @return CakeResponse|null
 * @throws ForbiddenException When a directory traversal attempt.
 * @throws NotFoundException When the view file could not be found
 *   or MissingViewException in debug mode.
 */
    public $siteSettings;  

    public function beforeFilter() {
        $this->siteSettings = $this->siteSettings();
        $logo = Configure::read('AbsoluteUrl').'SiteSettings/'.$this->siteSettings['SiteSettings']['logo'];
        $services = $this->serviceMenu();
        $aboutMenu = $this->aboutMenu();
        $siteSettings =$this->siteSettings;     
        $this->set(compact('siteSettings','logo','services','aboutMenu'));
    }

    public function thanks($order_id = null){
        $this->Session->delete('HotelData');
        if(empty($order_id)){
            $this->Session->setFlash(__("Order id is missing.", true),'error');
            $this->redirect(['controller'=>'hotel_search','action'=>'index']);
        }
    }
        
    public function cancel($order_id = null){
        $this->Session->delete('HotelData');
        $this->set(compact('order_id'));
    }

    public function downloaddocument() { 
        $this->siteSettings = $this->siteSettings();
        $siteSettings =$this->siteSettings;    
        $this->loadModel('Admin.RoomReservation');
        $working_key = Configure::read('working_key');
        $encResponse = $_POST["encResp"]; //This is the response sent by the CCAvenue Server
        $rcvdString = $this->decrypt($encResponse, $working_key); //Crypto Decryption used as per the specified working key.
        $decryptValues = explode('&', $rcvdString);
        $dataSize = sizeof($decryptValues);
        $bookingData = [];
        for ($i = 0; $i < $dataSize; $i++) {
            $information = explode('=', $decryptValues[$i]);
            if ($i == 3){
                if ($information[1] === 'Success') {
                     $order_status = 1;
                }elseif($information[1] === 'Aborted'){
                    $order_status = 2;
                }else{
                    $order_status = 3;
                }
            }
            if ($i == 0) $order_id = $information[1];
            if ($i == 1) $tracking_id = $information[1];
            if ($i == 2) $bank_ref_no = $information[1];
            if ($i == 5) $payment_mode = $information[1];
            if ($i == 10) $amount = $information[1];
            if ($i == 9) $currency = $information[1];
            if ($i == 6) $card_name = $information[1];
            if ($i == 19) $delivery_name = $information[1];
            if ($i == 25) $delivery_tel = $information[1];
            if ($i == 4) $failure_message = $information[1];
            if ($i == 40) $trans_date = $information[1];
        }

       
            $sitephone = '';
            if ($siteSettings['SiteSettings']['phone']) {
                 $sitephone =  $siteSettings['SiteSettings']['phone'];
            } 
            
        if ($order_status != 1) {
           
            $this->redirect(['controller'=>'booking','action'=>'cancel',$order_id]);
        }else{

            
            $trans_date= str_replace("/", "-", $trans_date);
            $trans_date = date('Y-m-d H:i:s',strtotime($trans_date));
            $res = $this->RoomReservation->updateAll(
                        array('booking_id' => "'$order_id'",'tracking_id' => "'$tracking_id'",'bank_ref_no' => "'$bank_ref_no'",'payment_mode' => "'$payment_mode'",'trans_date' => "'$trans_date'",'order_status' => "'$order_status'"),
                        array('booking_id' => $order_id)
                    );


            
            $this->layout = 'pdf';
            ini_set('memory_limit', '512M');
            set_time_limit(0);
            $siteUrlfront = Configure::read('siteUrlfront');
            $logo = $siteUrlfront.'app/webroot/images/logo_pdf.png';
            $this->loadModel('Admin.Hotel');
            $HotelData =  $this->Session->read('HotelData');
            $userServices = $this->Session->read('HotelData.userServices');
           
         

            $extra = 0;
            if (isset($userServices) && !empty($userServices)) {
                foreach ($userServices as $key => $userService) { 
                    $extra += $userService['Services']['price']+$userService['Services']['tax'];
                }
            }
           

            $cityHotel =  $this->Hotel->find('first',['conditions'=>['id'=>$HotelData['userInputData']['hotel_select']]]);
            $hotel_name = $cityHotel['Hotel']['title'];
            $this->set(compact('logo','sitephone', 'order_id','delivery_name','delivery_tel', 'payment_mode', 'trans_date', 'amount', 'currency', 'card_name', 'hotel_name','HotelData'));
           
        }
    }


    public function sendInvoice($documentName=null, $order_id = null){

        $this->layout = "";
        $this->autoRender = false;
        $this->loadModel('Admin.TravelerDetails');     
        $this->loadModel('Admin.TravelerContactDetails');     
        if($documentName!='' && $order_id!=''){
            $travelerDetail = $this->TravelerDetails->find('first', array('conditions'=>array('booking_id' => $order_id)));
            $travelerContDetail = $this->TravelerContactDetails->find('first', array('conditions'=>array('booking_id' => $order_id)));
            
            if(!empty($travelerDetail) && !empty($travelerContDetail)){
                
                $fullname = [];
                if(!empty($travelerDetail['TravelerDetails']['title'])){
                    $fullname[] = $travelerDetail['TravelerDetails']['title'];
                }
                if(!empty($travelerDetail['TravelerDetails']['first_name'])){
                    $fullname[] = $travelerDetail['TravelerDetails']['first_name'];
                }

                if(!empty($travelerDetail['TravelerDetails']['middle_name'])){
                    $fullname[] = $travelerDetail['TravelerDetails']['middle_name'];
                }

                if(!empty($travelerDetail['TravelerDetails']['last_name'])){
                    $fullname[] = $travelerDetail['TravelerDetails']['last_name'];
                }

                $username = implode(' ', $fullname);
                $email_to = $travelerContDetail['TravelerContactDetails']['email_id'];
                $mobile_no = $travelerContDetail['TravelerContactDetails']['mobile_no'];
                $relativeUrl = Configure::read('RelativeUrl');
                $sms = "Your booking with kmvn has been confirmed. Your booking id is ".$order_id."";
                $this->Email = new CakeEmail('smtp');
                $this->Email->to('rajpalsingh.info@gmail.com');
                $this->Email->subject('Invoice');
                $this->Email->from('sandeep.kumar@soncoya.in');
                $this->Email->emailFormat('html');
                $this->Email->template('sendinvoice')->viewVars( array('username'=>$username));
                $this->Email->attachments(array($relativeUrl . 'invoices/' . $documentName.'.pdf'));
                $this->Email->send();
                $this->send_sms($mobile_no,$sms);
                $this->redirect(['controller'=>'booking','action'=>'thanks',$order_id]);
            } else{
                return false;
            }       
        }else{
            return false;
        }
    }

    

  
}
