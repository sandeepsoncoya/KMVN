<?php
App::uses('AppModel', 'Model');
/**
* User Model
*
*/
class TravelerDetails extends AdminAppModel {
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
    public $name = 'TravelerDetails';
    public $useTable = 'traveler_details';

}
