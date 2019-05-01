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
class AttractionController extends AdminAppController
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
        
        $title = "Attraction";
        $this->set('title_for_layout', $title);
        $this->set(compact('title'));

    }
    public function add(){
        
        $title = "Add Attraction";
        $this->set('title_for_layout', $title);
        $this->loadModel('Admin.AttractionImages');
        $this->loadModel('Admin.Attraction');
        
        if ($this->request->is(array('PUT','POST' ))) {

            $data = $this->request->data['Attraction'];
            $this->Attraction->set($data); 

            if($this->Attraction->validates()){
                if(!empty($this->data['Attraction']['featured_img']['tmp_name'])){
                    $fileArray =  explode(".",$this->data['Attraction']['featured_img']['name']);
                    $fileExtension = end($fileArray);
                    $fileName =  str_replace(" ","_",$this->data['Attraction']['title']).'_'.time().".".$fileExtension;
                    $filePath = Configure::read('RelativeUrl').'attraction/';                    
                    move_uploaded_file($this->data['Attraction']['featured_img']['tmp_name'],$filePath.$fileName);
                    $data['featured_image'] = $fileName;
                }else{
                    $data['featured_image'] = (isset($this->data['Attraction']['featured_image']))?$this->data['Attraction']['featured_image']:'';
                }
                      
                if(!isset($this->request->data['Attraction']['id'])){
                    $data['slug']= $this->createSlug($this->data['Attraction']['title'],NULL,'Attraction'); 
                    $this->Attraction->create();                   
                }else{
                    $data['slug']= $this->createSlug($this->data['Attraction']['title'],$this->request->data['Attraction']['id'],'Attraction'); 
                }
                //$data['slug']= Inflector::slug(strtolower($this->data['Attraction']['title']), $replacement = '-');
                
                $this->Attraction->save($data);
                if(!isset($this->request->data['Attraction']['id'])){
                    $AttractionId =   $this->Attraction->getInsertID();                 
                }else{
                    $AttractionId =  $this->request->data['Attraction']['id'];     
                }
                if(isset($AttractionId)){
                    $this->AttractionImages->deleteAll(array('AttractionImages.attraction_id' => $AttractionId), false);
                    if(!empty($data['images'])){
                        $i = 0;
                        foreach($data['images'] as $image){
                            $alt = $data['alt'][$i];
                            $dataToSave = ['file'=>$image,'attraction_id'=>$AttractionId,'alt'=>$alt];
                            $this->AttractionImages->create();
                            $this->AttractionImages->save($dataToSave);
                            $i++;
                        }
                    }
                }
                $this->Session->setFlash(__('Attraction saved successfully...',true),'success');
                $this->redirect(array('controller'=>'attraction','action' => 'index','plugin'=>'admin'));
            }else{
            }
        }elseif(!$this->request->is('post')){      
            $id = (isset($this->request->params['pass'][0]))?$this->request->params['pass'][0]:0;
            if($id > 0){
                $this->Attraction->bindModel([
                    'hasMany'=>[
                        'AttractionImages'=>[
                          'className'=>'AttractionImages',
                          'foreignKey'=>'attraction_id'
                        ]
                    ],
                    
                ]);
                $data = $this->Attraction->find('first',['conditions'=>['attraction.id'=>$id]]);              
                $this->request->data['Attraction'] = $data['Attraction']; 
                $this->request->data['AttractionImages'] = $data['AttractionImages'];             
            }
        }
        
        $this->set(compact('title','AttractionImages'));

    }
    public function delete($id){
        $this->autoRender = false;
        $this->loadModel('Admin.Attraction');
        if($id != ""){
            $this->Attraction->deleteAll(array('Attraction.id' => $id), false);
            $this->Session->setFlash(__('Attraction deleted successfully.',true),'success');
            $this->redirect(array('controller'=>'attraction','action' => 'index','plugin'=>'admin'));
        }else{
            $this->Session->setFlash(__('Invalid request.',true),'error');
            $this->redirect(array('controller'=>'attraction','action' => 'index','plugin'=>'admin'));
        }
    }
   
}