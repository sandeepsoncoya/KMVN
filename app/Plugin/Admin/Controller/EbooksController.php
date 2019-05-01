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
class EbooksController extends AdminAppController
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
        
        $title = "E-books";
        $this->set('title_for_layout', $title);
        $this->set(compact('title'));

    }
    public function add(){
        $title = "Add Ebook";
        $this->set('title_for_layout', $title);
        $this->loadModel('Admin.Ebooks');
        if ($this->request->is(array('PUT','POST' ))) {
            $data = $this->request->data['Ebooks'];
            $this->Ebooks->set($data); 
            if($this->Ebooks->validates()){
                if(!empty($this->data['Ebooks']['file']['tmp_name'])){
                    $fileArray =  explode(".",$this->data['Ebooks']['file']['name']);
                    $fileExtension = end($fileArray);
                    $fileName =  str_replace(" ","_",$this->data['Ebooks']['name']).'_'.time().".".$fileExtension;
                    $filePath = Configure::read('RelativeUrl').'ebooks/';                    
                    move_uploaded_file($this->data['Ebooks']['file']['tmp_name'],$filePath.$fileName);
                    $data['file'] = $fileName;
                }else{
                    $data['file'] = (isset($this->data['Ebooks']['file']))?$this->data['Ebooks']['file']:'';
                }
            
                $this->Ebooks->save($data);
                
                $this->Session->setFlash(__('Ebook saved successfully...',true),'success');
                $this->redirect(array('controller'=>'Ebooks','action' => 'index','plugin'=>'admin'));
            }else{
                  
            }
        }elseif(!$this->request->is('post')){      
            $id = (isset($this->request->params['pass'][0]))?$this->request->params['pass'][0]:0;
            if($id > 0){
                $data = $this->Ebooks->find('first',['conditions'=>['Ebooks.id'=>$id]]);
                $this->request->data['Ebooks'] = $data['Ebooks']; 
                          
            }
        }
        $this->set(compact('title'));
    }
    public function delete($id){
        $this->autoRender = false;
        $this->loadModel('Admin.Ebooks');
        if($id != ""){
            $this->Ebooks->deleteAll(array('Ebooks.id' => $id), false);
            $this->Session->setFlash(__('Ebooks deleted successfully.',true),'success');
            $this->redirect(array('controller'=>'Ebooks','action' => 'index','plugin'=>'admin'));
        }else{
            $this->Session->setFlash(__('Invalid request.',true),'error');
            $this->redirect(array('controller'=>'Ebooks','action' => 'index','plugin'=>'admin'));
        }
    }

    

    
  
   
}