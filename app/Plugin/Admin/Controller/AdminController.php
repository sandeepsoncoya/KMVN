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
class AdminController extends AdminAppController
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
    public function index(){
        $this->layout='login';
        $this->set('title', 'Login');
        $userinfo  = $this->Session->read("UserData");
       // pr($userinfo); die;
        $this->loadModel('Admin.SiteSettings');
        $siteData =  $this->SiteSettings->find('first');
        $siteLogo="";
        if(!empty($siteData)){
            $siteLogo =  Configure::read('AbsoluteUrl').'SiteSettings/'.$siteData['SiteSettings']['logo'];
        }
        if ($this->request->is('post')) {
            //pr($userinfo); die;
            $this->loadModel('Admin.Users');
            $email =  $this->request->data['Login']['email'];
            $password =  $this->request->data['Login']['password'];
            $hashedPasswords = Security::hash($password, NULL, true);

            $data = $this->Users->find('first',[
                                                'conditions' =>[
                                                    'email'=>$email,
                                                    'role'=>[1,2]
                                                ]
                                            ]
                                      );
            //echo $hashedPasswords; die;
           // pr($this->Users); die;
            
            if (!empty($data)) {
                if($data['Users']['status'] == 1){
                   // echo $hashedPasswords .'=='. $data['Users']['password']; die;
                    if($hashedPasswords == $data['Users']['password']){
                        $this->Session->write('UserData', $data);
                        
                        $this->Auth->login($data['Users']['id']);
                        $this->Session->setFlash(__('Login Successfully',true),'success');
                        $this->redirect(array('controller'=>'users','action' => 'dashboard','plugin'=>'admin'));  

                    }else{
                      $this->Session->setFlash(__("Password is incorrect. Please use correct password to login", true),'error');
                      $this->redirect(array('action' => 'index'));
                    }
                   
                   
                }else{
                     $this->Session->setFlash(__('Your account has been deactivated.', true),'info');
                }
                
            } else {
                $this->Session->setFlash(__('Invalid username or password', true),'error');
            }
        }/*else if(!$this->Session->check('Auth.User')){
            //      
        }else if($this->Session->check('Auth.User')){
            $this->redirect(array('controller'=>'users','action' => 'dashboard','plugin'=>'admin'));  
        } */
        $this->set(compact('siteLogo'));
    }
    public function register(){
        $this->layout='login';
    } 
    public function forgot_password(){
        $this->layout='login';
    }
    public function logout() {
        $this->Session->delete('UserData');
        $this->Session->setFlash(__("Logout Successfully...", true),'info');
        $this->redirect($this->Auth->logout());
    }


    
}