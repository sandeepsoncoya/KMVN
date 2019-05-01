<?php
App::uses('AppModel', 'Model');
/**
* User Model
*
*/
class HotelFacilitiesInfo extends AdminAppModel {
    public $actsAs = array('Containable');
    public $name = 'HotelFacilitiesInfo';
    public $useTable = 'hotel_facilities_info';
     public $belongsTo = array(
        'HotelFacilities' => array(
            'className' => 'Admin.HotelFacilities',
             'foreignKey'=>'facility_id'
        )
    );
    var	 $validate  = array(
		'title' => array(
			'notBlank' => array(								
				'rule' => 'notBlank',
                'message' => 'Please enter hotel facilities info title.',
                
            )

        ),
        'facility_id' => array(
            'notBlank' => array(								
                'rule' => 'notBlank',
                'message' => 'Please select hotel facility.',
                
            )

        ),
    );  
   

}
