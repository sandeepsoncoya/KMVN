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
class CityController extends AdminAppController
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
        
        $title = "City List";
        $this->set('title_for_layout', $title);
        $this->set(compact('title'));

    }
    public function add(){
        
        $title = "Add City";
        $this->set('title_for_layout', $title);
        $this->loadModel('Admin.City');
        if ($this->request->is(array('PUT','POST' ))) {

            $data = $this->request->data['City'];
            $this->City->set($data); 
                     
            if($this->City->validates()){
                
                if(!isset($this->request->data['City']['id'])){
                    $this->City->create();
                   
                }
                $this->City->save($data);
                $this->Session->setFlash(__('City saved successfully...',true),'success');
                $this->redirect(array('controller'=>'City','action' => 'index','plugin'=>'admin'));
            }else{
            }
        }elseif(!$this->request->is('post')){      
            $id = (isset($this->request->params['pass'][0]))?$this->request->params['pass'][0]:0;
            if($id > 0){
                $data = $this->City->findById($id);
                $this->request->data['City'] = $data['City']; 
                          
            }
        }
        
        $this->set(compact('title'));

    }
    public function delete($id){
        $this->autoRender = false;
        $this->loadModel('Admin.City');
        if($id != ""){
            $this->City->deleteAll(array('City.id' => $id), false);
            $this->Session->setFlash(__('City deleted successfully.',true),'success');
            $this->redirect(array('controller'=>'City','action' => 'index','plugin'=>'admin'));
        }else{
            $this->Session->setFlash(__('Invalid request.',true),'error');
            $this->redirect(array('controller'=>'City','action' => 'index','plugin'=>'admin'));
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
            $this->render('City/form');
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


    /*
     * get suburb by city id
     */
    public function getSuburbs() {
      $this->loadModel('Admin.Suburb');
      $suburbs = array();
      if (isset($this->request['data']['id'])) {
        $suburbs = $this->Suburb->find('list', array(
          'fields' => array(
            'id',
            'name',
          ),
          'conditions' => array(
            'Suburb.city_id' => $this->request['data']['id']
          )
        ));
      }
      header('Content-Type: application/json');
      echo json_encode($suburbs);
      exit();
    }
  
   
}