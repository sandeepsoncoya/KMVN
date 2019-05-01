<?php
App::uses('AppModel', 'Model');
/**
* User Model
*
*/
class RateInclude extends AdminAppModel {
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

    public $name = 'RateInclude';
    public $useTable = 'rate_include';
    var	 $validate  = array(
		'title' => array(
			'notBlank' => array(								
				'rule' => 'notBlank',
                'message' => 'Please enter  title.',
                
            )

		)

    );  
   

}
