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
class TourPackageController extends AdminAppController
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
        
        $title = "TourPackage";
        $this->set('title_for_layout', $title);
        $this->set(compact('title'));

    }
    public function add(){
        
        $title = "Add TourPackage";
        $this->set('title_for_layout', $title);
        $this->loadModel('Admin.TourPackageImages');
        $this->loadModel('Admin.TourPackage');
        $this->loadModel('Admin.TourItineraries');
                $this->loadModel('Admin.Attraction');
                $this->loadModel('Admin.TourAttraction');
                $this->loadModel('Admin.TourCategories');

        if ($this->request->is(array('PUT','POST' ))) {
            $data = $this->request->data['TourPackage'];
            $datatitle = $this->request->data['itinerarytitle'];
            $datadescription = $this->request->data['itinerarydescription'];
            $dataname = $this->request->data['itineraryname'];
            $attraction = $this->request->data['TourAttraction']['attraction'];
            $this->TourPackage->set($data); 
            if($this->TourPackage->validates()){
                if(!empty($this->data['TourPackage']['featured_img']['tmp_name'])){
                    $fileArray =  explode(".",$this->data['TourPackage']['featured_img']['name']);
                    $fileExtension = end($fileArray);
                    $fileName =  str_replace(" ","_",$this->data['TourPackage']['title']).'_'.time().".".$fileExtension;
                    $filePath = Configure::read('RelativeUrl').'tour/';                    
                    move_uploaded_file($this->data['TourPackage']['featured_img']['tmp_name'],$filePath.$fileName);
                    $data['featured_image'] = $fileName;
                }else{
                    $data['featured_image'] = (isset($this->data['TourPackage']['featured_image']))?$this->data['TourPackage']['featured_image']:'';
                }
                if(!isset($this->request->data['TourPackage']['id'])){
                    $data['slug']= $this->createSlug($this->data['TourPackage']['title'],NULL,'TourPackage'); 
                    $this->TourPackage->create();                   
                }else{
                    $data['slug']= $this->createSlug($this->data['TourPackage']['title'],$this->request->data['TourPackage']['id'],'TourPackage'); 
                }
                //$data['slug']=Inflector::slug(strtolower($this->data['TourPackage']['title']), $replacement = '-');
                $this->TourPackage->save($data);
                if(!isset($this->request->data['TourPackage']['id'])){
                    $TourPackageId =   $this->TourPackage->getInsertID();                 
                }else{
                    $TourPackageId =  $this->request->data['TourPackage']['id'];     
                }
                if(isset($TourPackageId)){
                    $this->TourPackageImages->deleteAll(array('TourPackageImages.tour_id' => $TourPackageId), false);
                    if(!empty($data['images'])){
                        $i = 0;
                        foreach($data['images'] as $image){
                            $alt = $data['alt'][$i];
                            $dataToSave = ['file'=>$image,'tour_id'=>$TourPackageId,'alt'=>$alt];
                            $this->TourPackageImages->create();
                            $this->TourPackageImages->save($dataToSave);
                            $i++;
                        }
                    }
                }

                if(isset($TourPackageId)){
                    $this->TourItineraries->deleteAll(array('TourItineraries.tour_id' => $TourPackageId), false);
                    if(!empty($datatitle) && !empty($datadescription)){
                        for($i=0; $i<count($datatitle); $i++) {

                            $dataToSaveI = ['title'=>$datatitle[$i],'description'=>$datadescription[$i],'tour_id'=>$TourPackageId,'name'=>$dataname[$i]];
                            
                             $this->TourItineraries->create();
                            $saved = $this->TourItineraries->save($dataToSaveI);
                        }
                    }
                }
                if(isset($TourPackageId)){
                    $this->TourAttraction->deleteAll(array('TourAttraction.tour_id' => $TourPackageId), false);
                    if(!empty($attraction)){
                        for($i=0; $i<count($attraction); $i++) {
                        $dataToSaveI = ['attraction_id'=>$attraction[$i],'tour_id'=>$TourPackageId];
                            $this->TourAttraction->create();
                            $saved = $this->TourAttraction->save($dataToSaveI);
                        }
                    }
                }

                $this->Session->setFlash(__('TourPackage saved successfully...',true),'success');
                $this->redirect(array('controller'=>'TourPackage','action' => 'index','plugin'=>'admin'));
            }else{
            }
        }elseif(!$this->request->is('post')){      
            $id = (isset($this->request->params['pass'][0]))?$this->request->params['pass'][0]:0;
            if($id > 0){
                $this->TourPackage->bindModel([
                    'hasMany'=>[
                        'TourPackageImages'=>[
                          'className'=>'TourPackageImages',
                          'foreignKey'=>'tour_id'
                        ]
                    ],
                    
                ]);

                $this->TourPackage->bindModel([
                    'hasMany'=>[
                        'TourItineraries'=>[
                          'className'=>'TourItineraries',
                          'foreignKey'=>'tour_id'
                        ]
                    ],
                    
                ]);
                $this->TourPackage->bindModel([
                    'hasMany'=>[
                        'TourAttraction'=>[
                          'className'=>'TourAttraction',
                          'foreignKey'=>'tour_id'
                        ]
                    ],
                    
                ]);

                $data = $this->TourPackage->find('first',['conditions'=>['TourPackage.id'=>$id]]);
                $this->request->data['TourPackage'] = $data['TourPackage']; 
                $this->request->data['TourPackageImages'] = $data['TourPackageImages'];             
                $this->request->data['TourAttraction'] = $data['TourAttraction'];             
                $this->request->data['TourItineraries'] = $data['TourItineraries'];             
            }
        }

                $attarctions = $this->Attraction->find('list',['keyField'=>'id','valueField'=>'title']);
                $tourCats = $this->TourCategories->find('list',['keyField'=>'id','valueField'=>'name']);

        $this->set(compact('title','TourPackageImages','TourItineraries','TourAttraction','attarctions','tourCats'));

    }
    public function delete($id){
        $this->autoRender = false;
        $this->loadModel('Admin.TourPackage');
        if($id != ""){
            $this->TourPackage->deleteAll(array('TourPackage.id' => $id), false);
            $this->Session->setFlash(__('TourPackage deleted successfully.',true),'success');
            $this->redirect(array('controller'=>'tourPackage','action' => 'index','plugin'=>'admin'));
        }else{
            $this->Session->setFlash(__('Invalid request.',true),'error');
            $this->redirect(array('controller'=>'tourPackage','action' => 'index','plugin'=>'admin'));
        }
    }

    
    
  
   
}