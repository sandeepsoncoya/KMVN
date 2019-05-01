<?php
App::uses('AppModel', 'Model');
/**
* User Model
*
*/
class AppliedLeave extends AppModel {
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

public $name = 'AppliedLeave';
public $useTable = 'applied_leave';
var	 $validate  = array(
		'title' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Please enter title.',
			),
			'unique' => array(
				'required' => true,				
				'rule' =>  ['isUnique'],
				'message' => 'This department is already exists.',
			),
		)
	);
}
