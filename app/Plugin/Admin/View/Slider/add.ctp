<?php
$id = (isset($this->request->params['pass'][0]))?$this->request->params['pass'][0]:0;
$lbl = ($id==0)?'Add':'Update';

?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-info">
                <h4 class="m-b-0 text-white">Slide Information</h4>
            </div>
            <?php echo $this->Form->create('Slider', ['type' => 'file']); ?>
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
                                        echo $this->Form->input('status', [
                                            'type' => 'select',						                  
                                            'class'=>'form-control required',                                            
                                            'options'=>['1'=>'Active','0'=>'In-avtive'],
                                            'empty'=>'Please Select...',
                                            'required'   => false,
                                        ]);
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <?php
                                 $fileExistBanner =  false;
                                if(isset($this->data['Slider']['image']) && $this->data['Slider']['image']!=""){
                                   
                                    $filePath = Configure::read('RelativeUrl').'slider/';
                                    $fileNameBanner = $this->data['Slider']['image'];                                   
                                    if(file_exists($filePath.$fileNameBanner)){
                                        $fileExistBanner =  true;                                       
                                        $fileAbsolutePathBanner = Configure::read('AbsoluteUrl').'slider/'.$fileNameBanner;
                                    }
                                }
                            ?>
                            <div class="<?php echo ($fileExistBanner==true)?"col-md-3":"col-md-6"; ?>">
                                <div class="form-group has-success">
                                    <?php
                                        echo $this->Form->input('banner_img', [
                                            'type' => 'file',						                  
                                            'class'=>'form-control required', 
                                            'label'=>'Banner Image'                                       
                                           
                                        ]);
                                    ?>
                                </div>
                            </div>
                            <?php if($fileExistBanner == true){ ?>
                                 <div class='col-md-3'>
                                    <?php
                                        echo $this->Form->input('image', [
                                            'type' => 'hidden',
                                            'value'=>$fileNameBanner              
                                        ]);
                                        echo $this->Html->image($fileAbsolutePathBanner, array('class'=>'d-block w-100'));
                                    ?>
                                </div>
                            <?php  } ?>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php
                                        echo $this->Form->input('link', [
                                            'type' => 'text',						                  
                                            'class'=>'form-control required',
                                            'required'   => false,
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
                                        'controller' => 'slider',
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