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
class TenderCategoriesController extends AdminAppController
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
        
        $title = "Tender Category List";
        $this->set('title_for_layout', $title);
        $this->set(compact('title'));

    }
    public function add(){
        
        $title = "Add Tender  Category";
        $this->set('title_for_layout', $title);
        $this->loadModel('Admin.TenderCategories');
       
       
        if ($this->request->is(array('PUT','POST' ))) {
            $data = $this->request->data['TenderCategories'];
            $this->TenderCategories->set($data); 
                     
            if($this->TenderCategories->validates()){
                
                if(!isset($this->request->data['TenderCategories']['id'])){
                    $this->TenderCategories->create();
                   
                }
                $data['slug']=Inflector::slug(strtolower($this->data['TenderCategories']['name']), $replacement = '-');
                $this->TenderCategories->save($data);
                $this->Session->setFlash(__('Tender category saved successfully...',true),'success');
                $this->redirect(array('controller'=>'TenderCategories','action' => 'index','plugin'=>'admin'));
            }else{
            }
        }elseif(!$this->request->is('post')){      
            $id = (isset($this->request->params['pass'][0]))?$this->request->params['pass'][0]:0;
            if($id > 0){
                $data = $this->TenderCategories->findById($id);
                $this->request->data['TenderCategories'] = $data['TenderCategories']; 
                          
            }
        }
        
        $this->set(compact('title'));

    }
    public function delete($id){
        $this->autoRender = false;
        $this->loadModel('Admin.TenderCategories');
        if($id != ""){
            $this->TenderCategories->deleteAll(array('TenderCategories.id' => $id), false);
            $this->Session->setFlash(__('Tender category deleted successfully.',true),'success');
            $this->redirect(array('controller'=>'TenderCategories','action' => 'index','plugin'=>'admin'));
        }else{
            $this->Session->setFlash(__('Invalid request.',true),'error');
            $this->redirect(array('controller'=>'TenderCategories','action' => 'index','plugin'=>'admin'));
        }
    }

    
    

    public function form(){
        if($this->request->is('ajax')){

             $this->layout = 'ajax';
             $modelName =  $this->request->data['model'];
             if(isset($this->request->data['id'])){
                 $this->loadModel("Admin.".$modelName);
                 $data =  $this->$modelName->findById($this->request->data['id']);
                 $this->request->data[$modelName] = $data[$modelName]; 
             }
            $this->set(compact('modelName'));
            $this->render('TenderCategories/form');
        }
    }

    public function save_data(){
        if ($this->request->is('ajax')) {
            if (!empty($this->data)) {
                $modelName =$this->data['model'];         
                $this->loadModel('Admin.'.$modelName); 
                $this-> $modelName->set($this->data[$modelName]);
                if($this->$modelName->validates()) {
                    if ($this->$modelName->save($this->data[$modelName])) {
                      $response=array();
                      $response['status']='success';
                      $response['message']=$modelName.' has been saved.';
                      $response['data']=$this->data;
                      echo json_encode($response);
                      die;
                    }
                }else {
                    $response=array();
                    $err = $this->$modelName->invalidFields();
                    $response['status']='error';
                    $response['message']=$modelName.' could not be saved. Please, try again.';
                    $response['data']=[$modelName=>$err];
                    echo json_encode($response);
                    die;
                }
            }
        }
    }
  
   
}