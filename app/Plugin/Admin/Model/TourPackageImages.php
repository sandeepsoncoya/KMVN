<?php
App::uses('AppModel', 'Model');
/**
* User Model
*
*/
class TourPackageImages extends AdminAppModel {
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
    public $name = 'TourPackageImages';
    public $useTable = 'tour_package_images';

}
