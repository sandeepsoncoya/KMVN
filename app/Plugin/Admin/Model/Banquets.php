<?php
App::uses('AppModel', 'Model');
/**
* User Model
*
*/
class Banquets extends AdminAppModel {
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
    public $name = 'Banquets';
    public $useTable = 'banquets';
    
    var	 $validate  = array(
		'title' => array(
			'notBlank' => array(								
				'rule' => 'notBlank',
                'message' => 'Please enter banquet title.',
            )
		),
        'per_day_price' => array(
            'notBlank' => array(                                
                'rule' => 'notBlank',
                'message' => 'Please enter per day price.',
            ),
            'price' => array(
                'rule' => array('decimal', 2),
                'message' => 'Please supply a valid price amount.'
            )
        ),
        'tax' => array(
            'notBlank' => array(                                
                'rule' => 'notBlank',
                'message' => 'Please enter tax.',
            ),
            'tax' => array(
                'rule' => array('decimal', 2),
                'message' => 'Please supply a valid tax.'
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
