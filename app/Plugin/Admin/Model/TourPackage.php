<?php
App::uses('AppModel', 'Model');
/**
* User Model
*
*/
class TourPackage extends AdminAppModel {
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
    public $name = 'TourPackage';
    public $useTable = 'tour_package';
  
    var	 $validate  = array(
		'title' => array(
			'notBlank' => array(								
				'rule' => 'notBlank',
                'message' => 'Please enter attraction title.',
            )
		),
        'departure_from' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Please enter departure from.',

            )

        ),
        'best_period' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Please enter best period.',

            )

        ),
        'duration' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Please enter duration.',

            )

        ),
        'pax' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Please enter pax.',

            )

        ),
        'terms_and_conditions' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Please enter terms and conditions.',

            )

        ),
        'inclusion' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Please enter inclusion.',

            )

        ),
        'exclusion' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Please enter exclusion.',

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
