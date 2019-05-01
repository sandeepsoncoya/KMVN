<?php
/**
 * Admin Controller
 *
 * PHP 5
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the below copyright notice.
 *
 * @author     Robert Love <robert@pollenizer.com>
 * @copyright  Copyright 2012, Pollenizer Pty. Ltd. (http://pollenizer.com)
 * @license    MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @since      CakePHP(tm) v 2.1.1
 */
App::uses('AdminAppController', 'Admin.Controller');
App::import('Helper', array('Breadcrumbs', 'Html'));
class HotelsController extends AdminAppController
{
    /**
     * Uses
     *
     * @var mixed
     */
    public $uses = null;
    /**
     * Index
     *
     * @return void
     */
    public $components = array('Admin.Email');
    function beforeFilter() {
        $this->checklogin();
    }
    public function index(){
        $title = "Hotels List";
        $this->set('title_for_layout', $title);
        $this->set(compact('title'));
    }
    public function add(){
        
        
        $title = "Add Hotel";
        $this->set('title_for_layout', $title);
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
        $categoryList =  $this->HotelCategory->find('list',['conditions'=>['is_active'=>1]]); 
        $cityList =  $this->City->find('list',['conditions'=>['is_active'=>1]]); 
        $this->HotelFacilities->bindModel([
            'hasMany'=>[
                'HotelFacilitiesInfo'=>[
                  'className'=>'HotelFacilitiesInfo',
                  'foreignKey'=>'facility_id'
                ]
            ],
            
        ]);
        $hotelFacility = $this->HotelFacilities->find('all',['conditions'=>['HotelFacilities.is_active'=>1]]);
        $hotelHighlight = $this->HotelHighlight->find('list',['conditions'=>['HotelHighlight.is_active'=>1]]);
        $attractions =  $this->Attraction->find('all',['conditions'=>['is_active'=>1]]);
        $bedType = $this->BedType->find('all',['conditions'=>['is_active'=>1]]);
        $services =  $this->Services->find('all',['conditions'=>['is_active'=>1]]);
        if ($this->request->is(array('PUT','POST' ))) {

            $modelName ='Hotel';  
            if (!empty($this->data)) {
                $this->loadModel('Admin.'.$modelName); 
                $slug = Inflector::slug(strtolower($this->data[$modelName]['title']), $replacement = '-');
                $idslug = null;
                if($this->data['Hotel']['id']!= ""){
                    $idslug = $this->data['Hotel']['id'];
                }
                $slug = $this->createSlug($this->data[$modelName]['title'],$idslug,$modelName);
                $this->request->data[$modelName]['slug']= $slug;
                $this->$modelName->set($this->data[$modelName]);
                if($this->$modelName->validates()) {
                    if (isset($this->data[$modelName])) {
                        if(!isset($this->data[$modelName]['id']) && $this->data[$modelName][id]== ""){
                            $this->$modelName->create();
                        }
                       
                        
                        $this->$modelName->save();
                        $response['status']='success';
                        $response['message']=$modelName.' has been saved.';
                        $response['data']=$this->data;
                        if($this->data['Hotel']['id']== ""){
                            $response['data']['Hotel']['id']=$this->$modelName->getLastInsertId();
                            $id = $this->$modelName->getLastInsertId();
                        }else{
                            $response['data']['Hotel']['id']=$this->data['Hotel']['id'];
                            $id =$this->data['Hotel']['id'];
                        }
                       
                        if(isset($this->data['Hotel']['hotel_higlight']) && !empty($this->data['Hotel']['hotel_higlight'])){
                            $this->HotelHighlightSelected->deleteAll(array('HotelHighlightSelected.hotel_id' => $id), false);
                            foreach($this->data['Hotel']['hotel_higlight'] as $key=>$val){
                                $dataToSave = ['hotel_id'=>$id,'highlight_id'=>$val[0]];
                               
                                $this->HotelHighlightSelected->create();
                                $this->HotelHighlightSelected->save($dataToSave);
                            }
                        }
                        
                        if(isset($this->data['Hotel']['images']) && !empty($this->data['Hotel']['images'])){
                           
                            $this->HotelImages->deleteAll(array('HotelImages.hotel_id' => $id), false);
                            foreach($this->data['Hotel']['images'] as $key=>$val){
                                $dataToSave = ['hotel_id'=>$id,'file'=>$val];
                                $this->HotelImages->create();
                                $this->HotelImages->save($dataToSave);
                            }
                        }
                        echo json_encode($response);
                        die; 
                    }
                }else{
                    $response=array();
                    $err = $this->$modelName->invalidFields();
                    $response['status']='error';
                    $response['message']=$modelName.' could not be saved. Please, try again.';
                    $response['data']=[$modelName=>$err];
                    echo json_encode($response);
                    die;
                }
            }
        }elseif(!$this->request->is('post')){ 


            $id = (isset($this->request->params['pass'][0]))?$this->request->params['pass'][0]:0;
            if($id > 0){
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
                        ],
                        'HotelFacilitiesSelected'=>[
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
                        'SeasionRate'=>[
                            'className'=>'SeasionRate',
                            'foreignKey'=>'hotel_id'
                        ],
                    ],
                    
                ]);
                $this->Room->bindModel([
                    'hasMany'=>[
                        'BedTypeHotel'=>[
                          'className'=>'BedTypeHotel',
                          'foreignKey'=>'room_id'
                        ],
                        
                    ],
                ]);
                $this->Hotel->recursive = 3;
                $data = $this->Hotel->find('first',['conditions'=>['Hotel.id'=>$id]]);  
               
                $this->request->data['Hotel'] = $data['Hotel']; 
                $this->request->data['HotelImages'] = $data['HotelImages'];             
                $this->request->data['HowToReach'] = $data['HowToReach'];             
                $this->request->data['HotelHighlightSelected'] = $data['HotelHighlightSelected'];             
                $this->request->data['HotelFacilitiesSelected'] = $data['HotelFacilitiesSelected'];             
                $this->request->data['HotelAttraction'] = $data['HotelAttraction'];             
                $this->request->data['Room'] = $data['Room'];
                $this->request->data['SeasionRate'] = $data['SeasionRate'];
                $this->request->data['HotelExtraService'] = $data['HotelExtraService'];
               //pr($data); die;
                   
                
            }
        }
        $this->set(compact('title','categoryList','hotelFacility','hotelHighlight','cityList','attractions','bedType','services'));

    }
    public function save_how_to_reach(){
        $this->autoRender = false;
        $this->loadModel('Admin.HowToReach');
        if($this->request->is(array('PUT','POST' ))) {
            $id = $this->data['HowToReach']['hotel_id'];
            
            if(isset($this->data['HowToReach']) && !empty($this->data['HowToReach'])){
                $this->HowToReach->deleteAll(array('HowToReach.perent_id' => $id,'HowToReach.perent_type' =>2), false);
                foreach($this->data['HowToReach']['type'] as $key=>$val){
                    if($key >0 ){
                        $dataToSave = ['perent_id'=>$this->data['HowToReach']['hotel_id'],'type'=>$this->data['HowToReach']['type'][$key],'description'=>$this->data['HowToReach']['description'][$key],'perent_type'=>2];
                        $this->HowToReach->create();
                        $this->HowToReach->save($dataToSave);
                    }
                   
                }
                $response['status']=true;
                $response['id']=$this->data['HowToReach']['hotel_id'];
            }
        }
        echo json_encode($response); die;
    }
    public function save_attraction(){
        $this->autoRender = false;
        $this->loadModel('Admin.HotelAttraction');
        if($this->request->is(array('PUT','POST' ))) {
            $id = $this->data['HotelAttraction']['hotel_id'];
            if(isset($this->data['HotelAttraction']) && !empty($this->data['HotelAttraction'])){
                
                $this->HotelAttraction->deleteAll(array('HotelAttraction.hotel_id' => $id), false);
                foreach($this->data['HotelAttraction']['attractions'] as $key=>$val){
                  
                        $dataToSave = ['hotel_id'=>$id,'attraction_id'=>$val];
                        $this->HotelAttraction->create();
                        $this->HotelAttraction->save($dataToSave);
                   
                   
                }
                $response['status']=true;
                $response['id']= $id;
            }
        }
        echo json_encode($response); die;
    }
    public function save_room(){
        $this->autoRender = false;
        $this->loadModel('Admin.Room');
        $this->loadModel('Admin.BedTypeHotel');
        if($this->request->is(array('PUT','POST' ))) {

           
           
            if(isset($this->data['Room']) && !empty($this->data['Room'])){
                //$this->Room->deleteAll(array('Room.hotel_id' =>$this->data['Room']['hotel_id']), false);
                foreach($this->data['Room']['room_type'] as $key=>$value){
                    if($key > 0){
                        $roomType = $this->data['Room']['room_type'][$key];
                        $description = $this->data['Room']['description'][$key];
                        if($this->data['Room']['id'][$key] > 0){
                            $dataToSave = ['id'=>$this->data['Room']['id'][$key],'hotel_id'=>$this->data['Room']['hotel_id'],'room_type'=>$roomType,'description'=>$description];
                        }else{
                            $this->Room->create();
                            $dataToSave = ['hotel_id'=>$this->data['Room']['hotel_id'],'room_type'=>$roomType,'description'=>$description];
                        }
                        if($this->Room->save($dataToSave)){
                            if($this->data['Room']['id'][$key] > 0 && $this->data['Room']['id'][$key]!=""){
                                $roomId = $this->data['Room']['id'][$key];
                            }else{
                                $roomId = $this->Room->getLastInsertID();
                            }
                        }
                        

                    }
                }
                if(isset($this->data['Room']['bed_type']) && !empty($this->data['Room']['bed_type'])){ 
                    $this->BedTypeHotel->deleteAll(array('BedTypeHotel.room_id' =>$roomId), false);  
                    foreach($this->data['Room']['bed_type'] as $bedtype){
                        $dataBedType = ['room_id'=>$roomId,'bed_type'=>$bedtype];
                        $this->BedTypeHotel->create();
                        $this->BedTypeHotel->save($dataBedType);
                        
                    }
                }
                $response['status']=true;
                $response['id']=$this->data['Room']['hotel_id'];
            }
        }
        echo json_encode($response); die;

        
    }
    public function save_extra_service(){
        $this->autoRender = false;
        $this->loadModel('Admin.HotelExtraService');
        
        if($this->request->is(array('PUT','POST' ))) {
            if(isset($this->data['HotelExtraService']) && !empty($this->data['HotelExtraService'])){
                $this->HotelExtraService->deleteAll(array('HotelExtraService.hotel_id' =>$this->data['HotelExtraService']['hotel_id']), false);
                foreach($this->data['HotelExtraService']['service_id'] as $key=>$value){                   
                    $dataToSave = ['hotel_id'=>$this->data['HotelExtraService']['hotel_id'],'service_id'=>$value];
                    $this->HotelExtraService->save($dataToSave);
                }
                $this->Session->setFlash(__('Hotel saved successfully...',true),'success');
                $this->redirect(array('controller'=>'hotels','action' => 'index','plugin'=>'admin'));
               
            }
        }
       
    }
    public function save_SeasionRate(){
        $this->autoRender = false;
        $this->loadModel('Admin.SeasionRate');
        if($this->request->is(array('PUT','POST' ))) {
            $id = $this->data['SeasionRate']['hotel_id'];
           // pr($this->data['SeasionRate']); die;
            if(isset($this->data['SeasionRate']) && !empty($this->data['SeasionRate'])){
                $this->SeasionRate->deleteAll(array('SeasionRate.hotel_id' => $id), false);
                foreach($this->data['SeasionRate']['season_name'] as $key=>$val){
                    if($key >0 ){
                        $validFrom =  date('Y-m-d',strtotime($this->data['SeasionRate']['valid_from'][$key]));
                        $validTo =  date('Y-m-d',strtotime($this->data['SeasionRate']['valid_to'][$key]));
                        $dataToSave = ['hotel_id'=>$this->data['SeasionRate']['hotel_id'],'valid_from'=>$validFrom,'valid_to'=>$validTo,'season_name'=>$this->data['SeasionRate']['season_name'][$key],'is_active'=>$this->data['SeasionRate']['is_active'][$key]];
                        $this->SeasionRate->create();
                        $this->SeasionRate->save($dataToSave);
                    }
                   
                }
                $response['status']=true;
                $response['id']=1;
            }
        }
        echo json_encode($response); die;
    }
    
    public function save_facility(){
        $this->autoRender = false;
        $this->loadModel('Admin.HotelFacilitiesSelected');
        if($this->request->is(array('PUT','POST' ))) {
            if(isset($this->data['HotelFacilitiesSelected']) && !empty($this->data['HotelFacilitiesSelected'])){
               
                $this->HotelFacilitiesSelected->deleteAll(array('HotelFacilitiesSelected.hotel_id' =>$this->data['HotelFacilitiesSelected']['hotel_id']), false);
                foreach($this->data['HotelFacilitiesSelected']['facility_id'] as $key=>$val){
                    if($key >0 ){
                        
                        $dataToSave = ['hotel_id'=>$this->data['HotelFacilitiesSelected']['hotel_id'],'faclities_id'=>$this->data['HotelFacilitiesSelected']['facility_id'][$key]];
                        
                        $this->HotelFacilitiesSelected->create();
                        $this->HotelFacilitiesSelected->save($dataToSave);
                    }
                   
                }
                $response['status']='success';
                $response['id']=$this->data['HotelFacilitiesSelected']['hotel_id'];
            }
        }
        echo json_encode($response); 
    }
    public function save_policy(){
        $this->autoRender = false;
        $this->loadModel('Admin.Hotel');
        if($this->request->is(array('PUT','POST' ))) {
            if(isset($this->data['Hotel']) && !empty($this->data['Hotel'])){
                $this->Hotel->id = $this->data['Hotel']['hotel_id'];
                $this->Hotel->saveField('hotel_policies', $this->data['Hotel']['hotel_policies']);
                $response['status']=true;
                $response['id']=$this->data['Hotel']['hotel_id'];
            }
        }
        echo json_encode($response); 


    }
    public function delete($id){
        $this->autoRender = false;
        $this->loadModel('Admin.Cms');
        if($id != ""){
            $this->Cms->deleteAll(array('Cms.id' => $id), false);
            $this->Session->setFlash(__('Page deleted successfully.',true),'success');
            $this->redirect(array('controller'=>'cms','action' => 'index','plugin'=>'admin'));
        }else{
            $this->Session->setFlash(__('Invalid request.',true),'error');
            $this->redirect(array('controller'=>'cms','action' => 'index','plugin'=>'admin'));
        }
    }
    
  
   
}