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
                <h3 class="mb-3 text-primary"> Permission Information </h3>
                <div id="s_main" class="tab-pane fade show in active">
                    <?php echo $this->Form->create('PermissionAccesses', ['type' => 'file', 'id'=>'permissionAdd','class'=>'validation-wizard wizard-circle m-t-40']); ?>
                    <?php 
                    
                        echo $this->Form->input('id', [
                                    'type' => 'hidden'  
                                ]);
                    
                    ?>

                    <?php 
                    $i = 0;
                    foreach ($moduleLists as $key => $value) { 
                        $module_check = false;
                        if(in_array($value['PermissionModules']['id'], $moduleArr)){
                            $module_check = true;
                        }


                    ?>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <?php
                                        echo $this->Form->input('Acesses.'.$i.'.permission_module_id', [
                                            'id'=>'module_'.$value['PermissionModules']['id'],
                                            'type' => 'checkbox',
                                            'value' => $value['PermissionModules']['id'],
                                            'hiddenField'=>false,
                                            'checked'=>$module_check,
                                            'multiple'=>'checkbox',
                                            'div'=> [
                                                'class' => 'form-check form-control-plaintext'
                                            ],                                        
                                            'required'   => false,
                                            'class' => 'form-check-input module_cls',
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
                        <div class="row child-check" style="margin-left:10px;">
                    <?php
                        $j = 0;
                        foreach ($value['PermissionSubModules'] as $s_key => $s_val) {
                            $sub_module_check = false;
                            if(!empty($submoduleArr[$i])){
                                $sub = $submoduleArr[$i];
                                if(in_array($s_val['id'], $sub)){
                                    $sub_module_check = true;
                                }
                            }
                    ?>
                                
                            <div class="col-md-2">
                                <div class="form-group">
                                    <?php
                                        echo $this->Form->input('Acesses.'.$i.'.permission_sub_module_id.'.$j, [
                                            'id'=>'sub_module_'.$s_val['id'],
                                            'type' => 'checkbox',
                                            'value' => $s_val['id'],
                                            'multiple'=>'checkbox',
                                            'checked'=>$sub_module_check,
                                            'hiddenField'=>false,
                                            'div'=> [
                                                'class' => 'form-check form-control-plaintext'
                                            ],                                        
                                            'required'   => false,
                                            'class' => 'form-check-input submodule_cls',
                                            'label' => [
                                                'text'=> $s_val['name'],
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
                    <?php
                        }
                        $i++;
                    }
                    ?>

                    
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
    $(".module_cls").on("change", function () {
        if($(this).prop("checked")){
            $(this).parents(".row").next(".child-check").find("input[type=checkbox]").prop("checked",true);
        }
        else{
            $(this).parents(".row").next(".child-check").find("input[type=checkbox]").prop("checked",false);
        }
    });
    
    $(".child-check").find("input[type=checkbox]").on("change",function(){
        if($(this).parents(".child-check").find("input[type='checkbox']:checked").length == 0) {
                $(this).parents(".child-check").prev(".row").find("input[type=checkbox]").prop("checked",false);
            } else {
                $(this).parents(".child-check").prev(".row").find("input[type=checkbox]").prop("checked",true);
            }
    })
});
</script>