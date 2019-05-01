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
class BedTypeController extends AdminAppController
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
        
        $title = "Bed Type List";
        $this->set('title_for_layout', $title);
        $this->set(compact('title'));

    }
    public function add() {
        $this->loadModel('Admin.BedType');
        $this->loadModel('Admin.RoomFacility');
        $this->loadModel('Admin.RoomFacilityInfo');
        $this->loadModel('Admin.RoomImages');
        $this->loadModel('Admin.RoomSelectedFacility');
        $this->RoomFacility->bindModel([
            'hasMany'=>[
                'RoomFacilityInfo'=>[
                  'className'=>'RoomFacilityInfo',
                  'foreignKey'=>'room_facility_id'
                ]
            ],
            
        ]);
        $hotelFacility = $this->RoomFacility->find('all',['conditions'=>['RoomFacility.is_active'=>1]]); 
        if ($this->request->is(array('PUT','POST' ))) {
            
            if (!empty($this->data)) {
                $this->BedType->set($this->data['BedType']);
                if($this->BedType->validates()) {
                    //pr( $this->BedType); die;
                    if(!isset($this->request->data['BedType']['id']) && $this->request->data['BedType']['id']== ""){
                        $this->BedType->create();
                    }
                    $this->BedType->save();
                    if(!isset($this->request->data['BedType']['id']) && $this->request->data['BedType']['id']== ""){
                        
                        $id = $this->BedType->getLastInsertId();
                    }else{
                        $id =$this->data['BedType']['id'];
                    }
                    if(isset($this->data['BedType']['images']) && !empty($this->data['BedType']['images'])){
                        $this->RoomImages->deleteAll(array('RoomImages.bed_type_id' => $id), false);
                        foreach($this->data['BedType']['images'] as $image){
                            $dataTosave =['bed_type_id'=>$id,'file'=>$image];
                            $this->RoomImages->save($dataTosave);
                        }
                       
                    }
                    if(isset($this->data['RoomFacilitySelected']) && !empty($this->data['RoomFacilitySelected'])){
                        $this->RoomSelectedFacility->deleteAll(array('RoomSelectedFacility.bed_type_id' => $id), false);
                        foreach($this->data['RoomFacilitySelected'] as $facility){
                            
                            $dataTosave =['bed_type_id'=>$id,'facility_info_id'=>$facility[0]];
                            $this->RoomSelectedFacility->save($dataTosave);
                        }
                       
                    }
                    $this->Session->setFlash(__('Bed Type saved successfully...',true),'success');
                    $this->redirect(array('controller'=>'bed_type','action' => 'index','plugin'=>'admin'));

                }
            }
           
        }elseif(!$this->request->is('post')){      
            $id = (isset($this->request->params['pass'][0]))?$this->request->params['pass'][0]:0;
            if($id > 0){
                $this->BedType->bindModel([
                    'hasMany'=>[
                        'RoomImages'=>[
                          'className'=>'RoomImages',
                          'foreignKey'=>'bed_type_id'
                        ],
                        'RoomSelectedFacility'=>[
                            'className'=>'RoomSelectedFacility',
                            'foreignKey'=>'bed_type_id'
                        ]
                    ],
                    
                ]);
                $data = $this->BedType->find('first',['conditions'=>['BedType.id'=>$id]]); 
                $this->request->data['BedType'] = $data['BedType']; 
                $this->request->data['RoomImages'] = $data['RoomImages'];             
                $this->request->data['RoomSelectedFacility'] = $data['RoomSelectedFacility'];             
            }
        }
        
        
        $title = "Bed Type";
        $this->set('title_for_layout', $title);
       
        $this->set(compact('title','hotelFacility','CmsImages'));

	}
 
}