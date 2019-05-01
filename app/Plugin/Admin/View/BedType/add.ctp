<?php
$id = (isset($this->request->params['pass'][0]))?$this->request->params['pass'][0]:0;
$lbl = ($id==0)?'Add':'Update';

?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-info">
                <h4 class="m-b-0 text-white">Bed Type Information</h4>
            </div>
            <?php echo $this->Form->create('BedType', ['type' => 'file']); ?>
                <?php 
               
                    echo $this->Form->input('id', [
                                'type' => 'hidden'                              
                            ]);
                
                ?>
                <div class="form-body">
                    <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                    <?php
                                        echo $this->Form->input('title', [
                                            'type' => 'text',						                  
                                            'class'=>'form-control required',
                                        ]);
                                    ?>
                            
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                    <?php
                                        echo $this->Form->input('adult_beds', [
                                            'type' => 'text',						                  
                                            'class'=>'form-control required',
                                            
                                        ]);
                                    ?>
                            
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                    <?php
                                        echo $this->Form->input('extra_beds', [
                                            'type' => 'text',						                  
                                            'class'=>'form-control required',
                                            
                                        ]);
                                    ?>
                            
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                    <?php
                                        echo $this->Form->input('child_beds', [
                                            'type' => 'text',						                  
                                            'class'=>'form-control required',
                                            'label'=>'Child W/o Bed'                                   
                                        ]);
                                    ?>
                            
                            </div>
                        </div>
                        
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                    echo $this->Form->input('is_active', [
                                        'type' => 'select',
                                        'options'=>['1'=>'Active','0'=>'De-active'],					                  
                                        'class'=>'form-control required',
                                    ]);
                                ?>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h4>Room Facilities</h4>
                    <?php 
                        if(isset($hotelFacility) && !empty($hotelFacility)):
                            if(isset($this->request->data['RoomSelectedFacility'])){
                                
                                $selectedFacility = $this->request->data['RoomSelectedFacility'];
                                $selectedFacility =array_column($selectedFacility, 'bed_type_id');
                                $selectedFacility = array_values($selectedFacility);
                            
                            }
                    ?>
                    <?php foreach($hotelFacility as $facility){  ?>
                        <h4><?php echo $facility['RoomFacility']['title']; ?></h4>
                        <div class="form-row">
                            
                            <?php

                            if(isset($facility['RoomFacilityInfo']) && !empty($facility['RoomFacilityInfo'])): ?>
                                <?php foreach($facility['RoomFacilityInfo'] as $info): 
                                        $Facitlyid= $info['id'];
                                    ?>
                                    <div class="col-md-3">
                                        <div class="form-check form-control-plaintext">
                                            <input type="checkbox" name="data[RoomFacilitySelected][facility_id][]" <?php echo (isset($selectedFacility) && in_array($Facitlyid,$selectedFacility))?'checked="checked"':''; ?> class="form-check-input" value="<?php echo $info['id']; ?>" >
                                            <label  class="form-check-label"><?php echo $info['title']; ?></label>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            
                        </div>
                     <?php } ?>
                    <?php endif; ?>
                        <ul id="images">
                            
                            <?php if(isset($this->data['RoomImages']) && !empty($this->data['RoomImages'])): ?>
                                <?php foreach($this->data['RoomImages']  as $image): 
                                        $imageName = $image['file'];
                                        $fileAbPath = Configure::read('AbsoluteUrl').'room/thumb/';
                                    
                                    ?>
                                    <li >
                                        <div class="img-thumb" style="background-image:url(<?php echo $fileAbPath.$imageName;?>)">
                                            <a href="javascript:void(0)" class="imgdel" data-imgId="<?php echo $image['id']; ?>" data-action="delete_room_image" data-imgName="<?php echo $imageName; ?>" >
                                                <i class="fas fa-times"></i>
                                            </a>
                                            <input type="hidden" name="data[BedType][images][]" value="<?php echo $imageName; ?>">
                                            
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
                                <input id="files" multiple="true" data-action="room_images" data-deleteAction="delete_room_image" data-model="BedType" name="files[]" type="file">
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
                                        'controller' => 'bed_type',
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