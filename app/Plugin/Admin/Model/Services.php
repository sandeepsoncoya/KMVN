<?php
App::uses('AppModel', 'Model');
/**
* User Model
*
*/
class Services extends AdminAppModel {
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
    public $name = 'Services';
    public $useTable = 'services';
  
    var	 $validate  = array(
		'title' => array(
			'notBlank' => array(								
				'rule' => 'notBlank',
                'message' => 'Please enter title.',
            )
		),
        
        'terms_and_conditions' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Please enter terms and conditions.',

            )

        ),
        'price' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Please enter price.',

            )

        ),
        'tax' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Please enter tax.',

            )

        ),
        'total_price' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Please enter total price.',

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

        )
        		

    ); 

}
