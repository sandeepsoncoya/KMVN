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
class CmsController extends AdminAppController
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
        
        $title = "Pages List";
        $this->set('title_for_layout', $title);
        $this->set(compact('title'));

    }
    public function add(){
        
        $title = "Add Page";
        $this->set('title_for_layout', $title);
        $this->loadModel('Admin.Users');
        $this->loadModel('Admin.Cms');
        $this->loadModel('Admin.CmsImages');
        $this->loadModel('Admin.Category');
        
        $categoryList =  $this->Category->find('list',['conditions'=>['status'=>1,'type'=>1]]); 
       
        if ($this->request->is(array('PUT','POST' ))) {
            $data = $this->request->data['Cms'];
            $this->Cms->set($data); 
                     
            if($this->Cms->validates()){
                if(!empty($this->data['Cms']['featured_img']['tmp_name'])){
                    $fileArray =  explode(".",$this->data['Cms']['featured_img']['name']);
                    $fileExtension = end($fileArray);
                    $fileName =  str_replace(" ","_",$this->data['Cms']['title']).'_'.time().".".$fileExtension;
                    $filePath = Configure::read('RelativeUrl').'cms/';                    
                    move_uploaded_file($this->data['Cms']['featured_img']['tmp_name'],$filePath.$fileName);
                    $data['featured_image'] = $fileName;
                }else{
                    $data['featured_image'] = (isset($this->data['Cms']['featured_image']))?$this->data['Cms']['featured_image']:'';
                }
                if(!empty($this->data['Cms']['banner_img']['tmp_name'])){
                    $fileArray =  explode(".",$this->data['Cms']['banner_img']['name']);
                    $fileExtension = end($fileArray);
                    $fileName =  str_replace(" ","_",$this->data['Cms']['title']).'_banner_'.time().".".$fileExtension;
                    $filePath = Configure::read('RelativeUrl').'cms/';                    
                    move_uploaded_file($this->data['Cms']['banner_img']['tmp_name'],$filePath.$fileName);
                    $data['banner_image'] = $fileName;
                }else{
                    $data['banner_image'] = (isset($this->data['Cms']['banner_image']))?$this->data['Cms']['banner_image']:'';
                }          
                if(!isset($this->request->data['Cms']['id'])){
                    $this->Cms->create();                   
                }
                $data['slug']=Inflector::slug(strtolower($this->data['Cms']['title']), $replacement = '-');
                $this->Cms->save($data);
                if(!isset($this->request->data['Cms']['id'])){
                    $cmsId =   $this->Cms->getInsertID();                 
                }else{
                    $cmsId =  $this->request->data['Cms']['id'];     
                }
                if(isset($cmsId)){
                    $this->CmsImages->deleteAll(array('CmsImages.cms_id' => $cmsId), false);
                    if(!empty($data['images'])){
                        $i = 0;
                        foreach($data['images'] as $image){
                            $alt = $data['alt'][$i];
                            $dataToSave = ['file'=>$image,'cms_id'=>$cmsId,'alt'=>$alt];
                            $this->CmsImages->create();
                            $this->CmsImages->save($dataToSave);
                            $i++;
                        }
                    }
                }
                $this->Session->setFlash(__('Cms saved successfully...',true),'success');
                $this->redirect(array('controller'=>'cms','action' => 'index','plugin'=>'admin'));
            }else{
            }
        }elseif(!$this->request->is('post')){      
            $id = (isset($this->request->params['pass'][0]))?$this->request->params['pass'][0]:0;
            if($id > 0){
                $this->Cms->bindModel([
                    'hasMany'=>[
                        'CmsImages'=>[
                          'className'=>'CmsImages',
                          'foreignKey'=>'cms_id'
                        ]
                    ],
                    
                ]);
                $data = $this->Cms->find('first',['conditions'=>['Cms.id'=>$id]]);              
                $this->request->data['Cms'] = $data['Cms']; 
                $this->request->data['CmsImages'] = $data['CmsImages'];             
            }
        }
        
        $this->set(compact('title','categoryList','CmsImages'));

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