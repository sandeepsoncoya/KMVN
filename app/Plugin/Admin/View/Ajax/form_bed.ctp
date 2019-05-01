<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Add <?php echo preg_replace('/([a-z])([A-Z])/s','$1 $2', $modelName);  ?></h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <?php echo $this->Form->create($modelName, ['type' => 'file','id'=>'addFromRoom','url' => 'save_bed']); ?>
        <div class="modal-body">
                <?php 
                    
                        echo $this->Form->input('id', [
                                    'type' => 'hidden'                              
                                ]);
                   
                    echo $this->Form->input('room_id', [
                        'type' => 'hidden',
                        'value'=>$roomId                             
                    ]);
                ?>
               
                <input type="hidden" value="<?php echo $modelName ?>" name="model" />
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <?php
                            echo $this->Form->input('bed_type', [
                                'type' => 'select',						                  
                                'class'=>'form-control required',
                                'options'=>$bedType
                            ]);
                        ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <?php
                            echo $this->Form->input('no_of_rooms', [
                                'type' => 'text',						                  
                                'class'=>'form-control required',
                                
                            ]);
                        ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                        <?php
                            echo $this->Form->input('description', [
                                'type' => 'textarea',						                  
                                'class'=>'form-control required',
                                
                            ]);
                        ?>
                   
                </div>
                <ul id="imagesBedType">
                    <?php if(!empty($bedTypeImages)):?>
                        <?php foreach($bedTypeImages as $image):
                                $imageName = $image['RoomImages']['file'];
                                $fileAbPath = Configure::read('AbsoluteUrl').'room/thumb/';
                            
                            ?>
                            <li >
                                <div class="img-thumb" style="background-image:url(<?php echo $fileAbPath.$imageName;?>)">
                                    <a href="javascript:void(0)" class="imgdel" data-imgId="<?php echo $image['RoomImages']['id']; ?>" data-action="delete_room_image" data-imgName="<?php echo $imageName; ?>" >
                                        <i class="fas fa-times"></i>
                                    </a>
                                    <input type="hidden" name="data[BedTypeHotel][images][]" value="<?php echo $imageName; ?>">
                                    
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
                        <input id="filesRoom" multiple="true" data-action="room_images" data-deleteAction="delete_room_image" data-model="BedTypeHotel" name="files[]" type="file">
                    </div>
                </div>
                <div class="form-group">
                    <?php
                        echo $this->Form->input('is_active', [
                            'type' => 'select',						                  
                            'class'=>'form-control required',
                            'options'=>['1'=>'Active','0'=>'In-active']
                        ]);
                    ?>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
            <?php 
                echo $this->Form->button(' <i class="fa fa-check"></i> Save', ['type' => 'submit','class'=>'btn btn-success','id'=>'saveroom']);
            ?>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>
</div>