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
class HotelsController  extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();
 public $helpers = array("App");
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
        //$this->loadComponent('Basic');
       
        $this->siteSettings = $this->siteSettings();
        $logo = Configure::read('AbsoluteUrl').'SiteSettings/'.$this->siteSettings['SiteSettings']['logo'];
        $siteSettings =$this->siteSettings;
        $this->loadModel('Activities');
        $activityList = $this->Activities->find('all',['conditions'=>['is_active'=>1]]);
        $this->set(compact('siteSettings','logo','activityList'));
        
    }
	
	
	
    public function index(){
         $page = Configure::read('pagecount');
         $this->Hotel->bindModel([
                    'hasMany'=>[
                        
                        'HotelHighlightSelected'=>[
                            'className'=>'HotelHighlightSelected',
                            'foreignKey'=>'hotel_id'
                        ],
                        
                        'HotelAttraction'=>[
                            'className'=>'HotelAttraction',
                            'foreignKey'=>'hotel_id'
                        ],
                        
                    ],
                    
                ]);
                $this->HotelHighlightSelected->bindModel([
                    'belongsTo'=>[
                        'HotelHighlight'=>[
                          'className'=>'Admin.HotelHighlight',
                          'foreignKey'=>'highlight_id'
                        ],
                        
                    ],
                ]);

                $this->HotelAttraction->bindModel([
                    'belongsTo'=>[
                        'Attraction'=>[
                          'className'=>'Admin.Attraction',
                          'foreignKey'=>'attraction_id'
                        ],
                        
                    ],
                ]);

       $this->Hotel->recursive = 3;
       $hotels =  $this->Hotel->find('all',['conditions'=>['Hotel.is_active'=>1],'order'=>['created'=>'DESC'], 'limit' => $page]);
       $hotelALl =  $this->Hotel->find('all',['conditions'=>['Hotel.is_active'=>1],'order'=>['created'=>'DESC']]);
       $allcount = sizeof($hotelALl);

        $this->set(compact('hotels','allcount'));
    }


	public function details() {
        $this->Hotel->bindModel([
                    'hasMany'=>[
                        'HotelImages'=>[
                          'className'=>'HotelImages',
                          'foreignKey'=>'hotel_id',
                        ],
                        'HotelHighlightSelected'=>[
                            'className'=>'HotelHighlightSelected',
                            'foreignKey'=>'hotel_id'
                        ],
                        'HowToReach'=>[
                            'className'=>'HowToReach',
                            'foreignKey'=>'perent_id'
                        ],
                        'HotelAttraction'=>[
                            'className'=>'HotelAttraction',
                            'foreignKey'=>'hotel_id'
                        ]
                        ,'HotelFacilitiesSelected'=>[
                            'className'=>'HotelFacilitiesSelected',
                            'foreignKey'=>'hotel_id'
                        ],
                        'Room'=>[
                            'className'=>'Room',
                            'foreignKey'=>'hotel_id'
                        ],
                        'HotelExtraService'=>[
                            'className'=>'HotelExtraService',
                            'foreignKey'=>'hotel_id'
                        ],
                        
                        
                    ],

                    
        ]);

        $this->HotelFacilitiesSelected->bindModel([
                    'belongsTo'=>[
                        'HotelFacilitiesInfo'=>[
                          'className'=>'Admin.HotelFacilitiesInfo',
                          'foreignKey'=>'faclities_id'
                        ],
                        
                    ],
        ]);
                  
        $this->HotelHighlightSelected->bindModel([
                    'belongsTo'=>[
                        'HotelHighlight'=>[
                          'className'=>'Admin.HotelHighlight',
                          'foreignKey'=>'highlight_id'
                        ],
                        
                    ],
        ]);

        $this->HotelAttraction->bindModel([
                    'belongsTo'=>[
                        'Attraction'=>[
                          'className'=>'Admin.Attraction',
                          'foreignKey'=>'attraction_id'
                        ],
                        
                    ],
        ]);

        $this->HotelExtraService->bindModel([
                    'belongsTo'=>[
                        'Services'=>[
                          'className'=>'Admin.Services',
                          'foreignKey'=>'service_id'
                        ],
                        
                    ],
        ]);
               
        $this->Hotel->recursive = 5;
        $hotelDetails = $this->Hotel->findBySlug($this->request->params['pass'][0]);
        $hotelid = $hotelDetails['Hotel']['id'];
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
                        ]
                        
                    ],
                    'hasMany'=>[
                        
                        'RoomImages'=>[
                          'className'=>'Admin.RoomImages',
                          'foreignKey'=>'bed_type_id'
                        ],
                        
                    ]
        ]);

        $this->BedType->bindModel([
                    'hasMany'=>[
                        'RoomSelectedFacility'=>[
                          'className'=>'Admin.RoomSelectedFacility',
                          'foreignKey'=>'bed_type_id'
                        ]
                        
                    ],
                   
        ]);

        $this->RoomSelectedFacility->bindModel([
                    'hasMany'=>[
                        'RoomFacilityInfo'=>[
                          'className'=>'Admin.RoomFacilityInfo',
                          'foreignKey'=>''
                        ],
                        
                    ],
        ]);

        $this->RoomFacilityInfo->bindModel([
                    'belongsTo'=>[
                        'RoomFacility'=>[
                          'className'=>'Admin.RoomFacility',
                          'foreignKey'=>'room_facility_id'
                        ],
                        
                    ],
        ]);

        $this->Room->recursive = 5;
        $room  = $this->Room->find('all',['conditions'=>['Room.hotel_id'=>$hotelid]]);
        $this->Hotel->bindModel([
                    'belongsTo'=>[
                        'SeasionRate'=>[
                          'className'=>'Admin.SeasionRate',
                          'foreignKey'=>'hotel_id'
                        ],
                        
                    ],
        ]);
        $date = date('Y-m-d');
        $seasionRate  = $this->SeasionRate->find('first',['conditions'=>['valid_from <='=>$date,'valid_to >='=>$date,'hotel_id'=>$hotelid]]);

         
        $this->set(compact('hotelDetails','room','hotelid','seasionRate'));
    }
    public function search(){
        //pr($this->request->data); die;
    }
   
}
