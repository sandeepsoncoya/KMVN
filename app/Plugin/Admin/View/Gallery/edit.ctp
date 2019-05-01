<?php
$id = (isset($this->request->params['pass'][0]))?$this->request->params['pass'][0]:0;
$lbl = ($id==0)?'Add':'Update';

?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-info">
                <h4 class="m-b-0 text-white">Edit Attraction</h4>
            </div>
            <?php echo $this->Form->create('Attraction', ['type' => 'file']); ?>
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
                        </div>
                        <div class="row">
                            
                            <?php
                                 $fileExistFeatured =  false;
                                if(isset($this->data['Attraction']['featured_image']) && $this->data['Attraction']['featured_image']!=""){
                                   
                                    $filePath = Configure::read('RelativeUrl').'attraction/';
                                    $fileNameFeatured = $this->data['Attraction']['featured_image'];                                   
                                    if(file_exists($filePath.$fileNameFeatured)){
                                        $fileExistFeatured =  true;                                       
                                        $fileAbsolutePathFeatured = Configure::read('AbsoluteUrl').'attraction/'.$fileNameFeatured;
                                    }
                                }
                            ?>
                            
                            <div class="<?php echo ($fileExistFeatured==true)?"col-md-3":"col-md-6"; ?>">
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
                            <?php if($fileExistFeatured == true){ ?>
                                 <div class='col-md-3'>
                                    <?php
                                        echo $this->Form->input('featured_image', [
                                            'type' => 'hidden',
                                            'value'=>$fileNameFeatured              
                                        ]);
                                        echo $this->Html->image($fileAbsolutePathFeatured, array('class'=>'d-block w-100'));
                                    ?>
                                </div>
                            <?php  } ?>
                            
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
                        <ul id="images">
                            
                            <?php if(isset($this->data['AttractionImages']) && !empty($this->data['AttractionImages'])): ?>
                                <?php foreach($this->data['AttractionImages']  as $image): 
                                        $imageName = $image['file'];
                                        $fileAbPath = Configure::read('AbsoluteUrl').'attraction/thumb/';
                                    
                                    ?>
                                    <li >
                                        <div class="img-thumb" style="background-image:url(<?php echo $fileAbPath.$imageName;?>)">
                                            <a href="javascript:void(0)" class="imgdel" data-imgId="<?php echo $image['id']; ?>" data-action="delete_attraction_image" data-imgName="<?php echo $imageName; ?>" >
                                                <i class="fas fa-times"></i>
                                            </a>
                                            <input type="hidden" name="data[Attraction][images][]" value="<?php echo $imageName; ?>">
                                            <input type="hidden" name="data[Attraction][alt][]" value="<?php echo $image['alt']; ?>">
                                        </div>
                                    </li>
                                 <?php endforeach; ?>                                            
                            <?php endif; ?>
                        </ul>
                        <div class="position-relative clearfix">
                            <div class="drop">
                                <div class="cont">
                                    <i class="mdi mdi-cloud-download"></i>
                                    <div class="tit">
                                        Drag &amp; Drop
                                    </div>
                                    <div class="desc">
                                        your files to Assets, or 
                                    </div>
                                    <button class="btn btn-warning btn-sm">click here to browse</button>
                                </div>
                                <input id="files" multiple="true" data-action="attraction_images" data-deleteAction="delete_attraction_image" data-model="Attraction" name="files[]" type="file">
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
                                        'controller' => 'attraction',
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