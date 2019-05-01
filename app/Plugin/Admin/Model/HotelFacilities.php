<?php
App::uses('AppModel', 'Model');
/**
* User Model
*
*/
class HotelFacilities extends AdminAppModel {
     public $actsAs = array('Containable');

    public $name = 'HotelFacilities';
    public $useTable = 'hotel_facilities';
   
    var	 $validate  = array(
		'title' => array(
			'notBlank' => array(								
				'rule' => 'notBlank',
                'message' => 'Please enter hotel facilities title.',
                
            )

		)
    );  
   

}
