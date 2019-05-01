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

class UsersController extends AdminAppController
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
    public $components = array('Admin.Email','Paginator');
    function beforeFilter() {
        $this->checklogin();
        //$this->Auth->autoRedirect = false;
       // parent::beforeFilter();
    }
    public function index(){
        $this->set('title', 'Users');
        $this->loadModel('Admin.Users');

        $conditions['Users.role'] = 2; 
        $this->paginate = array(           
            'limit' => 10,
            'conditions'=> $conditions
        );

        $data = $this->paginate('Users');       
        $this->set(compact('data'));

    }
    public function dashboard(){
        $this->loadModel('Admin.Hotel');
        $this->loadModel('Admin.Room');
        $this->loadModel('Admin.BedType');
        $this->loadModel('Admin.TourPackage');
        $this->loadModel('Admin.Destination');
        $this->loadModel('Admin.Company');
        $this->loadModel('Admin.RoomReservation');
        $title = "Dashboard";
        $this->set('title_for_layout', $title);
        $this->set(compact('title'));       
        $this->loadModel('Admin.Users');
        /*Get total number of hotels*/
        $total_hotels = $this->Hotel->find('all',['conditions'=>['Hotel.is_active'=>1]]);
        $hotel_count = sizeof($total_hotels);

        /*Get total number of tour packages*/
        $total_Package = $this->TourPackage->find('all',['conditions'=>['TourPackage.is_active'=>1]]);
        $Package_count = sizeof($total_Package);

        /*Get total number of destinations*/
        $total_Destination = $this->Destination->find('all',['conditions'=>['Destination.is_active'=>1]]);
        $Destination_count = sizeof($total_Destination);

        /*Get total number of destinations*/
        $total_Company = $this->Company->find('all',['conditions'=>['Company.is_active'=>1]]);
        $Company_count = sizeof($total_Company);

         $this->RoomReservation->bindModel([
                    'hasOne'=>[
                        'Hotel'=>[
                          'className'=>'Hotel',
                          'foreignKey'=>'id',
                        ],
                        'Room'=>[
                            'className'=>'Room',
                            'foreignKey'=>'id',
                        ],
                        'BedType'=>[
                            'className'=>'BedType',
                            'foreignKey'=>'id',
                        ]
                    ],
                    
                ]);
        $date = date('Y-m-d', strtotime("-7 days"));

         $this->paginate = [
                'page' => 1,
                'limit' => 5,
                'maxLimit' => 5,
            ];
        /*Get hotel bookings for last 7 days*/
        $reservedRooms = $this->paginate($this->RoomReservation);
        //debug($reservedRooms); die;
        $userData = $this->Session->read('UserData');
        $this->set(compact('title','hotel_count','Package_count','Destination_count','Company_count','reservedRooms'));
    }
    public function change_password(){
        $title = "Change Password";
        $this->set('title_for_layout', $title);
        $this->loadModel('Admin.Users');
        if ($this->request->is(['post','put'])) {
            $uid = $this->Auth->user();
            $this->request->data['Users']['id'] = $uid;          
            $data = $this->request->data['Users'];   
            //   pr($data); die;    
            $this->Users->set($data);        
            if($this->Users->changePasswordValidate()){
                $password = Security::hash($this->data['Users']['new_password'], null, true);
               
                $dataToSave =  ['id'=>$uid,'password'=>$password];
                $this->Users->save($dataToSave);
                $this->Session->setFlash(__('Password update successfully...',true),'success');
                $this->Session->delete('UserData');               
                $this->redirect($this->Auth->logout());

            }else {
               
            }
        }
        $this->set(compact('title'));
    }
    public function profile(){
        $title = "Profile";
        $this->set('title_for_layout', $title);
        $this->loadModel('Admin.Users');
        if ($this->request->is(['post','put'])) {
            $uid = $this->Auth->user();
            $this->request->data['Users']['id'] = $uid;          
            $data = $this->request->data['Users'];
            $this->Users->set($data);        
            
                $name = $data['name'];             
                $email = $data['email'];             
                $dataToSave =  ['id'=>$uid,'name'=>$name,'email'=>$email];
               
                $this->Users->save($dataToSave);
                $data = $this->Users->findById($uid);
                $this->Session->write('UserData', $data);
                $this->Session->setFlash(__('Profile updated successfully...',true),'success');                         
                $this->redirect(array('controller'=>'users','action' => 'dashboard','plugin'=>'admin')); 

            
        }
        $this->set(compact('title'));

        
    }
    public function list_groups(Type $var = null){
        $title = "List Groups";
        $this->set('title_for_layout', $title);
        $this->set(compact('title'));
      
    }
    public function add_group(){
        $title = "Add Group";
        $this->set('title_for_layout', $title);
        $this->set(compact('title'));
        $this->loadModel('Admin.Users');
        if ($this->request->is(['post','put'])) {
            $data = $this->data['Users'];
            $this->Users->set($data);
            if(isset($this->data['Users']['id'])){
                $this->Users->validator()->remove('logo_image');
                $this->Users->validator()->remove('password');
            }
            if($this->Users->add_groupvalidation()){
                $data['password'] = Security::hash($data['password'], NULL, true); 
                if(!empty($this->data['Users']['logo_image']['tmp_name'])){
                    $fileArray =  explode(".",$this->data['Users']['logo_image']['name']);
                    $fileExtension = end($fileArray);
                    $fileName =  str_replace(" ","_",$this->data['Users']['name']).'_'.time().".".$fileExtension;
                    $filePath = Configure::read('GroupRelativeUrl');
                    move_uploaded_file($this->data['Users']['logo_image']['tmp_name'],$filePath.$fileName);
                    $data['logo'] = $fileName;
                }else{
                    $data['logo'] = isset($this->data['Users']['logo'])?$this->data['Users']['logo']:'';
                }
                $data['role'] = 2;
                if(!isset($this->data['Users']['id'])){
                    $this->Users->create();
                }
                
                $this->Users->save($data,false);
                $this->Session->setFlash(__('Group saved successfully...',true),'success');
                $this->redirect(array('controller'=>'users','action' => 'list_groups','plugin'=>'admin')); 

            }
        }else{               
            $id = (isset($this->request->params['pass'][0]))?$this->request->params['pass'][0]:0;
          
            if($id > 0){
                $data = $this->Users->findById($id);                  
                $this->request->data['Users'] = $data['Users'];
                //pr($this->request); die;
            }
        }

    }


    /*
     * Add User
     */
    public function add_user(){
        $title = "Add User";
        $this->set('title_for_layout', $title);
        $this->set(compact('title'));
        $this->loadModel('Admin.Users');
        $this->loadModel('Admin.Roles');

        $roles = $this->Roles->find('list');
        if ($this->request->is(['post','put'])) {
            $data = $this->data['Users'];
            $this->Users->set($data);
            if(isset($this->data['Users']['id'])){
                $this->Users->validator()->remove('logo_image');
                $this->Users->validator()->remove('password');
            }
            if($this->Users->add_uservalidation()){
                $data['password'] = Security::hash($data['password'], NULL, true); 
                if(!empty($this->data['Users']['logo_image']['tmp_name'])){
                    $fileArray =  explode(".",$this->data['Users']['logo_image']['name']);
                    $fileExtension = end($fileArray);
                    $fileName =  str_replace(" ","_",$this->data['Users']['name']).'_'.time().".".$fileExtension;
                    $filePath = Configure::read('GroupRelativeUrl');
                    move_uploaded_file($this->data['Users']['logo_image']['tmp_name'],$filePath.$fileName);
                    $data['logo'] = $fileName;
                }else{
                    $data['logo'] = isset($this->data['Users']['logo'])?$this->data['Users']['logo']:'';
                }

                if(!isset($this->data['Users']['id'])){
                    $this->Users->create();
                }
                
                $this->Users->save($data,false);
                $this->Session->setFlash(__('Group saved successfully...',true),'success');
                $this->redirect(array('controller'=>'users','action' => 'list_users','plugin'=>'admin')); 

            }
        }else{               
            $id = (isset($this->request->params['pass'][0]))?$this->request->params['pass'][0]:0;
          
            if($id > 0){
                $data = $this->Users->findById($id);                  
                $this->request->data['Users'] = $data['Users'];
                //pr($this->request); die;
            }
        }

        $this->set(compact('roles'));

    }

    /*
     * List Users
     */
    public function list_users(){
        $title = "List Users";
        $this->set('title_for_layout', $title);
        $this->set(compact('title'));
      
    }

}