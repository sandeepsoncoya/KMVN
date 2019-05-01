<?php
App::uses('AppModel', 'Model');
/**
* User Model
*
*/
class SiteSettings extends AdminAppModel {
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

    public $name = 'SiteSettings';
    public $useTable = 'site_settings';
  


}
