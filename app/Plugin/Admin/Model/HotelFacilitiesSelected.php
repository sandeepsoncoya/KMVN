<?php
App::uses('AppModel', 'Model');
/**
* User Model
*
*/
class HotelFacilitiesSelected extends AdminAppModel {
 	public $actsAs = array('Containable');
    public $name = 'HotelFacilitiesSelected';
    public $useTable = 'hotel_facilities_selected';
    
}
