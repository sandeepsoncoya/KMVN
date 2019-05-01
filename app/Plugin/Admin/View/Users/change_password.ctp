<?php
$id = (isset($this->request->params['pass'][0]))?$this->request->params['pass'][0]:0;
$lbl = ($id==0)?'Add':'Update';
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            
            <?php echo $this->Form->create('Users', ['type' => 'file']); ?>
                <?php 
                if($id > 0): 
                    echo $this->Form->input('id', [
                                'type' => 'hidden'                              
                            ]);
                endif; 
                ?>
                <div class="form-body">
                    <div class="card-body">
                        <div class="row p-t-20">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php
                                        echo $this->Form->input('old_password', [
                                            'type' => 'password',						                  
                                            'class'=>'form-control required',
                                            'required'   => false,
                                        ]);
                                    ?>
                                   
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group has-danger">
                                    <?php
                                        echo $this->Form->input('new_password', [
                                            'type' => 'password',						                  
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
                                        echo $this->Form->input('confirm_password', [
                                            'type' => 'password',						                  
                                            'class'=>'form-control required',
                                            'required'   => false,
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

