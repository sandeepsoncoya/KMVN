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
/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link https://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class TendersController  extends AppController {

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
        $this->loadModel('Admin.Tenders');
        $this->loadModel('Admin.TenderCategory');
        $this->siteSettings = $this->siteSettings();
        $logo = Configure::read('AbsoluteUrl').'SiteSettings/'.$this->siteSettings['SiteSettings']['logo'];
        $siteSettings =$this->siteSettings;
        $this->loadModel('Activities');
        $activityList = $this->Activities->find('all',['conditions'=>['is_active'=>1]]);
        $this->set(compact('siteSettings','logo','activityList'));
        
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
	public function details() {
        

    }
   
}
