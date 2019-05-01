<?php
App::uses('AppModel', 'Model');
/**
* User Model
*
*/
class CompanyUsers extends AdminAppModel {
 
    public $name = 'CompanyUsers';
    public $useTable = 'company_users';

    public $virtualFields = array(
	    'name' => 'CONCAT(CompanyUsers.first_name, " ", CompanyUsers.last_name)'
	);


    var	 $validate  = array(
		'username' => array(
			'notBlank' => array(								
				'rule' => 'notBlank',
                'message' => 'Please enter login Id.',
            ),
	        'unique' => array(
	            'rule' => 'isUnique',
	            'message' => 'This login id is already registered.'
	        )
		),
		'password' => array(
			'notBlank' => array(								
				'rule' => 'notBlank',
                'message' => 'Please enter password.',
            )
		),
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
		'markup_value' => array(
			'notBlank' => array(								
				'rule' => 'notBlank',
                'message' => 'Please enter markup value.',
            )
		),
		'line' => array(
			'notBlank' => array(								
				'rule' => 'notBlank',
                'message' => 'Please enter line 1.',
                
            )
		),
		'city' => array(
			'notBlank' => array(								
				'rule' => 'notBlank',
                'message' => 'Please select city.',
                
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
		),
		'mobile' =>  array(
		    'numeric' => array(
		        'rule' => 'numeric',
		        'message' => 'Please enter only numbers in mobile.'
		    ),
		    'minlength' => array(
		        'rule' => array('minLength', '10'),
		        'message' => 'Please enter minimum 10 numbers in mobile.'
		    )
		)

    );  
   

}
