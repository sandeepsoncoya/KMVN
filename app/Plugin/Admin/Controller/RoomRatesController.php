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
class RoomRatesController extends AdminAppController
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
        
        $title = "Room Rates";
        $hotelId =  $this->request->params['named']['hotel'];
        $this->set('title_for_layout', $title);
        $this->set(compact('title','hotelId'));

    }
    public function add(){
        
        $title = "Room Rates";
        $this->set('title_for_layout', $title);
        $this->loadModel('Admin.RoomRates');
        $this->loadModel('Admin.Room');
        $this->loadModel('Admin.RateCode');
        $this->loadModel('Admin.SeasionRate');
        $this->loadModel('Admin.RateInclude');
        $this->loadModel('Admin.RoomInclusionSelected');
        $this->loadModel('Admin.RoomCancellation');
        $this->loadModel('Admin.BedTypeHotel');
        $this->loadModel('Admin.BedType');
        $hotelId = (isset($this->request->params['named']['hotel']))?$this->request->params['named']['hotel']:0;
        $rooms = $this->Room->find('list',['conditions'=>['is_active'=>1],'fields'=>['id','room_type']]);
        $rateCode = $this->RateCode->find('list',['conditions'=>['is_active'=>1],'fields'=>['id','title']]);
        $rateInclude = $this->RateInclude->find('all',['conditions'=>['is_active'=>1],'fields'=>['id','title']]);
        $season = $this->SeasionRate->find('list',['conditions'=>['is_active'=>1,'hotel_id'=>$hotelId],'fields'=>['id','season_name']]);
        $bedTypeArr=[];
        if ($this->request->is(array('PUT','POST' ))) {


            if (!empty($this->data)) {
                $this->request->data['RoomRates']['hotel_id'] = $hotelId;

                $this->RoomRates->set($this->data['RoomRates']);
                
                if($this->RoomRates->validates()) {

                    if($this->request->data['RoomRates']['id']== ""){
                        $this->RoomRates->create();
                    }
                    $this->RoomRates->save($this->data['RoomRates']);
                    if($this->request->data['RoomRates']['id']== ""){
                        $id = $this->RoomRates->getLastInsertId();
                    }else{
                        $id =$this->data['RoomRates']['id'];
                    }
                    
                    if(isset($this->data['RoomInclusionSelected']) && !empty($this->data['RoomInclusionSelected'])){
                        $this->RoomInclusionSelected->deleteAll(array('RoomInclusionSelected.rate_id' => $id), false);
                        foreach($this->data['RoomInclusionSelected'] as $facility){
                            
                            $dataTosave =['rate_id'=>$id,'include_id'=>$facility[0]];
                            $this->RoomInclusionSelected->save($dataTosave);
                        }
                       
                    }
                    $this->RoomCancellation->deleteAll(array('RoomCancellation.rate_id' => $id), false);
                    $roomId =  $this->request->data['RoomRates']['room_id'];
                    $bedTypeId =  $this->request->data['RoomRates']['bed_type_id'];
                   
                    foreach($this->data['RoomRates']['days'] as $key=>$val){
                        $dataTosave =['rate_id'=>$id,'room_id'=>$roomId,'bed_type_id'=>$bedTypeId,'days'=>$this->data['RoomRates']['days'][$key],'time'=>$this->data['RoomRates']['time'][$key],'refund_percentage'=>$this->data['RoomRates']['refund_percentage'][$key],'refund_tax'=>$this->data['RoomRates']['refund_tax'][$key]];
                        $this->RoomCancellation->create();
                        $this->RoomCancellation->save($dataTosave);

                    }
                    
                    $this->Session->setFlash(__('Room Rate saved successfully...',true),'success');
                    $this->redirect(array('controller'=>'room_rates','action' => 'index','plugin'=>'admin','hotel'=>$hotelId));

                }
            }
           
        }elseif(!$this->request->is('post')){      
            $id = (isset($this->request->params['pass'][0]))?$this->request->params['pass'][0]:0;
            if($id > 0){
                $this->RoomRates->bindModel([
                    'hasMany'=>[
                        'RoomInclusionSelected'=>[
                          'className'=>'RoomInclusionSelected',
                          'foreignKey'=>'rate_id',
                          
                        ],
                        'RoomCancellation'=>[
                            'className'=>'RoomCancellation',
                            'foreignKey'=>'rate_id'
                        ]
                    ],
                    
                ]);
                
               
                $data = $this->RoomRates->find('first',['conditions'=>['RoomRates.id'=>$id]]);
                
                if($data['RoomRates']['room_id'] != ""){
                    $roomId = $data['RoomRates']['room_id'];
                    $this->BedTypeHotel->bindModel(
                        array(
                        'belongsTo'=>array(
                            'BedType' =>array(
                                    'className' => 'Admin.BedType',
                                    'foreignKey'=> 'bed_type',
                                    'fields'=>['BedType.id','BedType.title']
                                )
                            )
                        )
                    );
                    $dataBedType = $this->BedTypeHotel->find('all',['conditions'=>['BedTypeHotel.room_id'=>$roomId]]);
                   
                    if(!empty($dataBedType)){
                        foreach($dataBedType as $bedType){
                            $bedTypeArr[$bedType['BedType']['id']]=$bedType['BedType']['title'];
                        }
                    }
                }  
               
                $this->request->data['RoomRates'] = $data['RoomRates']; 
                $this->request->data['RoomInclusionSelected'] = $data['RoomInclusionSelected'];             
                $this->request->data['RoomCancellation'] = $data['RoomCancellation'];             
            }
        }
        
        $this->set(compact('title','rooms','rateCode','season','rateInclude','hotelId','bedTypeArr'));

    }
    public function delete($id){
        $this->autoRender = false;
        $this->loadModel('Admin.Services');
        if($id != ""){
            $this->Services->deleteAll(array('Services.id' => $id), false);
            $this->Session->setFlash(__('Service deleted successfully.',true),'success');
            $this->redirect(array('controller'=>'Services','action' => 'index','plugin'=>'admin'));
        }else{
            $this->Session->setFlash(__('Invalid request.',true),'error');
            $this->redirect(array('controller'=>'Services','action' => 'index','plugin'=>'admin'));
        }
    }
   
}