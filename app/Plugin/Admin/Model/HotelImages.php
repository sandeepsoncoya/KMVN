<?php
App::uses('AppModel', 'Model');
/**
* User Model
*
*/
class HotelImages extends AdminAppModel {
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

    public $name = 'HotelImages';
    public $useTable = 'hotel_images';
   
   

}
