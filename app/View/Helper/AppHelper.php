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
class AppHelper extends Helper {


	 public function getBedRates($hotel_id, $room_id, $bed_type_id,$seasionRate_id) { 
 		$AnotherModel = ClassRegistry::init('RoomRates');
           $roomrates  = $AnotherModel->find('first',['fields'=>['adult_one_rate'],'conditions'=>['hotel_id'=>$hotel_id,'room_id'=>$room_id,'bed_type_id'=>$bed_type_id,'season_id'=>$seasionRate_id]]);

          return $roomrates;


    }


    public function getTourCategoryList() { 
 		$AnotherModel = ClassRegistry::init('TourCategories');
        $tourCatList  = $AnotherModel->find('all',['conditions'=>['is_active'=>1]]);
		return $tourCatList;
    }


    public function getRemainActivityTickets($activity_id = null) { 

    	$now = new DateTime();;
        $currDate = $now->format('Y-m-d');

 		$AnotherModel = ClassRegistry::init('ActivityBookings');
        $activityList = $AnotherModel->find('all',['conditions'=>['activity_id'=>$activity_id, 'created'=>$currDate]]);

        $sum = 0;
        foreach ($activityList as $list) {
        	$sum += $list['ActivityBookings']['number_of_ticket'];
        }

        return $sum;
	}


    
}
