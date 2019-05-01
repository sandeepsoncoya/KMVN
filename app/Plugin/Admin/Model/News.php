<?php
App::uses('AppModel', 'Model');
/**
* User Model
*
*/
class News extends AdminAppModel {
    /**
    * Display field
    *
    * @var string
    */
    /**
    * Validation rules
    *
    * @var array
    */
    public $actsAs = array('Containable');
    public $name = 'News';
    public $useTable = 'news';
  
    var	 $validate  = array(
		'title' => array(
			'notBlank' => array(								
				'rule' => 'notBlank',
                'message' => 'Please enter title.',
            )
		),
        'description' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Please enter description.',

            )

        ),
        'type' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Please select type.',

            )

        ),
        'featured_img' => array(             
            'extension' => array(
                'rule' => array('extension', array('pdf')),
                'message' => 'File does not have a pdf extension',
                'on' =>'create'
                 )
        ),
        'is_active' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Please choose status.',

            )

        )
        		

    ); 
}
