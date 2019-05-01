<?php
App::uses('AppModel', 'Model');
/**
* User Model
*
*/
class AttractionImages extends AdminAppModel {
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
    public $name = 'AttractionImages';
    public $useTable = 'attraction_images';

}
