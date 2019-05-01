<?php
App::uses('AppModel', 'Model');
/**
* User Model
*
*/
class Tenders extends AdminAppModel {
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
    public $name = 'Tenders';
    public $useTable = 'tenders';
  
    var	 $validate  = array(
		'name' => array(
			'notBlank' => array(								
				'rule' => 'notBlank',
                'message' => 'Please enter tender title.',
            )
		),
        'description' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Please enter description.',

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

   public function uploadFile( $check ) {

    $uploadData = array_shift($check);

    if ( $uploadData['size'] == 0 || $uploadData['error'] !== 0) {
        return false;
    }

    $uploadFolder = 'uploads'. DS .'tenders';
    $fileName = time() . '.pdf';
    $uploadPath =  $uploadFolder . DS . $fileName;

    if( !file_exists($uploadFolder) ){
        mkdir($uploadFolder);
    }

    if (move_uploaded_file($uploadData['tmp_name'], $uploadPath)) {
        $this->set('file', $fileName);
        return true;
    }

    return false;
}


}
