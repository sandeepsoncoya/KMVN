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
App::uses('AdminController', 'Admin.Controller');
class AjaxController extends AdminAppController
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
    function beforeFilter() {
        $this->checklogin();
    }
    public function listing(){
        $this->autoRender = false;
        $modelName = $this->request->data['model'];
        $this->loadModel('Admin.'.$modelName);
        $column = $this->request['data']['order'][0]['column'];
        $sortColumn = 'modified';

        if($column == 0){
            $sortColumn = $modelName.'.title';
        }
        if($column == 1){
            $sortColumn = $modelName.'.status';
        }
        $conditions=[];
        if(!empty($this->request['data']['search'])){
            $searchItem = $this->request['data']['search']['value'];
            if($searchItem != ""){
               $searchItem="%".$searchItem."%";
               $conditions[$modelName.'.title like'] = $searchItem; 
            }
        }
        $order =  "DESC";
        $startLimit = $this->request['data']['start'];
        $length = $this->request['data']['length'];        
        $datas = $this->$modelName->find('all',['conditions'=>$conditions,'offset'=>$startLimit,'limit'=>$length,'order'=>[$sortColumn=>$order]]);
        $total = $this->$modelName->find('count');
        $info = [];
        foreach ($datas as $data) {
            $id = $data[$modelName]['id'];
            $actionList = '<a href="javascript:void(0)" data-editId="'.$id.'" class="text-inverse p-r-10 edit" data-model="'.$modelName.'" data-action="form" data-toggle="tooltip" title="Edit" data-original-title="Edit"><i class="ti-marker-alt"></i></a>';
            $actionList .= '<a href="javascript:void(0)" data-deleteId="'.$id.'" data-model="'.$modelName.'" class="text-inverse delete" title="Delete" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash"></i></a>';
            if($data[$modelName]['is_active'] == 1){
                $status='<span class="label label-success font-weight-100">Active</span>';
            }else{
                $status='<span class="label label-danger font-weight-100">De-active</span>';
            }
            $info[] = [$data[$modelName]['title'],$status,$actionList];
        }
        $response['draw'] =$this->request['data']['draw'];
        $response['recordsTotal'] = $total;
        $response['recordsFiltered'] = $total;
        $response['data'] =$info;
        echo json_encode($response);
        die;
    }
    public function listing_ajax(){
        $this->autoRender = false;
        $modelName = $this->request->data['model'];
        $this->loadModel('Admin.'.$modelName);
        $column = $this->request['data']['order'][0]['column'];
        $sortColumn = 'modified';

        if($column == 0){
            $sortColumn = $modelName.'.title';
        }
        if($column == 1){
            $sortColumn = $modelName.'.status';
        }
        $conditions=[];
        if(!empty($this->request['data']['search'])){
            $searchItem = $this->request['data']['search']['value'];
            if($searchItem != ""){
               $searchItem="%".$searchItem."%";
               $conditions[$modelName.'.title like'] = $searchItem; 
            }
        }
        $order =  "DESC";
        $startLimit = $this->request['data']['start'];
        $length = $this->request['data']['length'];        
        $datas = $this->$modelName->find('all',['conditions'=>$conditions,'offset'=>$startLimit,'limit'=>$length,'order'=>[$sortColumn=>$order]]);
        $total = $this->$modelName->find('count');
        $info = [];
        foreach ($datas as $data) {
            $id = $data[$modelName]['id'];
            $actionList = '<a href="javascript:void(0)" data-editId="'.$id.'" class="text-inverse p-r-10 edit" data-model="'.$modelName.'" data-action="form_ajax" data-toggle="tooltip" title="Edit" data-original-title="Edit"><i class="ti-marker-alt"></i></a>';
            $actionList .= '<a href="javascript:void(0)" data-deleteId="'.$id.'" data-model="'.$modelName.'" class="text-inverse delete" title="Delete" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash"></i></a>';
            if($data[$modelName]['is_active'] == 1){
                $status='<span class="label label-success font-weight-100">Active</span>';
            }else{
                $status='<span class="label label-danger font-weight-100">De-active</span>';
            }
            $info[] = [$data[$modelName]['title'],$status,$actionList];
        }
        $response['draw'] =$this->request['data']['draw'];
        $response['recordsTotal'] = $total;
        $response['recordsFiltered'] = $total;
        $response['data'] =$info;
        echo json_encode($response);
        die;
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
            $this->set(compact('modelName'));
            $this->render('Faqs/form');
        }
    }

    function form_ajax(){
        if($this->request->is('ajax')){
             $this->layout = 'ajax';
             $modelName =  $this->request->data['model'];
             if(isset($this->request->data['id'])){
                 $this->loadModel("Admin.".$modelName);
                 $data =  $this->$modelName->findById($this->request->data['id']);
                 $this->request->data[$modelName] = $data[$modelName]; 
             }
            $this->set(compact('modelName'));
            $this->render('Ajax/form');
        }
    }
    
    function form_bed_type(){
        $this->loadModel("Admin.BedType");
        if($this->request->is('ajax')){
            $this->layout = 'ajax';
            $modelName =  $this->request->data['model'];
            if(isset($this->request->data['id'])){
                $this->loadModel("Admin.".$modelName);
                $data =  $this->$modelName->findById($this->request->data['id']);
                $this->request->data[$modelName] = $data[$modelName]; 
            }
            $this->set(compact('modelName'));
            $this->render('Ajax/'.$modelName);
        } 
    }
    function hotel_facilities_info_form(){
        $this->loadModel("Admin.HotelFacilities");
        if($this->request->is('ajax')){
            $this->layout = 'ajax';
            $modelName =  $this->request->data['model'];
            if(isset($this->request->data['id'])){
                $this->loadModel("Admin.".$modelName);
                $data =  $this->$modelName->findById($this->request->data['id']);
                $this->request->data[$modelName] = $data[$modelName]; 
            }
            $facilityList = $this->HotelFacilities->find('list',['conditions'=>['is_active'=>1],'fields'=>['id','title']]);
            $this->set(compact('facilityList'));
            $this->set(compact('modelName'));
            $this->render('Ajax/'.$modelName);
        }
    }
    function room_facilities_info_form(){
        $this->loadModel("Admin.RoomFacility");
        if($this->request->is('ajax')){
            $this->layout = 'ajax';
            $modelName =  $this->request->data['model'];
            if(isset($this->request->data['id'])){
                $this->loadModel("Admin.".$modelName);
                $data =  $this->$modelName->findById($this->request->data['id']);
                $this->request->data[$modelName] = $data[$modelName]; 
            }
            $facilityList = $this->RoomFacility->find('list',['conditions'=>['is_active'=>1],'fields'=>['id','title']]);
            $this->set(compact('facilityList'));
            $this->set(compact('modelName'));
            $this->render('Ajax/'.$modelName);
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
  
    public function save_facility_info(){
        if ($this->request->is('ajax')) {
            if (!empty($this->data)) {
                $modelName =$this->data['model'];         
                $this->loadModel('Admin.'.$modelName); 
                $this->$modelName->set($this->data[$modelName]);
                if($this->$modelName->validates()) {
                    if (isset($this->data[$modelName])) {
                        $this->$modelName->save($this->data[$modelName]);
                        $response['status']='success';
                        $response['message']=$modelName.' has been saved.';
                        $response['data']=$this->data;
                        echo json_encode($response);
                        die;
                    }
                }else{
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
    

    public function save_bed_type(){
        if ($this->request->is('ajax')) {
            if (!empty($this->data)) {
                $modelName =$this->data['model'];         
                $this->loadModel('Admin.'.$modelName); 
                $this->$modelName->set($this->data[$modelName]);
                if($this->$modelName->validates()) {
                    if (isset($this->data[$modelName])) {
                        $this->$modelName->save($this->data[$modelName]);
                        $response['status']='success';
                        $response['message']=$modelName.' has been saved.';
                        $response['data']=$this->data;
                        echo json_encode($response);
                        die;
                    }
                }else{
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
    public function list_slider(){
        $this->autoRender = false;
        $this->loadModel('Admin.Slider');
        $column = $this->request['data']['order'][0]['column'];
        $sortColumn = 'modified';
        if($column == 0){
            $sortColumn = 'Slider.title';
        }
        $conditions=[];
       
        if(!empty($this->request['data']['search'])){
            $searchItem = $this->request['data']['search']['value'];
            if($searchItem != ""){
               $searchItem="%".$searchItem."%";
               $conditions['Slider.title like'] = $searchItem; 
            }
            
        }
        $order =  strtoupper($this->request['data']['order'][0]['dir']);
        $startLimit = $this->request['data']['start'];
        $length = $this->request['data']['length'];        
       
        $datas = $this->Slider->find('all',['conditions'=>$conditions,'offset'=>$startLimit,'limit'=>$length,'order'=>[$sortColumn=>$order]]);
        $total = $this->Slider->find('count');
        $info = [];
        
        foreach ($datas as $data) {
            $id= $data['Slider']['id'];
            $url= Configure::read('siteUrl').'slider/add/'.$data['Slider']['id'];
            $urlDelete= Configure::read('siteUrl').'slider/delete/'.$data['Slider']['id'];           
            $actionList = '<div class="btn-group">
                            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-spin fa-cog"></i> 
                            </button>
                            <div class="dropdown-menu animated flipInX">
                                <a class="dropdown-item" href="'.$url.'">Edit</a>
                                <a class="dropdown-item delete" href="javascript:void(0)" data-url="'.$urlDelete.'" >Delete</a>
                                
                            </div>
                        </div>';
            $actionList = '<a href="'.$url.'" data-editId="'.$id.'" class="text-inverse p-r-10"  data-action="form" data-toggle="tooltip" title="Edit" data-original-title="Edit"><i class="ti-marker-alt"></i></a>';
            $actionList .= '<a href="javascript:void(0)" data-deleteId="'.$id.'" data-model="Slider" class="text-inverse delete" title="Delete" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash"></i></a>';
            $info[] = [$data['Slider']['title'],$actionList];
        }
        $response['draw'] =$this->request['data']['draw'];
        $response['recordsTotal'] = $total;
        $response['recordsFiltered'] = $total;
        $response['data'] =$info;
        echo json_encode($response);
        die;

    }

    /*
     * Listing Company Users
     */
    public function listing_company_users(){
        $this->autoRender = false;
        $this->loadModel('Admin.CompanyUsers');
        $this->loadModel('Admin.Company');
        $this->loadModel('Admin.City');
        
        //get company list
        $companyList = $this->Company->find('list',['conditions'=>['is_active'=>1]]);

        $column = $this->request['data']['order'][0]['column'];
        $sortColumn = 'modified';
        if($column == 0){
            $sortColumn = 'CompanyUsers.name';
        }
        if($column == 0){
            $sortColumn = 'CompanyUsers.company_name';
        }
        if($column == 0){
            $sortColumn = 'CompanyUsers.phone_number';
        }
        if($column == 0){
            $sortColumn = 'CompanyUsers.email';
        }
        if($column == 0){
            $sortColumn = 'CompanyUsers.website';
        }
        

        $conditions=[];
       
        if(!empty($this->request['data']['search'])){
            $searchItem = $this->request['data']['search']['value'];
            if($searchItem != ""){
               $searchItem="%".$searchItem."%";
               $conditions['CompanyUsers.name like'] = $searchItem; 
            }
            
        }
        $order =  strtoupper($this->request['data']['order'][0]['dir']);
        $startLimit = $this->request['data']['start'];
        $length = $this->request['data']['length'];        
       
        $datas = $this->CompanyUsers->find('all',['conditions'=>$conditions,'offset'=>$startLimit,'limit'=>$length,'order'=>[$sortColumn=>$order]]);
        $total = $this->CompanyUsers->find('count');
        $info = [];
        
        foreach ($datas as $data) {
            $id= $data['CompanyUsers']['id'];
            $url= Configure::read('siteUrl').'company_users/add/'.$data['CompanyUsers']['id'];
            $urlDelete= Configure::read('siteUrl').'company_users/delete/'.$data['CompanyUsers']['id'];  
            $urlWallet= Configure::read('siteUrl').'user_wallets/index/'.$data['CompanyUsers']['id'];  
            
            if($data['CompanyUsers']['is_active']==1){
                $status = "Active";
            }else{
                $status = "In-active";
            }         
           
            $actionList = '<a href="'.$url.'" class="text-inverse p-r-10" data-toggle="tooltip" title="Edit" data-original-title="Edit"><i class="ti-marker-alt"></i></a>';
            $actionList .= '<a href="javascript:void(0)" data-deleteId="'.$id.'" data-model="CompanyUsers" class="text-inverse delete" title="Delete" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash"></i></a>';
            $actionList .= '<a href="'.$urlWallet.'" class="text-inverse p-r-10" data-toggle="tooltip" title="Wallet List" data-original-title="Add Wallet"><i class="ti-money" aria-hidden="true"></i></a>';

            $info[] = [$data['CompanyUsers']['name'],$companyList[$data['CompanyUsers']['company_id']],$data['CompanyUsers']['phone_1'],$data['CompanyUsers']['email'],$data['CompanyUsers']['website'],$status,$actionList];
        }
        $response['draw'] =$this->request['data']['draw'];
        $response['recordsTotal'] = $total;
        $response['recordsFiltered'] = $total;
        $response['data'] =$info;
        echo json_encode($response);
        die;

    }

    /*
     *  Listing Company
     */
    public function listing_company(){
        $this->autoRender = false;
        $this->loadModel('Admin.Company');
        global $company_type;
        $column = $this->request['data']['order'][0]['column'];
        $sortColumn = 'modified';
        if($column == 0){
            $sortColumn = 'Company.name';
        }
        if($column == 0){
            $sortColumn = 'Company.company_type';
        }
        if($column == 0){
            $sortColumn = 'Company.email';
        }
        if($column == 0){
            $sortColumn = 'Company.phone_number';
        }
        if($column == 0){
            $sortColumn = 'Company.website';
        }
        

        $conditions=[];
       
        if(!empty($this->request['data']['search'])){
            $searchItem = $this->request['data']['search']['value'];
            if($searchItem != ""){
               $searchItem="%".$searchItem."%";
               $conditions['Company.name like'] = $searchItem; 
            }
            
        }
        $order =  strtoupper($this->request['data']['order'][0]['dir']);
        $startLimit = $this->request['data']['start'];
        $length = $this->request['data']['length'];        
       
        $datas = $this->Company->find('all',['conditions'=>$conditions,'offset'=>$startLimit,'limit'=>$length,'order'=>[$sortColumn=>$order]]);
        $total = $this->Company->find('count');
        $info = [];
        
        foreach ($datas as $data) {
            $id= $data['Company']['id'];
            $url= Configure::read('siteUrl').'company/add/'.$data['Company']['id'];
            $urlDelete= Configure::read('siteUrl').'company/delete/'.$data['Company']['id'];  
            if($data['Company']['is_active']==1){
                $status = "Active";
            }else{
                $status = "In-active";
            }         
            
            $actionList = '<a href="'.$url.'" class="text-inverse p-r-10"   data-toggle="tooltip" title="Edit" data-original-title="Edit"><i class="ti-marker-alt"></i></a>';
            $actionList .= '<a href="javascript:void(0)" data-deleteId="'.$id.'" data-model="Company" class="text-inverse delete" title="Delete" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash"></i></a>';
            $info[] = [$data['Company']['name'],$company_type[$data['Company']['company_type']],$data['Company']['phone_1'],$data['Company']['email'],$data['Company']['website'],$status,$actionList];
        }
        $response['draw'] =$this->request['data']['draw'];
        $response['recordsTotal'] = $total;
        $response['recordsFiltered'] = $total;
        $response['data'] =$info;
        echo json_encode($response);
        die;

    }


    /*
     *  Listing Role
     */
    public function listing_role(){
        $this->autoRender = false;
        $this->loadModel('Admin.Roles');
       
        $column = $this->request['data']['order'][0]['column'];
        $sortColumn = 'Roles.id';
        if($column == 0){
            $sortColumn = 'Roles.name';
        }
        
        $conditions=[];
       
        if(!empty($this->request['data']['search'])){
            $searchItem = $this->request['data']['search']['value'];
            if($searchItem != ""){
               $searchItem="%".$searchItem."%";
               $conditions['Roles.name like'] = $searchItem; 
            }
        }
        $order =  strtoupper($this->request['data']['order'][0]['dir']);
        $startLimit = $this->request['data']['start'];
        $length = $this->request['data']['length'];        
       
        $datas = $this->Roles->find('all',['conditions'=>$conditions,'offset'=>$startLimit,'limit'=>$length,'order'=>[$sortColumn=>$order]]);
        $total = $this->Roles->find('count');
        $info = [];
        
        foreach ($datas as $data) {
            $id= $data['Roles']['id'];
            $url= Configure::read('siteUrl').'roles/add/'.$data['Roles']['id'];
            $urlDelete= Configure::read('siteUrl').'roles/delete/'.$data['Roles']['id'];  
            $urlPermission= Configure::read('siteUrl').'permission_accesses/add_permission/'.$data['Roles']['id'];
            
            $actionList = '<a href="'.$url.'" class="text-inverse p-r-10" data-toggle="tooltip" title="Edit" data-original-title="Edit"><i class="ti-marker-alt"></i></a>';
            $actionList .= '<a href="'.$urlPermission.'" class="text-inverse p-r-10" data-toggle="tooltip" title="Permission Access" data-original-title="Permission Access"><i class="ti-plus"></i></a>';
            $actionList .= '<a href="javascript:void(0)" data-deleteId="'.$id.'" data-model="Roles" class="text-inverse delete" title="Delete" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash"></i></a>';
            $info[] = [$data['Roles']['name'],date('Y-m-d H:i:s', strtotime($data['Roles']['created'])),$actionList];
        }
        $response['draw'] =$this->request['data']['draw'];
        $response['recordsTotal'] = $total;
        $response['recordsFiltered'] = $total;
        $response['data'] =$info;
        echo json_encode($response);
        die;

    }


    /*
     *  Listing User
     */
    public function listing_user(){
        $this->autoRender = false;
        $this->loadModel('Admin.Users');
        $this->loadModel('Admin.Roles');
        //get roles list
        $roles = $this->Roles->find('list');
       
        $column = $this->request['data']['order'][0]['column'];
        $sortColumn = 'modified';
        if($column == 0){
            $sortColumn = 'Users.name';
        }
        if($column == 0){
            $sortColumn = 'Users.role';
        }
        if($column == 0){
            $sortColumn = 'Users.email';
        }
        if($column == 0){
            $sortColumn = 'Users.phone';
        }
        

        $conditions=['role !='=> 1];
       
        if(!empty($this->request['data']['search'])){
            $searchItem = $this->request['data']['search']['value'];
            if($searchItem != ""){
               $searchItem="%".$searchItem."%";
               $conditions['Users.name like'] = $searchItem; 
            }
            
        }
        $order =  strtoupper($this->request['data']['order'][0]['dir']);
        $startLimit = $this->request['data']['start'];
        $length = $this->request['data']['length'];        
       
        $datas = $this->Users->find('all',['conditions'=>$conditions,'offset'=>$startLimit,'limit'=>$length,'order'=>[$sortColumn=>$order]]);
        $total = $this->Users->find('count');
        $info = [];
        
        foreach ($datas as $data) {
            $id= $data['Users']['id'];
            $url= Configure::read('siteUrl').'users/add/'.$data['Users']['id'];
            //$urlDelete= Configure::read('siteUrl').'users/delete/'.$data['Users']['id'];  
            if($data['Users']['status']==1){
                $status = "Active";
            }else{
                $status = "In-active";
            }         
            
            $actionList = '<a href="'.$url.'" class="text-inverse p-r-10" data-toggle="tooltip" title="Edit" data-original-title="Edit"><i class="ti-marker-alt"></i></a>';
            $actionList .= '<a href="javascript:void(0)" data-deleteId="'.$id.'" data-model="Users" class="text-inverse delete" title="Delete" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash"></i></a>';
            $info[] = [ $data['Users']['name'], $roles[$data['Users']['role']], $data['Users']['email'],$data['Users']['phone'],$status,$actionList ];
            //pr($info); die;
        }

        $response['draw'] =$this->request['data']['draw'];
        $response['recordsTotal'] = $total;
        $response['recordsFiltered'] = $total;
        $response['data'] =$info;
        echo json_encode($response);
        die;

    }

    public function listing_hotel(){
        $this->autoRender = false;
        $this->loadModel('Admin.Hotel');
        $column = $this->request['data']['order'][0]['column'];
        $sortColumn = 'modified';
        if($column == 0){
            $sortColumn = 'Hotel.title';
        }
        if($column == 0){
            $sortColumn = 'Hotel.phone';
        }
        if($column == 0){
            $sortColumn = 'Hotel.email';
        }
        if($column == 0){
            $sortColumn = 'Hotel.website';
        }
        $conditions=[];
       
        if(!empty($this->request['data']['search'])){
            $searchItem = $this->request['data']['search']['value'];
            if($searchItem != ""){
               $searchItem="%".$searchItem."%";
               $conditions['Hotel.title like'] = $searchItem; 
            }
            
        }
        $order =  strtoupper($this->request['data']['order'][0]['dir']);
        $startLimit = $this->request['data']['start'];
        $length = $this->request['data']['length'];        
       
        $datas = $this->Hotel->find('all',['conditions'=>$conditions,'offset'=>$startLimit,'limit'=>$length,'order'=>[$sortColumn=>$order]]);
        $total = $this->Hotel->find('count');
        $info = [];
        
        foreach ($datas as $data) {
            $id= $data['Hotel']['id'];
            $url= Configure::read('siteUrl').'hotels/add/'.$data['Hotel']['id'];
            $rateUrl= Configure::read('siteUrl').'room_rates/index/hotel:'.$data['Hotel']['id'];
            $urlDelete= Configure::read('siteUrl').'hotels/delete/'.$data['Hotel']['id'];  
            if($data['Hotel']['is_active']==1){
                $status = "Active";

            }else{
                $status = "In-active";
            }         
            
            $actionList = '<a href="'.$rateUrl.'" class="text-inverse p-r-10"   data-toggle="tooltip" data-original-title="Add Room Rates"><i class="ti-credit-card " aria-hidden="true"></i></a>';
            $actionList .= '<a href="'.$url.'" class="text-inverse p-r-10"   data-toggle="tooltip" title="Edit" data-original-title="Edit"><i class="ti-marker-alt"></i></a>';
            $actionList .= '<a href="javascript:void(0)" data-deleteId="'.$id.'" data-model="Hotel" class="text-inverse delete" title="Delete" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash"></i></a>';
            $info[] = [$data['Hotel']['title'],$data['Hotel']['phone'],$data['Hotel']['email'],$data['Hotel']['website'],$status,$actionList];
        }
        $response['draw'] =$this->request['data']['draw'];
        $response['recordsTotal'] = $total;
        $response['recordsFiltered'] = $total;
        $response['data'] =$info;
        echo json_encode($response);
        die;

    }

    /*
     * List User Wallet 
     */
    public function listing_user_wallets(){
        $this->autoRender = false;
        $this->loadModel('Admin.CompanyUsers');
        $this->loadModel('Admin.UserWallets');
        
        $column = $this->request['data']['order'][0]['column'];
        $sortColumn = 'UserWallets.created';
        if($column == 0){
            $sortColumn = 'UserWallets.amount';
        }
        if($column == 0){
            $sortColumn = 'UserWallets.amount_type';
        }
        if($column == 0){
            $sortColumn = 'UserWallets.description';
        }
        if($column == 0){
            $sortColumn = 'UserWallets.created';
        }

        $conditions=[];
       
        if(!empty($this->request['data']['search'])){
            $searchItem = $this->request['data']['search']['value'];

            $conditions['company_user_id'] = $this->request->data['userId'];
            if($searchItem != ""){
               $searchItem="%".$searchItem."%";
               $conditions['UserWallets.amount like'] = $searchItem; 
            }
            
        }

        $order = "DESC";;
        $startLimit = $this->request['data']['start'];
        $length = $this->request['data']['length'];        
       
        $datas = $this->UserWallets->find('all',['conditions'=>$conditions,'offset'=>$startLimit,'limit'=>$length,'order'=>[$sortColumn=>$order]]);
        $total = $this->UserWallets->find('count');
        $info = [];
        
        foreach ($datas as $data) {
            $id= $data['UserWallets']['id'];
            
            $info[] = [ $data['UserWallets']['amount'], $data['UserWallets']['amount_type'], $data['UserWallets']['description'], date('Y-m-d H:i:s', strtotime($data['UserWallets']['created'])) ];
        }
        $response['draw'] =$this->request['data']['draw'];
        $response['recordsTotal'] = $total;
        $response['recordsFiltered'] = $total;
        $response['data'] =$info;
        echo json_encode($response);
        die;

    }


    public function list_page(){
        $this->autoRender = false;
      
        $this->loadModel('Admin.Category');
        $this->loadModel('Admin.Cms');
        $column = $this->request['data']['order'][0]['column'];
        $sortColumn = 'modified';

        if($column == 0){
            $sortColumn = 'Cms.title';
        }
        if($column == 1){
            $sortColumn = 'Category.title';
        }
      
       
        $conditions=[];
       
        if(!empty($this->request['data']['search'])){
            $searchItem = $this->request['data']['search']['value'];
            if($searchItem != ""){
               $searchItem="%".$searchItem."%";
               $conditions['Cms.title like'] = $searchItem; 
            }
            
        }
        $order =  strtoupper($this->request['data']['order'][0]['dir']);
        $startLimit = $this->request['data']['start'];
        $length = $this->request['data']['length'];        
        $this->Cms->bindModel([
            'belongsTo'=>[
                'Category'=>[
                  'className'=>'Category',
                  'foreignKey'=>'category'
                ]
            ],
            
        ]);
        $datas = $this->Cms->find('all',['conditions'=>$conditions,'offset'=>$startLimit,'limit'=>$length,'order'=>[$sortColumn=>$order]]);
        $total = $this->Cms->find('count');
        $info = [];
        
        foreach ($datas as $data) {
            $id =$data['Cms']['id'];
            $url= Configure::read('siteUrl').'cms/add/'.$data['Cms']['id'];
            $urlDelete= Configure::read('siteUrl').'cms/delete/'.$data['Cms']['id'];           
            $actionList = '<a href="'.$url.'" class="text-inverse p-r-10"  data-action="form" data-toggle="tooltip" title="Edit" data-original-title="Edit"><i class="ti-marker-alt"></i></a>';
            $actionList .= '<a href="javascript:void(0)" data-deleteId="'.$id.'" data-model="Cms" class="text-inverse delete" title="Delete" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash"></i></a>';
            
            $info[] = [$data['Cms']['title'],$data['Category']['title'],$actionList];
        }
        $response['draw'] =$this->request['data']['draw'];
        $response['recordsTotal'] = $total;
        $response['recordsFiltered'] = $total;
        $response['data'] =$info;
        echo json_encode($response);
        die;

    }
    public function list_category($value=''){
        $this->autoRender = false;
        $column = $this->request['data']['order'][0]['column'];
        $sortColumn = 'created';

        if($column == 0){
            $sortColumn = 'title';
        }
        if($column == 1){
            $sortColumn = 'type';
        }
        if($column == 2){
            $sortColumn = 'status';
        }
        
        $conditions= [];
        if(!empty($this->request['data']['search'])){
            $searchItem = $this->request['data']['search']['value'];
            if($searchItem != ""){
                $searchItem="%".$searchItem."%";
               $conditions['title like'] = $searchItem; 
            }
            
        }
        $order =  strtoupper($this->request['data']['order'][0]['dir']);
        $startLimit = $this->request['data']['start'];
        $length = $this->request['data']['length'];
        $this->loadModel('Admin.Category');
        $datas = $this->Category->find('all',['conditions'=>$conditions,'offset'=>$startLimit,'limit'=>$length,'order'=>[$sortColumn=>$order]]);
        $total = $this->Category->find('count',['conditions'=>$conditions]);
        $info = [];
       // pr($permissionArray); die;
        //echo $permissionArray['department']['delete']; 
        foreach ($datas as $data) {
            $id= $data['Category']['id'];
            $url= Configure::read('siteUrl').'category/add/'.$data['Category']['id'];
            $urlDelete= Configure::read('siteUrl').'category/delete/'.$data['Category']['id'];
            $actionList = '<a href="'.$url.'" class="text-inverse p-r-10"  data-action="form" data-toggle="tooltip" title="Edit" data-original-title="Edit"><i class="ti-marker-alt"></i></a>';
            $actionList .= '<a href="javascript:void(0)" data-deleteId="'.$id.'" data-model="Category" class="text-inverse delete" title="Delete" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash"></i></a>';
            if($data['Category']['type']==1){
                $type = "CMS";

            }
            if($data['Category']['status']==1){
                $status = "Active";

            }else{
                $status = "In-active";
            }
            $info[] = [$data['Category']['title'],$type,$status,$actionList];
        }
        $response['draw'] =$this->request['data']['draw'];
        $response['recordsTotal'] = $total;
        $response['recordsFiltered'] = $total;
       
        $response['data'] =$info;
        echo json_encode($response);
        die;
       
    }
    public function facility_info_listing(){
        $this->autoRender = false;
        $modelName =$this->data['model'];  
        $this->loadModel('Admin.'.$modelName);
        $this->loadModel('Admin.HotelFacilities');
        $column = $this->request['data']['order'][0]['column'];
        $sortColumn = 'modified';
        if($column == 0){
            $sortColumn ='HotelFacilities.title';
        }
        if($column == 1){
            $sortColumn = $modelName.'.title';
        }
       
        if($column == 2){
            $sortColumn = $modelName.'.is_active';
        }
        $conditions=[]; 
        if(!empty($this->request['data']['search'])){
            $searchItem = $this->request['data']['search']['value'];
            if($searchItem != ""){
               $searchItem="%".$searchItem."%";
               $conditions[$modelName.'.title like'] = $searchItem; 
            }
        }
        $order =  "DESC";
        $startLimit = $this->request['data']['start'];
        $length = $this->request['data']['length'];
        $this->$modelName->bindModel([
            'belongsTo'=>[            
                'HotelFacilities'=>[
                    'className'=>'HotelFacilities',
                    'foreignKey'=>'facility_id'
                ]
            ],
            
        ]);          
        $datas = $this->$modelName->find('all',['conditions'=>$conditions,'offset'=>$startLimit,'limit'=>$length,'order'=>[$sortColumn=>$order]]);
        $total = $this->$modelName->find('count');
        $info = [];
        foreach ($datas as $data) {
            $id = $data[$modelName]['id'];
            $actionList = '<a href="javascript:void(0)" data-editId="'.$id.'" class="text-inverse p-r-10 edit" data-model="'.$modelName.'" data-action="hotel_facilities_info_form" data-toggle="tooltip" title="Edit" data-original-title="Edit"><i class="ti-marker-alt"></i></a>';
            $actionList .= '<a href="javascript:void(0)" data-deleteId="'.$id.'" data-model="'.$modelName.'" class="text-inverse delete" title="Delete" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash"></i></a>';
            if($data[$modelName]['is_active'] == 1){
                $status='<span class="label label-success font-weight-100">Active</span>';
            }else{
                $status='<span class="label label-danger font-weight-100">De-active</span>';
            }
            $info[] = [$data['HotelFacilities']['title'],$data[$modelName]['title'],$status,$actionList];
        }
        $response['draw'] =$this->request['data']['draw'];
        $response['recordsTotal'] = $total;
        $response['recordsFiltered'] = $total;
        $response['data'] =$info;
        echo json_encode($response);
        die;
    }
    public function room_facility_info_listing(){
        $this->autoRender = false;
        $modelName =$this->data['model'];  
        $this->loadModel('Admin.'.$modelName);
        $this->loadModel('Admin.RoomFacility');
        $column = $this->request['data']['order'][0]['column'];
        $sortColumn = 'modified';
        if($column == 0){
            $sortColumn ='RoomFacility.title';
        }
        if($column == 1){
            $sortColumn = $modelName.'.title';
        }
       
        if($column == 2){
            $sortColumn = $modelName.'.is_active';
        }
        $conditions=[]; 
        if(!empty($this->request['data']['search'])){
            $searchItem = $this->request['data']['search']['value'];
            if($searchItem != ""){
               $searchItem="%".$searchItem."%";
               $conditions[$modelName.'.title like'] = $searchItem; 
            }
        }
        $order =  "DESC";
        $startLimit = $this->request['data']['start'];
        $length = $this->request['data']['length'];
        $this->$modelName->bindModel([
            'belongsTo'=>[            
                'RoomFacility'=>[
                    'className'=>'RoomFacility',
                    'foreignKey'=>'room_facility_id'
                ]
            ],
            
        ]);          
        $datas = $this->$modelName->find('all',['conditions'=>$conditions,'offset'=>$startLimit,'limit'=>$length,'order'=>[$sortColumn=>$order]]);
        $total = $this->$modelName->find('count');
        $info = [];
        foreach ($datas as $data) {
            $id = $data[$modelName]['id'];
            $actionList = '<a href="javascript:void(0)" data-editId="'.$id.'" class="text-inverse p-r-10 edit" data-model="'.$modelName.'" data-action="room_facilities_info_form" data-toggle="tooltip" title="Edit" data-original-title="Edit"><i class="ti-marker-alt"></i></a>';
            $actionList .= '<a href="javascript:void(0)" data-deleteId="'.$id.'" data-model="'.$modelName.'" class="text-inverse delete" title="Delete" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash"></i></a>';
            if($data[$modelName]['is_active'] == 1){
                $status='<span class="label label-success font-weight-100">Active</span>';
            }else{
                $status='<span class="label label-danger font-weight-100">De-active</span>';
            }
            $info[] = [$data['RoomFacility']['title'],$data[$modelName]['title'],$status,$actionList];
        }
        $response['draw'] =$this->request['data']['draw'];
        $response['recordsTotal'] = $total;
        $response['recordsFiltered'] = $total;
        $response['data'] =$info;
        echo json_encode($response);
        die;
    }
    
    public function delete_data(){
        $this->autoRender = false;
        $modelName = $this->request->data['model'];
        $id = $this->request->data['id'];
        $this->loadModel('Admin.'.$modelName);
        if($id != ""){
            $this->$modelName->deleteAll(array($modelName.'.id' => $id), false);
            $output['status'] = true;
        }else{
            $output['status'] = false;
        }
        echo json_encode($output); die;
    }
    public function uploadhotelImage(){
        $this->autoRender = false;
        if(isset($_FILES['file']['name']) && $_FILES['file']['name']){
            $fileArray =  explode(".",$_FILES['file']['name']);
            $fileExtension = end($fileArray);
            array_pop($fileArray);
            $alt =  implode(" ", $fileArray);
            $fileName =  'hotel_image_'.rand(1,9999).'_'.time().".".$fileExtension;
            $filePath = Configure::read('RelativeUrl').'hotels/';
            $fileAbPath = Configure::read('AbsoluteUrl').'hotels/';
           
            move_uploaded_file($_FILES['file']['tmp_name'],$filePath.$fileName);
            $src = $filePath.$fileName;
            $dest=Configure::read('RelativeUrl').'hotels/thumb/'.$fileName;
            $targetWidth = '245';
            $this->createThumbnail($src, $dest, $targetWidth, $targetHeight = '200');
            $output['status'] = true;
            $output['file'] = $fileAbPath.'thumb/'.$fileName;
            $output['fileName'] = $fileName;
            $output['alt'] = $alt;
        }else{
            $output['status'] = false;
            $output['msg'] = 'Invalid request';
        }
        echo json_encode($output);
        die;
    }
    public function uploadhotelVideo(){
        $this->autoRender = false;
        if(isset($_FILES['file']['name']) && $_FILES['file']['name']){
            $fileArray =  explode(".",$_FILES['file']['name']);
            $fileExtension = end($fileArray);
            array_pop($fileArray);
            $alt =  implode(" ", $fileArray);
            $fileName =  'hotel_video_'.rand(1,9999).'_'.time().".".$fileExtension;
            $filePath = Configure::read('RelativeUrl').'hotels/';
            $fileAbPath = Configure::read('AbsoluteUrl').'hotels/';
            move_uploaded_file($_FILES['file']['tmp_name'],$filePath.$fileName);
            $output['status'] = true;
            $output['file'] = $fileAbPath.$fileName;
            $output['fileName'] = $fileName;
            $output['alt'] = $alt;
        }else{
            $output['status'] = false;
            $output['msg'] = 'Invalid request';
        }
        echo json_encode($output);
        die;
    }

    public function hotel_images(){
        $this->autoRender = false;
        if(isset($_FILES['file']['name']) && $_FILES['file']['name']){
            $fileArray =  explode(".",$_FILES['file']['name']);
            $fileExtension = end($fileArray);
            array_pop($fileArray);
            $alt =  implode(" ", $fileArray);
            $fileName =  'hotel_image_'.rand(1,9999).'_'.time().".".$fileExtension;
            $filePath = Configure::read('RelativeUrl').'hotels/';
            $fileAbPath = Configure::read('AbsoluteUrl').'hotels/';
           
            move_uploaded_file($_FILES['file']['tmp_name'],$filePath.$fileName);
            $src = $filePath.$fileName;
            $dest=Configure::read('RelativeUrl').'hotels/thumb/'.$fileName;
            $targetWidth = '245';
            $this->createThumbnail($src, $dest, $targetWidth, $targetHeight = '200');
            $output['status'] = true;
            $output['file'] = $fileAbPath.'thumb/'.$fileName;
            $output['fileName'] = $fileName;
            $output['alt'] = $alt;
        }else{
            $output['status'] = false;
            $output['msg'] = 'Invalid request';
        }
        echo json_encode($output);
        die;
    }
    public function room_images(){
        $this->autoRender = false;
        if(isset($_FILES['file']['name']) && $_FILES['file']['name']){
            $fileArray =  explode(".",$_FILES['file']['name']);
            $fileExtension = end($fileArray);
            array_pop($fileArray);
            $alt =  implode(" ", $fileArray);
            $fileName =  'room_image_'.rand(1,9999).'_'.time().".".$fileExtension;
            $filePath = Configure::read('RelativeUrl').'room/';
            $fileAbPath = Configure::read('AbsoluteUrl').'room/';
           
            move_uploaded_file($_FILES['file']['tmp_name'],$filePath.$fileName);
            $src = $filePath.$fileName;
            $dest=Configure::read('RelativeUrl').'room/thumb/'.$fileName;
            $targetWidth = '245';
            $this->createThumbnail($src, $dest, $targetWidth, $targetHeight = '200');
            $output['status'] = true;
            $output['file'] = $fileAbPath.'thumb/'.$fileName;
            $output['fileName'] = $fileName;
            $output['alt'] = $alt;
        }else{
            $output['status'] = false;
            $output['msg'] = 'Invalid request';
        }
        echo json_encode($output);
        die;
    }
    public function listing_attraction(){
        $this->autoRender = false;
        $modelName = $this->request->data['model'];
        $this->loadModel('Admin.'.$modelName);
        $column = $this->request['data']['order'][0]['column'];
        $sortColumn = 'modified';

        if($column == 0){
            $sortColumn = $modelName.'.title';
        }
        if($column == 1){
            $sortColumn = $modelName.'.status';
        }
        $conditions=[];
        if(!empty($this->request['data']['search'])){
            $searchItem = $this->request['data']['search']['value'];
            if($searchItem != ""){
               $searchItem="%".$searchItem."%";
               $conditions[$modelName.'.title like'] = $searchItem; 
            }
        }
        $order =  "DESC";
        $startLimit = $this->request['data']['start'];
        $length = $this->request['data']['length'];        
        $datas = $this->$modelName->find('all',['conditions'=>$conditions,'offset'=>$startLimit,'limit'=>$length,'order'=>[$sortColumn=>$order]]);
        $total = $this->$modelName->find('count');
        $info = [];
        foreach ($datas as $data) {
            $id = $data[$modelName]['id'];
            $url= Configure::read('siteUrl').'attraction/add/'.$data['Attraction']['id'];
            $actionList = '<a href="'.$url.'" class="text-inverse p-r-10"  data-action="form" data-toggle="tooltip" title="Edit" data-original-title="Edit"><i class="ti-marker-alt"></i></a>';

            $actionList .= '<a href="javascript:void(0)" data-deleteId="'.$id.'" data-model="'.$modelName.'" class="text-inverse delete" title="Delete" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash"></i></a>';

            if($data[$modelName]['featured_image'] != NULL){
                $imgurl = Configure::read('AbsoluteUrl').'/attraction/'.$data[$modelName]['featured_image'];
                $status='<img width="100" src="'.$imgurl.'" />';
            }else{
                $status='<span class="label label-danger font-weight-100">Image not available</span>';
            }
            $info[] = [$data[$modelName]['title'],$status,$actionList];
        }
        $response['draw'] =$this->request['data']['draw'];
        $response['recordsTotal'] = $total;
        $response['recordsFiltered'] = $total;
        $response['data'] =$info;
        echo json_encode($response);
        die;
    }



    public function attraction_images(){
        $this->autoRender = false;
        if(isset($_FILES['file']['name']) && $_FILES['file']['name']){
        $fileArray = explode(".",$_FILES['file']['name']);
        $fileExtension = end($fileArray);
        array_pop($fileArray);
        $alt = implode(" ", $fileArray);
        $fileName = 'attraction_image_'.rand(1,9999).'_'.time().".".$fileExtension;
        $filePath = Configure::read('RelativeUrl').'attraction/';
        $fileAbPath = Configure::read('AbsoluteUrl').'attraction/';
        move_uploaded_file($_FILES['file']['tmp_name'],$filePath.$fileName);
        $src = $filePath.$fileName;
        $dest=Configure::read('RelativeUrl').'attraction/thumb/'.$fileName;
        $targetWidth = '245';
        $this->createThumbnail($src, $dest, $targetWidth, $targetHeight = '460');
        $output['status'] = true;
        $output['file'] = $fileAbPath.$fileName;
        $output['fileName'] = $fileName;
        $output['alt'] = $alt;
        }else{
        $output['status'] = false;
        $output['msg'] = 'Invalid request';
        }
        echo json_encode($output);
        die;
    }

    public function delete_attraction_image(){
            $this->autoRender = false;
            $id = $this->data['id'];
            $fileName = $this->data['file'];
            $filePath = Configure::read('RelativeUrl').'attraction/';
            $thumbImage = $filePath.'thumb/'.$fileName;
            $orignalImage = $filePath.$fileName;
          
            if(file_exists($thumbImage)){
            unlink($thumbImage);
            }
            if(file_exists($orignalImage)){
            unlink($orignalImage);
            }
            if($id != ""){
            $this->loadModel('Admin.AttractionImages');
            $this->AttractionImages->deleteAll(array('AttractionImages.id' => $id), false);
            }
            $output['status'] = true;
            echo json_encode($output);
            die;
    }


    public function listing_banquet(){
        $this->autoRender = false;
        $modelName = $this->request->data['model'];
        $this->loadModel('Admin.'.$modelName);
        $column = $this->request['data']['order'][0]['column'];

        $sortColumn = 'modified';
        if($column == 0){
            $sortColumn = $modelName.'.title';
        }
        if($column == 1){
            $sortColumn = $modelName.'.status';
        }
        $conditions=[];
        if(!empty($this->request['data']['search'])){
            $searchItem = $this->request['data']['search']['value'];
            if($searchItem != ""){
               $searchItem="%".$searchItem."%";
               $conditions[$modelName.'.title like'] = $searchItem; 
            }
        }
        $order =  "DESC";
        $startLimit = $this->request['data']['start'];
        $length = $this->request['data']['length'];        
        $datas = $this->$modelName->find('all',['conditions'=>$conditions,'offset'=>$startLimit,'limit'=>$length,'order'=>[$sortColumn=>$order]]);
        $total = $this->$modelName->find('count');
        $info = [];


        foreach ($datas as $data) {
            $id = $data[$modelName]['id'];
            $url= Configure::read('siteUrl').'banquets/add/'.$data['Banquets']['id'];
            $actionList = '<a href="'.$url.'" class="text-inverse p-r-10"  data-action="form" data-toggle="tooltip" title="Edit" data-original-title="Edit"><i class="ti-marker-alt"></i></a>';

            $actionList .= '<a href="javascript:void(0)" data-deleteId="'.$id.'" data-model="'.$modelName.'" class="text-inverse delete" title="Delete" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash"></i></a>';

            if($data[$modelName]['featured_image'] != NULL){
                $imgurl = Configure::read('AbsoluteUrl').'/banquet/'.$data[$modelName]['featured_image'];
                $status='<img width="100" src="'.$imgurl.'" />';
            }else{
                $status='<span class="label label-danger font-weight-100">Image not available</span>';
            }
            $info[] = [$data[$modelName]['title'],$status,$actionList];
        }
        $response['draw'] =$this->request['data']['draw'];
        $response['recordsTotal'] = $total;
        $response['recordsFiltered'] = $total;
        $response['data'] =$info;
        echo json_encode($response);
        die;
    }


    public function banquet_images(){
        $this->autoRender = false;
        if(isset($_FILES['file']['name']) && $_FILES['file']['name']){
        $fileArray = explode(".",$_FILES['file']['name']);
        $fileExtension = end($fileArray);
        array_pop($fileArray);
        $alt = implode(" ", $fileArray);
        $fileName = 'banquet_image_'.rand(1,9999).'_'.time().".".$fileExtension;
        $filePath = Configure::read('RelativeUrl').'banquet/';
        $fileAbPath = Configure::read('AbsoluteUrl').'banquet/';
        move_uploaded_file($_FILES['file']['tmp_name'],$filePath.$fileName);
        $src = $filePath.$fileName;
        $dest=Configure::read('RelativeUrl').'banquet/thumb/'.$fileName;
        $targetWidth = '245';
        $this->createThumbnail($src, $dest, $targetWidth, $targetHeight = '460');
        $output['status'] = true;
        $output['file'] = $fileAbPath.$fileName;
        $output['fileName'] = $fileName;
        $output['alt'] = $alt;
        }else{
        $output['status'] = false;
        $output['msg'] = 'Invalid request';
        }
        echo json_encode($output);
        die;
    }


    public function delete_banquet_image(){
            $this->autoRender = false;
            $id = $this->data['id'];
            $fileName = $this->data['file'];
            $filePath = Configure::read('RelativeUrl').'banquet/';
            $thumbImage = $filePath.'thumb/'.$fileName;
            $orignalImage = $filePath.$fileName;
          
            if(file_exists($thumbImage)){
            unlink($thumbImage);
            }
            if(file_exists($orignalImage)){
            unlink($orignalImage);
            }
            if($id != ""){
            $this->loadModel('Admin.BanquetImages');
            $this->BanquetImages->deleteAll(array('BanquetImages.id' => $id), false);
            }
            $output['status'] = true;
            echo json_encode($output);
            die;
    }


    public function delete_room_image(){
            $this->autoRender = false;
            $id = $this->data['id'];
            $fileName = $this->data['file'];
            $filePath = Configure::read('RelativeUrl').'room/';
            $thumbImage = $filePath.'thumb/'.$fileName;
            $orignalImage = $filePath.$fileName;
        
            if(file_exists($thumbImage)){
            unlink($thumbImage);
            }
            if(file_exists($orignalImage)){
            unlink($orignalImage);
            }
            if($id != ""){
            $this->loadModel('Admin.RoomImages');
            $this->RoomImages->deleteAll(array('RoomImages.id' => $id), false);
            }
            $output['status'] = true;
            echo json_encode($output);
            die;
    }
    public function listing_tour(){
        $this->autoRender = false;
        $modelName = $this->request->data['model'];
        $this->loadModel('Admin.'.$modelName);
        $column = $this->request['data']['order'][0]['column'];
        $sortColumn = 'modified';

        if($column == 0){
            $sortColumn = $modelName.'.title';
        }
        if($column == 1){
            $sortColumn = $modelName.'.status';
        }
        $conditions=[];
        if(!empty($this->request['data']['search'])){
            $searchItem = $this->request['data']['search']['value'];
            if($searchItem != ""){
               $searchItem="%".$searchItem."%";
               $conditions[$modelName.'.title like'] = $searchItem; 
            }
        }
        $order =  "DESC";
        $startLimit = $this->request['data']['start'];
        $length = $this->request['data']['length'];        
        $datas = $this->$modelName->find('all',['conditions'=>$conditions,'offset'=>$startLimit,'limit'=>$length,'order'=>[$sortColumn=>$order]]);
        $total = $this->$modelName->find('count');
        $info = [];
        foreach ($datas as $data) {
            $id = $data[$modelName]['id'];
            $url= Configure::read('siteUrl').'TourPackage/add/'.$data['TourPackage']['id'];
            $actionList = '<a href="'.$url.'" class="text-inverse p-r-10"  data-action="form" data-toggle="tooltip" title="Edit" data-original-title="Edit"><i class="ti-marker-alt"></i></a>';

            $actionList .= '<a href="javascript:void(0)" data-deleteId="'.$id.'" data-model="'.$modelName.'" class="text-inverse delete" title="Delete" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash"></i></a>';

            if($data[$modelName]['is_active'] == 1){
                
                $status='<span class="label label-success font-weight-100">Active</span>';
            }else{
                $status='<span class="label label-danger font-weight-100">Inactive</span>';
            }
            $info[] = [$data[$modelName]['title'],$status,$actionList];
        }
        $response['draw'] =$this->request['data']['draw'];
        $response['recordsTotal'] = $total;
        $response['recordsFiltered'] = $total;
        $response['data'] =$info;
        echo json_encode($response);
        die;
    }

    public function listing_activities(){
        $this->autoRender = false;
        $modelName = $this->request->data['model'];
        $this->loadModel('Admin.'.$modelName);
        $column = $this->request['data']['order'][0]['column'];
        $sortColumn = 'modified';

        if($column == 0){
            $sortColumn = $modelName.'.name';
        }
        if($column == 1){
            $sortColumn = $modelName.'.status';
        }
        $conditions=[];
        if(!empty($this->request['data']['search'])){
            $searchItem = $this->request['data']['search']['value'];
            if($searchItem != ""){
               $searchItem="%".$searchItem."%";
               $conditions[$modelName.'.name like'] = $searchItem; 
            }
        }
        $order =  "DESC";
        $startLimit = $this->request['data']['start'];
        $length = $this->request['data']['length'];        
        $datas = $this->$modelName->find('all',['conditions'=>$conditions,'offset'=>$startLimit,'limit'=>$length,'order'=>[$sortColumn=>$order]]);
        $total = $this->$modelName->find('count');
        $info = [];
        foreach ($datas as $data) {
            $id = $data[$modelName]['id'];
            $url= Configure::read('siteUrl').'activities/add/'.$data['Activities']['id'];
            $actionList = '<a href="'.$url.'" class="text-inverse p-r-10"  data-action="form" data-toggle="tooltip" title="Edit" data-original-title="Edit"><i class="ti-marker-alt"></i></a>';

            $actionList .= '<a href="javascript:void(0)" data-deleteId="'.$id.'" data-model="'.$modelName.'" class="text-inverse delete" title="Delete" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash"></i></a>';

            if($data[$modelName]['is_active'] == 1){
                
                $status='<span class="label label-success font-weight-100">Active</span>';
            }else{
                $status='<span class="label label-danger font-weight-100">Inactive</span>';
            }
            $info[] = [$data[$modelName]['name'],$status,$actionList];
        }
        $response['draw'] =$this->request['data']['draw'];
        $response['recordsTotal'] = $total;
        $response['recordsFiltered'] = $total;
        $response['data'] =$info;
        echo json_encode($response);
        die;
    }

    public function listing_services(){
        $this->autoRender = false;
        $modelName = $this->request->data['model'];
        $this->loadModel('Admin.'.$modelName);
        $column = $this->request['data']['order'][0]['column'];
        $sortColumn = 'modified';

        if($column == 0){
            $sortColumn = $modelName.'.title';
        }
        if($column == 1){
            $sortColumn = $modelName.'.status';
        }
        $conditions=[];
        if(!empty($this->request['data']['search'])){
            $searchItem = $this->request['data']['search']['value'];
            if($searchItem != ""){
               $searchItem="%".$searchItem."%";
               $conditions[$modelName.'.title like'] = $searchItem; 
            }
        }
        $order =  "DESC";
        $startLimit = $this->request['data']['start'];
        $length = $this->request['data']['length'];        
        $datas = $this->$modelName->find('all',['conditions'=>$conditions,'offset'=>$startLimit,'limit'=>$length,'order'=>[$sortColumn=>$order]]);
        $total = $this->$modelName->find('count');
        $info = [];
        foreach ($datas as $data) {
            $id = $data[$modelName]['id'];
            $url= Configure::read('siteUrl').'Services/add/'.$data['services']['id'];
            $actionList = '<a href="'.$url.'" class="text-inverse p-r-10"  data-action="form" data-toggle="tooltip" title="Edit" data-original-title="Edit"><i class="ti-marker-alt"></i></a>';

            $actionList .= '<a href="javascript:void(0)" data-deleteId="'.$id.'" data-model="'.$modelName.'" class="text-inverse delete" title="Delete" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash"></i></a>';

            if($data[$modelName]['is_active'] == 1){
                
                $status='<span class="label label-success font-weight-100">Active</span>';
            }else{
                $status='<span class="label label-danger font-weight-100">Inactive</span>';
            }
            $info[] = [$data[$modelName]['title'],$status,$actionList];
        }
        $response['draw'] =$this->request['data']['draw'];
        $response['recordsTotal'] = $total;
        $response['recordsFiltered'] = $total;
        $response['data'] =$info;
        echo json_encode($response);
        die;
    }

    public function tour_images(){
        $this->autoRender = false;
        if(isset($_FILES['file']['name']) && $_FILES['file']['name']){
        $fileArray = explode(".",$_FILES['file']['name']);
        $fileExtension = end($fileArray);
        array_pop($fileArray);
        $alt = implode(" ", $fileArray);
        $fileName = 'tour_image_'.rand(1,9999).'_'.time().".".$fileExtension;
        $filePath = Configure::read('RelativeUrl').'tour/';
        $fileAbPath = Configure::read('AbsoluteUrl').'tour/';
        move_uploaded_file($_FILES['file']['tmp_name'],$filePath.$fileName);
        $src = $filePath.$fileName;
        $dest=Configure::read('RelativeUrl').'tour/thumb/'.$fileName;
        $targetWidth = '245';
        $this->createThumbnail($src, $dest, $targetWidth, $targetHeight = '460');
        $output['status'] = true;
        $output['file'] = $fileAbPath.$fileName;
        $output['fileName'] = $fileName;
        $output['alt'] = $alt;
        }else{
        $output['status'] = false;
        $output['msg'] = 'Invalid request';
        }
        echo json_encode($output);
        die;
    }
    public function delete_tour_image(){
            $this->autoRender = false;
            $id = $this->data['id'];
            $fileName = $this->data['file'];
            $filePath = Configure::read('RelativeUrl').'tour/';
            $thumbImage = $filePath.'thumb/'.$fileName;
            $orignalImage = $filePath.$fileName;
          
            if(file_exists($thumbImage)){
            unlink($thumbImage);
            }
            if(file_exists($orignalImage)){
            unlink($orignalImage);
            }
            if($id != ""){
            $this->loadModel('Admin.TourPackageImages');
            $this->TourPackageImages->deleteAll(array('TourPackageImages.id' => $id), false);
            }
            $output['status'] = true;
            echo json_encode($output);
            die;
    }

    public function hotelImagedelete(){
            $this->autoRender = false;
            $id = $this->data['id'];
            $fileName = $this->data['file'];
            $filePath = Configure::read('RelativeUrl').'hotels/';
            $thumbImage = $filePath.'thumb/'.$fileName;
            $orignalImage = $filePath.$fileName;
            if(file_exists($thumbImage)){
            unlink($thumbImage);
            }
            if(file_exists($orignalImage)){
            unlink($orignalImage);
            }
            $output['status'] = true;
            echo json_encode($output);
            die;
    }
    public function activity_images(){
        $this->autoRender = false;
        if(isset($_FILES['file']['name']) && $_FILES['file']['name']){
        $fileArray = explode(".",$_FILES['file']['name']);
        $fileExtension = end($fileArray);
        array_pop($fileArray);
        $alt = implode(" ", $fileArray);
        $fileName = 'activity_image_'.rand(1,9999).'_'.time().".".$fileExtension;
        $filePath = Configure::read('RelativeUrl').'activity/';
        $fileAbPath = Configure::read('AbsoluteUrl').'activity/';
        move_uploaded_file($_FILES['file']['tmp_name'],$filePath.$fileName);
        $src = $filePath.$fileName;
        $dest=Configure::read('RelativeUrl').'activity/thumb/'.$fileName;
        $targetWidth = '245';
        $this->createThumbnail($src, $dest, $targetWidth, $targetHeight = '460');
        $output['status'] = true;
        $output['file'] = $fileAbPath.$fileName;
        $output['fileName'] = $fileName;
        $output['alt'] = $alt;
        }else{
        $output['status'] = false;
        $output['msg'] = 'Invalid request';
        }
        echo json_encode($output);
        die;
    }

    public function delete_activity_image(){
            $this->autoRender = false;
            $id = $this->data['id'];
            $fileName = $this->data['file'];
            $filePath = Configure::read('RelativeUrl').'activity/';
            $thumbImage = $filePath.'thumb/'.$fileName;
            $orignalImage = $filePath.$fileName;
          
            if(file_exists($thumbImage)){
            unlink($thumbImage);
            }
            if(file_exists($orignalImage)){
            unlink($orignalImage);
            }
            if($id != ""){
            $this->loadModel('Admin.ActivityImages');
            $this->ActivityImages->deleteAll(array('ActivityImages.id' => $id), false);
            }
            $output['status'] = true;
            echo json_encode($output);
            die;
    }

    public function destination_images(){
        $this->autoRender = false;
        if(isset($_FILES['file']['name']) && $_FILES['file']['name']){
        $fileArray = explode(".",$_FILES['file']['name']);
        $fileExtension = end($fileArray);
        array_pop($fileArray);
        $alt = implode(" ", $fileArray);
        $fileName = 'destination_image_'.rand(1,9999).'_'.time().".".$fileExtension;
        $filePath = Configure::read('RelativeUrl').'destination/';
        $fileAbPath = Configure::read('AbsoluteUrl').'destination/';
        move_uploaded_file($_FILES['file']['tmp_name'],$filePath.$fileName);
        $src = $filePath.$fileName;
        $dest=Configure::read('RelativeUrl').'destination/thumb/'.$fileName;
        $targetWidth = '245';
        $this->createThumbnail($src, $dest, $targetWidth, $targetHeight = '460');
        $output['status'] = true;
        $output['file'] = $fileAbPath.$fileName;
        $output['fileName'] = $fileName;
        $output['alt'] = $alt;
        }else{
        $output['status'] = false;
        $output['msg'] = 'Invalid request';
        }
        echo json_encode($output);
        die;
    }

    public function delete_destination_image(){
        $this->autoRender = false;
        $id = $this->data['id'];
        $fileName = $this->data['file'];
        $filePath = Configure::read('RelativeUrl').'destination/';
        $thumbImage = $filePath.'thumb/'.$fileName;
        $orignalImage = $filePath.$fileName;
        
        if(file_exists($thumbImage)){
        unlink($thumbImage);
        }
        if(file_exists($orignalImage)){
        unlink($orignalImage);
        }
        if($id != ""){
        $this->loadModel('Admin.DestinationImages');
        $this->DestinationImages->deleteAll(array('DestinationImages.id' => $id), false);
        }
        $output['status'] = true;
        echo json_encode($output);
        die;
    }
    public function delete_hotel_images(){
        $this->autoRender = false;
        $id = $this->data['id'];
        $fileName = $this->data['file'];
        $filePath = Configure::read('RelativeUrl').'hotels/';
        $thumbImage = $filePath.'thumb/'.$fileName;
        $orignalImage = $filePath.$fileName;
        
        if(file_exists($thumbImage)){
            unlink($thumbImage);
        }
        if(file_exists($orignalImage)){
            unlink($orignalImage);
        }
        if($id != ""){
            $this->loadModel('Admin.HotelImages');
            $this->HotelImages->deleteAll(array('HotelImages.id' => $id), false);
        }
        $output['status'] = true;
        echo json_encode($output);
        die;
    }

    public function listing_destination(){
        $this->autoRender = false;
        $modelName = $this->request->data['model'];
        $this->loadModel('Admin.'.$modelName);
        $column = $this->request['data']['order'][0]['column'];
        $sortColumn = 'modified';

        if($column == 0){
            $sortColumn = $modelName.'.title';
        }
        if($column == 1){
            $sortColumn = $modelName.'.status';
        }
        $conditions=[];
        if(!empty($this->request['data']['search'])){
            $searchItem = $this->request['data']['search']['value'];
            if($searchItem != ""){
               $searchItem="%".$searchItem."%";
               $conditions[$modelName.'.title like'] = $searchItem; 
            }
        }
        $order =  "DESC";
        $startLimit = $this->request['data']['start'];
        $length = $this->request['data']['length'];        
        $datas = $this->$modelName->find('all',['conditions'=>$conditions,'offset'=>$startLimit,'limit'=>$length,'order'=>[$sortColumn=>$order]]);
        $total = $this->$modelName->find('count');
        $info = [];
        foreach ($datas as $data) {
            $id = $data[$modelName]['id'];
            $url= Configure::read('siteUrl').'Destination/add/'.$data['Destination']['id'];
            $actionList = '<a href="'.$url.'" class="text-inverse p-r-10"  data-action="form" data-toggle="tooltip" title="Edit" data-original-title="Edit"><i class="ti-marker-alt"></i></a>';

            $actionList .= '<a href="javascript:void(0)" data-deleteId="'.$id.'" data-model="'.$modelName.'" class="text-inverse delete" title="Delete" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash"></i></a>';

            if($data[$modelName]['is_active'] == 1){
                
                $status='<span class="label label-success font-weight-100">Active</span>';
            }else{
                $status='<span class="label label-danger font-weight-100">Inactive</span>';
            }
            $info[] = [$data[$modelName]['title'],$status,$actionList];
        }
        $response['draw'] =$this->request['data']['draw'];
        $response['recordsTotal'] = $total;
        $response['recordsFiltered'] = $total;
        $response['data'] =$info;
        echo json_encode($response);
        die;
    }
    public function listing_Tender(){
        $this->autoRender = false;
        $modelName = $this->request->data['model'];
        $this->loadModel('Admin.'.$modelName);
        $column = $this->request['data']['order'][0]['column'];
        $sortColumn = 'modified';

        if($column == 0){
            $sortColumn = $modelName.'.name';
        }
        if($column == 1){
            $sortColumn = $modelName.'.status';
        }
        $conditions=[];
        if(!empty($this->request['data']['search'])){
            $searchItem = $this->request['data']['search']['value'];
            if($searchItem != ""){
               $searchItem="%".$searchItem."%";
               $conditions[$modelName.'.name like'] = $searchItem; 
            }
        }
        $order =  "DESC";
        $startLimit = $this->request['data']['start'];
        $length = $this->request['data']['length'];        
        $datas = $this->$modelName->find('all',['conditions'=>$conditions,'offset'=>$startLimit,'limit'=>$length,'order'=>[$sortColumn=>$order]]);
        $total = $this->$modelName->find('count');
        $info = [];
        foreach ($datas as $data) {
            $id = $data[$modelName]['id'];

            $actionList = '<a href="javascript:void(0)" data-editId="'.$id.'" class="text-inverse p-r-10 editn" data-model="'.$modelName.'" data-action="form" data-toggle="tooltip" title="Edit" data-original-title="Edit"><i class="ti-marker-alt"></i></a>';

            $actionList .= '<a href="javascript:void(0)" data-deleteId="'.$id.'" data-model="'.$modelName.'" class="text-inverse delete" title="Delete" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash"></i></a>';

            if($data[$modelName]['is_active'] == 1){
                
                $status='<span class="label label-success font-weight-100">Active</span>';
            }else{
                $status='<span class="label label-danger font-weight-100">Inactive</span>';
            }
            $info[] = [$data[$modelName]['name'],$status,$actionList];
        }
        $response['draw'] =$this->request['data']['draw'];
        $response['recordsTotal'] = $total;
        $response['recordsFiltered'] = $total;
        $response['data'] =$info;
        echo json_encode($response);
        die;
    }
    public function listing_TourCat(){
        $this->autoRender = false;
        $modelName = $this->request->data['model'];
        $this->loadModel('Admin.'.$modelName);
        $column = $this->request['data']['order'][0]['column'];
        $sortColumn = 'modified';

        if($column == 0){
            $sortColumn = $modelName.'.name';
        }
        if($column == 1){
            $sortColumn = $modelName.'.status';
        }
        $conditions=[];
        if(!empty($this->request['data']['search'])){
            $searchItem = $this->request['data']['search']['value'];
            if($searchItem != ""){
               $searchItem="%".$searchItem."%";
               $conditions[$modelName.'.name like'] = $searchItem; 
            }
        }
        $order =  "DESC";
        $startLimit = $this->request['data']['start'];
        $length = $this->request['data']['length'];        
        $datas = $this->$modelName->find('all',['conditions'=>$conditions,'offset'=>$startLimit,'limit'=>$length,'order'=>[$sortColumn=>$order]]);
        $total = $this->$modelName->find('count');
        $info = [];
        foreach ($datas as $data) {
            $id = $data[$modelName]['id'];

            $actionList = '<a href="javascript:void(0)" data-editId="'.$id.'" class="text-inverse p-r-10 editn" data-model="'.$modelName.'" data-action="form" data-toggle="tooltip" title="Edit" data-original-title="Edit"><i class="ti-marker-alt"></i></a>';

            $actionList .= '<a href="javascript:void(0)" data-deleteId="'.$id.'" data-model="'.$modelName.'" class="text-inverse delete" title="Delete" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash"></i></a>';

            if($data[$modelName]['is_active'] == 1){
                
                $status='<span class="label label-success font-weight-100">Active</span>';
            }else{
                $status='<span class="label label-danger font-weight-100">Inactive</span>';
            }
            $info[] = [$data[$modelName]['name'],$status,$actionList];
        }
        $response['draw'] =$this->request['data']['draw'];
        $response['recordsTotal'] = $total;
        $response['recordsFiltered'] = $total;
        $response['data'] =$info;
        echo json_encode($response);
        die;
    }
    public function listing_tend(){
        $this->autoRender = false;
        $modelName = $this->request->data['model'];
        $this->loadModel('Admin.'.$modelName);
        $column = $this->request['data']['order'][0]['column'];
        $sortColumn = 'modified';

        if($column == 0){
            $sortColumn = $modelName.'.name';
        }
        if($column == 1){
            $sortColumn = $modelName.'.status';
        }
        $conditions=[];
        if(!empty($this->request['data']['search'])){
            $searchItem = $this->request['data']['search']['value'];
            if($searchItem != ""){
               $searchItem="%".$searchItem."%";
               $conditions[$modelName.'.name like'] = $searchItem; 
            }
        }
        $order =  "DESC";
        $startLimit = $this->request['data']['start'];
        $length = $this->request['data']['length'];        
        $datas = $this->$modelName->find('all',['conditions'=>$conditions,'offset'=>$startLimit,'limit'=>$length,'order'=>[$sortColumn=>$order]]);
        $total = $this->$modelName->find('count');
        $info = [];
        foreach ($datas as $data) {
            $id = $data[$modelName]['id'];
            $url= Configure::read('siteUrl').'Tenders/add/'.$data['Tenders']['id'];
            $actionList = '<a href="'.$url.'" class="text-inverse p-r-10"  data-action="form" data-toggle="tooltip" title="Edit" data-original-title="Edit"><i class="ti-marker-alt"></i></a>';

            $actionList .= '<a href="javascript:void(0)" data-deleteId="'.$id.'" data-model="'.$modelName.'" class="text-inverse delete" title="Delete" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash"></i></a>';

            if($data[$modelName]['is_active'] == 1){
                
                $status='<span class="label label-success font-weight-100">Active</span>';
            }else{
                $status='<span class="label label-danger font-weight-100">Inactive</span>';
            }
            $info[] = [$data[$modelName]['name'],$status,$actionList];
        }
        $response['draw'] =$this->request['data']['draw'];
        $response['recordsTotal'] = $total;
        $response['recordsFiltered'] = $total;
        $response['data'] =$info;
        echo json_encode($response);
        die;
    }

    public function listing_ebooks(){
        $this->autoRender = false;
        $modelName = $this->request->data['model'];
        $this->loadModel('Admin.'.$modelName);
        $column = $this->request['data']['order'][0]['column'];
        $sortColumn = 'modified';

        if($column == 0){
            $sortColumn = $modelName.'.name';
        }
        if($column == 1){
            $sortColumn = $modelName.'.status';
        }
        $conditions=[];
        if(!empty($this->request['data']['search'])){
            $searchItem = $this->request['data']['search']['value'];
            if($searchItem != ""){
               $searchItem="%".$searchItem."%";
               $conditions[$modelName.'.name like'] = $searchItem; 
            }
        }
        $order =  "DESC";
        $startLimit = $this->request['data']['start'];
        $length = $this->request['data']['length'];        
        $datas = $this->$modelName->find('all',['conditions'=>$conditions,'offset'=>$startLimit,'limit'=>$length,'order'=>[$sortColumn=>$order]]);
        $total = $this->$modelName->find('count');
        $info = [];
        foreach ($datas as $data) {
            $id = $data[$modelName]['id'];
            $url= Configure::read('siteUrl').'Ebooks/add/'.$data['Ebooks']['id'];
            $actionList = '<a href="'.$url.'" class="text-inverse p-r-10"  data-action="form" data-toggle="tooltip" title="Edit" data-original-title="Edit"><i class="ti-marker-alt"></i></a>';

            $actionList .= '<a href="javascript:void(0)" data-deleteId="'.$id.'" data-model="'.$modelName.'" class="text-inverse delete" title="Delete" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash"></i></a>';

            if($data[$modelName]['is_active'] == 1){
                
                $status='<span class="label label-success font-weight-100">Active</span>';
            }else{
                $status='<span class="label label-danger font-weight-100">Inactive</span>';
            }
            $info[] = [$data[$modelName]['name'],$status,$actionList];
        }
        $response['draw'] =$this->request['data']['draw'];
        $response['recordsTotal'] = $total;
        $response['recordsFiltered'] = $total;
        $response['data'] =$info;
        echo json_encode($response);
        die;
    }
    public function listing_news(){
        $this->autoRender = false;
        $modelName = $this->request->data['model'];
        $this->loadModel('Admin.'.$modelName);
        $column = $this->request['data']['order'][0]['column'];
        $sortColumn = 'modified';

        if($column == 0){
            $sortColumn = $modelName.'.title';
        }
        if($column == 1){
            $sortColumn = $modelName.'.type';
        }
        if($column == 2){
            $sortColumn = $modelName.'.status';
        }
        $conditions=[];
        if(!empty($this->request['data']['search'])){
            $searchItem = $this->request['data']['search']['value'];
            if($searchItem != ""){
               $searchItem="%".$searchItem."%";
               $conditions[$modelName.'.title like'] = $searchItem; 
            }
        }
        $order =  "DESC";
        $startLimit = $this->request['data']['start'];
        $length = $this->request['data']['length'];        
        $datas = $this->$modelName->find('all',['conditions'=>$conditions,'offset'=>$startLimit,'limit'=>$length,'order'=>[$sortColumn=>$order]]);
        $total = $this->$modelName->find('count');
        $info = [];
        foreach ($datas as $data) {
            $id = $data[$modelName]['id'];
            $url= Configure::read('siteUrl').'News/add/'.$data['News']['id'];
            $actionList = '<a href="'.$url.'" class="text-inverse p-r-10"  data-action="form" data-toggle="tooltip" title="Edit" data-original-title="Edit"><i class="ti-marker-alt"></i></a>';

            $actionList .= '<a href="javascript:void(0)" data-deleteId="'.$id.'" data-model="'.$modelName.'" class="text-inverse delete" title="Delete" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash"></i></a>';

            if($data[$modelName]['is_active'] == 1){
                
                $status='<span class="label label-success font-weight-100">Active</span>';
            }else{
                $status='<span class="label label-danger font-weight-100">Inactive</span>';
            }
            $info[] = [$data[$modelName]['title'],$data[$modelName]['type'],$status,$actionList];
        }
        $response['draw'] =$this->request['data']['draw'];
        $response['recordsTotal'] = $total;
        $response['recordsFiltered'] = $total;
        $response['data'] =$info;
        echo json_encode($response);
        die;
    }
    public function listing_gallery(){
        $this->autoRender = false;
        $modelName = $this->request->data['model'];
        $this->loadModel('Admin.'.$modelName);
        $column = $this->request['data']['order'][0]['column'];
        $sortColumn = 'modified';

        if($column == 0){
            $sortColumn = $modelName.'.title';
        }
        if($column == 1){
            $sortColumn = $modelName.'.type';
        }
        if($column == 2){
            $sortColumn = $modelName.'.file';
        }
        if($column == 3){
            $sortColumn = $modelName.'.status';
        }
        $conditions=[];
        if(!empty($this->request['data']['search'])){
            $searchItem = $this->request['data']['search']['value'];
            if($searchItem != ""){
               $searchItem="%".$searchItem."%";
               $conditions[$modelName.'.title like'] = $searchItem; 
            }
        }
        $order =  "DESC";
        $startLimit = $this->request['data']['start'];
        $length = $this->request['data']['length'];        
        $datas = $this->$modelName->find('all',['conditions'=>$conditions,'offset'=>$startLimit,'limit'=>$length,'order'=>[$sortColumn=>$order]]);
        $total = $this->$modelName->find('count');
        $info = [];
        foreach ($datas as $data) {
            $id = $data[$modelName]['id'];
            $url= Configure::read('siteUrl').'Gallery/add/'.$data['Gallery']['id'];
            $actionList = '<a href="'.$url.'" class="text-inverse p-r-10"  data-action="form" data-toggle="tooltip" title="Edit" data-original-title="Edit"><i class="ti-marker-alt"></i></a>';

            $actionList .= '<a href="javascript:void(0)" data-deleteId="'.$id.'" data-model="'.$modelName.'" class="text-inverse delete" title="Delete" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash"></i></a>';

            if($data[$modelName]['is_active'] == 1){
                
                $status='<span class="label label-success font-weight-100">Active</span>';
            }else{
                $status='<span class="label label-danger font-weight-100">Inactive</span>';
            }


            if($data[$modelName]['type'] == 'image'){
                $imgurl = Configure::read('AbsoluteUrl').'/gallery/'.$data[$modelName]['file'];
                $type='<img src="'.$imgurl.'" width="260" height="215" />';
            }else{
                $imgurl1 = $data[$modelName]['file'];
                $type=$imgurl1;
            }


            $info[] = [$data[$modelName]['title'],$data[$modelName]['type'],$type,$status,$actionList];
        }
        $response['draw'] =$this->request['data']['draw'];
        $response['recordsTotal'] = $total;
        $response['recordsFiltered'] = $total;
        $response['data'] =$info;
        echo json_encode($response);
        die;
    }
    public function listing_faq(){
        $this->autoRender = false;
        $modelName = $this->request->data['model'];
        $this->loadModel('Admin.'.$modelName);
        $column = $this->request['data']['order'][0]['column'];
        $sortColumn = 'modified';

        if($column == 0){
            $sortColumn = $modelName.'.title';
        }
        if($column == 1){
            $sortColumn = $modelName.'.answer';
        }
        if($column == 2){
            $sortColumn = $modelName.'.status';
        }
        $conditions=[];
        if(!empty($this->request['data']['search'])){
            $searchItem = $this->request['data']['search']['value'];
            if($searchItem != ""){
               $searchItem="%".$searchItem."%";
               $conditions[$modelName.'.title like'] = $searchItem; 
            }
        }
        $order =  "DESC";
        $startLimit = $this->request['data']['start'];
        $length = $this->request['data']['length'];        
        $datas = $this->$modelName->find('all',['conditions'=>$conditions,'offset'=>$startLimit,'limit'=>$length,'order'=>[$sortColumn=>$order]]);
        $total = $this->$modelName->find('count');
        $info = [];
        foreach ($datas as $data) {
            $id = $data[$modelName]['id'];

            $actionList = '<a href="javascript:void(0)" data-editId="'.$id.'" class="text-inverse p-r-10 edit" data-model="'.$modelName.'" data-action="form" data-toggle="tooltip" title="Edit" data-original-title="Edit"><i class="ti-marker-alt"></i></a>';

            $actionList .= '<a href="javascript:void(0)" data-deleteId="'.$id.'" data-model="'.$modelName.'" class="text-inverse delete" title="Delete" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash"></i></a>';

            if($data[$modelName]['is_active'] == 1){
                
                $status='<span class="label label-success font-weight-100">Active</span>';
            }else{
                $status='<span class="label label-danger font-weight-100">Inactive</span>';
            }
            $info[] = [$data[$modelName]['title'],$data[$modelName]['answer'],$status,$actionList];
        }
        $response['draw'] =$this->request['data']['draw'];
        $response['recordsTotal'] = $total;
        $response['recordsFiltered'] = $total;
        $response['data'] =$info;
        echo json_encode($response);
        die;
    }
    public function listing_city(){
        $this->autoRender = false;
        $modelName = $this->request->data['model'];
        $this->loadModel('Admin.'.$modelName);
        $column = $this->request['data']['order'][0]['column'];
        $sortColumn = 'modified';

        if($column == 0){
            $sortColumn = $modelName.'.name';
        }
        if($column == 1){
            $sortColumn = $modelName.'.state';
        }
        if($column == 2){
            $sortColumn = $modelName.'.status';
        }
        $conditions=[];
        if(!empty($this->request['data']['search'])){
            $searchItem = $this->request['data']['search']['value'];
            if($searchItem != ""){
               $searchItem="%".$searchItem."%";
               $conditions[$modelName.'.name like'] = $searchItem; 
            }
        }
        $order =  "DESC";
        $startLimit = $this->request['data']['start'];
        $length = $this->request['data']['length'];  
         $this->loadModel("Admin.States");
        $this->$modelName->bindModel(
                       array(
                       'belongsTo'=>array(
                           'States' =>array(
                               'className' => 'Admin.States',
                               'foreignKey'=> 'state_id',
                                            )
                                        )
                           )
           );

        $datas = $this->$modelName->find('all',['conditions'=>$conditions,'offset'=>$startLimit,'limit'=>$length,'order'=>[$sortColumn=>$order]]);
        $total = $this->$modelName->find('count');
        $info = [];
              
        foreach ($datas as $data) {

            $id = $data[$modelName]['id'];
            $actionList = '<a href="javascript:void(0)" data-editId="'.$id.'" class="text-inverse p-r-10 editn" data-model="'.$modelName.'" data-action="form" data-toggle="tooltip" title="Edit" data-original-title="Edit"><i class="ti-marker-alt"></i></a>';

            $actionList .= '<a href="javascript:void(0)" data-deleteId="'.$id.'" data-model="'.$modelName.'" class="text-inverse delete" title="Delete" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash"></i></a>';
          
            if($data[$modelName]['is_active'] == 1){
                
                $status='<span class="label label-success font-weight-100">Active</span>';
            }else{
                $status='<span class="label label-danger font-weight-100">Inactive</span>';
            }
            $info[] = [$data[$modelName]['name'],$data['States']['title'],$status,$actionList];
        }
        $response['draw'] =$this->request['data']['draw'];
        $response['recordsTotal'] = $total;
        $response['recordsFiltered'] = $total;
        $response['data'] =$info;
        echo json_encode($response);
        die;
    }

    public function listing_states(){
        $this->autoRender = false;
        $modelName = $this->request->data['model'];
        $this->loadModel('Admin.'.$modelName);
        $column = $this->request['data']['order'][0]['column'];
        $sortColumn = 'modified';

        if($column == 0){
            $sortColumn = $modelName.'.title';
        }
        
        if($column == 2){
            $sortColumn = $modelName.'.status';
        }
        $conditions=[];
        if(!empty($this->request['data']['search'])){
            $searchItem = $this->request['data']['search']['value'];
            if($searchItem != ""){
               $searchItem="%".$searchItem."%";
               $conditions[$modelName.'.title like'] = $searchItem; 
            }
        }
        $order =  "DESC";
        $startLimit = $this->request['data']['start'];
        $length = $this->request['data']['length'];        
        $datas = $this->$modelName->find('all',['conditions'=>$conditions,'offset'=>$startLimit,'limit'=>$length,'order'=>[$sortColumn=>$order]]);
        $total = $this->$modelName->find('count');
        $info = [];
        foreach ($datas as $data) {
            $id = $data[$modelName]['id'];

            $actionList = '<a href="javascript:void(0)" data-editId="'.$id.'" class="text-inverse p-r-10 editn" data-model="'.$modelName.'" data-action="form" data-toggle="tooltip" title="Edit" data-original-title="Edit"><i class="ti-marker-alt"></i></a>';

            $actionList .= '<a href="javascript:void(0)" data-deleteId="'.$id.'" data-model="'.$modelName.'" class="text-inverse delete" title="Delete" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash"></i></a>';

            if($data[$modelName]['is_active'] == 1){
                
                $status='<span class="label label-success font-weight-100">Active</span>';
            }else{
                $status='<span class="label label-danger font-weight-100">Inactive</span>';
            }
            $info[] = [$data[$modelName]['title'],$status,$actionList];
        }
        $response['draw'] =$this->request['data']['draw'];
        $response['recordsTotal'] = $total;
        $response['recordsFiltered'] = $total;
        $response['data'] =$info;
        echo json_encode($response);
        die;
    }
    
    public function list_bed_type(){ 
        $this->autoRender = false;
        $modelName = $this->request->data['model'];
        $this->loadModel('Admin.'.$modelName);
        $column = $this->request['data']['order'][0]['column'];
        $sortColumn = 'modified';

        if($column == 0){
            $sortColumn = $modelName.'.title';
        }
        
        if($column == 2){
            $sortColumn = $modelName.'.adult_beds';
        }
        if($column == 3){
            $sortColumn = $modelName.'.extra_beds';
        }
        if($column == 4){
            $sortColumn = $modelName.'.child_beds';
        }
        if($column == 5){
            $sortColumn = $modelName.'.is_active';
        }
        
        $conditions=[];
        if(!empty($this->request['data']['search'])){
            $searchItem = $this->request['data']['search']['value'];
            if($searchItem != ""){
               $searchItem="%".$searchItem."%";
               $conditions[$modelName.'.title like'] = $searchItem; 
            }
        }
        $order =  "DESC";
        $startLimit = $this->request['data']['start'];
        $length = $this->request['data']['length'];        
        $datas = $this->$modelName->find('all',['conditions'=>$conditions,'offset'=>$startLimit,'limit'=>$length,'order'=>[$sortColumn=>$order]]);
        $total = $this->$modelName->find('count');
        $info = [];
        foreach ($datas as $data) {
            $id = $data[$modelName]['id'];
            $url= Configure::read('siteUrl').'bed_type/add/'.$data['BedType']['id'];
            $actionList = '<a href="'.$url.'" data-editId="'.$id.'" class="text-inverse p-r-10 " data-action="form" data-toggle="tooltip" title="Edit" data-original-title="Edit"><i class="ti-marker-alt"></i></a>';

            $actionList .= '<a href="javascript:void(0)" data-deleteId="'.$id.'" data-model="'.$modelName.'" class="text-inverse delete" title="Delete" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash"></i></a>';

            if($data[$modelName]['is_active'] == 1){
                
                $status='<span class="label label-success font-weight-100">Active</span>';
            }else{
                $status='<span class="label label-danger font-weight-100">Inactive</span>';
            }
            $info[] = [$data[$modelName]['title'],$data[$modelName]['adult_beds'],$data[$modelName]['extra_beds'],$data[$modelName]['child_beds'],$status,$actionList];
        }
        $response['draw'] =$this->request['data']['draw'];
        $response['recordsTotal'] = $total;
        $response['recordsFiltered'] = $total;
        $response['data'] =$info;
        echo json_encode($response);
        die;
        
    }
    public function get_bed_type(){
        $this->autoRender = false;
        $this->loadModel('Admin.BedTypeHotel');
        $this->loadModel('Admin.BedType');
        $roomId = $this->data['roomId'];
        if(!empty($roomId)){
            $this->BedTypeHotel->bindModel(
                array(
                'belongsTo'=>array(
                    'BedType' =>array(
                            'className' => 'Admin.BedType',
                            'foreignKey'=> 'bed_type',
                        )
                    )
                )
            );
            $data = $this->BedTypeHotel->find('all',['conditions'=>['BedTypeHotel.room_id'=>$roomId]]);
            if(!empty($data)){
                $output['status'] = true;
                $output['info'] = $data;
            }else{
                $output['status'] = false;
            }


        }else{
            $output['status'] = false;
        }
       
        echo json_encode($output); die;
    }
    public function listing_room_rates(){
        $this->autoRender = false;
        $modelName = $this->request->data['model'];
        $this->loadModel('Admin.'.$modelName);
        $this->loadModel('Admin.Room');
        $this->loadModel('Admin.BedType');
        $column = $this->request['data']['order'][0]['column'];
        $sortColumn = 'RoomRates.modified';

        if($column == 0){
            $sortColumn = 'Room.room_type';
        }
        
        if($column == 2){
            $sortColumn ='BedType.title';
        }
       
        
        $conditions=[];
        if(!empty($this->request['data']['search'])){
            $searchItem = $this->request['data']['search']['value'];
            if($searchItem != ""){
               $searchItem="%".$searchItem."%";
               $conditions['Room.room_type like'] = $searchItem; 
            }
        }
        $order =  "DESC";
        $startLimit = $this->request['data']['start'];
        $length = $this->request['data']['length'];
        $this->$modelName->bindModel([
            'belongsTo'=>[
                'BedType'=>[
                  'className'=>'BedType',
                  'foreignKey'=>'bed_type_id'
                ],
                'Room'=>[
                    'className'=>'Room',
                    'foreignKey'=>'room_id'
                ],
                
            ],
            
        ]);  
        $conditions['Room.hotel_id']=   $this->request->data['hotelId'];  
        $datas = $this->$modelName->find('all',['conditions'=>$conditions,'offset'=>$startLimit,'limit'=>$length,'order'=>[$sortColumn=>$order]]);
        $total = $this->$modelName->find('count');
        $info = [];
        foreach ($datas as $data) {
            $id = $data[$modelName]['id'];
            $url= Configure::read('siteUrl').'room_rates/add/hotel:'.$this->request->data['hotelId'];
            $editUrl= Configure::read('siteUrl').'room_rates/add/hotel:'.$this->request->data['hotelId'].'/'.$data[$modelName]['id'];
           // $actionList = '<a href="'.$url.'" class="text-inverse p-r-10 " data-action="form" data-toggle="tooltip" title="Edit" data-original-title="Edit"><i class="fa fa-plus"></i></a>';
            $actionList = '<a href="'.$editUrl.'" class="text-inverse p-r-10 " data-action="form" data-toggle="tooltip" title="Edit" data-original-title="Edit"><i class="ti-marker-alt"></i></a>';
            $actionList .= '<a href="javascript:void(0)" data-deleteId="'.$id.'" data-model="'.$modelName.'" class="text-inverse delete" title="Delete" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash"></i></a>';

            if($data[$modelName]['is_active'] == 1){
                
                $status='<span class="label label-success font-weight-100">Active</span>';
            }else{
                $status='<span class="label label-danger font-weight-100">Inactive</span>';
            }
            $info[] = [$data['Room']['room_type'],$data['BedType']['title'],$status,$actionList];
        }
        $response['draw'] =$this->request['data']['draw'];
        $response['recordsTotal'] = $total;
        $response['recordsFiltered'] = $total;
        $response['data'] =$info;
        echo json_encode($response);
        die;

    }
    public function delete_room(){
        $this->autoRender = false;
        $this->loadModel('Admin.Room');
        $this->loadModel('Admin.BedTypeHotel');
        $roomId =  $this->data['deleteId'];
        if($roomId > 0){
            $this->Room->deleteAll(array('Room.id' =>$roomId), false);
            $this->BedTypeHotel->deleteAll(array('BedTypeHotel.room_id' =>$roomId), false);
            
            $output['status'] = true;
        }else{
            $output['status'] = false;
        }
        echo json_encode($output); die;
    }
    public function list_contactsenq($value=''){
        $this->autoRender = false;
        $column = $this->request['data']['order'][0]['column'];
        $sortColumn = 'created';

        if($column == 0){
            $sortColumn = 'first_name';
        }
        if($column == 1){
            $sortColumn = 'last_name';
        }
        if($column == 2){
            $sortColumn = 'phone';
        }
        if($column == 3){
            $sortColumn = 'email';
        }
        if($column == 4){
            $sortColumn = 'message';
        }
        
        $conditions= [];
        if(!empty($this->request['data']['search'])){
            $searchItem = $this->request['data']['search']['value'];
            if($searchItem != ""){
                $searchItem="%".$searchItem."%";
               $conditions['first_name like'] = $searchItem; 
            }
            
        }
        $order =  strtoupper($this->request['data']['order'][0]['dir']);
        $startLimit = $this->request['data']['start'];
        $length = $this->request['data']['length'];
        $this->loadModel('Admin.ContactInquiries');
        $datas = $this->ContactInquiries->find('all',['conditions'=>$conditions,'offset'=>$startLimit,'limit'=>$length,'order'=>[$sortColumn=>$order]]);
        $total = $this->ContactInquiries->find('count',['conditions'=>$conditions]);
        $info = [];
        foreach ($datas as $data) {
            $info[] = [$data['ContactInquiries']['first_name'],$data['ContactInquiries']['last_name'],$data['ContactInquiries']['phone'],$data['ContactInquiries']['email'],$data['ContactInquiries']['message']];
        }
        $response['draw'] =$this->request['data']['draw'];
        $response['recordsTotal'] = $total;
        $response['recordsFiltered'] = $total;
       
        $response['data'] =$info;
        echo json_encode($response);
        die;
       
    }

    public function listing_dashboard(){
        $this->autoRender = false;
        $modelName = $this->request->data['model'];
        $this->loadModel('Admin.'.$modelName);
        $column = $this->request['data']['order'][0]['column'];
        $sortColumn = 'modified';

        if($column == 0){
            $sortColumn = $modelName.'.booking_id';
        }
        if($column == 1){
            $sortColumn = $modelName.'.hotel';
        }
        if($column == 1){
            $sortColumn = $modelName.'.hoteldetail';
        }
        $conditions=[];
        if(!empty($this->request['data']['search'])){
            $searchItem = $this->request['data']['search']['value'];
            if($searchItem != ""){
               $searchItem="%".$searchItem."%";
               $conditions[$modelName.'.booking_id like'] = $searchItem; 
            }
        }
        $order =  "DESC";
        $startLimit = $this->request['data']['start'];
        $length = $this->request['data']['length'];  
         $this->loadModel("Admin.Hotel");
        $this->$modelName->bindModel(
                       array(
                       'belongsTo'=>array(
                           'Hotel' =>array(
                               'className' => 'Admin.Hotel',
                               'foreignKey'=> 'hotel_id',
                            ),
                           'Room' =>array(
                               'className' => 'Admin.Room',
                               'foreignKey'=> 'room_id',
                            ),
                           'BedType' =>array(
                               'className' => 'Admin.BedType',
                               'foreignKey'=> 'bed_id',
                            ),
                                        )
                           )
           );

        $datas = $this->$modelName->find('all',['conditions'=>$conditions,'offset'=>$startLimit,'limit'=>$length,'order'=>[$sortColumn=>$order]]);
        $total = $this->$modelName->find('count');
        $info = [];

        $result = array();
        foreach ($datas as $element) {
            $result[$element['RoomReservation']['booking_id']][] = $element;
        }

        foreach ($result as $bookingid => $dataset) {
                    $hotelData = "<table>
                                <tr>
                                  <th>Room</th>
                                  <th>Adults</th>
                                  <th>Child</th>
                                  <th>Total amount</th>
                                  <th>Checkin</th>
                                  <th>checkout</th>
                                  <th>No of rooms</th>
                                </tr>";
                                foreach ($dataset as $key => $data) {
                                  $hotelData .= "<tr>
                                      <td>".$data['Room']['room_type'].'-'.$data['BedType']['title']."</td>
                                      <td>".$data['RoomReservation']['adults']."</td>
                                      <td>".$data['RoomReservation']['child']."</td>
                                      <td>".$data['RoomReservation']['total_amount']."</td>
                                      <td>".$data['RoomReservation']['check_in']."</td>
                                      <td>".$data['RoomReservation']['check_out']."</td>
                                      <td>".$data['RoomReservation']['no_of_rooms']."</td>
                                    </tr>";
                                }
                    $hotelData .= "</table>";
           
            $info[] = [$bookingid,$data['Hotel']['title'],$hotelData];
        }
        $response['draw'] =$this->request['data']['draw'];
        $response['recordsTotal'] = $total;
        $response['recordsFiltered'] = $total;
        $response['data'] =$info;
        echo json_encode($response);
        die;
    }
    public function form_room(){
        if($this->request->is('ajax')){
            $this->layout = 'ajax';
            $modelName =  $this->request->data['model'];
            $hotelId =  $this->request->data['hotelId'];
            if(isset($this->request->data['id'])){
                $this->loadModel("Admin.".$modelName);
                $data =  $this->$modelName->findById($this->request->data['id']);
                $this->request->data[$modelName] = $data[$modelName]; 
            }
           $this->set(compact('modelName','hotelId'));
           $this->render('form_room');
        }

    }
    public function add_bed_type(){
        if($this->request->is('ajax')){
            $this->loadModel('Admin.BedType');
            $this->layout = 'ajax';
            $modelName = 'BedTypeHotel';
            $roomId =  $this->request->data['roomId'];
            $bedType =  $this->BedType->find('list',['conditions'=>['is_active'=>1],'fields'=>['id','title']]);
            if(isset($this->request->data['id'])){
                $this->loadModel("Admin.".$modelName);
                $data =  $this->$modelName->findById($this->request->data['id']);
                $this->request->data[$modelName] = $data[$modelName]; 
            }
           $this->set(compact('modelName','roomId','bedType'));
           $this->render('form_bed');
        }

    }
    
    public function save_room(){
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
    public function save_bed(){
        if ($this->request->is('ajax')) {
            if (!empty($this->data)) {
               
                $modelName =$this->data['model'];         
                $this->loadModel('Admin.'.$modelName); 
                $this->loadModel('Admin.RoomImages'); 
                $this-> $modelName->set($this->data[$modelName]);
                if($this->$modelName->validates()) {
                    if ($this->$modelName->save($this->data[$modelName])) {
                        if($this->request->data[$modelName]['id']== ""){
                        
                            $id = $this->$modelName->getLastInsertId();
                        }else{
                            $id =$this->data[$modelName]['id'];
                        }
                        $roomId = $this->data[$modelName]['room_id'];
                        if(isset($this->data[$modelName]['images']) && !empty($this->data[$modelName]['images'])){
                            $this->RoomImages->deleteAll(array('RoomImages.bed_type_id' => $id), false);
                            foreach($this->data[$modelName]['images'] as $image){
                                $dataTosave =['bed_type_id'=>$id,'file'=>$image,'room_id'=>$roomId];
                                $this->RoomImages->save($dataTosave);
                            }
                           
                        }
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
    
    public function listing_room($value=''){
        $this->autoRender = false;
        $column = $this->request['data']['order'][0]['column'];
        $sortColumn = 'created';
        $hotelId = $this->request['data']['hotelId'];
        if($column == 0){
            $sortColumn = 'room_type';
        }
        if($column == 1){
            $sortColumn = 'description';
        }
        
        $conditions= [];
        if(!empty($this->request['data']['search'])){
            $searchItem = $this->request['data']['search']['value'];
            if($searchItem != ""){
                $searchItem="%".$searchItem."%";
               $conditions['room_type like'] = $searchItem; 
            }
            
        }
        $conditions['hotel_id'] = $hotelId;
        $order =  strtoupper($this->request['data']['order'][0]['dir']);
        $startLimit = $this->request['data']['start'];
        $length = $this->request['data']['length'];
        $this->loadModel('Admin.Room');
        $datas = $this->Room->find('all',['conditions'=>$conditions,'offset'=>$startLimit,'limit'=>$length,'order'=>[$sortColumn=>$order]]);
        $total = $this->Room->find('count',['conditions'=>$conditions]);
        $info = [];
        foreach ($datas as $data) {
            $id = $data['Room']['id'];
            $actionList = '<a href="javascript:void(0)" data-editId="'.$id.'" class="text-inverse p-r-10 edit" data-model="Room" data-action="form_room" data-toggle="tooltip" title="Edit" data-original-title="Edit"><i class="ti-marker-alt"></i></a>';
            $actionList .= '<a href="javascript:void(0)" data-deleteId="'.$id.'" data-model="Room" class="text-inverse delete" title="Delete" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash"></i></a>&nbsp;&nbsp;&nbsp;';
            $actionList .= '<a href="javascript:void(0)" data-room="'.$id.'" data-model="Room" class="text-inverse view_bed_type" title="View Bed Type" data-toggle="tooltip" data-original-title="View Bed Type"><i class="mdi mdi-eye"></i></a>&nbsp;&nbsp;&nbsp;';
            $actionList .= '<a href="javascript:void(0)" data-room="'.$id.'" data-model="Room" class="text-inverse add_bed_type" title="Add Bed Type" data-toggle="tooltip" data-original-title="Add Bed Type"><i class="fa fa-plus"></i></a>';
            if($data['Room']['is_active'] == 1){
                $status='<span class="label label-success font-weight-100">Active</span>';
            }else{
                $status='<span class="label label-danger font-weight-100">De-active</span>';
            }
            $info[] = [$data['Room']['room_type'],$data['Room']['description'],$status,$actionList];
        }
        $response['draw'] =$this->request['data']['draw'];
        $response['recordsTotal'] = $total;
        $response['recordsFiltered'] = $total;
       
        $response['data'] =$info;
        echo json_encode($response);
        die;
       
    }
}