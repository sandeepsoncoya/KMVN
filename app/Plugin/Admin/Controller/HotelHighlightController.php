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
class HotelHighlightController  extends AdminAppController
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
        
        $title = "Hotel Hotel Highlight";
        $this->set('title_for_layout', $title);
        $this->set(compact('title'));

    }
   
    public function delete($id){
        $this->autoRender = false;
        $this->loadModel('Admin.HotelHighlight');
        if($id != ""){
            $this->HotelHighlight->deleteAll(array('HotelHighlight.id' => $id), false);
            $this->Session->setFlash(__('Hotel Highlight deleted successfully.',true),'success');
            $this->redirect(array('controller'=>'hotel_highlight','action' => 'index','plugin'=>'admin'));
        }else{
            $this->Session->setFlash(__('Invalid request.',true),'error');
            $this->redirect(array('controller'=>'hotel_highlight','action' => 'index','plugin'=>'admin'));
        }
    }
}