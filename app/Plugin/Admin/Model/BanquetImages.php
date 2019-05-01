<?php
App::uses('AppModel', 'Model');
/**
* User Model
*
*/
class BanquetImages extends AdminAppModel {
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
    public $name = 'BanquetImages';
    public $useTable = 'banquet_images';

}
