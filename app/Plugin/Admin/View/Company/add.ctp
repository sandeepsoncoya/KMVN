<?php 
    echo $this->Html->script([
        '/admin/assets/libs/moment/moment',
        '/admin/assets/libs/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker-custom',
           
    ], array('block' => 'scriptBottom'));
    echo $this->Html->css([
        '/admin/assets/libs/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker',                
           
    ], array('block' => 'cssBottom'));
 ?>
 <?php
    $id = (isset($this->request->params['pass'][0]))?$this->request->params['pass'][0]:0;
    $lbl = ($id==0)?'Add':'Update';

    $cityArray = [];
    $hotelArray = [];
    if(isset($this->data['CompanyHotels'])){
        foreach ($this->data['CompanyHotels'] as $key => $val) {
           $cityArray[] = $val['city_id'];
           $hotelArray[] = $val['hotel_id'];
          
        }
    }
?>
<div class="col-12">

    <div class="card">
        <div class="card-body wizard-content">
            <div class="tab-content br-n pn">
                <hr>
                <h3 class="mb-3 text-primary"> Basic Information </h3>
                <div id="s_main" class="tab-pane fade show in active">
                    <?php echo $this->Form->create('Company', ['type' => 'file', 'id'=>'companyAdd','class'=>'validation-wizard wizard-circle m-t-40']); ?>
                    <?php 
                    
                        echo $this->Form->input('id', [
                                    'type' => 'hidden'                              
                                ]);
                    
                    ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                    echo $this->Form->input('name', [
                                        'type' => 'text',						                  
                                        'class'=>'form-control required',
                                        'required'   => true,
                                    ]);
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                    global $company_type;
                                    echo $this->Form->input('company_type', [
                                        'type' => 'select',                                       
                                        'class'=>'form-control required',
                                        'required' => false,
                                        'options' => $company_type
                                    ]);
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                    echo $this->Form->input('contact_person', [
                                        'type' => 'text',                                         
                                        'class'=>'form-control required',
                                        'required'   => true,
                                    ]);
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                    echo $this->Form->input('address', [
                                        'type' => 'textarea',
                                        'class'=>'form-control required',                                         
                                        'required'   => true,
                                        
                                    ]);

                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                    echo $this->Form->input('pin_post_code', [
                                        'type' => 'text',                                         
                                        'class'=>'form-control required',
                                        'required'   => true,
                                    ]);
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                    echo $this->Form->input('city', [
                                        'type' => 'select',                                       
                                        'class'=>'form-control required',
                                        'required' => false,
                                        'options' => $cityList
                                    ]);
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                    echo $this->Form->input('phone_1', [
                                        'type' => 'text',   
                                        'maxlength'=>10,                                      
                                        'class'=>'form-control required',
                                        'required'   => true,
                                    ]);
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                    echo $this->Form->input('fax', [
                                        'type' => 'text', 
                                        'maxlength'=>10,                                        
                                        'class'=>'form-control required',
                                        'required'   => false,
                                    ]);
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <?php
                                    echo $this->Form->input('phone_2', [
                                        'type' => 'text',  
                                        'maxlength'=>10,                                       
                                        'class'=>'form-control required',
                                        'required'   => false,
                                    ]);
                                ?>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <?php
                                    echo $this->Form->input('email', [
                                        'type' => 'text',                                         
                                        'class'=>'form-control required',
                                        'required'   => false,
                                    ]);
                                ?>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <?php
                                    echo $this->Form->input('website', [
                                        'type' => 'text',                                         
                                        'class'=>'form-control required',
                                        'required'   => false,
                                    ]);
                                ?>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h3 class="mb-3 text-primary"> Rate Settings </h3>
                    <div class="row align-items-end">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                    global $rate_code;
                                    echo $this->Form->input('rate_code', [
                                        'type' => 'select',                                       
                                        'class'=>'form-control required',
                                        'required' => false,
                                        'options' => $rate_code
                                    ]);
                                ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                    echo $this->Form->input('is_xml_feed', [
                                        'type' => 'checkbox',
                                        'div'=> [
                                            'class' => 'form-check form-control-plaintext'
                                        ],						                  
                                        'required'   => false,
                                        'class' => 'form-check-input',
                                        'label' => [
                                            'text'=> 'xml feed genrated',
                                            'class'=>'form-check-label'
                                        ]
                                    ]);
                                ?>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <h3 class="mb-3 text-primary"> Hotel Settings </h3>
                    
                        <?php 
                            $i= 0;
                            foreach ($cityHotelData as $key => $data) {
                                if(!empty($data['Hotel'])){ 
                                    $city_check = false;
                                    if(in_array($data['City']['id'], array_unique($cityArray))){
                                        $city_check = true;
                                    }
                        ?>
                                    <div class="row align-items-end">    
                                        <div class="col-md-12">
                                            <div class="form-group citydiv">
                                                <?php
                                                    echo $this->Form->input('CompanyHotels.'.$i.'.city_id', [
                                                        'id'=>'city_id_'.$data['City']['id'],
                                                        'type' => 'checkbox',
                                                        'value'=> $data['City']['id'],
                                                        'checked' => $city_check,
                                                        'div'=> [
                                                            'class' => 'form-check form-control-plaintext'
                                                        ],                                        
                                                        'required' => false,
                                                        'hiddenField'=>false,
                                                        'class' => 'form-check-input city_cls',
                                                        'label' => [
                                                            'text'=> $data['City']['name'],
                                                            'class'=>'form-check-label'
                                                        ]
                                                    ]);
                                                ?>
                                            
                                            
                                                <div id="city_hotel_<?php echo $data['City']['id']; ?>" class="child-check">
                                                <?php
                                                $j = 0; 
                                                foreach ($data['Hotel'] as $hotel) { 
                                                    $hotel_check = false;
                                                    if(in_array($hotel['id'], $hotelArray)){
                                                        $hotel_check = true;
                                                    }

                                                    ?>
                                                   
                                                        <div class="col-md-4" style="float: left;">
                                                            <div class="form-group">
                                                                <?php
                                                                    echo $this->Form->input('CompanyHotels.'.$i.'.hotel_id.'.$j, [
                                                                        'type' => 'checkbox',
                                                                        'value'=> $hotel['id'],
                                                                        'checked' => $hotel_check,
                                                                        'multiple'=>'checkbox',
                                                                        'hiddenField'=>false,
                                                                        'div'=> [
                                                                            'class' => 'form-check form-control-plaintext'
                                                                        ],                                        
                                                                        'required'   => false,
                                                                        'class' => 'form-check-input hotel_cls',
                                                                        'label' => [
                                                                            'text'=> $hotel['title'],
                                                                            'class'=>'form-check-label'
                                                                        ]
                                                                    ]);
                                                                ?>
                                                            </div>
                                                        </div>
                                                    
                                                <?php 
                                                    $j++; 
                                                } 
                                                ?>
                                                </div>
                                            
                                            </div>


                                        </div>
                                    </div>
                        <?php   
                                    $i++;
                                } 
                            }
                        ?>
                    
                    <hr>
                    <h3 class="mb-3 text-primary">Company Activate</h3>
                    <div class="row align-items-end">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                    echo $this->Form->input('is_active', [
                                        'type' => 'checkbox',
                                        'div'=> [
                                            'class' => 'form-check form-control-plaintext'
                                        ],                                        
                                        'required'   => false,
                                        'class' => 'form-check-input',
                                        'label' => [
                                            'text'=> 'check to activate the company',
                                            'class'=>'form-check-label'
                                        ]
                                    ]);
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <?php 
                            echo $this->Form->button('Save', ['type' => 'submit','class'=>'btn btn-success','id'=>'save']);
                        ?>
                    </div>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
            
        </div>
    </div>
</div>



<script language="javascript">
$(function(){

    // add multiple select / deselect functionality
    $(".city_cls").on("change", function () {
        if($(this).prop("checked")){
            $(this).parents(".form-check").next().find("input[type=checkbox]").prop("checked",true);
        }
        else{
            $(this).parents(".form-check").next().find("input[type=checkbox]").prop("checked",false);
        }
    });
    
    $(".child-check").find("input[type=checkbox]").on("change",function(){
        if($(this).parents(".child-check").find("input[type='checkbox']:checked").length == 0) {
                $(this).parents(".child-check").prev(".form-check").find("input[type=checkbox]").prop("checked",false);
            } else {
                $(this).parents(".child-check").prev(".form-check").find("input[type=checkbox]").prop("checked",true);
            }
    })
});
</script>