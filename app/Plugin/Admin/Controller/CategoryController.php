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
class CategoryController extends AdminAppController
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
        
        $title = "Category List";
        $this->set('title_for_layout', $title);
        $this->set(compact('title'));

    }
    public function add(){
        
        $title = "Add Category";
        $this->set('title_for_layout', $title);
        $this->loadModel('Admin.Category');
       
       
        if ($this->request->is(array('PUT','POST' ))) {
            $data = $this->request->data['Category'];
            $this->Category->set($data); 
                     
            if($this->Category->validates()){
                if(!empty($this->data['Category']['banner_img']['tmp_name'])){
                    $fileArray =  explode(".",$this->data['Category']['banner_img']['name']);
                    $fileExtension = end($fileArray);
                    $fileName =  'banner_'.str_replace(" ","_",$this->data['Category']['title']).'_'.time().".".$fileExtension;
                    $filePath = Configure::read('RelativeUrl').'category/';                    
                    move_uploaded_file($this->data['Category']['banner_img']['tmp_name'],$filePath.$fileName);
                    $data['banner_image'] = $fileName;
                }else{
                    $data['banner_image'] = (isset($this->data['Category']['banner_image']))?$this->data['Category']['banner_image']:'';
                }
                if(!empty($this->data['Category']['featured_img']['tmp_name'])){
                    $fileArray =  explode(".",$this->data['Category']['featured_img']['name']);
                    $fileExtension = end($fileArray);
                    $fileName =  'featured_'.str_replace(" ","_",$this->data['Category']['title']).'_'.time().".".$fileExtension;
                    $filePath = Configure::read('RelativeUrl').'category/';                    
                    move_uploaded_file($this->data['Category']['featured_img']['tmp_name'],$filePath.$fileName);
                    $data['featured_image'] = $fileName;
                    $destiMain=Configure::read('RelativeUrl').'category/thumb/'.$fileName;
                    $targetWidthMain = '270';
                    $src=$filePath.$fileName;
                    $this->createThumbnail($src, $destiMain, $targetWidthMain, $targetHeight = '270');
                }else{
                    $data['featured_image'] = (isset($this->data['Category']['featured_image']))?$this->data['Category']['featured_image']:'';
                } 
                
                if(!empty($this->data['Category']['icon_img']['tmp_name'])){
                    $fileArray =  explode(".",$this->data['Category']['icon_img']['name']);
                    $fileExtension = end($fileArray);
                    $fileName =  'icon_'.str_replace(" ","_",$this->data['Category']['title']).'_'.time().".".$fileExtension;
                    $filePath = Configure::read('RelativeUrl').'category/';                    
                    move_uploaded_file($this->data['Category']['icon_img']['tmp_name'],$filePath.$fileName);
                    $data['icon'] = $fileName;
                }else{
                    $data['icon'] = (isset($this->data['Category']['icon']))?$this->data['Category']['icon']:'';
                } 
                if(!isset($this->request->data['Category']['id'])){
                    $this->Category->create();
                   
                }
                $data['slug']=Inflector::slug(strtolower($this->data['Category']['title']), $replacement = '-');
                $this->Category->save($data);
                $this->Session->setFlash(__('Category saved successfully...',true),'success');
                $this->redirect(array('controller'=>'category','action' => 'index','plugin'=>'admin'));
            }else{
            }
        }elseif(!$this->request->is('post')){      
            $id = (isset($this->request->params['pass'][0]))?$this->request->params['pass'][0]:0;
            if($id > 0){
                $data = $this->Category->findById($id);
                $this->request->data['Category'] = $data['Category']; 
                          
            }
        }
        
        $this->set(compact('title'));

    }
    public function delete($id){
        $this->autoRender = false;
        $this->loadModel('Admin.Category');
        if($id != ""){
            $this->Category->deleteAll(array('Category.id' => $id), false);
            $this->Session->setFlash(__('Category deleted successfully.',true),'success');
            $this->redirect(array('controller'=>'category','action' => 'index','plugin'=>'admin'));
        }else{
            $this->Session->setFlash(__('Invalid request.',true),'error');
            $this->redirect(array('controller'=>'category','action' => 'index','plugin'=>'admin'));
        }
    }
    
  
   
}