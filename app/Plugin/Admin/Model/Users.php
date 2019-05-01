<?php
App::uses('AppModel', 'Model');
/**
* User Model
*
*/
class Users extends AdminAppModel {
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

public $name = 'Users';
public $useTable = 'users';
public function changePasswordValidate(){
	 $validateUser = array(

		'old_password' => array(
			'notBlank' => array(
				'required' => true,				
				'rule' => 'notBlank',
				'message' => 'Please enter your old password.',

			),
			'matchOldPassword' => array(
				'required' => true,				
				'rule' => 'matchOldPassword',
				'message' => 'Please enter correct old password.',

			),

		),
		'new_password' => array(
			'notBlank' => array(
				'required' => true,				
				'rule' => 'notBlank',
				'message' => 'Please enter your new password.',

			),
			'minLength' => array(
				'required' => true,				
				'rule' =>  array('minLength', '8'),
				'message' => 'Minimum 8 characters long.',

			),

		),
		'confirm_password' => array(
			'notBlank' => array(
				'required' => true,				
				'rule' => 'notBlank',
				'message' => 'Please enter your new password.',

			),
			'minLength' => array(
				'required' => true,				
				'rule' =>  array('minLength', '8'),
				'message' => 'Password length should greater then 8 characters.',

			),
			'misMatch' => array(
				'required' => true,				
				'rule' =>  array('identicalFieldValues'),
				'message' => 'Password miss match.',

			),

		),

	);
	$this->validate = $validateUser;
    return $this->validates();

}
public function add_groupvalidation(){
	 $validateUser = array(

		'name' => array(
			'notBlank' => array(
				'required' => true,				
				'rule' => 'notBlank',
				'message' => 'Please enter group name.',

			),
			
		),
		'email' => array(
			'notBlank' => array(
				'required' => true,				
				'rule' => 'notBlank',
				'message' => 'Please enter group email.',
			),
			
		),
		'phone' => array(
			'notBlank' => array(
				'required' => true,				
				'rule' => 'notBlank',
				'message' => 'Please enter group phone number.',
			),
			
		),
		'logo_image' => array(
			'notBlank' => array(
				'required' => true,				
				'rule' => 'notBlank',
				'message' => 'Please enter group logo.',
			),
			'on' => 'create'
			
		),
		'sub_title' => array(
			'notBlank' => array(
				'required' => true,				
				'rule' => 'notBlank',
				'message' => 'Please enter group sub title.',
			),
			
		),	
		'password' => array(
			'notBlank' => array(
				'required' => true,				
				'rule' => 'notBlank',
				'message' => 'Please enter your new password.',

			),
			'minLength' => array(
				'required' => true,				
				'rule' =>  array('minLength', '8'),
				'message' => 'Minimum 8 characters long.',

			),
			'on' => 'create'

		)

	);
	$this->validate = $validateUser;
    return $this->validates();

}
public function add_uservalidation(){
	 $validateUser = array(

		'name' => array(
			'notBlank' => array(
				'required' => true,				
				'rule' => 'notBlank',
				'message' => 'Please enter group name.',

			),
			
		),
		'email' => array(
			'notBlank' => array(
				'required' => true,				
				'rule' => 'notBlank',
				'message' => 'Please enter group email.',
			),
			
		),
		'phone' => array(
			'notBlank' => array(
				'required' => true,				
				'rule' => 'notBlank',
				'message' => 'Please enter group phone number.',
			),
			
		),
		'logo_image' => array(
			'notBlank' => array(
				'required' => true,				
				'rule' => 'notBlank',
				'message' => 'Please enter group logo.',
			),
			'on' => 'create'
			
		),
		'sub_title' => array(
			'notBlank' => array(
				'required' => true,				
				'rule' => 'notBlank',
				'message' => 'Please enter group sub title.',
			),
			
		),	
		'password' => array(
			'notBlank' => array(
				'required' => true,				
				'rule' => 'notBlank',
				'message' => 'Please enter your new password.',

			),
			'minLength' => array(
				'required' => true,				
				'rule' =>  array('minLength', '8'),
				'message' => 'Minimum 8 characters long.',

			),
			'on' => 'create'

		)

	);
	$this->validate = $validateUser;
    return $this->validates();

}
public function matchOldPassword(){

	$old_password = Security::hash($this->data['Users']['old_password'], null, true);
	$id = $this->data['Users']['id'];
	$userData = $this->findById($id);
	if($old_password != $userData['Users']['password']){
		return false;
	}else{
		return true;
	}

}
public function identicalFieldValues(){
	if($this->data['Users']['password'] != $this->data['Users']['confirm_password']){
		return false;
	}else{
		return true;
	}
}
public function beforeValidate($options = array()){
    if (!empty($this->data['Users']['id'])) { //example
        $this->validator()->remove('password');
        $this->validator()->remove('confirm_password');
        $this->validator()->remove('logo_image');
    }
}
}
