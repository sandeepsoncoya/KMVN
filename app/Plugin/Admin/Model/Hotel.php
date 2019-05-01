<?php
App::uses('AppModel', 'Model');
/**
* User Model
*
*/
class Hotel extends AdminAppModel {
 
    public $name = 'Hotel';
    public $useTable = 'hotel';
    var	 $validate  = array(
		'title' => array(
			'notBlank' => array(								
				'rule' => 'notBlank',
                'message' => 'Please enter hotel title.',
                
            )

		),
		'city' => array(
			'notBlank' => array(								
				'rule' => 'notBlank',
                'message' => 'Please select hotel city.',
                
			)

        ),
        'hotel_category' => array(
			'notBlank' => array(								
				'rule' => 'notBlank',
                'message' => 'Please select hotel category.',
                
			)

        )
        

    );  
   

}
