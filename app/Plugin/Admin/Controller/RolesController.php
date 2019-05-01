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
class RolesController extends AdminAppController
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
        
        $title = "Roles List";
        $this->set('title_for_layout', $title);
        $this->set(compact('title'));

    }
    public function add(){
        
        $title = "Add Roles";
        $this->set('title_for_layout', $title);
        $this->loadModel('Admin.Roles');
        
        //pr($moduleLists); die;
        $moduleLists = [];
        if ($this->request->is(array('PUT','POST'))) {
            //pr($this->request->data); die;
            $modelName ='Roles';  
            if (!empty($this->data)) {
                $this->loadModel('Admin.'.$modelName); 
                $slug = Inflector::slug(strtolower(trim($this->data[$modelName]['name'])), $replacement = '-');
                $idslug = null;
                if($this->data['Roles']['id']!= ""){
                    $idslug = $this->data['Roles']['id'];
                }
                $slug = $this->createSlug(trim($this->data[$modelName]['name']),$idslug,$modelName);
                $this->request->data[$modelName]['slug']= $slug;
                $this->$modelName->set($this->data[$modelName]);
             
                if($this->$modelName->validates()) {
                    if (isset($this->data[$modelName])) {
                        if(!isset($this->data[$modelName]['id']) && $this->data[$modelName]['id']== ""){
                            $this->$modelName->create();
                        }
                       
                        $this->$modelName->save();

                        $this->Session->setFlash(__('Role saved successfully.',true),'success');
                        $this->redirect(array('controller'=>'roles','action' => 'index','plugin'=>'admin'));
                    }
                }
            }
        }elseif(!$this->request->is('post')){      
            $id = (isset($this->request->params['pass'][0]))?$this->request->params['pass'][0]:0;
            if($id > 0){
                $data = $this->Roles->find('first',['conditions'=>['Roles.id'=>$id]]);
                $this->request->data['Roles'] = $data['Roles']; 
            }
        }
        
        $this->set(compact('title','moduleLists'));
    }
}