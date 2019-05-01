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
    public $helpers = array('Pdf');
    public $components = array('Email');


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
        if(empty($order_id)){
            $this->Session->setFlash(__("Order id is missing.", true),'error');
            $this->redirect(['controller'=>'hotel_search','action'=>'index']);
        }
        //$this->downloaddocument($order_id);
        //$this->set(compact('order_id'));
    }
		
    public function cancel($order_id = null){
        $this->set(compact('order_id'));
    }

    /*public function view_pdf($id = 1){ ini_set('memory_limit', '512M');
        require_once(APP . 'vendors' . DS . 'dompdf' . DS . 'lib/html5lib/Parser.php'); 
        require_once(APP . 'vendors' . DS . 'dompdf' . DS . 'src/Autoloader.php'); 

        $this->autoRender = false;
        $path = Configure::read('RelativeUrl');
        $dompdf = new Dompdf();
        $html = file_get_contents("view_pdf.ctp");           

        $dompdf->load_html($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->set_paper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream($path."invoice.pdf", array("Attachment" =>0));
        exit(0);
    }*/


    public function downloaddocument() { 
        $this->loadModel('Admin.RoomReservation');
        $working_key = Configure::read('working_key');
        $encResponse = $_POST["encResp"];            //This is the response sent by the CCAvenue Server
        $rcvdString = $this->decrypt($encResponse, $working_key);        //Crypto Decryption used as per the specified working key.
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
            if ($i == 40) $trans_date = date('Y-m-d H:i:s',strtotime($information[1]));
        }

        if ($order_status != 1) {
            $this->redirect(['controller'=>'booking','action'=>'cancel',$order_id]);
        }else{
            $this->RoomReservation->updateAll(
                        array('booking_id' => "'$order_id'",'tracking_id' => "'$tracking_id'",'bank_ref_no' => "'$bank_ref_no'",'payment_mode' => "'$payment_mode'",'trans_date' => "'$trans_date'",'order_status' => "'$order_status'"),
                        array('booking_id' => "'$order_id'")
                    );
            $this->layout = 'pdf';
            ini_set('memory_limit', '512M');
            set_time_limit(0);
            $siteUrlfront = Configure::read('siteUrlfront');
            $logo = $siteUrlfront.'app/webroot/images/logo_pdf.png';
            $this->set(compact('logo', 'order_id'));
        }
    }


    public function sendInvoice($documentName=null, $order_id = null){
        $this->layout = "";
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
                $relativeUrl = Configure::read('RelativeUrl');

                $this->Email->send('raj@mailinator.com','KMVN Booking','MEssage',$relativeUrl . 'invoices/' . $documentName.'.pdf');

                //$this->Email->to  = $email_to;
                /*$this->Email->to  = 'raj@mailinator.com';
                $this->Email->subject = 'Invoice';
                $this->Email->from = 'sandeep.kumar@soncoya.in';
                $this->Email->layout = '';
                $this->Email->template = 'sendinvoice';
                $this->Email->sendAs = 'html';
                $this->Email->attachments = array($relativeUrl . 'invoices/' . $documentName.'.pdf');
                $this->set(compact('username'));
                
                $this->Email->send();*/
                $this->redirect(['controller'=>'booking','action'=>'thanks',$order_id]);


            } else{
                return false;
            }       
        }else{
            return false;
        }
    }

    

  
}
