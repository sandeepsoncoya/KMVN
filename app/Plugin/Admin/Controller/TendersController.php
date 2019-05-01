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
class TendersController extends AdminAppController
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
        
        $title = "Tender";
        $this->set('title_for_layout', $title);
        $this->set(compact('title'));

    }
    public function add(){
        $title = "Add Tender";
        $this->set('title_for_layout', $title);
        $this->loadModel('Admin.TenderCategories');
        $this->loadModel('Admin.Tenders');
        if ($this->request->is(array('PUT','POST' ))) {
            $data = $this->request->data['Tenders'];
            $this->Tenders->set($data); 
            if($this->Tenders->validates()){
                if(!empty($this->data['Tenders']['featured_img']['tmp_name'])){
                    $fileArray =  explode(".",$this->data['Tenders']['featured_img']['name']);
                    $fileExtension = end($fileArray);
                    $fileName =  str_replace(" ","_",$this->data['Tenders']['name']).'_'.time().".".$fileExtension;
                    $filePath = Configure::read('RelativeUrl').'tenders/';                    
                    move_uploaded_file($this->data['Tenders']['featured_img']['tmp_name'],$filePath.$fileName);
                    $data['file'] = $fileName;
                }else{
                    $data['file'] = (isset($this->data['Tenders']['file']))?$this->data['Tenders']['file']:'';
                }
                if(!isset($this->request->data['Tenders']['id'])){
                    $data['slug']= $this->createSlug($this->data['Tenders']['name'],NULL,'Tenders'); 
                    $this->Tenders->create();                   
                }else{
                    $data['slug']= $this->createSlug($this->data['Tenders']['name'],$this->request->data['Tenders']['id'],'Tenders'); 

                }
                $data['slug']=Inflector::slug(strtolower($this->data['Tenders']['name']), $replacement = '-');
                $this->Tenders->save($data);
                
                $this->Session->setFlash(__('Tenders saved successfully...',true),'success');
                $this->redirect(array('controller'=>'Tenders','action' => 'index','plugin'=>'admin'));
            }else{
                  
            }
        }elseif(!$this->request->is('post')){      
            $id = (isset($this->request->params['pass'][0]))?$this->request->params['pass'][0]:0;
            if($id > 0){
                $data = $this->Tenders->find('first',['conditions'=>['Tenders.id'=>$id]]);
                $this->request->data['Tenders'] = $data['Tenders']; 
                          
            }
        }
        $tenderCategories = $this->TenderCategories->find('list',['keyField'=>'id','valueField'=>'name','conditions'=>['TenderCategories.is_active'=>1]]);
        $this->set(compact('title','tenderCategories'));
    }
    public function delete($id){
        $this->autoRender = false;
        $this->loadModel('Admin.Tenders');
        if($id != ""){
            $this->Tenders->deleteAll(array('Tenders.id' => $id), false);
            $this->Session->setFlash(__('Tenders deleted successfully.',true),'success');
            $this->redirect(array('controller'=>'Tenders','action' => 'index','plugin'=>'admin'));
        }else{
            $this->Session->setFlash(__('Invalid request.',true),'error');
            $this->redirect(array('controller'=>'Tenders','action' => 'index','plugin'=>'admin'));
        }
    }

    

    
  
   
}