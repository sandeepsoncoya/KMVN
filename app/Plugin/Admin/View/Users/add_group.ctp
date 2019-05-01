<?php
$id = (isset($this->request->params['pass'][0]))?$this->request->params['pass'][0]:0;
$lbl = ($id==0)?'Add':'Update';

?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-info">
                <h4 class="m-b-0 text-white">Group Information</h4>
            </div>
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
                                       
                                        echo $this->Form->input('name', [
                                            'type' => 'text',						                  
                                            'class'=>'form-control required',
                                            
                                        ]);
                                    ?>
                                   
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group has-danger">
                                    <?php
                                       
                                        echo $this->Form->input('email', [
                                            'type' => 'email',						                  
                                            'class'=>'form-control required',
                                            
                                        ]);
                                    ?>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group has-success">
                                    <?php
                                        
                                        echo $this->Form->input('phone', [
                                            'type' => 'text',						                  
                                            'class'=>'form-control required',
                                           
                                        ]);
                                    ?>
                                </div>
                            </div>
                            <?php
                                 $fileExist =  false;
                                if(isset($this->data['Students']['logo']) && $this->data['Students']['logo']!=""){
                                   
                                    $filePath = Configure::read('RelativeUrl').'students/';
                                    $fileName = $this->data['Students']['logo'];
                                   
                                    if(file_exists($filePath.$fileName)){
                                        $fileExist =  true;                                       
                                        $fileAbsolutePath = Configure::read('AbsoluteUrl').'students/'.$fileName;
                                    }
                                }
                            ?>
                            <div class='<?php echo ($fileExist==true)?"col-md-3":"col-md-6"; ?>'>
                                <div class="form-group">
                                    <?php
                                        
                                        echo $this->Form->input('logo_image', [
                                            'type' => 'file',						                  
                                            'class'=>'form-control required',
                                            
                                        ]);
                                    ?>
                                </div>
                            </div>
                            <?php 
                                if($fileExist == true){ ?>
                                 <div class='col-md-3'>
                                    <?php
                                        echo $this->Form->input('logo', [
                                            'type' => 'hidden',
                                            'value'=>$fileName              
                                        ]);
                                        echo $this->Html->image($fileAbsolutePath, array('class'=>'d-block w-100'));
                                    ?>
                                </div>
                            <?php  } ?>
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php
                                        //pr(); die;
                                        echo $this->Form->input('sub_title', [
                                            'type' => 'text',						                  
                                            'class'=>'form-control required',
                                            
                                        ]);

                                        
                                    ?>
                                    
                                </div>
                            </div>
                            <?php 
                                if($id == 0): 
                            ?>
                                <div class="col-md-6">
                                    <?php
                                        //pr(); die;
                                        echo $this->Form->input('password', [
                                            'type' => 'password',						                  
                                            'class'=>'form-control required',
                                            
                                        ]);
                                    ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <?php
                                        //pr(); die;
                                        echo $this->Form->input('description', [
                                            'type' => 'textarea',						                  
                                            'class'=>'form-control required',
                                            
                                        ]);
                                    ?>
                                </div>
                            </div>
                            <!--/span-->
                            
                            <!--/span-->
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
                                        'controller' => 'users',
                                        'action' => 'list_groups',
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