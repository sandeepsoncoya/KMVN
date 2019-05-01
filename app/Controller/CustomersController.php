<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');
App::uses('Security', 'Utility'); 
//App::uses('Session', 'Controller/Component/Auth');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link https://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class CustomersController  extends AppController {

   

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();

/**
 * Displays a view
 *
 * @return CakeResponse|null
 * @throws ForbiddenException When a directory traversal attempt.
 * @throws NotFoundException When the view file could not be found
 *   or MissingViewException in debug mode.
 */
    public $siteSettings;  


    public function beforeFilter() {
        $this->loadModel('Customers');
        $this->loadModel('Admin.UserWallets');
        $this->loadModel('Admin.CompanyUsers');
        
        $this->siteSettings = $this->siteSettings();
        $logo = Configure::read('AbsoluteUrl').'SiteSettings/'.$this->siteSettings['SiteSettings']['logo'];
        $siteSettings =$this->siteSettings;
        $this->loadModel('Activities');
        $activityList = $this->Activities->find('all',['conditions'=>['is_active'=>1]]);

        $this->set(compact('siteSettings','logo','activityList'));
        //$this->Auth->allow('login');
        $this->loginCheck();

    }


    public function index(){

        $tenders =$this->TenderCategory->find('all',
                array(
                    'conditions' => array('TenderCategory.is_active' => 1),
                    'joins' => array(
                         array(
                            'table' => 'tenders',
                            'alias' => 'Tenders',
                            'type' => 'LEFT',
                            'conditions' => array('Tenders.tender_category_id = TenderCategory.id'),
                            
                         ),
                     ),
                    'fields' => array('*'),

                )
            );   
        $this->set(compact('tenders'));
    }
    public function login()
    {
        $this->set('title', 'Login');
        $this->loadModel('Admin.SiteSettings');
        $this->loadModel('Customers');
        $siteData =  $this->SiteSettings->find('first');
        $siteLogo="";
        if(!empty($siteData)){
            $siteLogo =  Configure::read('AbsoluteUrl').'SiteSettings/'.$siteData['SiteSettings']['logo'];
        }
        if ($this->request->is('post')) {
            $email =  $this->request->data['Login']['email'];
            $password =  $this->request->data['Login']['password'];
            $hashedPasswords = Security::hash($password, NULL, true);

            $data = $this->Customers->find('first',[
                                                'conditions' =>[
                                                    'email'=>$email,
                                                    'password'=>$hashedPasswords,
                                                    'is_active'=>1
                                                ]
                                            ]
                                      );

            if (!empty($data)) {
                if($data['Customers']['is_active'] == 1){
                    if($hashedPasswords == $data['Customers']['password']){
                        $this->Session->write('CustomerData', $data);

                        $this->redirect(array('controller'=>'customers','action' => 'home'));  
                        //$this->Auth->login($data['Customers']['id']);
                        $this->Session->setFlash(__('Login Successfully',true),'success');
                        $this->redirect(array('controller'=>'customers','action' => 'home'));  
                    }else{
                      $this->Session->setFlash(__("Password is incorrect. Please use correct password to login", true),'error');
                      $this->redirect(array('action' => 'login'));
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
            $this->redirect(array('controller'=>'customers','action' => 'home'));  
        } */

        $this->set(compact('siteLogo'));

    }

    public function home()
    {

        $this->loadModel("Admin.City");
        $this->loadModel("Admin.Hotel");
        

        $getUserData = $this->Session->read('CustomerData');
        
        $userId = $getUserData['Customers']['id'];
        $user = $this->Customers->find('first',[
                                                'conditions' =>[
                                                'id'=>$userId,
                                            ]
                                        ]
                                    );
       
        
               
        $company_user = $this->CompanyUsers->findById($userId);

        $cityList =  $this->City->find('list',['conditions'=>['is_active'=>1]]);



        $sum_credit = $this->UserWallets->find('all', array(
                                                    'conditions' => array(
                                                    'UserWallets.company_user_id' => $userId, 'UserWallets.amount_type' => 'credit'),
                                                    'fields' => array('sum(UserWallets.amount) as total_sum_credit')
                                                )
                                            );
        $sum = $sum_credit['0'];  
        $credit_amt = $sum[0]['total_sum_credit'];


        $minus_credit = $this->UserWallets->find('all', array(
                                                    'conditions' => array(
                                                    'UserWallets.company_user_id' => $userId, 'UserWallets.amount_type' => 'debit'),
                                                    'fields' => array('sum(UserWallets.amount) as total_minus_credit')
                                                )
                                            );
        $min = $minus_credit['0'];  
        $debit_amt = $min[0]['total_minus_credit'];

        $current_amt = $credit_amt - $debit_amt;

        $this->set(compact('user','current_amt','cityList'));

    }
	
    public function logout() {
        $this->Session->delete('CustomerData');
        $this->Session->setFlash(__("Logout Successfully...", true),'info');
        $this->redirect(array('controller'=>'customers','action' => 'login')); 
        /*$this->redirect($this->Auth->logout());*/
    }


    public function myWallet() {
        $this->set('title', 'My Wallet');
    }

    
}
