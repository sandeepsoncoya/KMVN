<?php
App::uses('AppModel', 'Model');
/**
* User Model
*
*/
class HotelHighlightSelected extends AdminAppModel {
 	public $actsAs = array('Containable');
    public $name = 'HotelHighlightSelected';
    public $useTable = 'hotel_highlight_selected';
  /*  public $belongsTo = array(
        'HotelHighlight' 
    );*/
}
