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
class StatesController extends AdminAppController
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
        
        $title = "States List";
        $this->set('title_for_layout', $title);
        $this->set(compact('title'));

    }
    public function add(){
        
        $title = "Add State";
        $this->set('title_for_layout', $title);
        $this->loadModel('Admin.States');
        if ($this->request->is(array('PUT','POST' ))) {

            $data = $this->request->data['States'];
            $this->States->set($data); 
                     
            if($this->States->validates()){
                
                if(!isset($this->request->data['States']['id'])){
                    $this->States->create();
                   
                }
                $this->States->save($data);
                $this->Session->setFlash(__('State saved successfully...',true),'success');
                $this->redirect(array('controller'=>'States','action' => 'index','plugin'=>'admin'));
            }else{
            }
        }elseif(!$this->request->is('post')){      
            $id = (isset($this->request->params['pass'][0]))?$this->request->params['pass'][0]:0;
            if($id > 0){
                $data = $this->States->findById($id);
                $this->request->data['States'] = $data['States']; 
                          
            }
        }
        
        $this->set(compact('title'));

    }
    public function delete($id){
        $this->autoRender = false;
        $this->loadModel('Admin.States');
        if($id != ""){
            $this->States->deleteAll(array('States.id' => $id), false);
            $this->Session->setFlash(__('State deleted successfully.',true),'success');
            $this->redirect(array('controller'=>'States','action' => 'index','plugin'=>'admin'));
        }else{
            $this->Session->setFlash(__('Invalid request.',true),'error');
            $this->redirect(array('controller'=>'States','action' => 'index','plugin'=>'admin'));
        }
    }

    
    

    function form(){
        if($this->request->is('ajax')){
             $this->layout = 'ajax';
             $modelName =  $this->request->data['model'];
             if(isset($this->request->data['id'])){
                 $this->loadModel("Admin.".$modelName);
                 $data =  $this->$modelName->findById($this->request->data['id']);
                 $this->request->data[$modelName] = $data[$modelName]; 
             }
             $this->loadModel("Admin.States");
             $states = $this->States->find('list',['keyField'=>'id','valueField'=>'title']);
            $this->set(compact('modelName','states'));
            $this->render('States/form');
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