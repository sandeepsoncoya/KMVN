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
class BanquetsController  extends AppController {

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
        $this->loadModel('Admin.Banquets');
        $this->loadModel('Admin.BanquetBookings');
        $this->siteSettings = $this->siteSettings();
        $logo = Configure::read('AbsoluteUrl').'SiteSettings/'.$this->siteSettings['SiteSettings']['logo'];
        $siteSettings =$this->siteSettings;
        $this->set(compact('siteSettings','logo'));
    }
	
    public function index(){
       $page = Configure::read('pagecount');
       $banquets =  $this->Banquets->find('all',['conditions'=>['Banquets.is_active'=>1],'order'=>['created'=>'DESC'], 'limit' => $page]);

       $banquetsAll =  $this->Banquets->find('all',['conditions'=>['Banquets.is_active'=>1],'order'=>['created'=>'DESC']]);
       $allcount = sizeof($banquetsAll);
        $this->set(compact('banquets','allcount'));
    }


	public function details() {
        $this->Banquets->bindModel([
                    'hasMany'=>[
                        'BanquetImages'=>[
                          'className'=>'Admin.BanquetImages',
                          'foreignKey'=>'banquet_id'
                        ]
                    ],
                    
                ]);
        $this->Banquets->recursive = 2;
        $banquetDetails = $this->Banquets->findBySlug($this->request->params['pass'][0]);
        $this->set(compact('banquetDetails'));

    }


    public function checkStatusBanquet($banquetBookingId=null){
        //$this->autoRender =false;
        $working_key = Configure::read('working_key');
        $encResponse = $_POST["encResp"];            //This is the response sent by the CCAvenue Server
        $rcvdString = $this->decrypt($encResponse, $working_key);  //Crypto Decryption used as per the specified working key.
        $decryptValues = explode('&', $rcvdString);
        $dataSize = sizeof($decryptValues);
       //pr($decryptValues); die;
        $order_status = 0;
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

            if ($i == 0) $order_id        = $information[1];
            if ($i == 1) $tracking_id     = $information[1];
            if ($i == 2) $bank_ref_no     = $information[1];
            if ($i == 5) $payment_mode    = $information[1];
            if ($i == 10) $amount         = $information[1];
            if ($i == 9) $currency        = $information[1];
            if ($i == 6) $card_name       = $information[1];
            if ($i == 19) $delivery_name  = $information[1];
            if ($i == 25) $delivery_tel   = $information[1];
            if ($i == 4) $failure_message = $information[1];
            if ($i == 40) $trans_date     = date('Y-m-d H:i:s',strtotime($information[1]));
        }

        if($order_status == 1){
            $this->BanquetBookings->updateAll(
                array('tracking_id' => "'$tracking_id'", 'bank_ref_no' => "'$bank_ref_no'", 'payment_mode' => "'$payment_mode'", 'trans_date' => "'$trans_date'", 'status'=> 1),
                array('id' => "$banquetBookingId")
            );


            $this->BanquetBookings->bindModel([
                    'belongsTo'=>[
                        'Banquets'=>[
                          'className'=>'Banquets',
                          'foreignKey'=>'banquet_id'
                        ]
                    ],
                    
                ]);
            
            $banquetBook = $this->BanquetBookings->findById($banquetBookingId);

            

            if(!empty($banquetBook)){

                $this->layout = 'pdf';
                ini_set('memory_limit', '512M');
                set_time_limit(0);
                $siteUrlfront = Configure::read('siteUrlfront');
                $logo = $siteUrlfront.'app/webroot/images/logo_pdf.png';
                $this->set(compact('banquetBook','logo'));
            }

            
           // $this->redirect(array('controller'=>'banquets', 'action'=>'thankyou', $order_id));
        }else{
            $this->redirect(array('controller'=>'banquets', 'action'=>'cancel', $order_id));
        }
    }


    public function thankyou($order_id = null){
        if(empty($order_id)){
            $this->Session->setFlash(__("Order id is missing.", true),'error');
            $this->redirect(['controller'=>'banquets','cancel'=>'cancel', $order_id]);
        }

        $this->set(compact('order_id'));
    }
        
    public function cancel($order_id = null){
        $this->set(compact('order_id'));
    }
   
    
    public function sendBanquetInvoice($documentName=null, $booking_id = null){

        $this->layout = "";
        $this->loadModel('Admin.Banquets');     
        $this->loadModel('Admin.BanquetBookings');     
       
        if($documentName!='' && $booking_id!=''){
            
            $this->BanquetBookings->bindModel([
                    'belongsTo'=>[
                        'Banquets'=>[
                          'className'=>'Banquets',
                          'foreignKey'=>'banquet_id'
                        ]
                    ],
                    
                ]);
            $bookingDetail = $this->BanquetBookings->find('first', array('conditions'=>array('booking_id' => $booking_id)));
            
            //pr($bookingDetail); die; 
            if(!empty($bookingDetail)){
                
                $banquet_name = $bookingDetail['Banquets']['title'];
                $username = $bookingDetail['BanquetBookings']['name'];
                $email_to = $bookingDetail['BanquetBookings']['email'];
                $relativeUrl = Configure::read('RelativeUrl');

                $this->Email = new CakeEmail('smtp');
                $this->Email->to($email_to);
                $this->Email->subject('Banquet Booking Invoice');
                $this->Email->from('sandeep.kumar@soncoya.in');
                $this->Email->emailFormat('html');
                $this->Email->template('sendbanquetinvoice')->viewVars( array('username'=>$username, 'banquet_name'=>$banquet_name));
                $this->Email->attachments(array($relativeUrl . 'banquet_invoices/' . $documentName.'.pdf'));
                $this->Email->send();
                //send sms
                $phone = $bookingDetail['BanquetBookings']['phone'];
                $sms = 'Hello '.$bookingDetail['BanquetBookings']['name']. ', your booking for banquet has been confirmed. Your Booking id is '.$bookingDetail['BanquetBookings']['booking_id'];
                $this->send_sms($phone, $sms);

                $this->redirect(['controller'=>'banquets','action'=>'thankyou', $booking_id]);

            } else{
                return false;
            }       
        }else{
            return false;
        }
    }
}
