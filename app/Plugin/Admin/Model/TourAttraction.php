<?php
App::uses('AppModel', 'Model');
/**
* User Model
*
*/
class TourAttraction extends AdminAppModel {
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
    public $name = 'TourAttraction';
    public $useTable = 'tour_attractions';
    public $belongsTo = array(
        'Attraction' 
    );
    
}
