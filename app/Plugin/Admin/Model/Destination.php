<?php
App::uses('AppModel', 'Model');
/**
* User Model
*
*/
class Destination extends AdminAppModel {
    /**
    * Display field
    *
    * @var string
    */
    /**
    * Validation rules
    *
    * @var array
    */
    public $actsAs = array('Containable');
    public $name = 'Destination';
    public $useTable = 'destination';
  
    var	 $validate  = array(
		'title' => array(
			'notBlank' => array(								
				'rule' => 'notBlank',
                'message' => 'Please enter attraction title.',
            )
		),
        'city' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Please enter city',

            )

        ),
        'description' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Please enter description.',

            )

        ),
        'featured_image' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Please choose featured image.',

            )

        ),
        'is_active' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Please choose status.',

            )

        ),
        'lat' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Please enter description',

            )

        ),
		'long' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Please enter description',

			)

        )
        		

    ); 

}
