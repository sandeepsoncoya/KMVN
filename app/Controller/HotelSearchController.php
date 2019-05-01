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
App::uses('CakeEmail', 'Network/Email'); 
use Dompdf\Dompdf;

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link https://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class HotelSearchController   extends AppController {

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
    public function index(){
         $this->loadModel('Admin.BedTypeHotel');
        $this->loadModel('Admin.Hotel');
        $this->loadModel('Admin.BedType');
        $this->loadModel('Admin.RoomReservation');
        $this->loadModel('Admin.City');
        $this->loadModel('Admin.Room'); 
        $this->loadModel('Admin.Room'); 
        $this->loadModel('Admin.RoomImages'); 
        $this->loadModel('Admin.RoomSelectedFacility'); 
        $this->loadModel('Admin.RoomFacilityInfo'); 
        //debug($this->Session->read('HotelData')); die;
        $cityList =  $this->City->find('list',['conditions'=>['is_active'=>1]]);

        if (!empty($this->data['HotelSearch'])) {

             $cityId =   isset($this->data['HotelSearch']['city']) ? $this->data['HotelSearch']['city'] : '';
            $hotelId =  isset($this->data['HotelSearch']['hotel_select']) ? $this->data['HotelSearch']['hotel_select'] : '';
            $roomId =  isset($this->data['HotelSearch']['room_type']) ? $this->data['HotelSearch']['room_type']:'';
            $bedTypeId =  isset($this->data['HotelSearch']['bed_type']) ?$this->data['HotelSearch']['bed_type'] : '';
            $checkIn =  isset($this->data['HotelSearch']['check_in']) ?$this->data['HotelSearch']['check_in'] : '';
            $checkOut =  isset($this->data['HotelSearch']['check_out']) ? $this->data['HotelSearch']['check_out'] : '';
            $adultId =  isset($this->data['HotelSearch']['adult']) ? $this->data['HotelSearch']['adult'] : '';
            $childId =  isset($this->data['HotelSearch']['child']) ? $this->data['HotelSearch']['child'] :'';
            $guestId =  isset($this->data['HotelSearch']['guest']) ? $this->data['HotelSearch']['guest'] :'';
            $no_of_rooms =  isset($this->data['HotelSearch']['no_of_rooms']) ?$this->data['HotelSearch']['no_of_rooms'] :'';

            $this->Session->write('HotelData.userInputData',$this->data['HotelSearch']);
        }else{
             $userInputData =  $this->Session->read('HotelData.userInputData');
             $cityId =   isset($userInputData['city']) ? $userInputData['city'] : '';
             $hotelId =  isset($userInputData['hotel_select']) ? $userInputData['hotel_select'] : '';
             $roomId =  isset($userInputData['room_type']) ? $userInputData['room_type'] : '';
             $bedTypeId =  isset($userInputData['bed_type_id']) ? $userInputData['bed_type_id'] : '';
             $checkIn =  isset($userInputData['check_in']) ? $userInputData['check_in'] : '';
             $checkOut =  isset($userInputData['check_out']) ? $userInputData['check_out'] : '';
             $adultId =  isset($userInputData['no_of_adults']) ? $userInputData['no_of_adults'] : '';
             $childId =  isset($userInputData['no_of_childs']) ? $userInputData['no_of_childs'] : '';
             $no_of_rooms =  isset($userInputData['no_of_rooms']) ? $userInputData['no_of_rooms'] : '';
        }
        $conditions['hotel_id'] = $hotelId;
        $conditions['room_id'] = $roomId;
        $conditions['check_in >='] = $checkIn;
        $conditions['check_out <='] = $checkOut;
        $bookedHotel =  $this->RoomReservation->find('all',['conditions'=>$conditions]);

        $cityHotel = [];
        $rooms = [];
        $totalBookedRoom= [];
        if($cityId != ""){
            $cityHotel =  $this->Hotel->find('list',['conditions'=>['city'=>$cityId]]);
            $this->Room->bindModel([
                    'hasMany'=>[
                        'BedTypeHotel'=>[
                          'className'=>'Admin.BedTypeHotel',
                          'foreignKey'=>'room_id'
                        ],
                        
                    ],
        ]);

        $this->Room->recursive = 3;
            $rooms =  $this->Room->find('list',['conditions'=>['hotel_id'=>$hotelId],'fields'=>['id','room_type']]);
        }
        if(!empty($bookedHotel)){
            foreach($bookedHotel as $book){
                if(isset($totalBookedRoom[$book['RoomReservation']['bed_id']])){
                   $totalBookedRoom[$book['RoomReservation']['bed_id']] = $totalBookedRoom[$book['RoomReservation']['bed_id']] + $book['RoomReservation']['no_of_rooms'];  
               }else{
                 $totalBookedRoom[$book['RoomReservation']['bed_id']] = $book['RoomReservation']['no_of_rooms'];
               }
               
            }
        }
        $this->BedTypeHotel->bindModel([
            'belongsTo'=>[
                    'BedType'=>[
                    'className'=>'BedType',
                    'foreignKey'=>'bed_type',
                ]
            ],
        ]);
        $beds =  $this->BedTypeHotel->find('all',['conditions'=>['BedTypeHotel.room_id'=>$roomId]]);
        
        $HotelRooms =  $this->BedTypeHotel->find('all',['conditions'=>['room_id'=>$roomId]]);
        
        $betTypeArr = [];
        foreach ($HotelRooms as $hrooms) {
            $betTypeArr[] = $hrooms['BedTypeHotel']['bed_type'];
        }

        $bedTypeIds = implode(',', $betTypeArr);
     
        $HotelRooms =  $this->BedTypeHotel->find('all',['conditions'=>['room_id'=>$roomId,'bed_type'=>$betTypeArr]]);
        $availableRoom = [];
        foreach ($HotelRooms as $hotelRoom) {
            if(array_key_exists($hotelRoom['BedTypeHotel']['bed_type'], $totalBookedRoom)){

                $availRoom = $hotelRoom['BedTypeHotel']['no_of_rooms'] - $totalBookedRoom[$hotelRoom['BedTypeHotel']['bed_type']];
                
                if($no_of_rooms <= $availRoom){
                     $availableRoom = $hotelRoom['BedTypeHotel']['bed_type'];
                }
                   
            }else{
               
                if($no_of_rooms <= $hotelRoom['BedTypeHotel']['no_of_rooms']){
                     $availableRoom[] = $hotelRoom['BedTypeHotel']['bed_type'];
                }
            }
        }
        $cond['Hotel.id'] = $hotelId;
        //$cond['RoomReservation.check_in <='] = $checkIn;
        //$cond['RoomReservation.check_out >='] = $checkOut;
        $cond['Room.id'] = $roomId;
        $cond['BedType.id'] = $availableRoom;
      

            $bedJoin = array(
                            'table' => 'bed_type',
                            'alias' => 'BedType',
                            'type'  => 'LEFT',
                            'foreignKey' => false,
                            'conditions' => array(
                                'BedType.id = BedTypeHotel.bed_type',
                                
                            )
                        );
       

        //pr($cond); die;
        $options=array(
            'joins'  => array(
                            
                             array(
                                'table' => 'room',
                                'alias' => 'Room',
                                'type'  => 'LEFT',
                                'foreignKey' => false,
                                'conditions' => array(
                                    'Room.hotel_id = Hotel.id'
                                )
                            ),
                            array(
                                'table' => 'bed_type_hotel',
                                'alias' => 'BedTypeHotel',
                                'type'  => 'LEFT',
                                'foreignKey' => false,
                                'conditions' => array(
                                    'BedTypeHotel.room_id = Room.id'
                                )
                            ),
                            
                            $bedJoin,
                            array(
                                'table' => 'seasion_rate',
                                'alias' => 'SeasionRate',
                                'type'  => 'LEFT',
                                'foreignKey' => false,
                                'conditions' => array(
                                    'SeasionRate.hotel_id = Hotel.id',
                                    'SeasionRate.valid_from <='=>date('Y-m-d'),
                                    'SeasionRate.valid_to >='=>date('Y-m-d'),
                                    'SeasionRate.is_active'=>1
                                )
                            ),
                            array(
                                'table' => 'room_rates',
                                'alias' => 'RoomRates',
                                'type'  => 'LEFT',
                                'foreignKey' => false,
                                'conditions' => array(
                                    'RoomRates.hotel_id = Hotel.id',
                                    'RoomRates.season_id = SeasionRate.id',
                                    'RoomRates.room_id = Room.id',
                                    'RoomRates.bed_type_id = BedType.id'
                                )
                            ),
                            array(
                                'table' => 'room_images',
                                'alias' => 'RoomImages',
                                'type'  => 'LEFT',
                                'foreignKey' => false,
                                'conditions' => array(
                                    'RoomImages.bed_type_id = BedTypeHotel.id'
                                )
                            ),
                            array(
                                'table' => 'room_selected_facility',
                                'alias' => 'RoomSelectedFacility',
                                'type'  => 'LEFT',
                                'foreignKey' => false,
                                'conditions' => array(
                                    'RoomSelectedFacility.bed_type_id = BedType.id'
                                )
                            ),
                            array(
                                'table' => 'room_facility_info',
                                'alias' => 'RoomFacilityInfo',
                                'type'  => 'LEFT',
                                'foreignKey' => false,
                                'conditions' => array(
                                    'RoomFacilityInfo.room_facility_id = RoomSelectedFacility.facility_info_id'
                                )
                            ),
                            array(
                                'table' => 'room_facility',
                                'alias' => 'RoomFacility',
                                'type'  => 'LEFT',
                                'foreignKey' => false,
                                'conditions' => array(
                                    'RoomFacilityInfo.room_facility_id = RoomFacility.id'
                                )
                            )
                        ),

            'fields' => ['Hotel.id','Hotel.city','Room.id','Room.room_type','Room.hotel_id','BedTypeHotel.id','BedTypeHotel.room_id','BedTypeHotel.bed_type','BedTypeHotel.no_of_rooms','BedType.id','BedType.title','BedType.adult_beds','BedType.child_beds','SeasionRate.id','RoomRates.id','RoomRates.adult_one_rate','RoomRates.extra_bed','RoomRates.adult_one_tax','RoomRates.extra_bed_tax','RoomRates.deposit_required','RoomRates.is_deposit_refundable','Room.description','RoomImages.file','RoomSelectedFacility.bed_type_id','RoomSelectedFacility.id','RoomFacility.id','RoomFacility.title','RoomFacilityInfo.room_facility_id','RoomFacilityInfo.title'],
            'conditions' => $cond
        );
        $getHotelData = $this->Hotel->find('all',  $options );
        //debug($getHotelData); die;
        
        $this->set(compact('availableBeds','Roomfacility','availableRoom','roomImages','cityList','cityId','cityHotel','hotelId','checkIn','checkOut','rooms','roomId','bedlist','bedTypeId','no_of_rooms','adultId','childId','guestId','getHotelData'));
    }

    public function services()
    {
        $this->loadModel('Admin.Services');
        $this->loadModel('Admin.HotelExtraService');
        $user_input_data = $this->Session->read('HotelData.userInputData');
        if (!$this->Session->read('HotelData.RoomSelected')) {
            $this->redirect(array('controller'=>'hotel_search','action' => 'index'));
        } else{
            $hotel_id = $user_input_data['hotel_select'];
            $this->HotelExtraService->bindModel([
                    'belongsTo'=>[
                        'Services'=>[
                          'className'=>'Admin.Services',
                          'foreignKey'=>'service_id'
                        ]
                    ],
             ]);
            $this->HotelExtraService->recursive = 2;
            $services = $this->HotelExtraService->find('all',['conditions'=>['HotelExtraService.hotel_id'=>$hotel_id]]);
        }
        
        $this->set(compact('services'));
    }

    public function review()
    {
        $this->loadModel('Admin.RoomCancellation');
        $this->loadModel('Admin.BedType');
        $this->loadModel('Admin.RoomRates');

        $user_input_data = $this->Session->read('HotelData.userInputData');
        if (!$this->Session->read('HotelData.RoomSelected')) {
            $this->redirect(array('controller'=>'hotel_search','action' => 'index'));
        } else{

            $userServices = $this->Session->read('HotelData.userServices');
            $HotelData = $this->Session->read('HotelData.RoomSelected');
           
            if(!empty($HotelData)){
                foreach($HotelData as $room){
                    
                    $room_id = $room['room_id'];
                    $rateId = $room['rate_id'];
                    $bedType = $this->BedType->find('first',['conditions'=>['id'=>$room['bed_type_id']]]);
                    $roomRate = $this->RoomRates->find('first',['conditions'=>['id'=>$rateId]]);
                    
                    $HotelData[$room['bed_type_id']]['roomcancel'] = $this->RoomCancellation->find('all',['conditions'=>['room_id'=>$room['room_id'],'rate_id'=>$room['rate_id']],'order'=>['days'=>'ASC']]);
                    
                    $HotelData[$room['bed_type_id']]['bedType'] = $bedType;
                    $HotelData[$room['bed_type_id']]['RoomRates'] = $roomRate;
                }
            }
        }
        $this->set(compact('userServices', 'HotelData'));

    }

    public function travellers()
    {
        $this->loadModel('Admin.RoomCancellation');
        $this->loadModel('Admin.BedType');
        $this->loadModel('Admin.RoomRates');
        $this->Session->write('HotelData.terms', $this->request->data);
        $user_input_data = $this->Session->read('HotelData.userInputData');
        if (!$this->Session->read('HotelData.RoomSelected')) {
            $this->redirect(array('controller'=>'hotel_search','action' => 'index'));
        } else{

            $userServices = $this->Session->read('HotelData.userServices');
            $HotelData = $this->Session->read('HotelData.RoomSelected');
            
            if(!empty($HotelData)){
                foreach($HotelData as $room){
                    $room_id = $room['room_id'];
                    $rateId = $room['rate_id'];
                    $bedType = $this->BedType->find('first',['conditions'=>['id'=>$room['bed_type_id']]]);
                    $roomRate = $this->RoomRates->find('first',['conditions'=>['id'=>$rateId]]);
                    $HotelData[$room['bed_type_id']]['adult'] = isset($this->data['Room']['adult'][$room['bed_type_id']]) ? $this->data['Room']['adult'][$room['bed_type_id']] :'';
                    $HotelData[$room['bed_type_id']]['child'] =isset($this->data['Room']['child'][$room['bed_type_id']]) ? $this->data['Room']['child'][$room['bed_type_id']] : '';
                    $HotelData[$room['bed_type_id']]['roomcancel'] = $this->RoomCancellation->find('all',['conditions'=>['room_id'=>$room['room_id'],'rate_id'=>$room['rate_id']],'order'=>['days'=>'ASC']]);
                    $HotelData[$room['bed_type_id']]['bedType'] = $bedType;
                    $HotelData[$room['bed_type_id']]['RoomRates'] = $roomRate;
                    $this->Session->write('HotelData.RoomSelected',$HotelData);
                }
            }
        }

        $this->set(compact('userServices', 'HotelData'));
    }

    public function payment()
    {
        $this->loadModel('Admin.TravelerDetails');
        $this->loadModel('Admin.TravelerContactDetails');
        $this->loadModel('Admin.RoomReservation');
        $this->loadModel('Admin.BookedExtraServices');
        $this->loadModel('Admin.Hotel');
        $this->loadModel('Admin.Room');
        $this->loadModel('Admin.BedType');
        $this->loadModel('Admin.RoomRates');
        if (isset($this->request->data['Booking']) && !empty($this->request->data['Booking']['bookingid'])) {
            $bookingid = $this->request->data['Booking']['bookingid'];
        }else{
            $bookingid = substr(uniqid(rand(), true), 6,6);
            $bookingid =  strtoupper('KMVN'.$bookingid);
        }
        $travellers = $this->request->data['Travellers'];
       
        $travellersDetails = $this->request->data['TravellersDetails'];

        $this->Session->write('HotelData.travellers', $travellers);
        $this->Session->write('HotelData.travellersDetails', $travellersDetails);
        $HotelData = $this->Session->read('HotelData.RoomSelected');
        if ($this->Session->read('CustomerData.Customers.id') != null) {
            $user_id = $this->Session->read('CustomerData.Customers.id');
        }else{
            $user_id = null;
        }
      
        if (!empty($HotelData)) {
            $gTotal = 0; 
           
            
            foreach($HotelData as $data){
                $HotelDetails =  $this->Hotel->find('first',['conditions'=>['id'=>$data['hotel_id']]]);
                $hotelName = $HotelDetails['Hotel']['title'];
                $rateId = $data['rate_id'];
               
                $roomRate = $this->RoomRates->find('first',['conditions'=>['id'=>$rateId]]);

                $date1 = new DateTime($data['check_in_date']);
                $date2 = new DateTime($data['check_out_date']);
                $numberOfNights= $date2->diff($date1)->format("%a"); 
                $adultrate = (($data['no_of_rooms']) * ($roomRate['RoomRates']['adult_one_rate']))*$numberOfNights;
                $taxrate = (($data['no_of_rooms']) * ($roomRate['RoomRates']['adult_one_tax']))*$numberOfNights;
                $total = $adultrate + $taxrate;
                $userServices = $this->Session->read('HotelData.userServices');
                $extra = 0;
                if (isset($userServices) && !empty($userServices)) {
                    foreach ($userServices as $key => $userService) { 
                        $extra += $userService['Services']['price'] + $userService['Services']['tax'] * $userService['Services']['qty'];
                    }
                }
                $totalPayable = $adultrate + $taxrate + $extra;
                if(isset($data['extraBed'])==1){
                    $totalPayable = $totalPayable + $data['totalExtraBedChnage'];
                     $extra_bed_charge = $data['totalExtraBedChnage'];
                }else{
                    $extra_bed_charge = 0;
                }
                $gTotal = $gTotal + $totalPayable;
                $RoomDetails =  $this->Room->find('first',['conditions'=>['id'=>$data['room_id']]]);
                $room_typeName = $RoomDetails['Room']['room_type'];
                $BedTypeDetails =  $this->BedType->find('first',['conditions'=>['id'=>$data['bed_type_id']]]);
                $BedTypeName = $BedTypeDetails['BedType']['title'];
                $bookingData['booking_id'] = $bookingid;
                $bookingData['hotel_id'] = $data['hotel_id'] ;
                $bookingData['bed_id'] = $data['bed_type_id'] ;
                $bookingData['extra_bed_charge'] = $extra_bed_charge;
                $bookingData['room_id'] = $data['room_id'] ;
                $bookingData['check_in'] = $data['check_in_date'] ;
                $bookingData['check_out'] = $data['check_out_date'] ;
                $bookingData['no_of_rooms'] = $data['no_of_rooms'] ;
                $bookingData['room_rate'] =  $adultrate;
                $bookingData['tax'] = $taxrate;
                $bookingData['extra_service_charge'] = $extra;
                $bookingData['total_amount'] = $this->request->data['totalAmountToPay'];
                $bookingData['user_id'] = $user_id;
                $bookingData['hotel_name'] = $hotelName;
                $bookingData['room_type'] = $room_typeName;
                $bookingData['bed_type_name'] = $BedTypeName;
                $bookingData['adults'] = 1;
                $bookingData['child'] =1 ;
                $this->RoomReservation->set($bookingData); 
                $this->RoomReservation->create();
                if ($this->RoomReservation->save($bookingData)) {
                    $room_reservation_id = $this->RoomReservation->getLastInsertId();
                     if (isset($userServices) && !empty($userServices)) {
                        foreach ($userServices as $key => $userService) { 
                            $bookedExtraService['service_id'] = $userService['Services']['id'] ;
                            $bookedExtraService['room_reservation_id'] = $room_reservation_id;
                            $bookedExtraService['amount'] = $userService['Services']['price'];
                            $bookedExtraService['tax'] = $userService['Services']['tax'] ;
                            $bookedExtraService['total'] = $userService['Services']['total_price'] ;
                            $bookedExtraService['name'] = $userService['Services']['title'] ;
                            $this->BookedExtraServices->set($bookedExtraService); 
                            $this->BookedExtraServices->create();  
                            $this->BookedExtraServices->save($bookedExtraService);
                        }
                    }
                }
            }   
           
        }

        if (!empty($travellers)) {
            $travellers['booking_id'] = $bookingid;
            $this->TravelerDetails->set($travellers); 
            $this->TravelerDetails->create();   
            $this->TravelerDetails->save($travellers);
            
        }
        
        if (!empty($travellersDetails)) {
            $travellersDetails['booking_id'] = $bookingid ;
            $this->TravelerContactDetails->set($travellersDetails); 
            $this->TravelerContactDetails->create();  
            $this->TravelerContactDetails->save($travellersDetails);
        }
       
        if (isset($this->request->data['paymentOption']) && $this->request->data['paymentOption']  == 'Gateway') {

           $returnData =  $this->_paymentprocess($bookingid,$gTotal,$this->request->data);
          $this->set(compact('returnData'));
         
             
        }elseif(isset($this->request->data['paymentOption']) && $this->request->data['paymentOption']  == 'Wallet'){
            $this->autoRender= false;
            $returnData =  $this->_paymentwallet($bookingid,$gTotal,$this->request->data);
            if ($returnData == true) {
                $this->redirect(['controller'=>'booking','action'=>'thanks',$bookingid]);
            }else{
               $this->redirect(['controller'=>'booking','action'=>'cancel',$bookingid]); 
            }

        }elseif((isset($this->request->data['paymentOption']) && $this->request->data['paymentOption']  == 'BookingId' ) || (isset($this->request->data['paymentOption']) && $this->request->data['paymentOption']  == 'Wallet')){ 

            $this->autoRender= false;
            $this->_paymentBookingId($bookingid,$this->request->data);
            $this->render('doc_invoice');

        }
        
    }
    private function _paymentprocess($bookingid,$totalPayable,$requestData){

        $merchant_data = Configure::read('merchant_id');
        $working_key = Configure::read('working_key');
        $access_code = Configure::read('access_code'); 
        $redirectUrl = Configure::read('siteUrlfront').'booking/'.Configure::read('redirect_url'); 
        $cancelUrl = Configure::read('siteUrlfront').'booking/'.Configure::read('cancel_url'); 
      
        $postData['city'] =  $requestData['TravellersDetails']['city'];
        $postData['pin_code'] =  $requestData['TravellersDetails']['pin_code'];
        $postData['mobile_no'] =  $requestData['TravellersDetails']['mobile_no'];
        $postData['email_id'] =  $requestData['TravellersDetails']['email_id'];
        $postData['address_1'] =  $requestData['TravellersDetails']['address_1'];
        $postData['title'] =  $requestData['Travellers']['title'];
        $postData['first_name'] =  $requestData['Travellers']['first_name'];
        $postData['last_name'] =  $requestData['Travellers']['last_name'];

        $postData["redirect_url"] = $redirectUrl;
        $postData["cancel_url"] = $cancelUrl;
        $postData["currency"] = "INR";
        $postData["language"] = "EN";
        $postData["amount"] = $requestData['totalAmountToPay'];
        $postData["merchant_id"] = Configure::read('merchant_id');
        $postData["order_id"] = $bookingid;

        foreach ($postData as $key => $value) {
            $merchant_data .= $key . '=' . urlencode($value) . '&';
        }

        $encrypted_data = $this->encrypt($merchant_data, $working_key); // Method for 
        $returnArr['encrypted_data'] = $encrypted_data;
        $returnArr['access_code'] = $access_code;
        return $returnArr;

    }

    private function _paymentwallet($bookingid,$totalPayable,$requestData){
        if ($this->Session->read('CustomerData.Customers.id') != null) {
            $this->loadModel('Admin.UserWallets');
            $user_id = $this->Session->read('CustomerData.Customers.id');
            $walletbooking['amount_type'] = 'debit' ;
            $walletbooking['amount'] = $totalPayable ;
            $walletbooking['company_user_id'] = $user_id ;
            $walletbooking['description'] = "Booking for $bookingid id" ;
            $this->UserWallets->set($walletbooking); 
            $this->UserWallets->create();  
            $this->UserWallets->save($walletbooking);
            $this->doc_invoice($bookingid,$requestData);
           }

    }
    
    private function _paymentBookingId($bookingid,$requestData){

         $user_id = $this->Session->read('CustomerData.Customers.id');
         $user_type = $this->Session->read('CustomerData.Customers.is_gsa');
         $this->doc_invoice($bookingid,$requestData);
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

    public function doc_invoice($bookingid,$requestData) { 
            $HotelData = $this->Session->read('HotelData');
            $this->siteSettings = $this->siteSettings();
            $siteSettings =$this->siteSettings;    
            $this->loadModel('Admin.RoomReservation');
            $sitephone = '';
            if ($siteSettings['SiteSettings']['phone']) {
                 $sitephone =  $siteSettings['SiteSettings']['phone'];
            } 
            $this->layout = 'pdf';
            ini_set('memory_limit', '512M');
            set_time_limit(0);
            $siteUrlfront = Configure::read('siteUrlfront');
            $logo = $siteUrlfront.'app/webroot/images/logo_pdf.png';
            $this->loadModel('Admin.Hotel');
            $HotelData =  $this->Session->read('HotelData');
            $userServices = $this->Session->read('HotelData.userServices');

            $cityHotel =  $this->Hotel->find('first',['conditions'=>['id'=>$HotelData['userInputData']['hotel_select']]]);
            $hotel_name = $cityHotel['Hotel']['title'];

            $this->set(compact('HotelData','logo','sitephone', 'hotel_name','HotelData','bookingid'));



    }


    public function sendIdInvoice($documentName=null, $order_id = null){

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
                $this->redirect(['controller'=>'HotelSearch','action'=>'thanks',$order_id]);
            } else{
                return false;
            }       
        }else{
            return false;
        }
    }


  
}
