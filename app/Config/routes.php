<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
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
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
 
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 * 
 */
	
	$requestUri =  $_SERVER['REQUEST_URI'];

	if (strpos($requestUri, 'admin') !== false || strpos($requestUri, 'ajax') !== false) {
			
	}else{
		
		Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
		Router::connect('/customers/home', array('controller' => 'customers', 'action' => 'home'));
		/**
		 * ...and connect the rest of 'Pages' controller's URLs.
		 */
			
			
			//Router::connect('/services/:action/',  ['controller' => 'services', 'action' => 'index']);
			
			Router::connect('/tour-packages/:slug',
				array('controller' => 'tourPackages',
					'action' => 'index', array('_name' => 'tour-packages','pass'=>array('slug')))
			);

			Router::connect('/tour-packages',
				array('controller' => 'tourPackages',
					'action' => 'index')
			);

			Router::connect('/tour-package/:slug',
				array('controller' => 'tourPackages',
					'action' => 'details', array('_name' => 'tour-package','pass'=>array('slug')))
			);

			Router::connect('/hotels/:slug',
				array('controller' => 'hotels',
					'action' => 'details', array('_name' => 'hotels','pass'=>array('slug')))
			);

			Router::connect('/pages/:slug',
				array('controller' => 'pages',
					'action' => 'cms')
			);
			Router::connect('/pages/:slug/*',
				array('controller' => 'pages',
					'action' => 'details')
			);
			
			Router::connect('/contact-us',
				array('controller' => 'contact',
					'action' => 'index')
			);
			
			Router::connect('/services/:page',
				array('controller' => 'services',
					'action' => 'services')
			);

			Router::connect('/',
				array('controller' => 'destinations',
					'action' => 'index')
			);

			
			Router::connect('customers/login',
				array('controller' => 'customers',
					'action' => 'login')
			);
			
			Router::connect('/',
				array('controller' => 'activities',
					'action' => 'index')
			);

			Router::connect('/activities/:slug',
				array('controller' => 'activities',
					'action' => 'details', array('pass'=>array('slug')))
			);

	}
	
Router::parseExtensions('pdf');
	
	
	//Router::connect('services/*', ['controller' => 'services', 'action' => 'index']);
	
/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();
	

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
	
