<?php
App::uses('AppModel', 'Model');
/**
* User Model
*
*/
class Slider extends AdminAppModel {
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

    public $name = 'Slider';
    public $useTable = 'slider';
    var	 $validate  = array(
		'title' => array(
			'notBlank' => array(								
				'rule' => 'notBlank',
                'message' => 'Please enter slide title.',
                
            )

		),
		'link' => array(
			'notBlank' => array(								
				'rule' => 'notBlank',
                'message' => 'Please enter link.',
                
			)

        ),
        'description' => array(
			'notBlank' => array(								
				'rule' => 'notBlank',
                'message' => 'Please enter description.',
                
			)

        )
        

    );  
   

}
