<?php
App::uses('AppModel', 'Model');
/**
* User Model
*
*/
class Company extends AdminAppModel {
 
    public $name = 'Company';
    public $useTable = 'company';
    var	 $validate  = array(
		'name' => array(
			'notBlank' => array(								
				'rule' => 'notBlank',
                'message' => 'Please enter company name.',
                
            )

		),
		'contact_person' => array(
			'notBlank' => array(								
				'rule' => 'notBlank',
                'message' => 'Please enter contact person.',
            )

		),
		'address' => array(
			'notBlank' => array(								
				'rule' => 'notBlank',
                'message' => 'Please enter company address.',
                
            )

		),
		'pin_code' => array(
			'notBlank' => array(								
				'rule' => 'notBlank',
                'message' => 'Please enter pin post code.',
            )
		),
		'email' => array(
	        'required' => array(
	            'rule' => array('notBlank'),
	            'message' => 'Please enter company email.'
	        ),
	        'email' => array(
	            'rule' => array('email', true),
	            'message' => 'Please enter valid mail address.'
	        ),
	        'unique' => array(
	            'rule' => 'isUnique',
	            'message' => 'This email is already registered.'
	        )
	    ),
	    'website' => array(
	        'required' => array(
	            'rule' => array('notBlank'),
	            'message' => 'Please enter company website.'
	        ),
	        'website' => array(
        		'rule' => array('url', true),
        		'message' => 'Please enter valid website url.'
    		)
	    ),
	    'phone_1' =>  array(
		    'required' => array(
		        'rule' => 'notBlank', 
		        'message' => 'Please enter phone 1.'
		    ),
		    'numeric' => array(
		        'rule' => 'numeric',
		        'message' => 'Please enter only numbers in phone 1'
		    ),
		    'minlength' => array(
                'rule' => array('minLength', '8'),
		        'message' => 'Please enter minimum 8 numbers in phone 1'
		    )
		),
		'phone_2' =>  array(
		    'numeric' => array(
		        'rule' => 'numeric',
		        'message' => 'Please enter only numbers in phone 2'
		    ),
		    'minlength' => array(
		        'rule' => array('minLength', '8'),
		        'message' => 'Please enter minimum 8 numbers in phone 2'
		    )
		)

    );  
   

}
