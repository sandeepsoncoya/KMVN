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
class ActivitiesController extends AdminAppController
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
        
        $title = "Activities";
        $this->set('title_for_layout', $title);
        $this->set(compact('title'));

    }
    public function add(){
        
        $title = "Add Activity";
        $this->set('title_for_layout', $title);
        $this->loadModel('Admin.ActivityImages');
        $this->loadModel('Admin.Activities');
        if ($this->request->is(array('PUT','POST' ))) {

            //pr($this->request->data); die;

            $data = $this->request->data['Activities'];
            $this->Activities->set($data); 
            if($this->Activities->validates()){
                if(!empty($this->data['Activities']['featured_img']['tmp_name'])){
                    $fileArray =  explode(".",$this->data['Activities']['featured_img']['name']);
                    $fileExtension = end($fileArray);
                    $fileName =  str_replace(" ","_",$this->data['Activities']['name']).'_'.time().".".$fileExtension;
                    $filePath = Configure::read('RelativeUrl').'activity/';                    
                    move_uploaded_file($this->data['Activities']['featured_img']['tmp_name'],$filePath.$fileName);
                    $data['featured_image'] = $fileName;
                }else{
                    $data['featured_image'] = (isset($this->data['Activities']['featured_image']))?$this->data['Activities']['featured_image']:'';
                }
                if(!isset($this->request->data['Activities']['id'])){
                    $data['slug']= $this->createSlug($this->data['Activities']['name'],NULL,'Activities'); 
                    $this->Activities->create();                   
                }else{
                    $data['slug']= $this->createSlug($this->data['Activities']['name'],$this->request->data['Activities']['id'],'Activities'); 
                }
                $this->Activities->save($data);
                if(!isset($this->request->data['Activities']['id'])){
                    $ActivitiesId =   $this->Activities->getInsertID();                 
                }else{
                    $ActivitiesId =  $this->request->data['Activities']['id'];     
                }
                if(isset($ActivitiesId)){
                    $this->ActivityImages->deleteAll(array('ActivityImages.activity_id' => $ActivitiesId), false);
                    if(!empty($data['images'])){
                        $i = 0;
                        foreach($data['images'] as $image){
                            $alt = $data['alt'][$i];
                            $dataToSave = ['file'=>$image,'activity_id'=>$ActivitiesId,'alt'=>$alt];
                            $this->ActivityImages->create();
                            $this->ActivityImages->save($dataToSave);
                            $i++;
                        }
                    }
                }

                $this->Session->setFlash(__('Activities saved successfully...',true),'success');
                $this->redirect(array('controller'=>'activities','action' => 'index','plugin'=>'admin'));
            }else{
            }
        }elseif(!$this->request->is('post')){      
            $id = (isset($this->request->params['pass'][0]))?$this->request->params['pass'][0]:0;
            if($id > 0){
                $this->Activities->bindModel([
                    'hasMany'=>[
                        'ActivityImages'=>[
                          'className'=>'ActivityImages',
                          'foreignKey'=>'activity_id'
                        ]
                    ],
                    
                ]);

                $data = $this->Activities->find('first',['conditions'=>['Activities.id'=>$id]]);
                $this->request->data['Activities'] = $data['Activities']; 
                $this->request->data['ActivityImages'] = $data['ActivityImages'];             
            }
        }

        $this->set(compact('title','ActivityImages'));
    }
    public function delete($id){
        $this->autoRender = false;
        $this->loadModel('Admin.Activities');
        if($id != ""){
            $this->Activities->deleteAll(array('Activities.id' => $id), false);
            $this->Session->setFlash(__('Activity deleted successfully.',true),'success');
            $this->redirect(array('controller'=>'activities','action' => 'index','plugin'=>'admin'));
        }else{
            $this->Session->setFlash(__('Invalid request.',true),'error');
            $this->redirect(array('controller'=>'activities','action' => 'index','plugin'=>'admin'));
        }
    }
}