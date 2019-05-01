<?php
App::uses('AppModel', 'Model');
/**
* User Model
*
*/
class City extends AdminAppModel {
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
    public $name = 'City';
    public $useTable = 'city';
  
    var	 $validate  = array(
		'name' => array(
			'notBlank' => array(								
				'rule' => 'notBlank',
                'message' => 'Please enter name.',
            ),
            'checkUnique' => array(								
				'rule' => 'checkUnique',            
                
			)
		)
    ); 
    public function checkUnique() {
        if ($this->data['City']['name'] != "") {
            $conditions['name']=$this->data['City']['name'];
            if(isset($this->data['City']['id'])){
                $id = $this->data['City']['id'];
                $conditions['id !='] = $id;            
            }
                
            $pageData =  $this->find('first',['conditions'=>$conditions]);           
            if(!empty($pageData)){
                $errors[]="City should be unique";
            }
        }    
        if (!empty($errors))
            return implode("\n", $errors);    
        return true;
    } 

}
