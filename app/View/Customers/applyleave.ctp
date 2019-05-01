<?php
$id = (isset($this->request->params['pass'][0]))?$this->request->params['pass'][0]:0;
$lbl = ($id==0)?'Add':'Update';
$duration = ['1'=>"Full Day",'2'=>'Half Day'];
$dayPart = ['1'=>'First Half','2'=>'Second Half'];
?>
<div class="row">
  <div class="col-lg-6">
        <?php echo $this->Flash->render(); ?>
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                  <h3 class="text-center title-2">Apply for Leave</h3>
                </div>
                <hr>
                <?php echo $this->Form->create('AppliedLeave', ['type' => 'file']); ?>
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
                                    echo $this->Form->input('leave_type_id', [
                                        'type' => 'select', 
                                        'class'=>'form-control required',
                                        'options'=>$leaveArray,
                                        'empty'=>'Please select...',
                                        'label'=>'Leave Type'
                                    ]);
                                ?>
                            </div>
                            <div class="form-group">
                                <?php
                                    echo $this->Form->input('leave_type', [
                                        'type' => 'select', 
                                        'class'=>'form-control required',
                                        'options'=>$duration,
                                        'empty'=>'Please select...',
                                        'label'=>'Duration',
                                        'id'=>'duration'
                                    ]);
                                ?>
                            </div>
                            <div class="form-group half_day" style="display:none;">
                                <?php
                                    echo $this->Form->input('day_part', [
                                        'type' => 'select',                                   
                                        'class'=>'form-control required',
                                        'options'=>$dayPart,
                                        'empty'=>'Please select...',
                                        'label'=>'Day Part'
                                    ]);
                                ?>
                            </div>
                            <div class="form-group half_day" style="display:none;">
                                <?php
                                    echo $this->Form->input('half_day', [
                                        'type' => 'text',             
                                        'class'=>'form-control required pastDate',
                                        'label'=>'Date'
                                    ]);
                                ?>
                            </div>
                            <div class="form-group full_day" style="display:none;">
                                <?php
                                    echo $this->Form->input('from', [
                                        'type' => 'text',     
                                        'class'=>'form-control required pastDate',
                                        'label'=>'from Date'
                                    ]);
                                ?>
                            </div>
                            <div class="form-group full_day" style="display:none;">
                                <?php
                                    echo $this->Form->input('to', [
                                        'type' => 'text',     
                                        'class'=>'form-control required pastDate',
                                        'label'=>'To Date'
                                    ]);
                                ?>
                            </div>
                            <div class="form-group">
                                <?php
                                    echo $this->Form->input('reason', [
                                        'type' => 'textarea',     
                                        'class'=>'form-control',
                                        'label'=>'Reason'
                                    ]);
                                ?>
                            </div>
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