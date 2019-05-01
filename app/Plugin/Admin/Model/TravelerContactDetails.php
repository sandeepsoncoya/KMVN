<?php
App::uses('AppModel', 'Model');
/**
* User Model
*
*/
class TravelerContactDetails extends AdminAppModel {
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
    public $name = 'TravelerContactDetails';
    public $useTable = 'traveler_contact_details';

}
