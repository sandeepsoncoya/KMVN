<?php
App::uses('AppModel', 'Model');
/**
* User Model
*
*/
class BedTypeHotel extends AdminAppModel {
 
    public $name = 'BedTypeHotel';
    public $useTable = 'bed_type_hotel';
    var	 $validate  = array(
		'bed_type' => array(
			'notBlank' => array(								
				'rule' => 'notBlank',
                'message' => 'Please enter bed type.',
                
            ),
            'checkUnique' => array(								
				'rule' => 'checkUnique',            
                
			)

		),
		'no_of_rooms' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Please enter no of rooms.',

			)

        ),
        
        		

	); 
	public function checkUnique() {
        if ($this->data['BedTypeHotel']['bed_type'] != "") {
			
			$conditions['bed_type'] =  $this->data['BedTypeHotel']['bed_type'];   
			$conditions['room_id'] =  $this->data['BedTypeHotel']['room_id'];
			if(isset($this->data['BedTypeHotel']['id'])){
				$conditions['id !='] =  $this->data['BedTypeHotel']['id'];
			}   
			$pageData =  $this->find('first',['conditions'=>$conditions]); 
			         
            if(!empty($pageData)){
                $errors[]="This bed type already taken for this room";
            }
                        
        }    
        if (!empty($errors))
            return implode("\n", $errors);    
        return true;
    }
  
}
