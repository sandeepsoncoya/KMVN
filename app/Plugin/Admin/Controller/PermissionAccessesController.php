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
class PermissionAccessesController extends AdminAppController
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
        
        $title = "Company User List";
        $this->set('title_for_layout', $title);
        $this->set(compact('title'));

    }
    public function add_permission($role_id){
        $title = "Add Role Permission";
        $this->set('title_for_layout', $title);
        $this->loadModel('Admin.PermissionAccesses');
        $this->loadModel('Admin.PermissionModules');
        $this->loadModel('Admin.PermissionSubModule');

        $this->PermissionModules->bindModel([
            'hasMany'=>[
                'PermissionSubModules'=>[
                  'className'=>'PermissionSubModules',
                  'foreignKey'=>'permission_module_id'
                ]
            ],
            
        ]);
        $moduleLists = $this->PermissionModules->find('all',['conditions'=>['PermissionModules.status'=>1]]);
        
        $permissionAccessesData = $this->PermissionAccesses->find('first',['conditions'=>['role_id'=>$role_id],'fields'=>['id']]);

       

        if ($this->request->is(array('PUT','POST'))) {
            //pr($this->request->data); die;
            if(!empty($permissionAccessesData)){
                $this->PermissionAccesses->deleteAll(array('PermissionAccesses.id' => $permissionAccessesData['PermissionAccesses']['id']), false);  
            }
            

            $modelName ='PermissionAccesses';  
            if (!empty($this->data)) {
                $this->loadModel('Admin.'.$modelName); 
                $this->request->data[$modelName]['role_id'] = $role_id;
                $this->request->data[$modelName]['access_modules'] = json_encode($this->request->data['Acesses']);
                $this->$modelName->set($this->data[$modelName]);

                //pr($this->request->data[$modelName]['permission_sub_module_id']); die;
                if (isset($this->data[$modelName])) {

                    if(!isset($this->data[$modelName]['id']) && $this->data[$modelName]['id']== ""){
                        $this->$modelName->create();
                    }

                    $this->$modelName->save();
                    $this->Session->setFlash(__('Permission saved successfully.',true),'success');
                    $this->redirect(array('controller'=>'roles','action' => 'index','plugin'=>'admin'));
                }
            }
        }elseif(!$this->request->is('post')){      
            
            $id = (isset($permissionAccessesData['PermissionAccesses']['id']))?$permissionAccessesData['PermissionAccesses']['id']:0;
            $moduleArr = [];
            $submoduleArr = [];
            if($id > 0){

                $data = $this->PermissionAccesses->find('first',['conditions'=>['PermissionAccesses.id'=>$id]]);
               
                $this->request->data['PermissionAccesses']['role_id'] = $data['PermissionAccesses']['role_id']; 


                
                $moduleDataDecoded = json_decode($data['PermissionAccesses']['access_modules']);
                foreach ( $moduleDataDecoded as $value) {
                    $moduleArr[] = $value->permission_module_id;
                    $submoduleArr[] = isset($value->permission_sub_module_id) ? $value->permission_sub_module_id : 0;
                }
                
               // $this->request->data['PermissionAccesses']['module_id'] = $moduleArr; 
               // $this->request->data['PermissionAccesses']['sub_module_id'] = $submoduleArr; 
            }
        }
        //pr($moduleArr); die;
        //pr($submoduleArr); die;
        $this->set(compact('title','moduleLists','moduleArr','submoduleArr'));
    }
}