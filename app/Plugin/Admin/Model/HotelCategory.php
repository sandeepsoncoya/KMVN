<?php
App::uses('AppModel', 'Model');
/**
* User Model
*
*/
class HotelCategory extends AdminAppModel {
 
    public $name = 'HotelCategory';
    public $useTable = 'hotel_category';
      var	 $validate  = array(
      'title' => array(
        'notBlank' => array(								
          'rule' => 'notBlank',
                  'message' => 'Please enter hotel category title.',
                  
              )

      )
    );  
   

}
