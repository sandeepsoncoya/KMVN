<?php
/**
 * Application level View Helper
 *
 * This file is application-wide helper file. You can put all
 * application-wide helper-related methods here.
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
 * @package       app.View.Helper
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Helper', 'View');


/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */
class NavigationHelper extends AppHelper {


	public function getNavigation() {

 		$AnotherModel = ClassRegistry::init('PermissionModule');
        $moduleLists  = $AnotherModel->find('all',['conditions'=>['status'=>1]]);
        return $moduleLists;
    }


    public function getNavigationAcess($role_id){

		$AnotherModel = ClassRegistry::init('PermissionAccess');
        $accessLists  = $AnotherModel->find('all',['conditions'=>['role_id'=>$role_id]]);
        return $accessLists;
    }


    public function getModuleAccess($role_id){
    	
    	$AnotherModel = ClassRegistry::init('PermissionAccess');
    	$permissionAccessesData = $AnotherModel->find('first',['conditions'=>['role_id'=>$role_id],'fields'=>['id']]);
    	
    	$id = (isset($permissionAccessesData['PermissionAccess']['id']))?$permissionAccessesData['PermissionAccess']['id']:0;
    	$data = $AnotherModel->find('first',['conditions'=>['PermissionAccess.id'=>$id]]);
        
        $moduleDataDecoded = json_decode($data['PermissionAccess']['access_modules']);
        foreach ( $moduleDataDecoded as $value) {
            $moduleArr[] = $value->permission_module_id;
        }
		return $moduleArr;
    }


    public function getSubModuleAccess($role_id){
    	
    	$AnotherModel = ClassRegistry::init('PermissionAccess');
    	$permissionAccessesData = $AnotherModel->find('first',['conditions'=>['role_id'=>$role_id],'fields'=>['id']]);
    	
    	$id = (isset($permissionAccessesData['PermissionAccess']['id']))?$permissionAccessesData['PermissionAccess']['id']:0;
    	$data = $AnotherModel->find('first',['conditions'=>['PermissionAccess.id'=>$id]]);
        
        $moduleDataDecoded = json_decode($data['PermissionAccess']['access_modules']);

        foreach ( $moduleDataDecoded as $value) {
            $submoduleArr[$value->permission_module_id] = isset($value->permission_sub_module_id) ? $value->permission_sub_module_id : 0;

        }
		return $submoduleArr;
    }


}
