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
class CompanyController extends AdminAppController
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
        
        $title = "Companies List";
        $this->set('title_for_layout', $title);
        $this->set(compact('title'));

    }
    public function add(){
        
        $title = "Add Company";
        $this->set('title_for_layout', $title);
        $this->loadModel('Admin.Company');
        $this->loadModel('Admin.City');
        $this->loadModel('Admin.Hotel');
        $this->loadModel('Admin.CompanyHotels');


        //get city list
        $cityList  =  $this->City->find('list',['conditions'=>['is_active'=>1]]);
        
        //get city and hotel all data
        $this->City->bindModel([
            'hasMany'=>[
                'Hotel'=>[
                  'className'=>'Hotel',
                  'foreignKey'=>'city',
                  'fields'=>['id', 'title']
                ]
            ],
            
        ]);
        $cityHotelData  =  $this->City->find('all', [ 'conditions'=>['is_active'=>1]]);
            
        
        if ($this->request->is(array('PUT','POST'))) {
              
            $modelName ='Company';  
            if (!empty($this->data)) {
                $this->loadModel('Admin.'.$modelName); 
                $slug = Inflector::slug(strtolower(trim($this->data[$modelName]['name'])), $replacement = '-');
                $idslug = null;
                if($this->data['Company']['id']!= ""){
                    $idslug = $this->data['Company']['id'];
                }
                $slug = $this->createSlug(trim($this->data[$modelName]['name']),$idslug,$modelName);
                $this->request->data[$modelName]['slug']= $slug;
                $this->$modelName->set($this->data[$modelName]);
                
                //pr($this->data); die;
                if($this->$modelName->validates()) {
                    if (isset($this->data[$modelName])) {
                        if(!isset($this->data[$modelName]['id']) && $this->data[$modelName]['id']== ""){
                            $this->$modelName->create();
                        }
                       
                        if($this->$modelName->save()){

                            if(!isset($this->request->data['Company']['id'])){
                                $company_id = $this->$modelName->getInsertID();                
                            }else{
                                $company_id = $this->request->data['Company']['id'];     
                            }
                            
                            if(isset($company_id)){
                                if(!empty($this->request->data['CompanyHotels'])){
                                    $this->CompanyHotels->deleteAll(array('CompanyHotels.company_id' => $company_id), false);

                                    $compArr = [];
                                    foreach ($this->request->data['CompanyHotels'] as $key => $value) {
                                        foreach ($value['hotel_id'] as $h_key => $h_val) {
                                            $compArr['company_id']  = $company_id;
                                            $compArr['city_id']     = $value['city_id'];
                                            $compArr['hotel_id']    = $h_val;
                                            $this->CompanyHotels->create();
                                            $this->CompanyHotels->save($compArr);
                                        }
                                    }
                                }
                            }
                        }

                        $this->Session->setFlash(__('Company saved successfully.',true),'success');
                        $this->redirect(array('controller'=>'company','action' => 'index','plugin'=>'admin'));
                    }
                }
            }
        }elseif(!$this->request->is('post')){      
            $id = (isset($this->request->params['pass'][0]))?$this->request->params['pass'][0]:0;
            if($id > 0){

                $this->Company->bindModel([
                    'hasMany'=>[
                        'CompanyHotels'=>[
                          'className'=>'CompanyHotels',
                          'foreignKey'=>'company_id'
                        ]
                    ],
                    
                ]);

                $data = $this->Company->find('first',['conditions'=>['Company.id'=>$id]]);

                $this->request->data['Company']         = $data['Company']; 
                $this->request->data['CompanyHotels']   = $data['CompanyHotels']; 
            }
        }
        
        $this->set(compact('title','cityList','cityHotelData'));
    }
}