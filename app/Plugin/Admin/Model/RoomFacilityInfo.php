<?php
App::uses('AppModel', 'Model');
/**
* User Model
*
*/
class RoomFacilityInfo extends AdminAppModel {
  
    public $actsAs = array('Containable');
    public $name = 'RoomFacilityInfo';
    public $useTable = 'room_facility_info';
}
