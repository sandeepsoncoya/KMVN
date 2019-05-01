<?php
App::uses('AppModel', 'Model');
/**
* User Model
*
*/
class Gallery extends AdminAppModel {
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
    public $name = 'Gallery';
    public $useTable = 'gallery';
  
    var	 $validate  = array(
		'title' => array(
			'notBlank' => array(								
				'rule' => 'notBlank',
                'message' => 'Please enter title.',
            )
		),
        'description' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Please enter description.',

            )

        ),
        'type' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Please select type.',

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
