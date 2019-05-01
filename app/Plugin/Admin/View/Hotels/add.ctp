<?php 
    echo $this->Html->script([
        '/admin/assets/libs/moment/moment',
        '/admin/assets/libs/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker-custom',
           
    ], array('block' => 'scriptBottom'));
    echo $this->Html->css([
        '/admin/assets/libs/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker',                
           
    ], array('block' => 'cssBottom'));
 ?>
 <?php
    $id = (isset($this->request->params['pass'][0]))?$this->request->params['pass'][0]:0;
    $lbl = ($id==0)?'Add':'Update';

    
?>
<div class="col-12">

    <div class="card">
        <div class="card-body wizard-content">
            <ul class="nav nav-pills m-t-30 m-b-30">
                <li class=" nav-item"> <a href="#s_main" class="nav-link active" data-toggle="tab" aria-expanded="false">Main</a> </li>
                <li class="nav-item "> <a href="#s_reach" class="nav-link" data-toggle="tab" aria-expanded="false">How to Reach</a> </li>
                <li class="nav-item "> <a href="#s_facilities" class="nav-link " data-toggle="tab" aria-expanded="true">Facilities</a> </li>
                <li class="nav-item "> <a href="#s_attractions" class="nav-link " data-toggle="tab" aria-expanded="true">Attractions</a> </li>
                <li class="nav-item "> <a href="#s_policies" class="nav-link " data-toggle="tab" aria-expanded="true">Policies</a> </li>
                <li class="nav-item "> <a href="#s_rooms" class="nav-link " data-toggle="tab" aria-expanded="true">Rooms</a> </li>
                <li class="nav-item "> <a href="#s_rates" class="nav-link " data-toggle="tab" aria-expanded="true">Seasons</a> </li>
                <li class="nav-item "> <a href="#s_extra" class="nav-link " data-toggle="tab" aria-expanded="true">Extra Services</a> </li>
            </ul>
            <div class="tab-content br-n pn">
                <div id="s_main" class="tab-pane fade show in active">
                    <?php echo $this->Form->create('Hotel', ['type' => 'file','id'=>'hotelAdd','class'=>'validation-wizard wizard-circle m-t-40']); ?>
                    <?php 
                    
                        echo $this->Form->input('id', [
                                    'type' => 'hidden'                              
                                ]);
                    
                    ?>
                    <div class="row">
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
                            <div class="form-group">
                                <?php
                                    echo $this->Form->input('phone', [
                                        'type' => 'text',						                  
                                        'class'=>'form-control required',
                                        'required'   => false,
                                    ]);
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-end">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                    echo $this->Form->input('fax', [
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
                                    echo $this->Form->input('email', [
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
                                    echo $this->Form->input('website', [
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
                                    echo $this->Form->input('total_floors', [
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
                                    echo $this->Form->input('total_rooms', [
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
                                    echo $this->Form->input('check_in', [
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
                                    echo $this->Form->input('check_out', [
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
                                    echo $this->Form->input('child_age_limit', [
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
                                    echo $this->Form->input('hotel_category', [
                                        'type' => 'select',						                  
                                        'class'=>'form-control required',
                                        'required'   => false,
                                        'options'=>$categoryList
                                    ]);
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                    echo $this->Form->input('government_approved', [
                                        'type' => 'checkbox',
                                        'div'=> [
                                            'class' => 'form-check form-control-plaintext'
                                        ],						                  
                                        'required'   => false,
                                        'class' => 'form-check-input',
                                        'label' => [
                                            'class'=>'form-check-label'
                                        ]
                                    ]);
                                ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php
                                    echo $this->Form->input('featured_img', [
                                        'type' => 'file',
                                        'div'=>false,
                                        'class'=>'form-control required',						                  
                                        'required'   => false,
                                        'onchange'=>"uploadImage()"
                                        
                                    ]);
                                ?>
                            </div>
                        </div>
                        <div class="col-md-3 img">
                            
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <?php
                                    echo $this->Form->input('video1', [
                                        'type' => 'file',
                                        'div'=>false,
                                        'label'=>'Video',
                                        'class'=>'form-control required',                                         
                                        'required'   => false,
                                        'id'   => 'HotelVideo',
                                        
                                    ]);
                                ?>
                            </div>
                        </div>
                        <div class="col-md-3 video">
                            
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                    echo $this->Form->input('is_active', [
                                        'type' => 'select',
                                        'div'=>false,
                                        'class'=>'form-control required',						                  
                                        'required'   => false,
                                        'options'=>['1'=>'Active',0=>'De-Active']
                                        
                                    ]);
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group has-danger">
                             <?php echo $this->Form->input('is_featured', 
                                array(
                                  'label'=>' is featured ?', 
                                  'type'=>'checkbox',
                                
                                )); ?>
                          </div>
                       </div>
                        
                        
                    </div>
                    <hr>
                    <h3 class="mb-3 text-primary">Contact Person</h3>
                    <div class="row">
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                    echo $this->Form->input('contact_person_name', [
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
                                    echo $this->Form->input('contact_person_designation', [
                                        'type' => 'text',
                                        
                                        'class'=>'form-control required',						                  
                                        'required'   => false,
                                        
                                    ]);
                                ?>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h4>Hotel Highlights</h4>
                    <div class="form-row">
                        
                        <?php
                        if(isset($hotelHighlight) && !empty($hotelHighlight)):
                            $selectedHotel = [];
                        
                        ?>
                            <?php 
                              if(isset($this->request->data['HotelHighlightSelected'])){
                                  
                                  $selectedHotel = $this->request->data['HotelHighlightSelected'];
                                  $selectedHotel =array_column($selectedHotel, 'highlight_id');
                                  $selectedHotel = array_values($selectedHotel);
                              }
                               
                            ?>
                                <div class="col-md-3">
                                        <?php
                                            
                                            echo $this->Form->input('hotel_higlight.', [
                                                'type' => 'select',
                                                					                  
                                                'required'   => false,
                                                'multiple' => 'checkbox',
                                                
                                                'options'=>$hotelHighlight,
                                                'selected'=>$selectedHotel,
                                                'hiddenField'=>false
                                            ]);
                                        ?>
                                        
                                    
                                </div>
                            
                        <?php endif; ?>
                        
                    </div>
                    <hr>

                    <h4>Address Information</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                    echo $this->Form->input('city', [
                                        'type' => 'select',
                                        'class'=>'form-control required',						                  
                                        'required'   => false,
                                        'options'=>$cityList,
                                        'empty'=>'Please Select..'
                                        
                                    ]);
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                    echo $this->Form->input('state', [
                                        'type' => 'select',
                                        'class'=>'form-control ',						                  
                                        'required'   => false,
                                        
                                    ]);
                                ?>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <?php
                                    echo $this->Form->input('address', [
                                        'type' => 'textarea',
                                        'class'=>'form-control required',						                  
                                        'required'   => false,
                                        
                                    ]);
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                    echo $this->Form->input('pincode', [
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
                                    echo $this->Form->input('longitude', [
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
                                    echo $this->Form->input('lattitude', [
                                        'type' => 'text',
                                        'class'=>'form-control required',						                  
                                        'required'   => false,
                                        
                                    ]);
                                ?>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h4>Hotel Description</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <?php
                                    echo $this->Form->input('description', [
                                        'type' => 'textarea',
                                        'class'=>'form-control required',						                  
                                        'required'   => false,
                                        'id'=>'editor1',
                                        'label'=>false
                                        
                                    ]);
                                ?>
                            </div>
                        </div>
                    </div>
                    <h4>Hotel Images</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <ul id="images">
                                <?php if(isset($this->data['HotelImages']) && !empty($this->data['HotelImages'])): ?>
                                    <?php foreach($this->data['HotelImages']  as $image): 
                                            $imageName = $image['file'];
                                            $fileAbPath = Configure::read('AbsoluteUrl').'hotels/thumb/';
                                        
                                        ?>
                                        <li >
                                            <div class="img-thumb" style="background-image:url(<?php echo $fileAbPath.$imageName;?>)">
                                                <a href="javascript:void(0)" class="imgdel" data-imgId="<?php echo $image['id']; ?>" data-action="delete_hotel_images" data-imgName="<?php echo $imageName; ?>" >
                                                    <i class="fas fa-times"></i>
                                                </a>
                                                <input type="hidden" name="data[Hotel][images][]" value="<?php echo $imageName; ?>">
                                                <input type="hidden" name="data[Hotel][alt][]" value="<?php echo $image['alt']; ?>">
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
                                    <input id="files" multiple="true" data-action="hotel_images" data-deleteAction="delete_hotel_images" data-model="Hotel" name="files[]" type="file">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                            
                            <?php 
                                echo $this->Form->button('Next', ['type' => 'submit','class'=>'btn btn-success','id'=>'save']);
                            ?>
                        </div>
                    <?php echo $this->Form->end(); ?>
                </div>
                <div id="s_reach" class="tab-pane fade">
                    <?php echo $this->Form->create('HowToReach', ['type' => 'file','id'=>'HowToReachAdd','url' => 'save_how_to_reach']); ?>
                       
                        <div class="row mb-4">
                            <div class="col-lg-12 text-right">
                                <?php
                                    echo $this->Form->input('hotel_id', [
                                        'type' => 'hidden',						                  
                                        'class'=>'form-control hotel_id',
                                        'value'=>$id
                                    ]);
                                ?>
                                <?php
                                    
                                    echo $this->Html->link(
                                        '<i class="fa fa-plus"></i> Add Entry',
                                        'javascript:void(0)',
                                        [
                                        'escape' => false,
                                        'class'=>'btn btn-success',
                                        'id'=>'add_route'
                                        ]
                                    );
                                ?>
                            </div>
                        </div>
                        <div class="row route_block d-none">
                            <div class="col-md-6 route_block_remove">
                                <div class="card border-info">
                                    <div class="card-header bg-info text-white">
                                    How To Reach 
                                        <div class="card-actions">
                                            
                                            <a class="btn-close Routremoveblock" data-action="close"><i class="ti-close"></i></a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row p-t-20">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <?php
                                                        echo $this->Form->input('type.', [
                                                            'type' => 'select',						                  
                                                            'class'=>'form-control required',
                                                            'required'   => false,
                                                            'options'=>['1'=>'By Rail','2'=>'By Road','3'=>'By Air'],
                                                            'label'=>'Type'
                                                        ]);
                                                    ?>
                                                
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <?php
                                                        echo $this->Form->input('description.', [
                                                            'type' => 'textarea',						                  
                                                            'class'=>'form-control',
                                                            'required'   => true,
                                                            'value'=>'_value',
                                                            'label'=>'Description'
                                                        ]);
                                                    ?>
                                                
                                                </div>
                                            </div>
                                            
                                        </div>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row route_items">
                        <?php if(isset($this->request->data['HowToReach']) && !empty($this->request->data['HowToReach'])){ ?>
                            <?php foreach($this->request->data['HowToReach'] as $howToReach){ ?>
                                <div class="col-md-6 route_block_remove">
                                    <div class="card border-info">
                                        <div class="card-header bg-info text-white">
                                        How To Reach 
                                            <div class="card-actions">
                                                
                                                <a class="btn-close Routremoveblock" data-action="close"><i class="ti-close"></i></a>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row p-t-20">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <?php
                                                            echo $this->Form->input('type.', [
                                                                'type' => 'select',						                  
                                                                'class'=>'form-control required',
                                                                'required'   => false,
                                                                'options'=>['1'=>'By Rail','2'=>'By Road','3'=>'By Air'],
                                                                'label'=>'Type',
                                                                'selected'=>$howToReach['perent_type']
                                                            ]);
                                                        ?>
                                                    
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <?php
                                                            echo $this->Form->input('description.', [
                                                                'type' => 'textarea',						                  
                                                                'class'=>'form-control',
                                                                'required'   => true,
                                                                'value'=>$howToReach['description'],
                                                                'label'=>'Description'
                                                            ]);
                                                        ?>
                                                    
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        
                                        </div>
                                    </div>
                                </div>
                            <?php  } ?>
                        <?php  } ?>
                        </div>
                        <div class="text-right">
                            <?php 
                                echo $this->Form->button('Skip', ['type' => 'button','class'=>'btn text-success btn-link']);
                            ?>
                            <?php 
                                echo $this->Form->button('Next', ['type' => 'submit','class'=>'btn btn-success','id'=>'saveHowToReach']);
                            ?>
                        </div>
                    <?php echo $this->Form->end(); ?>
                </div>
                <div id="s_facilities" class="tab-pane fade">
                    <?php echo $this->Form->create('HotelFacilitiesSelected', ['type' => 'file','id'=>'FacilityAdd','url' => 'save_facility']); ?>
                    <?php
                        echo $this->Form->input('hotel_id', [
                            'type' => 'hidden',						                  
                            'class'=>'form-control hotel_id',
                            'value'=>$id
                        ]);
                    ?>                                       
                    <?php 
                        if(isset($hotelFacility) && !empty($hotelFacility)):
                            if(isset($this->request->data['HotelFacilitiesSelected'])){
                                
                                $selectedFacility = $this->request->data['HotelFacilitiesSelected'];
                                $selectedFacility =array_column($selectedFacility, 'faclities_id');
                                $selectedFacility = array_values($selectedFacility);
                            
                            }
                    ?>
                    <?php foreach($hotelFacility as $facility){  ?>
                        <h4><?php echo $facility['HotelFacilities']['title']; ?></h4>
                        <div class="form-row">
                            
                            <?php

                            if(isset($facility['HotelFacilitiesInfo']) && !empty($facility['HotelFacilitiesInfo'])): ?>
                                <?php foreach($facility['HotelFacilitiesInfo'] as $info): 
                                        $Facitlyid= $info['id'];
                                    ?>
                                    <div class="col-md-3">
                                        <div class="form-check form-control-plaintext">
                                            <input type="checkbox" name="data[HotelFacilitiesSelected][facility_id][]" <?php echo (isset($selectedFacility) && in_array($Facitlyid,$selectedFacility))?'checked="checked"':''; ?> class="form-check-input" value="<?php echo $info['id']; ?>" >
                                            <label  class="form-check-label"><?php echo $info['title']; ?></label>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            
                        </div>
                     <?php } ?>
                    <?php endif; ?>
                    <div class="text-right">
                        <?php 
                            echo $this->Form->button('Skip', ['type' => 'button','class'=>'btn text-success btn-link']);
                        ?>
                        <?php 
                            echo $this->Form->button('Next', ['type' => 'submit','class'=>'btn btn-success','id'=>'saveFacility']);
                        ?>
                    </div>
                    <?php echo $this->Form->end(); ?>
                </div>
                <div id="s_attractions" class="tab-pane fade">
                    <?php echo $this->Form->create('HotelAttraction', ['type' => 'file','id'=>'AttractionAdd','url' => 'save_attraction']); ?>
                    <?php
                        echo $this->Form->input('hotel_id', [
                            'type' => 'hidden',						                  
                            'class'=>'form-control hotel_id',
                            'value'=>$id
                        ]);
                    ?>   
                    <div class="row cards-boxed">
                        <?php if(isset($attractions) && !empty($attractions)): 
                            if(isset($this->request->data['HotelAttraction'])){
                                
                                $selectedAttraction = $this->request->data['HotelAttraction'];
                                $selectedAttraction =array_column($selectedAttraction, 'attraction_id');
                                $selectedAttraction = array_values($selectedAttraction);
                            
                            }
                            
                        ?>
                        <?php foreach($attractions as $attraction): ?>
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="custom-control custom-checkbox">
                                        
                                        <div class="form-check form-control-plaintext">
                                            <input type="checkbox" name="data[HotelAttraction][attractions][]" <?php echo (isset($selectedAttraction) && in_array($attraction['Attraction']['id'],$selectedAttraction))?'checked="checked"':''; ?> class="form-check-input" value="<?php echo $attraction['Attraction']['id']; ?>" >
                                            <label  class="form-check-label">&nbsp;</label>
                                        </div>
                                    </div>
                                    <img class="card-img-top img-responsive" src="http://www.placehold.it/250x166" alt="Card image cap">
                                    <div class="card-body">
                                        <h4 class="card-title"><?php echo $attraction['Attraction']['title']; ?></h4>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach;?>
                        <?php endif; ?>
                    </div>
                    <div class="text-right">
                        <?php 
                            echo $this->Form->button('Skip', ['type' => 'button','class'=>'btn text-success btn-link']);
                        ?>
                        <?php 
                            echo $this->Form->button('Next', ['type' => 'submit','class'=>'btn btn-success','id'=>'saveAttraction']);
                        ?>
                    </div>
                    <?php echo $this->Form->end(); ?>
                </div>
                <div id="s_policies" class="tab-pane fade">
                    <?php echo $this->Form->create('Hotel', ['type' => 'file','id'=>'PolicyAdd','url' => 'save_policy']); ?>
                        <?php
                            echo $this->Form->input('hotel_id', [
                                'type' => 'hidden',						                  
                                'class'=>'form-control hotel_id',
                                'value'=>$id
                            ]);
                        ?>  
                        <?php
                            echo $this->Form->input('hotel_policies', [
                                'type' => 'testarea',						                  
                                'class'=>'form-control',
                                'id'=>'editor2'
                            ]);
                        ?> 
                    <div class="text-right">
                        <?php 
                            echo $this->Form->button('Skip', ['type' => 'button','class'=>'btn text-success btn-link']);
                        ?>
                        <?php 
                            echo $this->Form->button('Next', ['type' => 'submit','class'=>'btn btn-success','id'=>'savePolicy']);
                        ?>
                    </div>                          
                    <?php  echo $this->Form->end(); ?>                           
                    
                </div>
                <div id="s_rooms" class="tab-pane fade">
                    <?php
                        echo $this->Form->input('hotel_id', [
                            'type' => 'hidden',						                  
                            'class'=>'form-control hotel_id',
                            'value'=>$id
                        ]);
                    ?> 
                    <div class="row mb-3">
                        <div class="col-lg-12 text-right">
                            <?php
                                echo $this->Html->link(
                                    '<i class="fa fa-plus"></i> Room',
                                    'javascript:void(0)',
                                    [
                                        'escape' => false,
                                        'class'=>'btn btn-success load_modal',
                                        'data-action'=>'form_room',
                                        'data-model'=>'Room'

                                    ]
                                );
                            ?>
                        </div>
                    </div>
                    <input type="hidden" value="listing_room" id="action"/>
                    <input type="hidden" value="Room" id="model"/>
                   
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">   
                                    <div class="table-responsive">
                                        <table id="datatable" class="table dataTables_wrapper container-fluid dt-bootstrap4 no-footer" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>                                
                                                    <th>Description</th>                                
                                                    <th>Status</th>                                                           
                                                    <th class="nosort">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="s_rates" class="tab-pane fade">
                    <?php echo $this->Form->create('SeasionRate', ['type' => 'file','id'=>'SeasionRateAdd','url' => 'save_SeasionRate']); ?>
                        <div class="row mb-4">
                            <div class="col-lg-12 text-right">
                                <?php
                                    echo $this->Form->input('hotel_id', [
                                        'type' => 'hidden',						                  
                                        'class'=>'form-control hotel_id',
                                        'value'=>$id
                                    ]);
                                ?>
                                <?php
                                    
                                    echo $this->Html->link(
                                        '<i class="fa fa-plus"></i> Add Season',
                                        'javascript:void(0)',
                                        [
                                        'escape' => false,
                                        'class'=>'btn btn-success',
                                        'id'=>'add_season'
                                        ]
                                    );
                                ?>
                            </div>
                        </div>
                        <div class="row season_block d-none">
                            <div class="col-md-6 season_block_remove">
                                <div class="card border-info">
                                    <div class="card-header bg-info text-white">
                                        Season
                                        <div class="card-actions">
                                            
                                            <a class="btn-close removeSeasonblock" data-action="close"><i class="ti-close"></i></a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row p-t-20">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <?php
                                                        echo $this->Form->input('season_name.', [
                                                            'type' => 'text',						                  
                                                            'class'=>'form-control',
                                                            'required'   => true,
                                                            'value'=>'_value',
                                                            'label'=>'Season Name'
                                                            
                                                        ]);
                                                    ?>
                                                
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?php
                                                        echo $this->Form->input('valid_from.', [
                                                            'type' => 'text',						                  
                                                            'class'=>'form-control required datepicker',
                                                            'required'   => true,
                                                            'value'=>'_value',
                                                            'label'=>'Valid From'
                                                        ]);
                                                    ?>
                                                
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?php
                                                        echo $this->Form->input('valid_to.', [
                                                            'type' => 'test',						                  
                                                            'class'=>'form-control required datepicker',
                                                            'required'   => true,
                                                            'value'=>'_value',
                                                            'label'=>'Valid To'
                                                            
                                                        ]);
                                                    ?>
                                                
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?php
                                                        echo $this->Form->input('is_active.', [
                                                            'type' => 'select',						                  
                                                            'class'=>'form-control',
                                                            'required'   => true,
                                                            'options'=>['1'=>'Active','0'=>'De-active'],
                                                            'label'=>'Is Active?'
                                                            
                                                        ]);
                                                    ?>
                                                
                                                </div>
                                            </div>
                                           
                                            
                                        </div>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row season_items">
                        <?php if(isset($this->request->data['SeasionRate']) && !empty($this->request->data['SeasionRate'])){ ?>
                            <?php 
                            foreach($this->request->data['SeasionRate'] as $rate){ 
                              $validFrom =  date('d F Y',strtotime($rate['valid_from']));   
                              $validTo =  date('d F Y',strtotime($rate['valid_to'])) ;  
                                
                            ?>
                                <div class="col-md-6 season_block_remove">
                                    <div class="card border-info">
                                        <div class="card-header bg-info text-white">
                                            Season
                                            <div class="card-actions">
                                                
                                                <a class="btn-close removeSeasonblock" data-action="close"><i class="ti-close"></i></a>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row p-t-20">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <?php
                                                            echo $this->Form->input('season_name.', [
                                                                'type' => 'text',						                  
                                                                'class'=>'form-control',
                                                                'required'   => true,
                                                                'value'=>$rate['season_name'],
                                                                'label'=>'Season Name'
                                                                
                                                            ]);
                                                        ?>
                                                    
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <?php
                                                            echo $this->Form->input('valid_from.', [
                                                                'type' => 'text',						                  
                                                                'class'=>'form-control required datepicker',
                                                                'required'   => true,
                                                                'value'=>$validFrom,
                                                                'label'=>'Valid From'
                                                            ]);
                                                        ?>
                                                    
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <?php
                                                            echo $this->Form->input('valid_to.', [
                                                                'type' => 'test',						                  
                                                                'class'=>'form-control required datepicker',
                                                                'required'   => true,
                                                                'value'=>$validTo,
                                                                'label'=>'Valid To'
                                                                
                                                            ]);
                                                        ?>
                                                    
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <?php
                                                            echo $this->Form->input('is_active.', [
                                                                'type' => 'select',						                  
                                                                'class'=>'form-control',
                                                                'required'   => true,
                                                                'options'=>['1'=>'Active','0'=>'De-active'],
                                                                'label'=>'Is Active?',
                                                                'default'=>$rate['is_active'],
                                                                
                                                            ]);
                                                        ?>
                                                    
                                                    </div>
                                                </div>
                                            
                                                
                                            </div>
                                        
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                        </div>
                        <div class="text-right">
                            <?php 
                                echo $this->Form->button('Skip', ['type' => 'button','class'=>'btn text-success btn-link']);
                            ?>
                            <?php 
                                echo $this->Form->button('Next', ['type' => 'submit','class'=>'btn btn-success','id'=>'saveSeason']);
                            ?>
                        </div>
                    <?php echo $this->Form->end(); ?>
                    
                </div>
                <div id="s_extra" class="tab-pane fade">
                    <?php echo $this->Form->create('HotelExtraService', ['type' => 'file','url' => 'save_extra_service']); ?> 
                    <?php
                        echo $this->Form->input('hotel_id', [
                            'type' => 'hidden',						                  
                            'class'=>'form-control hotel_id',
                            'value'=>$id
                        ]);
                    ?>                                      
                    <?php if(isset($services) && !empty($services)): ?>
                    <h4>Extra Services</h4>
                    <?php 
                        if(isset($this->request->data['HotelExtraService'])){
                                    
                            $selectedExtraService = $this->request->data['HotelExtraService'];
                            $selectedExtraService =array_column($selectedExtraService, 'service_id');
                            $selectedExtraService = array_values($selectedExtraService);
                        
                        }
                    ?>
                    <?php foreach($services as $service){ ?>
                        <div class="form-row">
                           
                            <div class="col-md-3">
                                <div class="form-check form-control-plaintext">
                                    <input type="checkbox" name="data[HotelExtraService][service_id][]" class="form-check-input" <?php echo (isset($selectedExtraService) && in_array($service['Services']['id'],$selectedExtraService))?'checked="checked"':''; ?> value="<?php echo $service['Services']['id']; ?>">
                                    <label for="HotelExtraServiceServiceId" class="form-check-label"><?php echo ucfirst($service['Services']['title']); ?></label>
                                </div>
                               
                                
                            </div>
                        </div>
                     <?php } ?>

                    <?php endif; ?>
                    <div class="text-right">
                       
                        <?php 
                            echo $this->Form->button('Submit', ['type' => 'submit','class'=>'btn btn-success']);
                        ?>
                    </div>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
            
        </div>
    </div>
</div>
