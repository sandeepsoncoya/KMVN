<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Add <?php echo preg_replace('/([a-z])([A-Z])/s','$1 $2', $modelName);  ?></h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <?php echo $this->Form->create($modelName, ['type' => 'file','id'=>'addFrom','url' => 'save_data']); ?>
        <div class="modal-body">
            <?php 
                if(isset($this->request->data['id'])): 
                    echo $this->Form->input('id', [
                                'type' => 'hidden'                              
                            ]);
                endif; 
            ?>
            <input type="hidden" value="<?php echo $modelName ?>" name="model" />
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php
                            echo $this->Form->input('name', [
                                'type' => 'text',						                  
                                'class'=>'form-control required',
                                
                            ]);
                        ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php
                            echo $this->Form->input('phone', [
                                'type' => 'text',						                  
                                'class'=>'form-control required',
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
                                'type' => 'email',
                                'class'=>'form-control required',						                  
                            ]);
                        ?>
                    </div>    
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php
                            echo $this->Form->input('company', [
                                'type' => 'text',						                  
                                'class'=>'form-control required',
                                'label'=>'Company Name'
                            ]);
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php
                            echo $this->Form->input('contact_person_name', [
                                'type' => 'text',						                  
                                'class'=>'form-control required',
                                
                            ]);
                        ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php
                            echo $this->Form->input('contact_person_phone', [
                                'type' => 'text',						                  
                                'class'=>'form-control required',
                            ]);
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php
                            echo $this->Form->input('location', [
                                'type' => 'text',						                  
                                'class'=>'form-control required',
                                
                            ]);
                        ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php
                            echo $this->Form->input('gstin', [
                                'type' => 'text',						                  
                                'class'=>'form-control required',
                            ]);
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <?php
                            echo $this->Form->input('correspond_address', [
                                'type' => 'textarea',						                  
                                'class'=>'form-control required',
                                
                            ]);
                        ?>
                    </div>
                </div>
               
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <?php
                            echo $this->Form->input('delivery_address', [
                                'type' => 'textarea',						                  
                                'class'=>'form-control required',
                                
                            ]);
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php
                            echo $this->Form->input('bank_name', [
                                'type' => 'text',						                  
                                'class'=>'form-control required',
                                
                            ]);
                        ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php
                            echo $this->Form->input('ifsc_code', [
                                'type' => 'text',						                  
                                'class'=>'form-control required',
                            ]);
                        ?>
                    
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php
                            echo $this->Form->input('account_name', [
                                'type' => 'text',						                  
                                'class'=>'form-control required',
                                
                            ]);
                        ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php
                            echo $this->Form->input('account_no', [
                                'type' => 'text',						                  
                                'class'=>'form-control required',
                            ]);
                        ?>
                    
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php
                            echo $this->Form->input('status', [
                                'type' => 'select',						                  
                                'class'=>'form-control required',
                                'options'=>['1'=>'Active','0'=>'De-Active']
                                
                            ]);
                        ?>
                    </div>
                </div>
               
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
            <?php 
                echo $this->Form->button('<i class="fa fa-check"></i> Save',[
                                                                                'type' => 'submit',
                                                                                'class'=>'btn btn-success',
                                                                                'id'=>'save'
                                                                            ]);
            ?>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>
</div>