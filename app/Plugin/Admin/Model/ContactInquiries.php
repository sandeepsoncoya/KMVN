<?php
App::uses('AppModel', 'Model');
/**
* Contacts Model
*
*/
class ContactInquiries extends AdminAppModel {
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
    public $name = 'ContactInquiries';
    public $useTable = 'contact_inquiries';
  
    var	 $validate  = array(
		'first_name' => array(
			'notBlank' => array(								
				'rule' => 'notBlank',
                'message' => 'Please enter first name.',
            )
		),
        'last_name' => array(
            'notBlank' => array(                                
                'rule' => 'notBlank',
                'message' => 'Please enter last name.',
            )
        ),
        'email' => array(
            'notBlank' => array(                                
                'rule' => 'notBlank',
                'message' => 'Please enter email id.',
            )
        ),
        'phone' => array(
            'notBlank' => array(                                
                'rule' => 'notBlank',
                'message' => 'Please enter phone number.',
            )
        ),
        'message' => array(
            'notBlank' => array(                                
                'rule' => 'notBlank',
                'message' => 'Please enter message.',
            )
        )
    ); 

}
