<?php
App::uses('AppModel', 'Model');
/**
* User Model
*
*/
class Newsletter extends AdminAppModel {
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

    public $name = 'Newsletter';
    public $useTable = 'newsletter';
   
   

}
