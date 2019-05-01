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
class SliderController extends AdminAppController
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
        
        $title = "Slider List";
        $this->set('title_for_layout', $title);
        $this->set(compact('title'));

    }
    public function add(){
        
        $title = "Add Slide";
        $this->set('title_for_layout', $title);
        $this->loadModel('Admin.Slider');
       
       
        if ($this->request->is(array('PUT','POST' ))) {
            $data = $this->request->data['Slider'];
            $this->Slider->set($data);                      
            if($this->Slider->validates()){
                if(!empty($this->data['Slider']['banner_img']['tmp_name'])){
                    $fileArray =  explode(".",$this->data['Slider']['banner_img']['name']);
                    $fileExtension = end($fileArray);
                    $fileName =  'slide_'.str_replace(" ","_",$this->data['Slider']['title']).'_'.time().".".$fileExtension;
                    $filePath = Configure::read('RelativeUrl').'slider/';                    
                    move_uploaded_file($this->data['Slider']['banner_img']['tmp_name'],$filePath.$fileName);
                    $data['image'] = $fileName;
                }else{
                    $data['image'] = (isset($this->data['Slider']['image']))?$this->data['Slider']['image']:'';
                }
               
                if(!empty($this->data['Slider']['background_img']['tmp_name'])){
                    $fileArray =  explode(".",$this->data['Slider']['background_img']['name']);
                    $fileExtension = end($fileArray);
                    $fileName =  'slide_background_'.str_replace(" ","_",$this->data['Slider']['title']).'_'.time().".".$fileExtension;
                    $filePath = Configure::read('RelativeUrl').'slider/';                    
                    move_uploaded_file($this->data['Slider']['background_img']['tmp_name'],$filePath.$fileName);
                    $data['background'] = $fileName;
                }else{
                    $data['background'] = (isset($this->data['Slider']['background']))?$this->data['Slider']['background']:'';
                }
                $this->Slider->save($data);
                $this->Session->setFlash(__('Slide saved successfully...',true),'success');
                $this->redirect(array('controller'=>'slider','action' => 'index','plugin'=>'admin'));
            }else{
            }
        }elseif(!$this->request->is('post')){      
            $id = (isset($this->request->params['pass'][0]))?$this->request->params['pass'][0]:0;
            if($id > 0){
                $data = $this->Slider->findById($id);
                $this->request->data['Slider'] = $data['Slider']; 
                          
            }
        }
         
        $this->set(compact('title'));

    }
    public function delete($id){
        $this->autoRender = false;
        $this->loadModel('Admin.Slider');
        if($id != ""){
            $this->Slider->deleteAll(array('Slider.id' => $id), false);
            $this->Session->setFlash(__('Slider deleted successfully.',true),'success');
            $this->redirect(array('controller'=>'slider','action' => 'index','plugin'=>'admin'));
        }else{
            $this->Session->setFlash(__('Invalid request.',true),'error');
            $this->redirect(array('controller'=>'slider','action' => 'index','plugin'=>'admin'));
        }
    }
    
  
   
}