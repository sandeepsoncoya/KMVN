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
class DestinationController extends AdminAppController
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
        
        $title = "Destination";
        $this->set('title_for_layout', $title);
        $this->set(compact('title'));

    }
    public function add(){
        $title = "Add Destination";
        $this->set('title_for_layout', $title);
        $this->loadModel('Admin.DestinationImages');
        $this->loadModel('Admin.Destination');
        $this->loadModel('Admin.DestinationAttraction');
        $this->loadModel('Admin.Attraction');
        $this->loadModel('Admin.City');
        
        if ($this->request->is(array('PUT','POST' ))) {
            $data = $this->request->data['Destination'];
            $attraction = $this->request->data['DestinationAttraction']['attraction'];
            $this->Destination->set($data); 
            if($this->Destination->validates()){
                if(!empty($this->data['Destination']['featured_img']['tmp_name'])){
                    $fileArray =  explode(".",$this->data['Destination']['featured_img']['name']);
                    $fileExtension = end($fileArray);
                    $fileName =  str_replace(" ","_",$this->data['Destination']['title']).'_'.time().".".$fileExtension;
                    $filePath = Configure::read('RelativeUrl').'destination/';                    
                    move_uploaded_file($this->data['Destination']['featured_img']['tmp_name'],$filePath.$fileName);
                    $data['featured_image'] = $fileName;
                }else{
                    $data['featured_image'] = (isset($this->data['Destination']['featured_image']))?$this->data['Destination']['featured_image']:'';
                }
                if(!isset($this->request->data['Destination']['id'])){
                    $data['slug']= $this->createSlug($this->data['Destination']['title'],NULL,'Destination'); 
                    $this->Destination->create();                   
                }else{
                    $data['slug']= $this->createSlug($this->data['Destination']['title'],$this->request->data['Destination']['id'],'Destination'); 

                }
               // $data['slug']=Inflector::slug(strtolower($this->data['Destination']['title']), $replacement = '-');
                $this->Destination->save($data);
                if(!isset($this->request->data['Destination']['id'])){
                    $DestinationId =   $this->Destination->getInsertID();                 
                }else{
                    $DestinationId =  $this->request->data['Destination']['id'];     
                }
                if(isset($DestinationId)){
                    $this->DestinationImages->deleteAll(array('DestinationImages.destination_id' => $DestinationId), false);
                    if(!empty($data['images'])){
                        $i = 0;
                        foreach($data['images'] as $image){
                            $alt = $data['alt'][$i];
                            $dataToSave = ['file'=>$image,'destination_id'=>$DestinationId,'alt'=>$alt];
                            $this->DestinationImages->create();
                            $this->DestinationImages->save($dataToSave);
                            $i++;
                        }
                    }
                }

                if(isset($DestinationId)){
                    $this->DestinationAttraction->deleteAll(array('DestinationAttraction.destination_id' => $DestinationId), false);
                    if(!empty($attraction)){
                        for($i=0; $i<count($attraction); $i++) {
                        $dataToSaveI = ['attraction_id'=>$attraction[$i],'destination_id'=>$DestinationId];
                            $this->DestinationAttraction->create();
                            $saved = $this->DestinationAttraction->save($dataToSaveI);
                        }
                    }
                }
                $this->Session->setFlash(__('Destination saved successfully...',true),'success');
                $this->redirect(array('controller'=>'Destination','action' => 'index','plugin'=>'admin'));
            }
        }elseif(!$this->request->is('post')){      
            $id = (isset($this->request->params['pass'][0]))?$this->request->params['pass'][0]:0;
            if($id > 0){
                $this->Destination->bindModel([
                    'hasMany'=>[
                        'DestinationImages'=>[
                          'className'=>'DestinationImages',
                          'foreignKey'=>'destination_id'
                        ]
                    ],
                    
                ]);

                $this->Destination->bindModel([
                    'hasMany'=>[
                        'DestinationAttraction'=>[
                          'className'=>'DestinationAttraction',
                          'foreignKey'=>'destination_id'
                        ]
                    ],
                    
                ]);

                $data = $this->Destination->find('first',['conditions'=>['Destination.id'=>$id]]);
                $this->request->data['Destination'] = $data['Destination']; 
                $this->request->data['DestinationImages'] = $data['DestinationImages'];             
                $this->request->data['DestinationAttraction'] = $data['DestinationAttraction'];             
            }
        }
        $attarctions = $this->Attraction->find('list',['keyField'=>'id','valueField'=>'title']);
        $cities = $this->City->find('list',['keyField'=>'id','valueField'=>'title']);
        $this->set(compact('title','DestinationImages','DestinationAttraction','attarctions','cities'));
    }
    public function delete($id){
        $this->autoRender = false;
        $this->loadModel('Admin.Destination');
        if($id != ""){
          

            $this->Destination->deleteAll(array('Destination.id' => $id), false);
            $this->DestinationImages->deleteAll(array('DestinationImages.destination_id' => $id), false);
            $this->DestinationAttraction->deleteAll(array('DestinationAttraction.destination_id' => $id), false);
            $this->Session->setFlash(__('Destination deleted successfully.',true),'success');
            $this->redirect(array('controller'=>'Destination','action' => 'index','plugin'=>'admin'));
        }else{
            $this->Session->setFlash(__('Invalid request.',true),'error');
            $this->redirect(array('controller'=>'Destination','action' => 'index','plugin'=>'admin'));
        }
    }

    

    
  
   
}