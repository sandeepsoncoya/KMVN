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
?>
<div class="col-12">

    <div class="card">
        <div class="card-body wizard-content">
            <div class="tab-content br-n pn">
                <hr>
                <h3 class="mb-3 text-primary"> Basic Information </h3>
                <div id="s_main" class="tab-pane fade show in active">
                    <?php echo $this->Form->create('CompanyUsers', ['type' => 'file', 'id'=>'companyUsersAdd','class'=>'validation-wizard wizard-circle m-t-40']); ?>
                    <?php 
                    
                        echo $this->Form->input('id', [
                                    'type' => 'hidden'                              
                                ]);
                    
                    ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                    echo $this->Form->input('username', [
                                        'type' => 'text', 
                                        'label'=>'Login Id',                                        
                                        'class'=>'form-control required',
                                        'required'   => true,
                                    ]);
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                    echo $this->Form->input('password', [
                                        'type' => 'text', 
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
                                    echo $this->Form->input('first_name', [
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
                                    echo $this->Form->input('last_name', [
                                        'type' => 'text',                                         
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
                                    echo $this->Form->input('company_id', [
                                        'type' => 'select',                                       
                                        'class'=>'form-control required',
                                        'required' => false,
                                        'options' => $companyList
                                    ]);
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                    echo $this->Form->input('markup_value', [
                                        'type' => 'text',                                         
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
                                    echo $this->Form->input('is_override_rate', [
                                        'type' => 'checkbox',
                                        'div'=> [
                                            'class' => 'form-check form-control-plaintext'
                                        ],                                        
                                        'required'   => false,
                                        'class' => 'form-check-input',
                                        'label' => [
                                            'text'=> 'Override Rate Permission',
                                            'class'=>'form-check-label'
                                        ]
                                    ]);
                                ?>
                            </div>
                        </div>
                    </div>    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                    echo $this->Form->input('is_gsa', [
                                        'type' => 'checkbox',
                                        'div'=> [
                                            'class' => 'form-check form-control-plaintext'
                                        ],                                        
                                        'required'   => false,
                                        'class' => 'form-check-input',
                                        'label' => [
                                            'text'=> 'IsGSA',
                                            'class'=>'form-check-label'
                                        ]
                                    ]);
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">    
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
                                            'text'=> 'Active',
                                            'class'=>'form-check-label'
                                        ]
                                    ]);
                                ?>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <h3 class="mb-3 text-primary"> Mailing Address </h3>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                    echo $this->Form->input('line_1', [
                                        'type' => 'text',
                                        'label'=>'Line 1',                                         
                                        'class'=>'form-control required',
                                        'required'   => true,
                                    ]);
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                    echo $this->Form->input('line_2', [
                                        'type' => 'text', 
                                        'label'=>'Line 2',                                        
                                        'class'=>'form-control required',
                                        'required'   => false,
                                    ]);
                                ?>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                    echo $this->Form->input('city_id', [
                                        'type' => 'select',  
                                        'id'=>'city_id',                                     
                                        'class'=>'form-control required',
                                        'required' => false,
                                        'options' => $cityList,
                                        'empty' => 'select city'
                                    ]);
                                ?>
                            </div>
                        </div>
                        <div id="suburb" class="col-md-6">
                            <div class="form-group">
                                <?php
                                    echo $this->Form->input('suburb_id', [
                                        'type' => 'select',  
                                        'id'=>'suburb_id',                                     
                                        'class'=>'form-control required',
                                        'required' => false,
                                        'options' => $suburbs,
                                        'empty' => 'select suburb'
                                    ]);
                                ?>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                    echo $this->Form->input('zipcode', [
                                        'type' => 'text',                                         
                                        'class'=>'form-control required',
                                        'required'   => false,
                                    ]);
                                ?>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <h3 class="mb-3 text-primary"> Contacts Details </h3>

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
                        
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                    echo $this->Form->input('mobile', [
                                        'type' => 'text',  
                                        'maxlength'=>10,
                                        'label'=>'Mobile no',                                       
                                        'class'=>'form-control required',
                                        'required'   => true,
                                    ]);
                                ?>
                            </div>
                        </div>

                        <div class="col-md-6">
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

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                    echo $this->Form->input('email', [
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

<script type="text/javascript">
    $(document).ready(function() {
        $("#city_id").on('change',function() {
            var id = $(this).val();
            $("#suburb_id").find('option').remove();
            if (id) {
                var dataString = 'id='+ id;
                $.ajax({
                    type: "POST",
                    url: '<?php echo Router::url(array("controller" => "city", "action" => "getSuburbs")); ?>' ,
                    data: dataString,
                    cache: false,
                    success: function(html) {
                        $.each(html, function(key, value) {              
                            $('<option>').val('').text('select');
                            $('<option>').val(key).text(value).appendTo($("#suburb_id"));
                        });
                    } 
                });
            }
        });
    });
</script>