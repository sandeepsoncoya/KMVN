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
class GalleryController extends AdminAppController
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
        
        $title = "Gallery";
        $this->set('title_for_layout', $title);
        $this->set(compact('title'));

    }
    public function add(){
        $title = "Add to gallery";
        $this->set('title_for_layout', $title);
        $this->loadModel('Admin.Gallery');
        if ($this->request->is(array('PUT','POST' ))) {

            $data = $this->request->data['Gallery'];
            $this->Gallery->set($data); 
            if($this->Gallery->validates()){
                if(!empty($this->data['Gallery']['featured_img']['tmp_name'])){
                    $fileArray =  explode(".",$this->data['Gallery']['featured_img']['name']);
                    $fileExtension = end($fileArray);
                    $fileName =  str_replace(" ","_",$this->data['Gallery']['title']).'_'.time().".".$fileExtension;
                    $filePath = Configure::read('RelativeUrl').'gallery/';                    
                    move_uploaded_file($this->data['Gallery']['featured_img']['tmp_name'],$filePath.$fileName);
                    $data['file'] = $fileName;
                }else{
                    $data['file'] = (isset($this->data['Gallery']['file']))?$this->data['Gallery']['file']:'';
                }
                if(!isset($this->request->data['Gallery']['id'])){
                    $this->Gallery->create();                   
                }
                $this->Gallery->save($data);
                
                $this->Session->setFlash(__('Gallery saved successfully...',true),'success');
                $this->redirect(array('controller'=>'Gallery','action' => 'index','plugin'=>'admin'));
            }else{
                  
            }
        }elseif(!$this->request->is('post')){      
            $id = (isset($this->request->params['pass'][0]))?$this->request->params['pass'][0]:0;
            if($id > 0){
                $data = $this->Gallery->find('first',['conditions'=>['Gallery.id'=>$id]]);
                $this->request->data['Gallery'] = $data['Gallery']; 
                          
            }
        }
        $this->set(compact('title'));
    }
    public function delete($id){
        $this->autoRender = false;
        $this->loadModel('Admin.Gallery');
        if($id != ""){
            $this->Gallery->deleteAll(array('Gallery.id' => $id), false);
            $this->Session->setFlash(__('Deleted successfully.',true),'success');
            $this->redirect(array('controller'=>'Gallery','action' => 'index','plugin'=>'admin'));
        }else{
            $this->Session->setFlash(__('Invalid request.',true),'error');
            $this->redirect(array('controller'=>'Gallery','action' => 'index','plugin'=>'admin'));
        }
    }

    

    
  
   
}