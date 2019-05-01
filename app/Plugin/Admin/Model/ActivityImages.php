<?php
App::uses('AppModel', 'Model');
/**
* User Model
*
*/
class ActivityImages extends AdminAppModel {
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
    public $name = 'ActivityImages';
    public $useTable = 'activity_images';

}
