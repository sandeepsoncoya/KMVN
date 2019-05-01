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
class CompanyUsersController extends AdminAppController
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
    public function add(){
        
        $title = "Add Company Users";
        $this->set('title_for_layout', $title);
        $this->loadModel('Admin.CompanyUsers');
        $this->loadModel('Admin.Company');
        $this->loadModel('Admin.City');
        


        //get city list
        $cityList = $this->City->find('list',['conditions'=>['is_active'=>1]]);
        //get company list
        $companyList = $this->Company->find('list',['conditions'=>['is_active'=>1]]);

        $suburbs = array();

        if ($this->request->is(array('PUT','POST'))) {
              
            $modelName ='CompanyUsers';  
            if (!empty($this->data)) {
                $this->loadModel('Admin.'.$modelName); 

                $this->request->data[$modelName]['password'] = Security::hash($this->request->data[$modelName]['password'], NULL, true); 
                $fullname = trim($this->data[$modelName]['first_name']).' '.trim($this->data[$modelName]['last_name']);
                $slug = Inflector::slug(strtolower($fullname), $replacement = '-');
                $idslug = null;
                if($this->data['CompanyUsers']['id']!= ""){
                    $idslug = $this->data['CompanyUsers']['id'];
                }

                $slug = $this->createSlug($fullname,$idslug,$modelName);
                $this->request->data[$modelName]['slug']= $slug;
                $this->$modelName->set($this->data[$modelName]);
                
                //pr($this->data); die;
                if($this->$modelName->validates()) {
                    if (isset($this->data[$modelName])) {
                        if(!isset($this->data[$modelName]['id']) && $this->data[$modelName]['id']== ""){
                            $this->$modelName->create();
                        }

                       
                        $this->$modelName->save();
                        $this->Session->setFlash(__('Users saved successfully.',true),'success');
                        $this->redirect(array('controller'=>'company_users','action' => 'index','plugin'=>'admin'));
                    }
                }
            }
        }elseif(!$this->request->is('post')){      
            $id = (isset($this->request->params['pass'][0]))?$this->request->params['pass'][0]:0;
            if($id > 0){

                $this->CompanyUsers->bindModel([
                    'belongsTo'=>[
                        'Company'=>[
                          'className'=>'Company',
                          'foreignKey'=>'company_id'
                        ]
                    ],
                    
                ]);

                $data = $this->CompanyUsers->find('first',['conditions'=>['CompanyUsers.id'=>$id]]);
                $this->request->data['CompanyUsers'] = $data['CompanyUsers']; 
                $this->request->data['CompanyUsers']['password'] = "";
                $this->request->data['Company']      = $data['Company']; 
            }
        }
        
        $this->set(compact('title','cityList','companyList','suburbs'));
    }
}