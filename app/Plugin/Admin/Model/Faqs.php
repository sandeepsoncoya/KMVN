<?php
App::uses('AppModel', 'Model');
/**
* User Model
*
*/
class Faqs extends AdminAppModel {
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
    public $name = 'Faqs';
    public $useTable = 'faqs';
  
    var	 $validate  = array(
		'title' => array(
			'notBlank' => array(								
				'rule' => 'notBlank',
                'message' => 'Please enter title.',
                
            )
		),
        'answer' => array(
            'notBlank' => array(                                
                'rule' => 'notBlank',
                'message' => 'Please enter answer.',
                
            )

        )
    ); 

}
