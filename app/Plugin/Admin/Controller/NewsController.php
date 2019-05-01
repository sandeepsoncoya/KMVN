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
class NewsController extends AdminAppController
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
        
        $title = "News";
        $this->set('title_for_layout', $title);
        $this->set(compact('title'));

    }
    public function add(){
        $title = "Add News";
        $this->set('title_for_layout', $title);
        $this->loadModel('Admin.News');
        if ($this->request->is(array('PUT','POST' ))) {
            $data = $this->request->data['News'];
            $this->News->set($data); 
            if($this->News->validates()){
                if(!empty($this->data['News']['featured_img']['tmp_name'])){
                    $fileArray =  explode(".",$this->data['News']['featured_img']['name']);
                    $fileExtension = end($fileArray);
                    $fileName =  str_replace(" ","_",$this->data['News']['title']).'_'.time().".".$fileExtension;
                    $filePath = Configure::read('RelativeUrl').'newsevents/';                    
                    move_uploaded_file($this->data['News']['featured_img']['tmp_name'],$filePath.$fileName);
                    $data['file'] = $fileName;
                }else{
                    $data['file'] = (isset($this->data['News']['file']))?$this->data['News']['file']:'';
                }
                if(!isset($this->request->data['News']['id'])){
                    $this->News->create();                   
                }
               // $data['slug']=Inflector::slug(strtolower($this->data['News']['name']), $replacement = '-');
                $this->News->save($data);
                
                $this->Session->setFlash(__('News saved successfully...',true),'success');
                $this->redirect(array('controller'=>'News','action' => 'index','plugin'=>'admin'));
            }else{
                  
            }
        }elseif(!$this->request->is('post')){      
            $id = (isset($this->request->params['pass'][0]))?$this->request->params['pass'][0]:0;
            if($id > 0){
                $data = $this->News->find('first',['conditions'=>['News.id'=>$id]]);
                $this->request->data['News'] = $data['News']; 
                          
            }
        }
        $this->set(compact('title'));
    }
    public function delete($id){
        $this->autoRender = false;
        $this->loadModel('Admin.News');
        if($id != ""){
            $this->News->deleteAll(array('News.id' => $id), false);
            $this->Session->setFlash(__('News deleted successfully.',true),'success');
            $this->redirect(array('controller'=>'News','action' => 'index','plugin'=>'admin'));
        }else{
            $this->Session->setFlash(__('Invalid request.',true),'error');
            $this->redirect(array('controller'=>'News','action' => 'index','plugin'=>'admin'));
        }
    }

    

    
  
   
}