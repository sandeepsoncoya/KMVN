<?php
App::uses('AppModel', 'Model');
/**
* User Model
*
*/
class TenderCategory extends AdminAppModel {
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
    public $name = 'TenderCategory';
    public $useTable = 'tender_categories';
  
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
        if ($this->data['TenderCategory']['name'] != "") {
            $conditions['name']=$this->data['TenderCategory']['name'];
            if(isset($this->data['TenderCategory']['id'])){
                $id = $this->data['TenderCategory']['id'];
                $conditions['id !='] = $id;            
            }
                
            $pageData =  $this->find('first',['conditions'=>$conditions]);           
            if(!empty($pageData)){
                $errors[]="TenderCategory should be unique";
            }
                        
        }    
        if (!empty($errors))
            return implode("\n", $errors);    
        return true;
    } 

}
