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
class DetailsController   extends AppController {

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
		$this->siteSettings = $this->siteSettings();
		$logo = Configure::read('AbsoluteUrl').'SiteSettings/'.$this->siteSettings['SiteSettings']['logo'];
		$services = $this->serviceMenu();
		$aboutMenu = $this->aboutMenu();
		$siteSettings =$this->siteSettings;	
		$this->loadModel('Activities');
		$activityList = $this->Activities->find('all',['conditions'=>['is_active'=>1]]);	
		$this->set(compact('siteSettings','logo','services','aboutMenu','activityList'));
		
	}
    public function index(){
		$category = $this->request->params['category'];
		$slug = $this->request->params['slug'];
		$this->loadModel('Admin.Product');
		$this->loadModel('Admin.ProductImages');
		$this->Product->bindModel([
			'hasMany'=>[
				'ProductImages'=>[
					'className'=>'ProductImages',
					'foreignKey'=>'product_id',
					'fields'=>['ProductImages.file','ProductImages.alt']
				],
			],
		]);
		
		$productData =  $this->Product->find('first',[
														'conditions'=>['Product.slug'=>$slug,'Product.status'=>1],
													]);
		$this->set(compact('productData'));
		
    }

}
