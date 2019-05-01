<?php
App::uses('AppModel', 'Model');
/**
* User Model
*
*/
class States extends AdminAppModel {

 
    
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
    public $name = 'States';
    public $useTable = 'state';
  
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
        if ($this->data['States']['name'] != "") {
            $conditions['name']=$this->data['City']['name'];
            if(isset($this->data['States']['id'])){
                $id = $this->data['States']['id'];
                $conditions['id !='] = $id;            
            }
                
            $pageData =  $this->find('first',['conditions'=>$conditions]);           
            if(!empty($pageData)){
                $errors[]="States should be unique";
            }
        }    
        if (!empty($errors))
            return implode("\n", $errors);    
        return true;
    } 

}
