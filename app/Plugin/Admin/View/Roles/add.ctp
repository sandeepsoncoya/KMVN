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
                <h3 class="mb-3 text-primary"> Role Information </h3>
                <div id="s_main" class="tab-pane fade show in active">
                    <?php echo $this->Form->create('Roles', ['type' => 'file', 'id'=>'roleAdd','class'=>'validation-wizard wizard-circle m-t-40']); ?>
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
                    </div>
                    <div class="text-right">
                        <?php 
                            echo $this->Form->button('Save', ['type' => 'submit','class'=>'btn btn-success','id'=>'save']);
                        ?>
                    </div>
                    <?php echo $this->Form->end(); ?>
                </div>

                <?php if(!empty($moduleLists)){ ?>
                    <hr>
                    <h3 class="mb-3 text-primary"> Permission Information </h3>
                    <div id="s_main" class="tab-pane fade show in active">
                    <?php echo $this->Form->create('PermissionAccesses', ['type' => 'file', 'id'=>'permissionAdd','class'=>'validation-wizard wizard-circle m-t-40']); ?>
                    <?php 
                    
                        echo $this->Form->input('id', [
                                    'type' => 'hidden'  
                                ]);
                    
                    ?>

                    <?php 
                    foreach ($moduleLists as $key => $value) { 
                    ?>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <?php
                                        echo $this->Form->input('permission_module_id', [
                                            'id'=>'module_'.$value['PermissionModules']['id'],
                                            'type' => 'checkbox',
                                            'value' => $value['PermissionModules']['id'],
                                            'div'=> [
                                                'class' => 'form-check form-control-plaintext'
                                            ],                                        
                                            'required'   => false,
                                            'class' => 'form-check-input',
                                            'label' => [
                                                'text'=> $value['PermissionModules']['name'],
                                                'class'=>'form-check-label'
                                            ]
                                        ]);
                                    ?>
                                </div>
                            </div>
                        </div>    
                        <?php 

                        if(!empty($value['PermissionSubModules'])){ ?>
                            <div class="row" style="margin-left:10px;">
                                <?php
                                    foreach ($value['PermissionSubModules'] as $s_key => $s_val) {
                                ?>
                                    
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <?php
                                                echo $this->Form->input('permission_module_id['.$value['PermissionModules']['id'].'][]', [
                                                    'id'=>'sub_module_'.$s_val['id'],
                                                    'type' => 'checkbox',
                                                    'value' => $s_val['id'],
                                                    'div'=> [
                                                        'class' => 'form-check form-control-plaintext'
                                                    ],                                        
                                                    'required'   => false,
                                                    'class' => 'form-check-input',
                                                    'label' => [
                                                        'text'=> $s_val['name'],
                                                        'class'=>'form-check-label'
                                                    ]
                                                ]);
                                            ?>
                                        </div>
                                    </div>
                                     
                                <?php   
                                    }
                                ?>
                            </div> 
                        <?php
                        }
                    }
                    ?>

                        
                    <div class="text-right">
                        <?php 
                            echo $this->Form->button('Save', ['type' => 'submit','class'=>'btn btn-success','id'=>'save']);
                        ?>
                    </div>
                    <?php echo $this->Form->end(); ?>
                    </div>
                    
                <?php } ?>
                



            </div>
            
        </div>
    </div>
</div>
