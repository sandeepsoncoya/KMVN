<?php

$id = (isset($this->request->params['pass'][0]))?$this->request->params['pass'][0]:0;
$lbl = ($id==0)?'Add':'Update';

?>
<div class="row">
  <div class="col-lg-6">
      <div class="card">
          <div class="card-header">Employee</div>
          <div class="card-body">
              <div class="card-title">
                  <h3 class="text-center title-2"><?php echo $lbl; ?> Employee</h3>
              </div>
              <hr>
              <?php echo $this->Form->create('Users', ['type' => 'file']); ?>
                <?php 

                      if($id > 0): 
                          echo $this->Form->input('id', [
                                'type' => 'hidden'                              
                            ]);
                      endif; 
                    ?>
                  <div class="row">
                      <div class="col-12">
                          <div class="form-group">
                            <?php
                                echo $this->Form->input('name', [
                                    'type' => 'text',
                                    'div'=>false,                         
                                    'class'=>'form-control'
                                  ]);
                            ?>
                            
                          </div>
                          <div class="form-group">
                            <?php
                                echo $this->Form->input('email', [
                                    'type' => 'email',
                                    'div'=>false,                         
                                    'class'=>'form-control'
                                  ]);
                            ?>
                            
                          </div>
                          <div class="form-group">
                            <?php
                                echo $this->Form->input('phone', [
                                    'type' => 'text',
                                    'div'=>false,                         
                                    'class'=>'form-control'
                                  ]);
                            ?>
                            
                          </div>
                          <div class="form-group">
                            <?php
                                echo $this->Form->input('emp_code', [
                                    'type' => 'text',
                                    'div'=>false,                         
                                    'class'=>'form-control'
                                  ]);
                            ?>
                            
                          </div>
                          <div class="form-group">
                            <?php
                                echo $this->Form->input('dob', [
                                    'type' => 'text',
                                    'div'=>false,                         
                                    'class'=>'form-control futureDate',
                                    'label'=>'Date of Birth'
                                  ]);
                            ?>
                            
                          </div>
                              <div class="form-group">
                                <?php
                                    echo $this->Form->input('doj', [
                                        'type' => 'text',
                                        'div'=>false,                         
                                        'class'=>'form-control datepicker',
                                        'label'=>'Date of Joining'
                                      ]);
                                ?>
                                
                              </div>
                            <div class="form-group">
                                <?php
                                     echo $this->Form->input('department', [
                                          'type' => 'select',                                   
                                          'class'=>'form-control required',
                                          'options'=>$departments,
                                          'empty'=>'Please select...'
                                      ]);
                                ?>
                            
                            </div>
                            
                          <div class="form-group">
                            <?php
                                echo $this->Form->input('degnation', [
                                    'type' => 'text',
                                    'div'=>false,                         
                                    'class'=>'form-control'
                                  ]);
                            ?>
                            
                          </div>
                            <?php if($id == 0):  ?>
                                <div class="form-group">
                                    <?php
                                        echo $this->Form->input('password', [
                                            'type' => 'password',
                                            'div'=>false,                         
                                            'class'=>'form-control'
                                          ]);
                                    ?>
                                
                                </div>
                                <div class="form-group">
                                    <?php
                                        echo $this->Form->input('confirm_password', [
                                            'type' => 'password',
                                            'div'=>false,                         
                                            'class'=>'form-control'
                                          ]);
                                    ?>
                                
                                </div>
                            <?php endif; ?>

                      </div>
                    
                  </div>
                  <div>
                    <?php 
                        echo $this->Form->button('Submit', ['type' => 'submit','class'=>'btn btn-primary btn-sm']);
                        ?>
                      
                  </div>
              <?php echo $this->Form->end(); ?>
          </div>
      </div>
  </div>
</div>
