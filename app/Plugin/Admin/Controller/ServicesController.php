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
class ServicesController extends AdminAppController
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
        
        $title = "Services";
        $this->set('title_for_layout', $title);
        $this->set(compact('title'));

    }
    public function add(){
        
        $title = "Add Service";
        $this->set('title_for_layout', $title);
        $this->loadModel('Admin.Services');
        
        if ($this->request->is(array('PUT','POST' ))) {
            $data = $this->request->data['Services'];

            $this->Services->set($data); 
            if($this->Services->validates()){
                if(!empty($this->data['Services']['featured_img']['tmp_name'])){
                    $fileArray =  explode(".",$this->data['Services']['featured_img']['name']);
                    $fileExtension = end($fileArray);
                    $fileName =  str_replace(" ","_",$this->data['Services']['title']).'_'.time().".".$fileExtension;
                    $filePath = Configure::read('RelativeUrl').'services/';                    
                    move_uploaded_file($this->data['Services']['featured_img']['tmp_name'],$filePath.$fileName);
                    $data['featured_image'] = $fileName;
                }else{
                    $data['featured_image'] = (isset($this->data['Services']['featured_image']))?$this->data['Services']['featured_image']:'';
                }
                if(!isset($this->request->data['Services']['id'])){
                    $this->Services->create();                   
                }
                $data['slug']=Inflector::slug(strtolower($this->data['Services']['title']), $replacement = '-');
                $this->Services->save($data);
            
                $this->Session->setFlash(__('Service saved successfully...',true),'success');
                $this->redirect(array('controller'=>'Services','action' => 'index','plugin'=>'admin'));
            }else{
            }
        }elseif(!$this->request->is('post')){      
            $id = (isset($this->request->params['pass'][0]))?$this->request->params['pass'][0]:0;
            if($id > 0){
                $data = $this->Services->find('first',['conditions'=>['Services.id'=>$id]]);
                $this->request->data['Services'] = $data['Services']; 
                          
            }
        }
        
        $this->set(compact('title'));

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