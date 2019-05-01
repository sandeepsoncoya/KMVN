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
class AjaxController   extends AppController {
    public $components = array('Email');
    public $helpers = array("App");
    public function beforeFilter() {

    }

    public function addServices(){
        if($this->request->is('ajax')){
            $this->autoRender = false;
             $this->layout = 'ajax';
             if(isset($this->request->data['serviceid'])){
                $userServices = [];
                $service_id = $this->request->data['serviceid'];
                 $this->loadModel("Admin.Services");
                 $services = $this->Services->find('first',['conditions'=>['Services.id'=>$this->request->data['serviceid']]]);
                 $services['Services']['qty'] = $this->request->data['qty'];

                 $data = $this->Session->read('HotelData.userServices');
                 $data[$service_id] = $services;
                $this->Session->write('HotelData.userServices', $data);

                $data['res'] = true;
                echo json_encode($data); die;
            }
        }
    }

    public function removeServices(){
        if($this->request->is('ajax')){
            $this->autoRender = false;
             $this->layout = 'ajax';
             if(isset($this->request->data['serviceid'])){
                $service_id = $this->request->data['serviceid'];
                   $data = $this->Session->read('HotelData.userServices');
                  unset($data[$service_id]);
                $this->Session->write('HotelData.userServices', $data);
                $data['res'] = true;
                echo json_encode($data); die;
             }
        }
    }

     public function loadmore(){
        $page = Configure::read('pagecount');
        if($this->request->is('ajax')){
             $this->layout = 'ajax';
             if(isset($this->request->data['row'])){
                 $this->loadModel("Admin.TourPackage");
                $tourPackages =  $this->TourPackage->find('all',['conditions'=>['TourPackage.is_active'=>1],'order'=>['created'=>'DESC'],'offset'=>$this->request->data['row'],'limit' => $page]);
             }
            $this->set(compact('tourPackages'));
            $this->render('loadmore');
        }
    }

public function loadhoteldetails(){
        if($this->request->is('ajax')){
             $this->layout = 'ajax';
             if(isset($this->request->data['bed_type_id'])){
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
                      //  $this->BedType->recursive = 3;

               // $bedTypes =  $this->BedType->find('first',['conditions'=>['BedType.id'=>$this->request->data['bed_type_id']]]);

                $this->BedTypeHotel->recursive = 3;

                $room  = $this->Room->find('all',['conditions'=>['Room.id'=>$this->request->data['roomid']]]);


                $roomdata  = $this->BedTypeHotel->find('all',['conditions'=>['BedTypeHotel.bed_type'=>$this->request->data['bed_type_id'],'BedTypeHotel.room_id'=>$this->request->data['roomid']]]);
                $this->BedTypeHotel->bindModel([
                    'belongsTo'=>[
                        'BedType'=>[
                          'className'=>'Admin.BedType',
                          'foreignKey'=>'bed_type'
                        ],
                        
                    ],
                ]);

                $this->BedTypeHotel->recursive = 1;
                $bedTypeHotel  = $this->BedTypeHotel->find('all',['conditions'=>['BedTypeHotel.room_id'=>$this->request->data['roomid']]]);

                $bed_type_id = $this->request->data['bed_type_id'];
                $hotelid = $this->request->data['hotelid'];
                $hotelCity  = $this->Hotel->find('first',['conditions'=>['Hotel.id'=>$this->request->data['hotelid']]]);
             }
            $this->set(compact('bedTypes','room','roomdata','bed_type_id','hotelid','bedTypeHotel','hotelCity'));
            $this->render('loadhoteldetails');
        }

    }

    public function loadmorehotels(){
        if($this->request->is('ajax')){
             $this->layout = 'ajax';
             if(isset($this->request->data['row'])){
                $this->loadModel('Admin.Hotel');
                $this->loadModel('Admin.HotelFacilities');
                $this->loadModel('Admin.HotelHighlight');
                $this->loadModel('Admin.HotelHighlightSelected');
                $this->loadModel('Admin.HotelAttraction');
                $this->loadModel('Admin.Attraction');
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
                $page = Configure::read('pagecount');
                $this->Hotel->recursive = 3;

                $hotels =  $this->Hotel->find('all',['conditions'=>['Hotel.is_active'=>1],'order'=>['created'=>'DESC'],'offset'=>$this->request->data['row'],'limit' => $page]);
             }
            $this->set(compact('hotels'));
            $this->render('loadmorehotels');
        }

    }

    public function loadmoredest(){
        $page = Configure::read('pagecount');
        if($this->request->is('ajax')){
             $this->layout = 'ajax';
             if(isset($this->request->data['row'])){
                 $this->loadModel("Admin.Destination");
                $destinations =  $this->Destination->find('all',['conditions'=>['Destination.is_active'=>1],'order'=>['created'=>'DESC'],'offset'=>$this->request->data['row'],'limit' => $page]);
             }
            $this->set(compact('destinations'));
            $this->render('loadmoredest');
        }

    }

    public function loadmorebanquet(){
        $page = Configure::read('pagecount');
        if($this->request->is('ajax')){
             $this->layout = 'ajax';

            if(isset($this->request->data['row'])){
                 $this->loadModel("Admin.Banquets");
                $banquets =  $this->Banquets->find('all',['conditions'=>['Banquets.is_active'=>1],'order'=>['created'=>'DESC'],'offset'=>$this->request->data['row'],'limit' => $page]);
            }
            $this->set(compact('banquets'));
            $this->render('loadmorebanquet');
        }

    }

    public function loadmoreact(){
        $page = Configure::read('pagecount');
        if($this->request->is('ajax')){
             $this->layout = 'ajax';

            if(isset($this->request->data['row'])){
                 $this->loadModel("Admin.Activities");
                $activities =  $this->Activities->find('all',['conditions'=>['Activities.is_active'=>1],'order'=>['created'=>'DESC'],'offset'=>$this->request->data['row'],'limit' => $page]);
            }
            $this->set(compact('activities'));
            $this->render('loadmoreact');
        }

    }

    public function getjobdetails(){
        $this->autoRender = false;  
       
        $jobId = $this->request['data']['jobId'];
        
        if(!empty($jobId)){
            $this->loadModel('Admin.JobPosting');
            $this->loadModel('Admin.Category');
            $this->JobPosting->bindModel([
                'belongsTo'=>[
                    'Category'=>[
                    'className'=>'Category',
                    'foreignKey'=>'category',
                    'fields'=>['Category.title','Category.type','Category.status','Category.icon']
                    ]
                ],
                
            ]);
            $jobOpening = $this->JobPosting->find('first',['JobPosting.status'=>1,'Category.type'=>4,'JobPosting.id'=>$jobId]);
            if(!empty($jobOpening)){
                $output['status'] = true;
                $output['info']= $jobOpening;
               
            }else{
                $output['status'] = false;
            }

        }else{
            $output['status'] = false;
        }
        echo json_encode($output); die;
    }
    public function applyjob(){
        $this->autoRender =false;
        $this->loadModel('Admin.ApplyJob');
        $data = $this->request['data']['ApplyJob'];
        $output['error'] = false;
        if($data['name'] == ""){
            $output['error'] = true;
            $output['name'] = 'Please enter your name';
        }
        if($data['email'] == ""){
            $output['error'] = true;
            $output['email'] = 'Please enter your email';
        }
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL) && $data['email'] != "") {
            $output['error'] = true;
            $output['email'] = 'Please enter valid email';
        }
        if($data['phone'] == ""){
            $output['error'] = true;
            $output['phone'] = 'Please enter your phone';
        }
        if($data['Resume']['name'] == ""){
            $output['error'] = true;
            $output['file'] = 'Please upload your updated resume';
        }
        if($data['Resume']['name'] != ""){
            $imageInfo = mime_content_type($data['Resume']['tmp_name']);          
            $name = $data['Resume']['name'];
            $nameExp = explode(".",$name);
            $allowedExtension = ['pdf','doc','docx'];
            $allowedMime = ['text/vnd.ms-word','text/vnd.ms-word ','application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
            $extension = strtolower(end($nameExp));
            $allowedMime = ['text/vnd.ms-word','text/vnd.ms-word ','application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
            if(!in_array($imageInfo,$allowedMime)){
                $output['error'] = true;
                $output['file'] = 'Please choose valid file';
            }
            if(!in_array($extension,$allowedExtension)){
                $output['error'] = true;
                $output['file'] = 'Please choose valid file';
            }
           
        }
        if($output['error'] == false){
            $fileArray =  explode(".",$data['Resume']['name']);
            $fileExtension = end($fileArray);
            $fileName =  str_replace(" ","_",$data['name']).'_'.time().".".$fileExtension;
            $filePath = Configure::read('RelativeUrl').'resumes/';                    
            move_uploaded_file($data['Resume']['tmp_name'],$filePath.$fileName);
            $data['resume'] = $fileName;
            $this->ApplyJob->create();
            $this->ApplyJob->save($data);
            $to ="sandeep.kumar@soncoya.in";
            $subject="Apply for job";
            $message="";
            $mail = $this->Email->send($to, $subject, $message);
            $output['msg']='Your resume submitted successfully.';
            $output['status'] =  true;
        }else{
            $output['status'] =  false; 
        }
        
        echo json_encode($output); die;
    }
    public function subscibe(){
        $this->autoRender =false;
        $this->loadModel('Admin.Newsletter');
        $data = $this->request['data']['Newsletter'];
        $output['error'] = false;
        if($data['news'] != ""){
            $output['error'] = true;            
        }
       
        if($data['email'] == ""){
            $output['error'] = true;
            $output['email'] = 'Please enter your email';
        }
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL) && $data['email'] != "") {
            $output['error'] = true;
            $output['email'] = 'Please enter valid email';
        }
        
        if($output['error'] == false){           
            $this->Newsletter->create();
            $this->Newsletter->save($data);
            $output['msg']='Your e-Mail subscribed successfully.';
            $output['status'] =  true;
        }else{
            $output['status'] =  false; 
        }
        echo json_encode($output); die;
    }
    public function contactform(){
        $this->autoRender =false;
        $this->loadModel('Admin.ContactInquiries');
        $data = $this->request['data']['ContactInquiries'];
        $output['error'] = false;
       
        if($data['first_name'] == ""){
            $output['error'] = true;
            $output['message'] = 'Please enter your first name';
        }
        if($data['last_name'] == ""){
            $output['error'] = true;
            $output['message'] = 'Please enter your last name';
        }
        if($data['email'] == ""){
            $output['error'] = true;
            $output['message'] = 'Please enter your email';
        }
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL) && $data['email'] != "") {
            $output['error'] = true;
            $output['message'] = 'Please enter valid email';
        } 
        if($data['phone'] == ""){
            $output['error'] = true;
            $output['message'] = 'Please enter your phone';
        }
        if($data['message'] == ""){
            $output['error'] = true;
            $output['message'] = 'Please enter your message';
        }
        
        if($output['error'] == false){           
            $this->ContactInquiries->create();
            $this->ContactInquiries->save($data);
            $output['msg']='Your Message sent successfully.';
            $output['status'] =  true;
        }else{
            $output['status'] =  false; 
        }
        echo json_encode($output); die;
    }
    public function save_quotation(){
        $this->autoRender =false;
        if ($this->request->is('ajax')) {
            if (!empty($this->data)) {
                $this->loadModel('Admin.Quotation'); 
                $this->Quotation->set($this->data['Quotation']);
                if($this->Quotation->validates()) {
                    if ($this->Quotation->save($this->data['Quotation'])) {
                    $response=array();
                    $response['status']='success';
                    $response['message']='Quotation has been saved.';
                    $response['data']=$this->data;
                    echo json_encode($response);
                    die;
                    }
                }else {
                    $response=array();
                    $modelName ="Quotation";
                    $err = $this->Quotation->invalidFields();
                    $response['status']='error';
                    $response['message']='Quotation could not be saved. Please, try again.';
                    $response['data']=[$modelName=>$err];
                    echo json_encode($response);
                    die;
                }
            }
        }
    
    }

    

    public function getTenders(){
        if($this->request->is('ajax')){
             $this->layout = 'ajax';
             if(isset($this->request->data['catid'])){


                 $this->loadModel('Admin.Tenders'); 
                $this->loadModel('Admin.TenderCategory'); 

                if ($this->request->data['catid'] != 0) {
                     $cond = array('TenderCategory.is_active' => 1,'Tenders.tender_category_id' => $this->request->data['catid']);
                }else{
                     $cond = array('TenderCategory.is_active' => 1);
                }

               $tenders =$this->TenderCategory->find('all',
                array(
                    'conditions' =>$cond,
                    'joins' => array(
                         array(
                            'table' => 'tenders',
                            'alias' => 'Tenders',
                            'type' => 'LEFT',    
                            'conditions' => array('Tenders.tender_category_id = TenderCategory.id'),
                        
                         ),
                     ),
                    'fields' => array('*'),

                )
            );   
            $this->set(compact('tenders'));
             
            $this->render('get_tenders');
        }

        }
    }
    public function get_hotels(){
        $this->autoRender =false;
        if ($this->request->is('ajax')) {
            if (!empty($this->data)) {
                $this->loadModel('Admin.Hotel'); 
                $cityId =  $this->data['cityId'];
                $hotels =  $this->Hotel->find('list',['conditions'=>['city'=>$cityId]]);
                if(!empty($hotels)) {
                   
                    $response=array();
                    $response['status']=true;
                    $response['data']=$hotels;
                   
                   
                }else {
                    $response=array();
                    $response['status']=false;
                    
                }
                 echo json_encode($response); die;
            }
        }

    }
    public function get_rooms(){
        $this->autoRender =false;
        if ($this->request->is('ajax')) {
            if (!empty($this->data)) {
                $this->loadModel('Admin.Hotel'); 
                $this->loadModel('Admin.Room'); 
                $hotelId =  $this->data['hotelId'];
                $rooms =  $this->Room->find('list',['conditions'=>['hotel_id'=>$hotelId],'fields'=>['id','room_type']]);
                if(!empty($rooms)) {
                   
                    $response=array();
                    $response['status']=true;
                    $response['data']=$rooms;
                   
                   
                }else {
                    $response=array();
                    $response['status']=false;
                    
                }
                 echo json_encode($response); die;
            }
        }

    }
    public function get_bed_type(){
        $this->autoRender =false;
        if ($this->request->is('ajax')) {
            if (!empty($this->data)) {
                $this->loadModel('Admin.Hotel'); 
                $this->loadModel('Admin.Room'); 
                $this->loadModel('Admin.BedTypeHotel'); 
                $this->loadModel('Admin.BedType'); 
                $roomId =  $this->data['roomId'];
                $this->BedTypeHotel->bindModel([
                    'belongsTo'=>[
                            'BedType'=>[
                            'className'=>'BedType',
                            'foreignKey'=>'bed_type',
                        ]
                    ],
                ]);
                $rooms =  $this->BedTypeHotel->find('all',['conditions'=>['BedTypeHotel.room_id'=>$roomId]]);
                if(!empty($rooms)) {
                   
                    $list = [];
                    $adult = [];
                    $guest = [];
                    $child = [];
                    foreach($rooms as $room){
                        $list[$room['BedType']['id']] = $room['BedType']['title'];
                        $adult[] = $room['BedType']['adult_beds'];
                        $guest[] = $room['BedType']['extra_beds'];
                        $child[] = $room['BedType']['child_beds'];
                        
                    }

                    $adult =  max($adult);
                    $guest =  max($guest);
                    $child =  max($child);
                    $response=array();
                    $response['status']=true;
                    $response['data']=$list;
                    $response['guest']=$guest;
                    $response['child']=$child;
                    $response['adult']=$adult;
                   
                   
                }else {
                    $response=array();
                    $response['status']=false;
                    
                }
                 echo json_encode($response); die;
            }
        }

    }
    public function get_hotel_how_to_reach(){
        $this->layout = 'ajax';
        if ($this->request->is('ajax')) {
            if (!empty($this->data)) {
                $this->loadModel('Admin.HowToReach'); 
                $hotelId =  $this->data['hotelId'];
                $howtoreach =  $this->HowToReach->find('all',['conditions'=>['perent_id'=>$hotelId]]);
            }
        }
        $this->set(compact('howtoreach'));
        $this->render('howtoreach');
    }
    public function get_facility(){
        $this->layout = 'ajax';
        if ($this->request->is('ajax')) {
            if (!empty($this->data)) {
                $this->loadModel('Admin.HotelFacilities'); 
                $this->loadModel('Admin.HotelFacilitiesInfo'); 
                $this->loadModel('Admin.HotelFacilitiesSelected'); 
                $hotelId =  $this->data['hotelId'];
                $this->HotelFacilitiesSelected->bindModel([
                    'belongsTo'=>[
                            'HotelFacilitiesInfo'=>[
                            'className'=>'HotelFacilitiesInfo',
                            'foreignKey'=>'faclities_id',
                        ]
                    ],
                ]);

                $this->HotelFacilities->bindModel([
                    'hasMany'=>[
                            'HotelFacilitiesInfo'=>[
                            'className'=>'HotelFacilitiesInfo',
                            'foreignKey'=>'facility_id',
                        ]
                    ],
                ]);
                $this->HotelFacilitiesSelected->recursive = 2;
                $facility =  $this->HotelFacilitiesSelected->find('all',['conditions'=>['HotelFacilitiesSelected.hotel_id'=>$hotelId]]);
              
            }
        }
        $this->set(compact('facility'));
        $this->render('facility');

    }
    public function get_attraction(){
        $this->layout = 'ajax';
        if ($this->request->is('ajax')) {
            if (!empty($this->data)) {
                $this->loadModel('Admin.HotelAttraction'); 
                $this->loadModel('Admin.Attraction'); 
                $this->loadModel('Admin.AttractionImages'); 
                $hotelId =  $this->data['hotelId'];
                $this->HotelAttraction->bindModel([
                    'belongsTo'=>[
                            'Attraction'=>[
                            'className'=>'Attraction',
                            'foreignKey'=>'attraction_id',
                        ]
                    ],
                ]);

                $this->Attraction->bindModel([
                    'hasMany'=>[
                            'AttractionImages'=>[
                            'className'=>'AttractionImages',
                            'foreignKey'=>'attraction_id',
                        ]
                    ],
                ]);
                $this->HotelAttraction->recursive = 2;
                $attraction =  $this->HotelAttraction->find('all',['conditions'=>['HotelAttraction.hotel_id'=>$hotelId]]);
                //pr($attraction); die;
            }
        }
        $this->set(compact('attraction'));
        $this->render('attraction');

    }
    public function get_highlights(Type $var = null)
    {
        $this->layout = 'ajax';
        if ($this->request->is('ajax')) {
            if (!empty($this->data)) {
                $this->loadModel('Admin.BedTypeHotel');
                $this->loadModel('Admin.Room');
                $this->loadModel('Admin.BedType');
                $this->loadModel('Admin.RoomImages');
                $this->loadModel('Admin.RoomSelectedFacility');
                $this->loadModel('Admin.RoomFacilityInfo');
                $this->loadModel('Admin.RoomFacilityInfo');
                $roomId  = $this->data['roomId'];
                $bedTypeId = $this->data['bedId'];
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
            }
        }
        $this->set(compact('Roomfacility','availableRoom','availableBeds'));
        $this->render('highlight');
    }

        public function search_hotels(){
            $this->layout = false;
            if($this->request->is('ajax')){
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
        }else{
        
             $userInputData =  $this->Session->read('HotelData.userInputData');
             $cityId =   $userInputData['HotelData']['city'];
             $hotelId =  $userInputData['HotelData']['hotel_id'];
             $roomId =  $userInputData['HotelData']['room_id'];
             $bedTypeId =  $userInputData['HotelData']['bed_type_id'];
             $bedTypeId =  $userInputData['HotelData']['bed_type_id'];
             $checkIn =  $userInputData['HotelData']['check_in_date'];
             $checkOut =  $userInputData['HotelData']['check_out_date'];
             $adultId =  $userInputData['HotelData']['no_of_adults'];
             $childId =  $userInputData['HotelData']['no_of_childs'];
             $no_of_rooms =  $userInputData['HotelData']['no_of_rooms'];
       
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
                                    'RoomImages.bed_type_id = BedType.id'
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
        //debug($options); die;
        $getHotelData = $this->Hotel->find('all',  $options );
        
        $this->set(compact('availableBeds','Roomfacility','availableRoom','roomImages','cityList','cityId','cityHotel','hotelId','checkIn','checkOut','rooms','roomId','bedlist','bedTypeId','no_of_rooms','adultId','childId','guestId','getHotelData'));
             
                $this->render('search_hotels');
            }
    }


    public function booking() {
        $this->autoRender = false;  
        $this->loadModel("ActivityBookings");
        $this->loadModel("Activities");

        if (!empty($this->data)) {
            $modelName ='ActivityBookings';  
            
            $this->request->data[$modelName]['booking_id'] = 'booking-'.mt_rand(1000,99999);
            
            $num_ticket_adult = !empty($this->data[$modelName]['number_of_ticket_adult']) ? $this->data[$modelName]['number_of_ticket_adult'] : 0;

            $num_ticket_child = !empty($this->data[$modelName]['number_of_ticket_child']) ? $this->data[$modelName]['number_of_ticket_child'] : 0;

            $total_number_ticket = $num_ticket_adult + $num_ticket_child;
            $this->request->data[$modelName]['number_of_ticket']= $total_number_ticket;

            //pr($this->request->data); die;

            $name = trim($this->data[$modelName]['name']);
            $slug = Inflector::slug(strtolower($name), $replacement = '-');
            $idslug = null;
            

            $slug = $this->createSlug($name,$idslug,$modelName);
            $this->request->data[$modelName]['slug']= $slug;
            $this->$modelName->set($this->data[$modelName]);
            
            //pr($this->data); die;
            //if($this->$modelName->validates()) {
            if (isset($this->data[$modelName])) {
                $this->$modelName->create();
                if($this->$modelName->save($this->data[$modelName])) {
                    
                    $last_inserted_id = $this->$modelName->id;

                    $merchant_data  = Configure::read('merchant_id');
                    $working_key    = Configure::read('working_key');
                    $access_code    = Configure::read('access_code'); 
                    $redirectUrl    = Configure::read('siteUrlfront').'activities/checkStatusActivity/'.$last_inserted_id; 
                    $cancelUrl      = Configure::read('siteUrlfront').'activities/'.Configure::read('cancel_url');

                    $bookingData = $this->$modelName->findById($last_inserted_id);
                    $postData = [];
                    $postData['activity_id']       =  $bookingData['ActivityBookings']['activity_id'];
                    $postData['booking_id']        =  $bookingData['ActivityBookings']['booking_id'];
                    $postData['name']              =  $bookingData['ActivityBookings']['name'];
                    $postData['email']             =  $bookingData['ActivityBookings']['email'];
                    $postData['number_of_ticket']  =  $bookingData['ActivityBookings']['number_of_ticket'];
                    $postData["redirect_url"]   = $redirectUrl;
                    $postData["cancel_url"]     = $cancelUrl;
                    $postData["currency"]       = "INR";
                    $postData["language"]       = "EN";
                    $postData["amount"]         = $bookingData['ActivityBookings']['total_price'];
                    $postData["merchant_id"]    = Configure::read('merchant_id');
                    $postData["order_id"]       = $last_inserted_id;

                    foreach ($postData as $key => $value) {
                        $merchant_data .= $key . '=' . urlencode($value) . '&';
                    }

                    $encrypted_data = $this->encrypt($merchant_data, $working_key); // Method for 

                    $returnArr['encrypted_data'] = $encrypted_data;
                    $returnArr['access_code']    = $access_code;
                    

                    $data = array('encrypted_data' => $returnArr['encrypted_data'], 'access_code' => $returnArr['access_code']);

                    $response=array();
                    $response['status']=true;
                    $response['msg']= 'success';
                    $response['data']=$data;


                }else {
                    $response=array();
                    $response['status']=false;
                    $response['msg']='error';
                }
                
                echo json_encode($response); die;
            }
            //}
        }
    }



    public function bookingTour() {
        $this->autoRender = false;  
        $this->loadModel("TourPackageBookings");
        $this->loadModel("TourPackage");

        if (!empty($this->data)) {
            $modelName ='TourPackageBookings';  
            
            $this->request->data[$modelName]['booking_id'] = 'tourbooking-'.mt_rand(1000,99999);
            $name = trim($this->data[$modelName]['name']);
            $slug = Inflector::slug(strtolower($name), $replacement = '-');
            $idslug = null;
            

            $slug = $this->createSlug($name,$idslug,$modelName);
            $this->request->data[$modelName]['slug']= $slug;
            $this->$modelName->set($this->data[$modelName]);
            
            //pr($this->data); die;
            //if($this->$modelName->validates()) {
            if (isset($this->data[$modelName])) {
                $this->$modelName->create();
                if($this->$modelName->save($this->data[$modelName])) {
                    
                    $last_inserted_id = $this->$modelName->id;

                    $merchant_data  = Configure::read('merchant_id');
                    $working_key    = Configure::read('working_key');
                    $access_code    = Configure::read('access_code'); 
                    $redirectUrl    = Configure::read('siteUrlfront').'tourPackages/checkStatusTour/'.$last_inserted_id; 
                    $cancelUrl      = Configure::read('siteUrlfront').'tourPackages/'.Configure::read('cancel_url');

                    $bookingData = $this->$modelName->findById($last_inserted_id);
                    $postData = [];
                    $postData['tour_package_id']   =  $bookingData['TourPackageBookings']['tour_package_id'];
                    $postData['booking_id']        =  $bookingData['TourPackageBookings']['booking_id'];
                    $postData['name']              =  $bookingData['TourPackageBookings']['name'];
                    $postData['email']             =  $bookingData['TourPackageBookings']['email'];
                    $postData['number_of_people']  =  $bookingData['TourPackageBookings']['number_of_people'];
                    $postData["redirect_url"]   = $redirectUrl;
                    $postData["cancel_url"]     = $cancelUrl;
                    $postData["currency"]       = "INR";
                    $postData["language"]       = "EN";
                    $postData["amount"]         = $bookingData['TourPackageBookings']['total_price'];
                    $postData["merchant_id"]    = Configure::read('merchant_id');
                    $postData["order_id"]       = $last_inserted_id;

                    foreach ($postData as $key => $value) {
                        $merchant_data .= $key . '=' . urlencode($value) . '&';
                    }

                    $encrypted_data = $this->encrypt($merchant_data, $working_key); // Method for 

                    $returnArr['encrypted_data'] = $encrypted_data;
                    $returnArr['access_code']    = $access_code;
                    

                    $data = array('encrypted_data' => $returnArr['encrypted_data'], 'access_code' => $returnArr['access_code']);

                    $response=array();
                    $response['status']=true;
                    $response['msg']= 'success';
                    $response['data']=$data;


                }else {
                    $response=array();
                    $response['status']=false;
                    $response['msg']='error';
                }
                
                echo json_encode($response); die;
            }
            //}
        }
    }


    public function bookingBanquet() {
        $this->autoRender = false;  
        $this->loadModel("BanquetBookings");
        $this->loadModel("Banquets");

        if (!empty($this->data)) {
            $modelName ='BanquetBookings';  
            
            $this->request->data[$modelName]['booking_id'] = 'booking-'.mt_rand(1000,99999);
            $name = trim($this->data[$modelName]['name']);
            $slug = Inflector::slug(strtolower($name), $replacement = '-');
            $idslug = null;
            

            $slug = $this->createSlug($name,$idslug,$modelName);
            $this->request->data[$modelName]['slug']= $slug;
            $this->$modelName->set($this->data[$modelName]);
            
            if (isset($this->data[$modelName])) {
                $this->$modelName->create();
                if($this->$modelName->save($this->data[$modelName])) {
                    
                    $last_inserted_id = $this->$modelName->id;

                    $merchant_data  = Configure::read('merchant_id');
                    $working_key    = Configure::read('working_key');
                    $access_code    = Configure::read('access_code'); 
                    $redirectUrl    = Configure::read('siteUrlfront').'banquets/checkStatusBanquet/'.$last_inserted_id; 
                    $cancelUrl      = Configure::read('siteUrlfront').'banquets/'.Configure::read('cancel_url');

                    $bookingData = $this->$modelName->findById($last_inserted_id);
                    $postData = [];
                    $postData['banquet_id']     =  $bookingData['BanquetBookings']['banquet_id'];
                    $postData['booking_id']     =  $bookingData['BanquetBookings']['booking_id'];
                    $postData['name']           =  $bookingData['BanquetBookings']['name'];
                    $postData['email']          =  $bookingData['BanquetBookings']['email'];
                    $postData['phone']          =  $bookingData['BanquetBookings']['phone'];
                    $postData['number_of_day']  =  $bookingData['BanquetBookings']['number_of_day'];
                    $postData["redirect_url"]   =  $redirectUrl;
                    $postData["cancel_url"]     =  $cancelUrl;
                    $postData["currency"]       =  "INR";
                    $postData["language"]       =  "EN";
                    $postData["amount"]         =  $bookingData['BanquetBookings']['total_price'];
                    $postData["merchant_id"]    =  Configure::read('merchant_id');
                    $postData["order_id"]       =  $last_inserted_id;

                    foreach ($postData as $key => $value) {
                        $merchant_data .= $key . '=' . urlencode($value) . '&';
                    }

                    $encrypted_data = $this->encrypt($merchant_data, $working_key); // Method for 

                    $returnArr['encrypted_data'] = $encrypted_data;
                    $returnArr['access_code']    = $access_code;
                    

                    $data = array('encrypted_data' => $returnArr['encrypted_data'], 'access_code' => $returnArr['access_code']);

                    $response=array();
                    $response['status']=true;
                    $response['msg']= 'success';
                    $response['data']=$data;


                }else {
                    $response=array();
                    $response['status']=false;
                    $response['msg']='error';
                }
                
                echo json_encode($response); die;
            }
            //}
        }
    }



    function createSlug($string, $id = null,$modelName) {
        $slug = Inflector::slug($string, '-');
        $slug = strtolower($slug);
        $this->loadModel($modelName);
        $i = 0;
        $params = array(
          'conditions' => array($modelName.'.slug' => $slug), 
          'fields' => array($modelName.'.id',$modelName.'.slug'));
    
        if (!is_null($id)) 
          $params['conditions']['not'] = array($modelName.'.id'=>$id);
        
        while (count($this->$modelName->find('all', $params)))  {
          $i++;
          $params['conditions'][$modelName.'.slug'] = $slug."-".$i;
        }
        if ($i) $slug .= "-".$i;
    
        return $slug;
    }
    function add_hotel(){
        $this->autoRender = false;  
        if($this->request->is('ajax')){
            $this->autoRender = false;
             $this->layout = 'ajax';
             //$roomArray = [];
             //$this->Session->destroy(); 
            // 
             if(isset($this->request->data['HotelData'])){
                $data['remove'] = false;
                $hotelId = $this->request->data['HotelData']['bed_type_id'];
                if(isset($this->request->data['HotelData']['removeId'])){
                    $roomArray=$this->Session->read('HotelData.RoomSelected');
                    unset($roomArray[$hotelId]);
                    $data['remove'] = true;
                }else{
                    if(!empty($this->Session->read('HotelData.RoomSelected'))){
                  
                        $roomArray=$this->Session->read('HotelData.RoomSelected');
                        $roomArray[$hotelId]=$this->request->data['HotelData']; 
                        
                    }else{
                        $roomArray[$hotelId] =$this->request->data['HotelData']; 
                    }

                }
                
                $this->Session->write('HotelData.RoomSelected', $roomArray);    
                  
                $data['res'] = true;
                $data['bedId'] = $hotelId;
                echo json_encode($data); die;
            }
        }
    }
    function add_extra_bed(){
        $this->autoRender = false;  
        if($this->request->is('ajax')){
            $roomArray = $this->Session->read('HotelData.RoomSelected');
            $roomRate = $this->data['rate'];
            $night = $this->data['night'];
            $extraBed = $this->data['value'];
            $bedId = $this->data['bedId'];
            if($extraBed ==0){
                $extraBedCharge =  ($roomRate/100)*20;
                $totalExtraBedChnage =  $extraBedCharge * $night;
                $response['status']=false;
                $response['extraBedCharge'] = $extraBedCharge;
                $response['totalExtraBedChnage']=$totalExtraBedChnage;
                $roomArray[$bedId]['extraBed']=false;
                $this->Session->write('HotelData.RoomSelected', $roomArray); 
            }else{
               
                $extraBedCharge =  ($roomRate/100)*20;
                $totalExtraBedChnage =  $extraBedCharge * $night;
                $response['status']=true;
                $response['extraBedCharge'] = $extraBedCharge;
                $response['totalExtraBedChnage']=$totalExtraBedChnage;

                $roomArray[$bedId]['extraBed']=true;
                $roomArray[$bedId]['extraBedCharge']=$extraBedCharge;
                $roomArray[$bedId]['totalExtraBedChnage']=$totalExtraBedChnage;
                $this->Session->write('HotelData.RoomSelected', $roomArray); 
               // pr($this->Session->read('HotelData.RoomSelected')); die; 

            }

            echo json_encode($response); die;

        }

    }
    
}
?>