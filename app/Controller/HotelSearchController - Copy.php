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
        $cityId =  $this->data['HotelSearch']['city'];
        $hotelId =  $this->data['HotelSearch']['hotel_select'];
        $roomId =  $this->data['HotelSearch']['room_type'];
        $bedTypeId =  $this->data['HotelSearch']['bed_type'];
        $checkIn =  $this->data['HotelSearch']['check_in'];
        $checkOut =  $this->data['HotelSearch']['check_out'];
        $adultId =  $this->data['HotelSearch']['adult'];
        $childId =  $this->data['HotelSearch']['child'];
        $guestId =  $this->data['HotelSearch']['guest'];
        $no_of_rooms =  $this->data['HotelSearch']['no_of_rooms'];
        $conditions['hotel_id'] = $hotelId;
        $conditions['room_id'] = $roomId;
        $conditions['bed_id'] = $bedTypeId;
        $conditions['check_in <='] = $checkOut;
        $conditions['check_out >='] = $checkIn;
        $bookedHotel =  $this->RoomReservation->find('all',['conditions'=>$conditions]);
      
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

        $this->BedTypeHotel->bindModel([
                    'belongsTo'=>[
                        'BedType'=>[
                          'className'=>'Admin.BedType',
                          'foreignKey'=>'bed_type'
                        ],
                        
                    ],
        ]);

        $this->BedType->bindModel([
                    'hasMany'=>[
                        'RoomSelectedFacility'=>[
                          'className'=>'Admin.RoomSelectedFacility',
                          'foreignKey'=>'bed_type_id'
                        ],
                        'RoomImages'=>[
                          'className'=>'Admin.RoomImages',
                          'foreignKey'=>'bed_type_id'
                        ],
                        
                    ],
                   
        ]);
        $this->Room->recursive = 3;
            $rooms =  $this->Room->find('list',['conditions'=>['hotel_id'=>$hotelId],'fields'=>['id','room_type']]);
        }

       /* $this->Room->recursive = 3;
            $rooms =  $this->Room->find('list',[
                'conditions'=>['hotel_id'=>$hotelId],
                'keyField'=>'id',
                'valueField'=>'name',
                'fields'=>['id','name' => "CONCAT(Room.room_type, ' ', BedType.title)"]]);

            pr($rooms); die;*/
        
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
               
        if(!empty($beds)) {
           
            $bedlist = [];
            $adult = [];
            $guest = [];
            $child = [];
            foreach($beds as $bed){
                $bedlist[$bed['BedType']['id']] = $bed['BedType']['title'];
                $adult[] = $bed['BedType']['adult_beds'];
                $guest[] = $bed['BedType']['extra_beds'];
                $child[] = $bed['BedType']['child_beds'];
                
            }

            $adult =  max($adult);
            $guest =  max($guest);
            $child =  max($child);
            $adultSelect =[];
            if($adult>0){
                for($i = 1;$i<=$adult;$i++){
                    $adultSelect[$i] =$i;
                }
            }
            $guestSelect =[];
            if($guest>0){
                for($i = 1;$i<=$guest;$i++){
                    $guestSelect[$i] =$i;
                }
            }
            $childSelect =[];
            if($child>0){
                for($i = 1;$i<=$child;$i++){
                    $childSelect[$i] =$i;
                }
            }
         
           
           
        }
        
        $HotelRooms =  $this->BedTypeHotel->find('first',['conditions'=>['room_id'=>$roomId,'bed_type'=>$bedTypeId]]);
     
        $totalRoom =  $HotelRooms['BedTypeHotel']['no_of_rooms'];
        $availableRoom =$totalRoom-$totalBookedRoom;
       
		if($availableRoom > 0){
            $this->BedTypeHotel->bindModel([
                'belongsTo'=>[
                        'BedType'=>[
                        'className'=>'BedType',
                        'foreignKey'=>'bed_type',
                    ]
                ],
            ]);
            $availableBeds =  $this->BedTypeHotel->find('first',['conditions'=>['BedTypeHotel.room_id'=>$roomId,'BedTypeHotel.bed_type'=>$bedTypeId]]);
            $availableRoom =  $this->Room->find('first',['conditions'=>['id'=>$roomId]]);
            $roomImages = $this->RoomImages->find('all',['conditions'=>['bed_type_id'=>$bedTypeId]]);
            $this->RoomSelectedFacility->bindModel([
                'belongsTo'=>[
                        'RoomFacilityInfo'=>[
                        'className'=>'RoomFacilityInfo',
                        'foreignKey'=>'facility_info_id',
                    ]
                ],
            ]);
            $Roomfacility = $this->RoomSelectedFacility->find('all',['conditions'=>['bed_type_id'=>$bedTypeId]]);
            //pr($availableBeds); die;
        }else{

        }
        //echo $childId; die;
        $this->set(compact('availableBeds','Roomfacility','availableRoom','roomImages','cityList','cityId','cityHotel','hotelId','checkIn','checkOut','rooms','roomId','bedlist','bedTypeId','no_of_rooms','adultSelect','adultId','childId','guestId','childSelect','guestSelect'));
    }

    
  
}
