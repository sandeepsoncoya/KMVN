<?php
$id = (isset($this->request->params['pass'][0]))?$this->request->params['pass'][0]:0;
$lbl = ($id==0)?'Add':'Update';

?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-info">
                <h4 class="m-b-0 text-white">Faq</h4>
            </div>
            <?php echo $this->Form->create('Faqs', ['type' => 'file']); ?>
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
                                        echo $this->Form->input('title', [
                                            'type' => 'text',						                  
                                            'class'=>'form-control required',
                                            'required'   => false,
                                        ]);
                                    ?>
                                   
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group has-danger">
                                    <?php
                                        echo $this->Form->input('answer', [
                                            'type' => 'textarea',						                  
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
                                        echo $this->Form->input('is_active', [
                                            'type' => 'select',						                  
                                            'class'=>'form-control required',
                                            'required'   => false,
                                            'options'=>['1'=>'Active','0'=>'In-active']
                                            
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
                            <?php
                                echo $this->Html->link(
                                    'Cancel',
                                    array(
                                        'controller' => 'Faqs',
                                        'action' => 'index',
                                        'plugin'=>'admin'                                        
                                    ),
                                    [
                                    'escape' => false,
                                    'class'=>'btn btn-dark'
                                    ]
                                );
                            ?>
                            
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>