<?php
App::uses('AppModel', 'Model');
/**
* User Model
*
*/
class UserWallets extends AdminAppModel {
 
    public $name = 'UserWallets';
    public $useTable = 'user_wallets';

    var	 $validate  = array(
		'amount' => array(
			'notBlank' => array(								
				'rule' => 'notBlank',
                'message' => 'Please enter amount.',
            ),
	        'money' => array(
	            'rule' => array('money','left'),
	            'message' => 'Please enter a valid amount.'
	        )
		)

    );  
   

}
