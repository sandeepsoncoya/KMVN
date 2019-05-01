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

        $cityList =  $this->City->find('list',['conditions'=>['is_active'=>1]]);
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
        $conditions['hotel_id'] = $hotelId;
        $conditions['room_id'] = $roomId;
        $conditions['check_in <='] = $checkOut;
        $conditions['check_out >='] = $checkIn;
        $bookedHotel =  $this->RoomReservation->find('all',['conditions'=>$conditions]);
        $cityHotel = [];
        $rooms = [];
        $totalBookedRoom =  0;
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
                $totalBookedRoom +=$book['RoomReservation']['no_of_rooms'];
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
        foreach ($HotelRooms as $rooms) {
            $betTypeArr[] = $rooms['BedTypeHotel']['bed_type'];
        }

        $bedTypeIds = implode(',', $betTypeArr);
     
        $totalRoom =  20;

        $availableRoom =$totalRoom-$totalBookedRoom;

        $cond['Hotel.id'] = $hotelId;
        $cond['RoomReservation.check_in <='] = $checkIn;
        $cond['RoomReservation.check_out >='] = $checkOut;
        $cond['Room.id'] = $roomId;
        if($availableRoom > 0){
            $bedJoin = array(
                            'table' => 'bed_type',
                            'alias' => 'BedType',
                            'type'  => 'LEFT',
                            'foreignKey' => false,
                            'conditions' => array(
                                'BedType.id = BedTypeHotel.bed_type'
                            )
                        );
        }else{

            $bedJoin = array(
                            'table' => 'bed_type',
                            'alias' => 'BedType',
                            'type'  => 'INNER',
                            'foreignKey' => false,
                            'conditions' => array(
                                'BedType.id = BedTypeHotel.bed_type',
                                'BedType.id = 0'
                            )
                        );
        }


        $options=array(
            'joins'  => array(
                            array(
                                'table' => 'room_reservation',
                                'alias' => 'RoomReservation',
                                'type'  => 'LEFT',
                                'foreignKey' => false,
                                'conditions' => array(
                                    'RoomReservation.hotel_id = Hotel.id'
                                )
                            ),
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
                            $bedJoin
                        ),

            'fields' => ['Hotel.id','RoomReservation.id','RoomReservation.check_in','RoomReservation.check_out','RoomReservation.room_id','Room.id','Room.room_type','Room.hotel_id','BedTypeHotel.id','BedTypeHotel.room_id','BedTypeHotel.bed_type','BedTypeHotel.no_of_rooms','BedType.id','BedType.title','BedType.adult_beds'],
            'conditions' => [$cond]
        );

        $getHotelData = $this->Hotel->find('all',  $options );
        echo "-->"; pr($getHotelData); die;
        
        $this->set(compact('availableBeds','Roomfacility','availableRoom','roomImages','cityList','cityId','cityHotel','hotelId','checkIn','checkOut','rooms','roomId','bedlist','bedTypeId','no_of_rooms','adultId','childId','guestId'));
    }

    
  
}
