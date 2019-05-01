<?php
App::uses('AppModel', 'Model');
/**
* User Model
*
*/
class HotelHighlight extends AdminAppModel {
    public $actsAs = array('Containable');
    public $name = 'HotelHighlight';
    public $useTable = 'hotel_highlight';
    
    var	 $validate  = array(
		'title' => array(
			'notBlank' => array(								
				'rule' => 'notBlank',
                'message' => 'Please enter title.',
                
            )

		)
    );  
   

}
