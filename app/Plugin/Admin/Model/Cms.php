<?php
App::uses('AppModel', 'Model');
/**
* User Model
*
*/
class Cms extends AdminAppModel {
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

    public $name = 'Cms';
    public $useTable = 'cms';
    var	 $validate  = array(
		'title' => array(
			'notBlank' => array(								
				'rule' => 'notBlank',
                'message' => 'Please enter page title.',
                
            ),
            'checkUnique' => array(								
				'rule' => 'checkUnique',            
                
			)

		),
		'category' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Please select category.',

			)

        ),
        
        'description' => array(
			'notBlank' => array(								
				'rule' => 'notBlank',
                'message' => 'Please enter description.',
                
			)

		),
        		

    );  
    public function checkUnique() {
        if ($this->data['Cms']['title'] != "") {
            $categoryId = $this->data['Cms']['category'];          
            $title =  $this->data['Cms']['title'];            
            $conditions['category']=$categoryId;
            $conditions['title']=$title;
            if(isset($this->data['Cms']['id'])){
                $id = $this->data['Cms']['id'];
                $conditions['id !='] = $id;            }
            
            $pageData =  $this->find('first',['conditions'=>$conditions]);           
            if(!empty($pageData)){
                $errors[]="Title should be unique";
            }
                        
        }    
        if (!empty($errors))
            return implode("\n", $errors);    
        return true;
    }


}
