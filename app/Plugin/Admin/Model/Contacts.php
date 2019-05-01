<?php
App::uses('AppModel', 'Model');
/**
* Contacts Model
*
*/
class Contacts extends AdminAppModel {
    /**
    * Display field
    *
    * @var string
    */
    public $toString = 'email';
    /**
    * Validation rules
    *
    * @var array
    */
    public $actsAs = array('Containable');
    public $name = 'Contacts';
    public $useTable = 'contacts';
  
    var	 $validate  = array(
		'title' => array(
			'notBlank' => array(								
				'rule' => 'notBlank',
                'message' => 'Please enter address title.',
            )
		),
        'address' => array(
            'notBlank' => array(                                
                'rule' => 'notBlank',
                'message' => 'Please enter address',
            )
        ),
        'type' => array(
            'notBlank' => array(                                
                'rule' => 'notBlank',
                'message' => 'Please select address type',
            )
        )
    ); 

}
