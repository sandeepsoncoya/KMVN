<?php
App::uses('AppModel', 'Model');
/**
* User Model
*
*/
class Contact extends AdminAppModel {
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

    public $name = 'Contact';
    public $useTable = 'contact';
}
