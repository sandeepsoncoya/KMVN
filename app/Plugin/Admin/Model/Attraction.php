<?php
App::uses('AppModel', 'Model');
/**
* User Model
*
*/
class Attraction extends AdminAppModel {
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
    public $name = 'Attraction';
    public $useTable = 'attraction';
    
    

    var	 $validate  = array(
		'title' => array(
			'notBlank' => array(								
				'rule' => 'notBlank',
                'message' => 'Please enter attraction title.',
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
