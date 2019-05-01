<?php
App::uses('AppModel', 'Model');
/**
* User Model
*
*/
class DestinationAttraction extends AdminAppModel {
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
    public $name = 'DestinationAttraction';
    public $useTable = 'destination_attraction';

}
