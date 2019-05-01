<?php
App::uses('AppModel', 'Model');
/**
* User Model
*
*/
class Roles extends AdminAppModel {
 
    public $name = 'Roles';
    public $useTable = 'roles';
    var	 $validate  = array(
		'name' => array(
			'notBlank' => array(								
				'rule' => 'notBlank',
                'message' => 'Please enter role name.',
                
            )
		)
    );  
}
