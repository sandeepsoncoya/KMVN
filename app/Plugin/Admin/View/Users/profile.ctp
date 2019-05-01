<?php 
$userData = $this->Session->read('UserData')

?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            
            <?php echo $this->Form->create('Users', ['type' => 'file']); ?>
             
                <div class="form-body">
                    <div class="card-body">
                        <div class="row p-t-20">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php
                                        echo $this->Form->input('name', [
                                            'type' => 'text',						                  
                                            'class'=>'form-control required',
                                            'required'   => false,
                                            'value'=>$userData['Users']['name']
                                        ]);
                                    ?>
                                   
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group has-danger">
                                    <?php
                                        echo $this->Form->input('email', [
                                            'type' => 'email',						                  
                                            'class'=>'form-control required',
                                            'required'   => false,
                                            'value'=>$userData['Users']['email']
                                        ]);
                                    ?>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="form-actions">
                        <div class="card-body">
                            <?php 
						        echo $this->Form->button(' <i class="fa fa-check"></i> Save', ['type' => 'submit','class'=>'btn btn-success ']);
						    ?>                           
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

