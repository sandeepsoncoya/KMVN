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
class HotelFacilitiesInfoController  extends AdminAppController
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
        $title = "Hotel Hotel Facilities Info";
        $this->set('title_for_layout', $title);
        $this->set(compact('title'));
    }
   
    public function delete($id){
        $this->autoRender = false;
        $this->loadModel('Admin.HotelFacilitiesInfo');
        if($id != ""){
            $this->HotelFacilitiesInfo->deleteAll(array('HotelFacilitiesInfo.id' => $id), false);
            $this->Session->setFlash(__('Hotel Facility Info deleted successfully.',true),'success');
            $this->redirect(array('controller'=>'hotel_facilities_info','action' => 'index','plugin'=>'admin'));
        }else{
            $this->Session->setFlash(__('Invalid request.',true),'error');
            $this->redirect(array('controller'=>'hotel_facilities_info','action' => 'index','plugin'=>'admin'));
        }
    }
}