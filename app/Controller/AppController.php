<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		https://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    /*  
    public $components = array(
        'Flash',
        'Session',
        'Auth' => array(
            'loginRedirect' => array(
                'controller' => 'customers',
                'action' => 'home',
            ),
            'logoutRedirect' => array(
                'controller' => 'customers',
                'action' => 'login',
            ),
            'authenticate' => array(
                'Form' => array(
                    'passwordHasher' => 'Blowfish'
                ),
            )
        )
    );*/
   

    
    public $helpers = array("MinifyHtml.MinifyHtml",'Navigation');
   

    public function beforeFilter() {
        if(!$this->Session->check('CustomerData')){
           // $this->redirect(array('controller'=>'customers','action' => 'login')); 
        }

        $this->loadModel('Admin.TourCategories');
        
        $this->siteSettings = $this->siteSettings();
        $logo = Configure::read('AbsoluteUrl').'SiteSettings/'.$this->siteSettings['SiteSettings']['logo'];
        $services = $this->serviceMenu();
        $aboutMenu = $this->aboutMenu();
        $tourCats = $this->TourCategories->find('list',['keyField'=>'id','valueField'=>'name']);
        $this->loadModel("Admin.News");
        $news =  $this->News->find('all',['conditions'=>['News.is_active'=>1,'type'=>"News & Events"],'order'=>['created'=>'DESC'],'limit'=>50]);
        $news_arr = [];
        foreach ($news as $key => $value) {
            $fileAbsolutePathFeatured = Configure::read('AbsoluteUrl').'news/'.$value['News']['file'];
              $news_arr[] = $value['News']['title'];
        }
        $newsFinalArray = array_values($news_arr);
        
        $siteSettings =$this->siteSettings;   
        $this->set(compact('siteSettings','logo','services','aboutMenu','tourCats','activityList','newsFinalArray'));

    }


    function loginCheck() {
        $returnUrl = $this->params->url;
        $userinfo  = $this->Session->read("CustomerData");
        if(empty($userinfo) && $returnUrl!='customers/login'){
            $this->redirect(array('controller'=>'customers','action' => 'login'));
        }
    }


	public function siteSettings(){
        $this->loadModel('Admin.SiteSettings');
        $siteData =  $this->SiteSettings->find('first');
        return $siteData;
    }
    public function serviceMenu(){
        $this->loadModel('Admin.Category');
        $this->loadModel('Admin.Services');
        $condition['Category.type'] =2;
        $condition['Category.position'] = [2,4];
        $condition['Category.status'] = 1;
        $services = $this->Category->find('all',['conditions'=>$condition]);
        return $services;
    }
    public function aboutMenu(){
        $this->loadModel('Admin.Category');
        $this->Category->bindModel([
            'hasMany'=>[
                'Cms'=>[
                  'className'=>'Cms',
                  'foreignKey'=>'category',
                  'fields'=>['title','slug','id']
                ]
            ],
            
        ]);
        $condition['Category.status'] =1;
        $condition['Category.slug'] ='about';
        $aboutMenu = $this->Category->find('first',['conditions'=>$condition,'fields'=>['title']]);
        return $aboutMenu;
    }


    public function encrypt($plainText, $key)
    {
        $key = $this->hextobin(md5($key));
        $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
        $openMode = openssl_encrypt($plainText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
        $encryptedText = bin2hex($openMode);
        return $encryptedText;
    }

    public function decrypt($encryptedText, $key)
    {
        $key = $this->hextobin(md5($key));
        $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
        $encryptedText = $this->hextobin($encryptedText);
        $decryptedText = openssl_decrypt($encryptedText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
        return $decryptedText;

    }


    //********** Hexadecimal to Binary function for php 4.0 version ********

    public function hextobin($hexString)
    {
        $length = strlen($hexString);
        $binString = "";
        $count = 0;
        while ($count < $length) {
            $subString = substr($hexString, $count, 2);
            $packedString = pack("H*", $subString);
            if ($count == 0) {
                $binString = $packedString;
            } else {
                $binString .= $packedString;
            }

            $count += 2;
        }
        return $binString;
    }

    public function generateRandomString($length = 10)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function send_sms($mobile,$sms){

        $phone = '+91'.$mobile;
        $sms = urlencode($sms);
        $url = "http://sms.smsmenow.in/sendsms.jsp?user=kmvnss&password=331d9cba2bXX&mobiles=".$phone."&sms=".$sms."&senderid=KMVNSS";
        $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url); //set url
            curl_setopt($ch, CURLOPT_HEADER, true); //get header
            curl_setopt($ch, CURLOPT_NOBODY, true); //do not include response body
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //do not show in browser the response
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); //follow any redirects
            $output = curl_exec($ch);
            $new_url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL); //extract the url from the header response
            curl_close($ch);
    
    }
}
