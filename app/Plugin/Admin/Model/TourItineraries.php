<?php
App::uses('AppModel', 'Model');
/**
* User Model
*
*/
class TourItineraries extends AdminAppModel {
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
    public $name = 'TourItineraries';
    public $useTable = 'tour_itineraries';

}
