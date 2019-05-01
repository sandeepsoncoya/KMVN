<?php
App::uses('AppModel', 'Model');
/**
* User Model
*
*/
class TourCategories extends AdminAppModel {
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
    public $name = 'TourCategories';
    public $useTable = 'tour_categories';
  
    var	 $validate  = array(
		'name' => array(
			'notBlank' => array(								
				'rule' => 'notBlank',
                'message' => 'Please enter tender category name.',
            ),
            'checkUnique' => array(								
				'rule' => 'checkUnique',            
                
			)

		)
    ); 
    public function checkUnique() {
        if ($this->data['TourCategories']['name'] != "") {
            $conditions['name']=$this->data['TourCategories']['name'];
            if(isset($this->data['TourCategories']['id'])){
                $id = $this->data['TourCategories']['id'];
                $conditions['id !='] = $id;            
            }
            $pageData =  $this->find('first',['conditions'=>$conditions]);           
            if(!empty($pageData)){
                $errors[]="category should be unique";
            }
        }    
        if (!empty($errors))
            return implode("\n", $errors);    
        return true;
    } 

}
