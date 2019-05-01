<?php
$id = (isset($this->request->params['pass'][0]))?$this->request->params['pass'][0]:0;
$lbl = ($id==0)?'Add':'Update';

?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-info">
                <h4 class="m-b-0 text-white">Category Information</h4>
            </div>
            <?php echo $this->Form->create('Category', ['type' => 'file']); ?>
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
                                        echo $this->Form->input('type', [
                                            'type' => 'select',						                  
                                            'class'=>'form-control required',                                            
                                            'options'=>['1'=>'CMS','2'=>'Product'],
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
                                if(isset($this->data['Category']['banner_image']) && $this->data['Category']['banner_image']!=""){
                                   
                                    $filePath = Configure::read('RelativeUrl').'category/';
                                    $fileNameBanner = $this->data['Category']['banner_image'];                                   
                                    if(file_exists($filePath.$fileNameBanner)){
                                        $fileExistBanner =  true;                                       
                                        $fileAbsolutePathBanner = Configure::read('AbsoluteUrl').'category/'.$fileNameBanner;
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
                                        echo $this->Form->input('banner_image', [
                                            'type' => 'hidden',
                                            'value'=>$fileNameBanner              
                                        ]);
                                        echo $this->Html->image($fileAbsolutePathBanner, array('class'=>'d-block w-100'));
                                    ?>
                                </div>
                            <?php  } ?>
                            <?php
                                 $fileExist =  false;
                                if(isset($this->data['Category']['featured_image']) && $this->data['Category']['featured_image']!=""){
                                   
                                    $filePath = Configure::read('RelativeUrl').'category/';
                                    $fileName = $this->data['Category']['featured_image'];                                   
                                    if(file_exists($filePath.$fileName)){
                                        $fileExist =  true;                                       
                                        $fileAbsolutePath = Configure::read('AbsoluteUrl').'category/thumb/'.$fileName;
                                    }
                                }
                            ?>
                            
                            <div class="<?php echo ($fileExist==true)?"col-md-3":"col-md-6"; ?>">
                                <div class="form-group has-success">
                                     <?php
                                        echo $this->Form->input('featured_img', [
                                            'type' => 'file',						                  
                                            'class'=>'form-control required',
                                            'required'   => false,
                                            'label'=>'Featured Image'
                                        ]);
                                    ?>
                                </div>
                            </div>
                            <?php if($fileExist == true){ ?>
                                 <div class='col-md-3'>
                                    <?php
                                        echo $this->Form->input('featured_image', [
                                            'type' => 'hidden',
                                            'value'=>$fileName              
                                        ]);
                                        echo $this->Html->image($fileAbsolutePath, array('class'=>'d-block w-100'));
                                    ?>
                                </div>
                            <?php  } ?>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group has-danger">
                                    <?php
                                        echo $this->Form->input('position', [
                                            'type' => 'select',						                  
                                            'class'=>'form-control required',                                            
                                            'options'=>['1'=>'None','2'=>'Menu','3'=>'Home Page','4'=>'Home & Menu Both'],
                                            'empty'=>'Please Select...',
                                            'required'   => false,
                                        ]);
                                    ?>
                                </div>
                            </div>
                          
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php
                                        echo $this->Form->input('status', [
                                            'type' => 'select',						                  
                                            'class'=>'form-control required',
                                            'required'   => false,
                                            'options'=>['1'=>'Active','0'=>'In-active']
                                            
                                        ]);
                                    ?>
                                </div>
                            </div>
                            
                        </div>
                       
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <?php
                                        echo $this->Form->input('short_description', [
                                            'type' => 'textarea',						                  
                                            'class'=>'form-control required',
                                            'required'   => false,
                                            'id'=>'editor2'
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
                                            'id'=>'editor1'
                                        ]);
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php
                                        echo $this->Form->input('meta_title', [
                                            'type' => 'text',						                  
                                            'class'=>'form-control required',
                                            'required'   => false,
                                            
                                        ]);
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php
                                        echo $this->Form->input('meta_keyword', [
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
                                        echo $this->Form->input('meta_description', [
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
                                        'controller' => 'category',
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