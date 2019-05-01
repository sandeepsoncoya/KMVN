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
class SiteSettingsController extends AdminAppController
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
        
        $title = "Site Settings";
        $this->set('title_for_layout', $title);
        $this->loadModel('Admin.SiteSettings');
        $this->set(compact('title'));
        if ($this->request->is(array('PUT','POST' ))) {
            $data = $this->request->data['SiteSettings'];
            $this->SiteSettings->set($data);                      
            if($this->SiteSettings->validates()){
                if(!empty($this->data['SiteSettings']['image_logo']['tmp_name'])){
                    $fileArray =  explode(".",$this->data['SiteSettings']['image_logo']['name']);
                    $fileExtension = end($fileArray);
                    $fileName =  str_replace(" ","_",'logo').'_'.time().".".$fileExtension;
                    $filePath = Configure::read('RelativeUrl').'SiteSettings/';                    
                    move_uploaded_file($this->data['SiteSettings']['image_logo']['tmp_name'],$filePath.$fileName);
                    $data['logo'] = $fileName;
                }else{
                    $data['logo'] = (isset($this->data['SiteSettings']['logo']))?$this->data['SiteSettings']['logo']:'';
                }
                
                if(!empty($this->data['SiteSettings']['favion_image']['tmp_name'])){
                    $fileArray =  explode(".",$this->data['SiteSettings']['favion_image']['name']);
                    $fileExtension = end($fileArray);
                    $fileName =  str_replace(" ","_",'favion').'_'.time().".".$fileExtension;
                    $filePath = Configure::read('RelativeUrl').'SiteSettings/';                    
                    move_uploaded_file($this->data['SiteSettings']['favion_image']['tmp_name'],$filePath.$fileName);
                    $data['favion'] = $fileName;
                }else{
                    $data['favion'] = (isset($this->data['SiteSettings']['favion']))?$this->data['SiteSettings']['favion']:'';
                } 
                if(!empty($this->data['SiteSettings']['footer_logo_image']['tmp_name'])){
                    $fileArray =  explode(".",$this->data['SiteSettings']['footer_logo_image']['name']);
                    $fileExtension = end($fileArray);
                    $fileName =  str_replace(" ","_",'footer_logo').'_'.time().".".$fileExtension;
                    $filePath = Configure::read('RelativeUrl').'SiteSettings/';                    
                    move_uploaded_file($this->data['SiteSettings']['footer_logo_image']['tmp_name'],$filePath.$fileName);
                    $data['footer_logo'] = $fileName;
                }else{
                    $data['footer_logo'] = (isset($this->data['SiteSettings']['footer_logo']))?$this->data['SiteSettings']['footer_logo']:'';
                } 
                if(!empty($this->data['SiteSettings']['destination_inner_banner_image']['tmp_name'])){
                    $fileArray =  explode(".",$this->data['SiteSettings']['destination_inner_banner_image']['name']);
                    $fileExtension = end($fileArray);
                    $fileName =  str_replace(" ","_",'destination_inner_banner').'_'.time().".".$fileExtension;
                    $filePath = Configure::read('RelativeUrl').'SiteSettings/';                    
                    move_uploaded_file($this->data['SiteSettings']['destination_inner_banner_image']['tmp_name'],$filePath.$fileName);
                    $data['destination_inner_banner'] = $fileName;
                }else{
                    $data['destination_inner_banner'] = (isset($this->data['SiteSettings']['destination_inner_banner']))?$this->data['SiteSettings']['destination_inner_banner']:'';
                }
                if(!empty($this->data['SiteSettings']['package_inner_banner_image']['tmp_name'])){
                    $fileArray =  explode(".",$this->data['SiteSettings']['package_inner_banner_image']['name']);
                    $fileExtension = end($fileArray);
                    $fileName =  str_replace(" ","_",'package_inner_banner').'_'.time().".".$fileExtension;
                    $filePath = Configure::read('RelativeUrl').'SiteSettings/';                    
                    move_uploaded_file($this->data['SiteSettings']['package_inner_banner_image']['tmp_name'],$filePath.$fileName);
                    $data['package_inner_banner'] = $fileName;
                }else{
                    $data['package_inner_banner'] = (isset($this->data['SiteSettings']['package_inner_banner']))?$this->data['SiteSettings']['package_inner_banner']:'';
                }
                if(!isset($this->request->data['SiteSettings']['id'])){
                    $this->Cms->create();
                   
                }              
                $this->SiteSettings->save($data);
                $this->Session->setFlash(__('Site Settings saved successfully...',true),'success');
                $this->redirect(array('controller'=>'site_settings','action' => 'index',1,'plugin'=>'admin'));
            }else{
            }
        }elseif(!$this->request->is('post')){      
            $id = (isset($this->request->params['pass'][0]))?$this->request->params['pass'][0]:0;
            if($id > 0){
                $data = $this->SiteSettings->findById($id);
                if(!empty($data)):
                    $this->request->data['SiteSettings'] = $data['SiteSettings'];
                endif;
                          
            }
        }

    }
    public function add(){
        
        $title = "Add Page";
        $this->set('title_for_layout', $title);
        $this->loadModel('Admin.Users');
        $this->loadModel('Admin.Cms');
        $this->loadModel('Admin.College');
        $collegeList = [];
        $groupsList =  $this->Users->find('list',['conditions'=>['role'=>2]]); 
       
        if ($this->request->is(array('PUT','POST' ))) {
            $data = $this->request->data['Cms'];
            $this->Cms->set($data); 
                     
            if($this->Cms->validates()){
                if(!empty($this->data['Cms']['image_cms']['tmp_name'])){
                    $fileArray =  explode(".",$this->data['Cms']['image_cms']['name']);
                    $fileExtension = end($fileArray);
                    $fileName =  str_replace(" ","_",$this->data['Cms']['title']).'_'.time().".".$fileExtension;
                    $filePath = Configure::read('RelativeUrl').'cms/';                    
                    move_uploaded_file($this->data['Cms']['image_cms']['tmp_name'],$filePath.$fileName);
                    $data['image'] = $fileName;
                }else{
                    $data['image'] = (isset($this->data['Cms']['image']))?$this->data['Cms']['image']:'';
                }           
                if(!isset($this->request->data['Cms']['id'])){
                    $this->Cms->create();
                   
                }
                $this->Cms->save($data);
                $this->Session->setFlash(__('Cms saved successfully...',true),'success');
                $this->redirect(array('controller'=>'cms','action' => 'index','plugin'=>'admin'));
            }else{
            }
        }elseif(!$this->request->is('post')){      
            $id = (isset($this->request->params['pass'][0]))?$this->request->params['pass'][0]:0;
            if($id > 0){
                $data = $this->Cms->findById($id);
                if(!empty($data)){
                    $groupId =  $data['Cms']['group_id'];
                    $collegeList =  $this->College->find('list',['conditions'=>['group_id'=>$groupId]]);
                }
                $this->request->data['Cms'] = $data['Cms']; 
                          
            }
        }
        $userData  = $this->getGroupDetails();  
        $isGroup = false;     
        if(isset($userData['Users']['role']) &&  $userData['Users']['role'] == 2){
           
            $this->request->data['Cms']['group_id'] = $userData['Users']['id'];
            $collegeList =  $this->College->find('list',['conditions'=>['group_id'=>$userData['Users']['id']]]);
            $isGroup = true;   
           
        }    
        $this->set(compact('title','groupsList','collegeList','isGroup'));

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