<?php
App::uses('AppModel', 'Model');
/**
* User Model
*
*/
class RoomFacility extends AdminAppModel {
  
    public $actsAs = array('Containable');
    public $name = 'RoomFacility';
    public $useTable = 'room_facility';
}
