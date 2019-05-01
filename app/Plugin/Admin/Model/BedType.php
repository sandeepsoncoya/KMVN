<?php
App::uses('AppModel', 'Model');
/**
* User Model
*
*/
class BedType extends AdminAppModel {
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
    public $name = 'BedType';
    public $useTable = 'bed_type';
  
    var	 $validate  = array(
		'title' => array(
			'notBlank' => array(								
				'rule' => 'notBlank',
                'message' => 'Please enter bed type title.',
                
            ),
            'isUnique' => array(								
				'rule' => 'isUnique',            
                'message' => 'Please enter unique title.',
			)

		),
		'adult_beds' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Please enter adult beds.',

			)

        ),
        'extra_beds' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Please enter extra beds.',

			)

        ),
        'child_beds' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Please enter child beds.',

			)

        ),
        		

    ); 
 

}
