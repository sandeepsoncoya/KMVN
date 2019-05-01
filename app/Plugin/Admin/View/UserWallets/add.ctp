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
                <h3 class="mb-3 text-primary"> <?= ucwords($comp_user_name); ?>'s Wallet </h3>
                <div id="s_main" class="tab-pane fade show in active">
                    <?php echo $this->Form->create('UserWallets', ['type' => 'file', 'id'=>'userWalletsAdd','class'=>'validation-wizard wizard-circle m-t-40']); ?>
                    
                    <?php 
                        echo $this->Form->input('company_user_id', [
                                    'type' => 'hidden',
                                    'value'=> $comp_user_id                              
                             ]);
                    
                    ?>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                    global $amount_type;
                                    echo $this->Form->input('amount_type', [
                                        'type' => 'select', 
                                        'label'=>'Amount Type', 
                                        'options'=>$amount_type,                                       
                                        'class'=>'form-control required',
                                        'required'=> false,
                                       
                                    ]);
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                    echo $this->Form->input('amount', [
                                        'type' => 'text', 
                                        'label'=>'Balance',                                        
                                        'class'=>'form-control required',
                                        'required'   => true,
                                    ]);
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <?php
                                    echo $this->Form->input('description', [
                                        'type' => 'textarea',						                  
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

