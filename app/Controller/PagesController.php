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
class PagesController extends AppController {

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
	public $helpers = array("MinifyHtml.MinifyHtml");
	public function beforeFilter() {
		
		$this->loadModel('Admin.TourCategories');
		$tourCats = $this->TourCategories->find('list',['keyField'=>'id','valueField'=>'name']);
		$this->siteSettings = $this->siteSettings();
		$logo = Configure::read('AbsoluteUrl').'SiteSettings/'.$this->siteSettings['SiteSettings']['logo'];
		$services = $this->serviceMenu();
		$aboutMenu = $this->aboutMenu();
		$siteSettings =$this->siteSettings;		
		$this->loadModel("Admin.News");
		$news =  $this->News->find('all',['conditions'=>['News.is_active'=>1,'type'=>"News & Events"],'order'=>['created'=>'DESC'],'limit'=>50]);
		$news_arr = [];
		foreach ($news as $key => $value) {
			$fileAbsolutePathFeatured = Configure::read('AbsoluteUrl').'news/'.$value['News']['file'];
			  $news_arr[] = $value['News']['title'];
		}
		$newsFinalArray = array_values($news_arr);

		$this->loadModel('Activities');
        $activityList = $this->Activities->find('all',['conditions'=>['is_active'=>1]]);

		$this->set(compact('siteSettings','logo','services','aboutMenu','tourCats','activityList','newsFinalArray'));
	}

	public function display() {
		$path = func_get_args();
		$count = count($path);
		if (!$count) {
			return $this->redirect('/');
		}
		if (in_array('..', $path, true) || in_array('.', $path, true)) {
			throw new ForbiddenException();
		}
		
		$this->set("title_for_layout",$this->siteSettings['SiteSettings']['title'].' - '.$this->siteSettings['SiteSettings']['meta_title']);
		$this->set("keyWord",$this->siteSettings['SiteSettings']['meta_keywords']);
		$this->set("metaDescription",$this->siteSettings['SiteSettings']['meta_description']);
		$this->loadModel("Admin.Slider");
		$this->loadModel("Admin.Destination");
		$this->loadModel("Admin.TourPackage");
		$this->loadModel("Admin.Tenders");
		$this->loadModel("Admin.Category");
		$this->loadModel("Admin.Gallery");
		$this->loadModel("Admin.Hotel");
		$this->loadModel("Admin.City");
		$this->loadModel("Admin.Faqs");
		$this->loadModel("Admin.News");
		$this->loadModel("Admin.Ebooks");
		$this->loadModel("Admin.Activities");
		$this->loadModel("Admin.News");
		$news =  $this->News->find('all',['conditions'=>['News.is_active'=>1,'type'=>"News & Events"],'order'=>['created'=>'DESC'],'limit'=>50]);
		$news_arr = [];
		foreach ($news as $key => $value) {
			$fileAbsolutePathFeatured = Configure::read('AbsoluteUrl').'news/'.$value['News']['file'];
			  $news_arr[] = $value['News']['title'];
		}
		$newsFinalArray = array_values($news_arr);

		$slider =  $this->Slider->find('all',['conditions'=>['status'=>1]]);
		$cityList =  $this->City->find('list',['conditions'=>['is_active'=>1]]);
		$conditions = [];
		$conditions['type']=2; 
		$conditions['status']=1; 
		$conditions['position']=['3','4']; 
		$featuredCategories = $this->Category->find('all',['conditions'=>$conditions]);
		$featuredDestinations =  $this->Destination->find('all',['conditions'=>['Destination.is_active'=>1,'Destination.is_featured'=>1],'order'=>['created'=>'DESC'],'limit'=>6]);
		$featuredTourPackages =  $this->TourPackage->find('all',['conditions'=>['TourPackage.is_active'=>1,'TourPackage.is_featured'=>1],'order'=>['created'=>'DESC'],'limit'=>9]);
		$tenders =  $this->Tenders->find('all',['conditions'=>['Tenders.is_active'=>1],'order'=>['created'=>'DESC'],'limit'=>15]);
		$ebooks =  $this->Ebooks->find('all',['conditions'=>['Ebooks.is_active'=>1],'order'=>['created'=>'DESC'],'limit'=>15]);
		$galleryImages =  $this->Gallery->find('all',['conditions'=>['Gallery.is_active'=>1],'order'=>['created'=>'DESC'],'limit'=>50]);
		$faqs =  $this->Faqs->find('all',['conditions'=>['Faqs.is_active'=>1],'order'=>['created'=>'DESC'],'limit'=>50]);
		

		$hotels =  $this->Hotel->find('all',['conditions'=>['Hotel.is_active'=>1,'Hotel.is_featured'=>1],'order'=>['created'=>'DESC'],'limit'=>4]);

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}

		

		$this->set(compact('page', 'subpage','slider','featuredCategories','featuredDestinations','featuredTourPackages','tenders','galleryImages','hotels','cityList','faqs','ebooks','newsFinalArray'));
		try {
			$this->render(implode('/', $path));
		} catch (MissingViewException $e) {
			if (Configure::read('debug')) {
				throw $e;
			}
			throw new NotFoundException();
		}
	}
	public function cms(){
		$slug= $this->request->params['slug'];
		$this->loadModel('Admin.Cms');
		if ($slug == 'about') {
			 $data = $this->Cms->find('all',['conditions'=>['id IN'=>['9','10','11']]]);
			 $this->set("title_for_layout",'About kvmn');
			 $this->set("keyWord",'About kvmn');
			 $this->set("metaDescription",'About kvmn');
		}else{
		     $data = $this->Cms->find('first',['conditions'=>['slug'=>$slug]]);
		     $this->set("title_for_layout",$this->siteSettings['SiteSettings']['title'].' - page ');
		     $this->set("keyWord",'page');
			 $this->set("metaDescription",'page');

		}
		if(!empty($data)){
			$this->set(compact('data'));
		}else{
			$this->redirect( Configure::read('siteUrlfront'));
		}
		
		$this->set("slug",$slug);
		
	}
	public function details(){
		# code...
	}
	public function aboutUs(){
		echo "sin"; die;
		$this->loadModel('Admin.Cms');
		$welcome = $this->Cms->find('first',['conditions'=>['id'=>9]]);
		$about = $this->Cms->find('first',['conditions'=>['id'=>10]]);
		$history = $this->Cms->find('first',['conditions'=>['id'=>11]]);
		$this->set(compact('welcome','about','history'));

	}

	
}
