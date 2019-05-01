<?php
App::uses('AppModel', 'Model');
/**
* User Model
*
*/
class CmsImages extends AdminAppModel {
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
    public $name = 'CmsImages';
    public $useTable = 'Cms_images';

}
