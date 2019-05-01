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
class ActivitiesController  extends AppController {

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
        $this->loadModel('Activities');
        $this->loadModel('ActivityBookings');
        $this->siteSettings = $this->siteSettings();
        $logo = Configure::read('AbsoluteUrl').'SiteSettings/'.$this->siteSettings['SiteSettings']['logo'];
        $services = $this->serviceMenu();
        $aboutMenu = $this->aboutMenu();
        $siteSettings =$this->siteSettings;     
        $this->set(compact('siteSettings','logo','services','aboutMenu','tourCats'));
    }


    public function index(){
        $page = Configure::read('pagecount');
        $customerData = '';
        $page = Configure::read('pagecount');
        if(!empty($this->Session->check('CustomerData'))){
            $customerData = $this->Session->read('CustomerData.Customers');
        }

        $now = new DateTime();;
        $currDate = $now->format('Y-m-d');

        $bookingCount = $this->ActivityBookings->find('count',['conditions'=>['status'=>1, 'created'=>$currDate]]);

        //pr($bookingCount); die;

        $this->Activities->bindModel([
                    'hasMany'=>[
                        'ActivityImages'=>[
                          'className'=>'ActivityImages',
                          'foreignKey'=>'activity_id'
                        ]
                    ],
                ]);
        $this->Activities->recursive = 2;
        $activityList = $this->Activities->find('all',['conditions'=>['is_active'=>1],'order'=>['created'=>'DESC'], 'limit' => $page]);
       
        $activityAllList = $this->Activities->find('all',['conditions'=>['is_active'=>1]]);
        $allcount = sizeof($activityAllList);


        $this->set(compact('activityList','allcount','customerData','bookingCount'));
    }
	
	public function details() {

        $now = new DateTime();;
        $currDate = $now->format('Y-m-d');
        $bookingCount = $this->ActivityBookings->find('count',['conditions'=>['status'=>1, 'created'=>$currDate]]);
        
        $this->Activities->bindModel([
                    'hasMany'=>[
                        'ActivityImages'=>[
                          'className'=>'ActivityImages',
                          'foreignKey'=>'activity_id'
                        ]
                    ],
                    
                ]);
        $this->Activities->recursive = 2;
        $activitiesDetails = $this->Activities->findBySlug($this->request->params['pass'][0]);
        $this->set(compact('activitiesDetails','bookingCount'));

    }


    public function checkStatusActivity($activityBookingId=null){
        //$this->autoRender =false;
        $working_key = Configure::read('working_key');
        $encResponse = $_POST["encResp"];  //This is the response sent by the CCAvenue Server
        $rcvdString = $this->decrypt($encResponse, $working_key); //Crypto Decryption used as per the specified working key.
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
            $this->ActivityBookings->updateAll(
                array('tracking_id' => "'$tracking_id'", 'bank_ref_no' => "'$bank_ref_no'", 'payment_mode' => "'$payment_mode'", 'trans_date' => "'$trans_date'", 'status'=> 1),
                array('id' => "$activityBookingId")
            );



            $this->ActivityBookings->bindModel([
                    'belongsTo'=>[
                        'Activities'=>[
                          'className'=>'Activities',
                          'foreignKey'=>'activity_id'
                        ]
                    ],
                    
                ]);
            
            $activityBook = $this->ActivityBookings->findById($activityBookingId);

            

            if(!empty($activityBook)){
                
                $this->layout = 'pdf';
                ini_set('memory_limit', '512M');
                set_time_limit(0);
                $siteUrlfront = Configure::read('siteUrlfront');
                $logo = $siteUrlfront.'app/webroot/images/logo_pdf.png';



                $this->set(compact('activityBook','logo'));
            }


            //$this->redirect(array('controller'=>'activities', 'action'=>'thankyou', $order_id));
        }else{
            $this->redirect(array('controller'=>'activities', 'action'=>'cancel', $order_id));
        }
    }


    public function thankyou($order_id = null){
        if(empty($order_id)){
            $this->Session->setFlash(__("Order id is missing.", true),'error');
            $this->redirect(['controller'=>'activities','cancel'=>'cancel', $order_id]);
        }

        $this->set(compact('order_id'));
    }
        
    public function cancel($order_id = null){
        $this->set(compact('order_id'));
    }


    public function sendActivityInvoice($documentName=null, $booking_id = null){
        $this->layout = "";
        $this->loadModel('Admin.Activities');     
        $this->loadModel('Admin.ActivityBookings');     
        if($documentName!='' && $booking_id!=''){
            
            $this->ActivityBookings->bindModel([
                    'belongsTo'=>[
                        'Activities'=>[
                          'className'=>'Activities',
                          'foreignKey'=>'activity_id'
                        ]
                    ],
                    
                ]);
            $bookingDetail = $this->ActivityBookings->find('first', array('conditions'=>array('booking_id' => $booking_id)));
            
            
            if(!empty($bookingDetail)){
                
                $activity_name = $bookingDetail['Activities']['name'];
                $username = $bookingDetail['ActivityBookings']['name'];
                $email_to = $bookingDetail['ActivityBookings']['email'];
                $relativeUrl = Configure::read('RelativeUrl');

                $this->Email = new CakeEmail('smtp');
                $this->Email->to($email_to);
                $this->Email->subject('Activity Booking Invoice');
                $this->Email->from('sandeep.kumar@soncoya.in');
                $this->Email->emailFormat('html');
                $this->Email->template('sendactivityinvoice')->viewVars( array('username'=>$username, 'activity_name'=>$activity_name));
                $this->Email->attachments(array($relativeUrl . 'activity_invoices/' . $documentName.'.pdf'));
                $this->Email->send();
                //send sms
                $phone = $bookingDetail['ActivityBookings']['phone'];
                $sms = 'Hello '.$bookingDetail['ActivityBookings']['name']. ', your booking for activity has been confirmed. Your Booking id is '.$bookingDetail['ActivityBookings']['booking_id'];
                $this->send_sms($phone, $sms);

                $this->redirect(['controller'=>'activities','action'=>'thankyou', $booking_id]);

            } else{
                return false;
            }       
        }else{
            return false;
        }
    }
    
   
}
