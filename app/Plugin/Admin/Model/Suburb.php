<?php
App::uses('AppModel', 'Model');
/**
* User Model
*
*/
class Suburb extends AdminAppModel {
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
    public $name = 'Suburb';
    public $useTable = 'suburb';
  
    var	 $validate  = array(
		'name' => array(
			'notBlank' => array(								
				'rule' => 'notBlank',
                'message' => 'Please enter name.',
            ),
        )
    ); 
     

}
