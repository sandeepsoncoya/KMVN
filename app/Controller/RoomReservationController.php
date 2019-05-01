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


/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link https://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class RoomReservationController   extends AppController {

    public $helpers = array('Html', 'Text');
    

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
        $this->loadModel('RoomReservation');
        $this->loadModel('Admin.Hotel');
        $this->loadModel('Admin.HotelCategory');
        $this->loadModel('Admin.HotelFacilities');
        $this->loadModel('Admin.HotelHighlight');
        $this->loadModel('Admin.HotelFacilitiesInfo');
        $this->loadModel('Admin.HotelHighlightSelected');
        $this->loadModel('Admin.City');
        $this->loadModel('Admin.HotelImages');
        $this->loadModel('Admin.HowToReach');
        $this->loadModel('Admin.Attraction');
        $this->loadModel('Admin.HotelAttraction');
        $this->loadModel('Admin.HotelFacilitiesSelected');
        $this->loadModel('Admin.BedType');
        $this->loadModel('Admin.Room');
        $this->loadModel('Admin.BedTypeHotel');
        $this->loadModel('Admin.Services');
        $this->loadModel('Admin.HotelExtraService');
        $this->loadModel('Admin.SeasionRate');
        $this->loadModel('Admin.RoomSelectedFacility');
        $this->loadModel('Admin.RoomFacility');
        $this->loadModel('Admin.RoomFacilityInfo');
        $this->loadModel('Admin.RoomCancellation');
      
        $this->loadModel('Admin.TravelerDetails');
        $this->loadModel('Admin.TravelerContactDetails');
        $this->loadModel('Admin.CompanyUsers');
      
    }

    
    public function myBookings(){
        $this->set('title', 'My Bookings');
    }
    
    public function viewBookings($booking_id='KMVN5845CB'){

        if(!empty($booking_id)){

            $cond = ['RoomReservation.booking_id'=> $booking_id, 'RoomReservation.user_id !='=> ''];
            
            $this->RoomReservation->bindModel([
                'belongsTo'=>[
                                'Hotel'=>[
                                    'className'=>'Hotel',
                                    'foreignKey'=>'hotel_id'
                                ]
                            ],
                'hasOne'=>[
                            'TravelerDetails'=>[
                                'className'=>'TravelerDetails',
                                'dependent' => true,
                                'foreignKey'   => false,
                                'associationForeignKey' => 'RoomReservation.booking_id'
                            ],
                            'TravelerContactDetails'=>[
                                'className'=>'TravelerContactDetails',
                                'dependent' => true,
                                'foreignKey'   => false,
                                'associationForeignKey' => 'RoomReservation.booking_id'
                            ],
                            'CompanyUsers'=>[
                                'className'=>'CompanyUsers',
                                'dependent' => true,
                                'foreignKey'   => false,
                                'associationForeignKey' => 'RoomReservation.user_id'
                            ],
                        ]


            ]);
            $room_reservations = $this->RoomReservation->find('first',[ 'conditions'=> $cond ]);
            //pr($room_reservations); die;
            $referer = $this->referer();
            $this->set(compact('room_reservations','referer'));
        }else{
            $this->redirect(['controllers'=> 'roomreservation', 'action'=> 'myBookings']);
        }
    }


    public function viewReport(){
        $this->set('title', 'View Report');
        $hotels = $this->Hotel->find('all',[ 'fields'=>['id','title'], 'order'=>'title ASC' ]);
        $this->set('hotels', $hotels);
        
        $room_reservations = "";
        $customer_id = $this->Session->read('CustomerData.Customers.id');
        $cond = ['RoomReservation.user_id' => $customer_id];
        if (isset($this->request->data) && !empty($this->request->data)) {
            
            if(!empty($this->request->data['date_from'])){
                $date_from = date('Y-m-d', strtotime($this->request->data['date_from']));
                $cond[] = [ 'DATE(RoomReservation.check_in)' => $date_from ];
            }
            
            if(!empty($this->request->data['date_to'])){
                $date_to = date('Y-m-d', strtotime($this->request->data['date_to']));
                $cond[] = [ 'DATE(RoomReservation.check_out)' => $date_to ];
            }

            if(!empty($this->request->data['hotel_id'])){
                $cond[] = [ 'Hotel.id' => $this->request->data['hotel_id'] ];
            }

            if(!empty($this->request->data['payment_mode'])){
                $cond[] = [ 'RoomReservation.payment_mode' => $this->request->data['payment_mode'] ];
            }

            if(!empty($this->request->data['order_status'])){
                $cond[] = [ 'RoomReservation.order_status' => $this->request->data['order_status'] ];
            }

            $order = 'RoomReservation.id Desc';
            $this->RoomReservation->bindModel([
                'belongsTo'=>[
                    'Hotel'=>[
                        'className'=>'Hotel',
                        'foreignKey'=>'hotel_id'
                    ]
                ]
            ]);

            $room_reservations = $this->RoomReservation->find('all',[ 'conditions'=> $cond, 'group'=>['RoomReservation.booking_id'], 'order'=> $order ]);
        }

         
        $this->set(compact('room_reservations')); 
        if ($this->request->is('ajax')) {
            $this->layout = '';
            $this->viewPath = 'Elements' . DS . 'room_reservation';
            $this->render('listing');
        }
        
    }
  
}
