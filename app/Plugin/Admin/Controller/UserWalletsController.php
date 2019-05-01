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
class UserWalletsController extends AdminAppController
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
    public function index($user_id=null){
        $this->loadModel('Admin.CompanyUsers');
        $this->loadModel('Admin.UserWallets');
        $company_user = $this->CompanyUsers->findById($user_id);
        $current_amt = $company_user['CompanyUsers']['remaining_amount'];
        $title = $company_user['CompanyUsers']['name']." Wallet List";
        $this->set('title_for_layout', $title);
        $this->set('user_id', $user_id);
        $this->set(compact('title', 'current_amt'));

    }
    public function add($user_id=null){
        
        $title = "Add Wallet";
        $this->set('title_for_layout', $title);
        $this->loadModel('Admin.UserWallets');
        $this->loadModel('Admin.CompanyUsers');


        $company_user = $this->CompanyUsers->findById($user_id);
        $comp_user_id = $company_user['CompanyUsers']['id'];
        $comp_user_name = $company_user['CompanyUsers']['name'];
        if ($this->request->is(array('POST'))) {
            
            $modelName ='UserWallets';  
            if (!empty($this->data)) {
                $this->loadModel('Admin.'.$modelName); 
                $walletslug = 'wallet-'.mt_rand(1000,9999);
                $slug = Inflector::slug(strtolower($walletslug), $replacement = '-');
                $idslug = null;
                
                $slug = $this->createSlug($walletslug,$idslug,$modelName);
                $this->request->data[$modelName]['slug']= $slug;
                $this->$modelName->set($this->data[$modelName]);
                if($this->$modelName->validates()) {
                    if (isset($this->data[$modelName])) {

                        $this->$modelName->create();
                        $this->$modelName->save($this->data);

                        $this->loadModel('Admin.UserWallets'); 
                        $sum_credit = $this->UserWallets->find('all', array(
                                                    'conditions' => array(
                                                    'UserWallets.company_user_id' => $user_id, 'UserWallets.amount_type' => 'credit'),
                                                    'fields' => array('sum(UserWallets.amount) as total_sum_credit')
                                                )
                                            );
                        $sum = $sum_credit['0'];  
                        $credit_amt = $sum[0]['total_sum_credit'];


                        $minus_credit = $this->UserWallets->find('all', array(
                                                                    'conditions' => array(
                                                                    'UserWallets.company_user_id' => $user_id, 'UserWallets.amount_type' => 'debit'),
                                                                    'fields' => array('sum(UserWallets.amount) as total_minus_credit')
                                                                )
                                                            );
                        $min = $minus_credit['0'];  
                        $debit_amt = $min[0]['total_minus_credit'];

                        $current_amt = $credit_amt - $debit_amt;

                        $this->CompanyUsers->updateAll(
                            array('remaining_amount' => "'$current_amt'"),
                            array('id' => $user_id)
                        );

                        $this->Session->setFlash(__('Amount saved successfully.',true),'success');
                        $this->redirect(array('controller'=>'user_wallets','action' => 'index',$comp_user_id,'plugin'=>'admin'));
                    }
                }
            }
        }
        
        $this->set(compact('title','comp_user_id','comp_user_name'));
    }
}