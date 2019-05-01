<?php
App::uses('AppModel', 'Model');
/**
* User Model
*
*/
class Category extends AdminAppModel {
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
    public $name = 'Category';
    public $useTable = 'category';
  
    var	 $validate  = array(
		'title' => array(
			'notBlank' => array(								
				'rule' => 'notBlank',
                'message' => 'Please enter category title.',
                
            ),
            'checkUnique' => array(								
				'rule' => 'checkUnique',            
                
			)

		),
		'type' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Please select type.',

			)

        )
        		

    ); 
    public function checkUnique() {
        if ($this->data['Category']['title'] != "") {
            $conditions['type'] = $this->data['Category']['type']; 
            $conditions['title']=$this->data['Category']['title'];
            if(isset($this->data['Category']['id'])){
                $id = $this->data['Category']['id'];
                $conditions['id !='] = $id;            
            }
                
            $pageData =  $this->find('first',['conditions'=>$conditions]);           
            if(!empty($pageData)){
                $errors[]="Category should be unique";
            }
                        
        }    
        if (!empty($errors))
            return implode("\n", $errors);    
        return true;
    } 

}
