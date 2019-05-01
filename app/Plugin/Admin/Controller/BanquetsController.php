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
class BanquetsController extends AdminAppController
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
        
        $title = "Banquets";
        $this->set('title_for_layout', $title);
        $this->set(compact('title'));

    }

    public function add(){
        
        $title = "Add Banquet";
        $this->set('title_for_layout', $title);
        $this->loadModel('Admin.BanquetImages');
        $this->loadModel('Admin.Banquets');
        
        if ($this->request->is(array('PUT','POST' ))) {

            $data = $this->request->data['Banquets'];
            $this->Banquets->set($data); 

            if($this->Banquets->validates()){
                if(!empty($this->data['Banquets']['featured_img']['tmp_name'])){
                    $fileArray =  explode(".",$this->data['Banquets']['featured_img']['name']);
                    $fileExtension = end($fileArray);
                    $fileName =  str_replace(" ","_",$this->data['Banquets']['title']).'_'.time().".".$fileExtension;
                    $filePath = Configure::read('RelativeUrl').'banquet/';                    
                    move_uploaded_file($this->data['Banquets']['featured_img']['tmp_name'],$filePath.$fileName);
                    $data['featured_image'] = $fileName;
                }else{
                    $data['featured_image'] = (isset($this->data['Banquets']['featured_image']))?$this->data['Banquets']['featured_image']:'';
                }
                      
                if(!isset($this->request->data['Banquets']['id'])){
                    $data['slug']= $this->createSlug($this->data['Banquets']['title'],NULL,'Banquets'); 
                    $this->Banquets->create();                   
                }else{
                    $data['slug']= $this->createSlug($this->data['Banquets']['title'],$this->request->data['Banquets']['id'],'Banquets'); 
                }
               

                $data['total_price'] = $this->data['Banquets']['per_day_price'] + ( $this->data['Banquets']['per_day_price'] * $this->data['Banquets']['tax'] / 100);

                
                $this->Banquets->save($data);
                if(!isset($this->request->data['Banquets']['id'])){
                    $BanquetId =   $this->Banquets->getInsertID();                 
                }else{
                    $BanquetId =  $this->request->data['Banquets']['id'];     
                }
                if(isset($BanquetId)){
                    $this->BanquetImages->deleteAll(array('BanquetImages.banquet_id' => $BanquetId), false);
                   

                    if(!empty($data['images'])){
                        $i = 0;
                        foreach($data['images'] as $image){
                            $alt = $data['alt'][$i];
                            $dataToSave = ['file'=>$image,'banquet_id'=>$BanquetId,'alt'=>$alt];
                            $this->BanquetImages->create();
                            $this->BanquetImages->save($dataToSave);
                            $i++;
                        }
                    }
                }
                $this->Session->setFlash(__('Banquet saved successfully...',true),'success');
                $this->redirect(array('controller'=>'Banquets','action' => 'index','plugin'=>'admin'));
            }
        }elseif(!$this->request->is('post')){      
            $id = (isset($this->request->params['pass'][0]))?$this->request->params['pass'][0]:0;
            if($id > 0){
                $this->Banquets->bindModel([
                    'hasMany'=>[
                        'BanquetImages'=>[
                          'className'=>'BanquetImages',
                          'foreignKey'=>'banquet_id'
                        ]
                    ],
                    
                ]);
                $data = $this->Banquets->find('first',['conditions'=>['Banquets.id'=>$id]]);    
                $this->request->data['Banquets'] = $data['Banquets']; 
                $this->request->data['BanquetImages'] = $data['BanquetImages'];             
            }
        }
        
        $this->set(compact('title','BanquetImages'));

    }
    public function delete($id){
        $this->autoRender = false;
        $this->loadModel('Admin.Banquets');
        if($id != ""){
            $this->Banquets->deleteAll(array('Banquets.id' => $id), false);
            $this->Session->setFlash(__('Banquet deleted successfully.',true),'success');
            $this->redirect(array('controller'=>'banquets','action' => 'index','plugin'=>'admin'));
        }else{
            $this->Session->setFlash(__('Invalid request.',true),'error');
            $this->redirect(array('controller'=>'banquets','action' => 'index','plugin'=>'admin'));
        }
    }
   
}