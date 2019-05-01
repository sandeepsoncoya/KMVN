<?php
App::uses('AppModel', 'Model');
/**
* User Model
*
*/
class DestinationImages extends AdminAppModel {
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
    public $name = 'DestinationImages';
    public $useTable = 'destination_images';

}
