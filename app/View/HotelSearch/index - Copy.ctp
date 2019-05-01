<section class="kh-banner" style="background-image:url('images/package_banner.jpg');">
    <div class="khb-in">
        <div class="container">
            <h2>Hotels</h2>
            <ul class="breadcrumb">
                <li><?php echo $this->Html->link('Home','/pages/home'); ?></li>
                <li><span>Hotel</span></li>
            </ul>
        </div>
    </div>
</section>
<section class="khp-block">
    <div class="container">
        <div class="khpb-content">
            <div class="kmpbf-wizard">
                <div class="kmpbfw-head">
                    <div class="kmpbfwh-left-btn">
                        <a href="#" class="btn btn-pink">Back to Home</a>
                    </div>
                    <div class="kmpbfwh-steps">
                        <ul>
                            <li><a class="active" href="#"><span>01</span> Hotels ></a></li>
                            <li><a href="#"><span>02</span> Extra Services >></a></li>
                            <li><a href="#"><span>03</span> Review >>></a></li>
                            <li><a href="#"><span>04</span> Travellers >>>></a></li>
                            <li><a href="#"><span>05</span> Confirmations <i class="material-icons">check</i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="kmpbfw-content">
                    <div class="kmpbfw-filter">
                        <div class="kmpbfwf-col city">
                            <?php
                                echo $this->Form->input('city', [
                                    'type' => 'select',						                  
                                    'class'=>'form-control citylist',
                                    'options'   => $cityList,
                                    'empty'   => 'Select...',
                                    'selected'=>$cityId,
                                    'label'=>false
                                ]);
                            ?>
									
                        </div>
                        <div class="kmpbfwf-col">
                                <?php
                                    echo $this->Form->input('hotel_select', [
                                        'type' => 'select',						                  
                                        'class'=>'form-control hotelList',                                           
                                        'empty'   => 'Select...',
                                        'id'=>'hotelSelect',
                                        'options'   => $cityHotel,
                                        'selected'=>$hotelId,
                                        'label'=>false
                                    ]);
                                ?>
                        </div>
                        <div class="kmpbfwf-col">
                            <div class="kmpbfwf-col-range">
                                <div class="kmpbfwfcr-col">
                                    <div class="custom-field date-in">
                                        <p>Check In</p>
                                        <input type="date" class="form-control" name="data[HotelSearch][check_in]" value="<?php echo $checkIn; ?>" placeholder="Select Date" />
                                    </div>
                                </div>
                                <div class="kmpbfwfcr-col">
                                    <div class="custom-field date-out">
                                        <p>Check In</p>
                                        <input type="date" class="form-control" name="data[HotelSearch][check_out]" value="<?php echo $checkOut; ?>" placeholder="Select Date" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kmpbfwf-col">
                            <div class="custom-field room">
                                <p>Room Type</p>
                                <?php
                                    echo $this->Form->input('room_type', [
                                        'type' => 'select',						                  
                                        'class'=>'form-control roomList',                                           
                                        'empty'   => 'Select...',
                                        'options'=>$rooms,
                                        'selected'=>$roomId,
                                        'label'=>false
                                    ]);
                                ?>
                            </div>
                        </div>
                        <div class="kmpbfwf-col">
                            <div class="custom-field bed">
                                <p>Bed Type</p>
                                <?php
                                    echo $this->Form->input('bed_type', [
                                        'type' => 'select',						                  
                                        'class'=>'form-control bedList',                                           
                                        'empty'   => 'Select...',
                                        'label'=>false,
                                        'options'=>$bedlist,
                                        'selected'=>$bedTypeId
                                    ]);
                                ?>	
                            </div>
                        </div>
                        <div class="kmpbfwf-col number">
                            <div class="custom-field bed">
                                <p>Room</p>
                                <?php
                                    echo $this->Form->input('no_of_rooms', [
                                        'type' => 'number',						                  
                                        'class'=>'form-control ',
                                        'value'=>$no_of_rooms,
                                        'label'=>false,                                          
                                    ]);
                                ?>	
                            </div>
                        </div>
                        <div class="kmpbfwf-col">
                            <div class="custom-field bed">
                                <p>Adult(>5yrs)</p>
                                <?php
                                    echo $this->Form->input('adult', [
                                        'type' => 'select',						                  
                                        'class'=>'form-control adultList',                                           
                                        'empty'   => 'Select...',
                                        'label'=>false,
                                        'options'=>$adultSelect,
                                        'selected'=>$adultId
                                    ]);
                                ?>
                                
                            </div>
                        </div>
                        <div class="kmpbfwf-col">
                            <div class="custom-field bed">
                                <p>Guest</p>
                                <?php
                                    echo $this->Form->input('guest', [
                                        'type' => 'select',						                  
                                        'class'=>'form-control guestList',                                           
                                        'empty'   => 'Select...',
                                        'label'=>false,
                                        'options'=>$guestSelect,
                                        'selected'=>$guestId
                                    ]);
                                ?>
                            </div>
                        </div>
                        <div class="kmpbfwf-col">
                            <div class="custom-field bed">
                                <p>Child(0-5yrs)</p>
                                <?php
                                    echo $this->Form->input('child', [
                                        'type' => 'select',						                  
                                        'class'=>'form-control childList',                                           
                                        'empty'   => 'Select...',
                                        'label'=>false,
                                        'options'=>$childSelect,
                                        'selected'=>$childId
                                    ]);
                                ?>
                            </div>
                        </div>
                        <div class="kmpbfwf-col btn">
                            <button type="button" class="btn btn-pink"><i class="material-icons">search</i> Search</button>
                        </div>
                    </div>
                    <div class="kmpb-hlist">
                        <div class="kmrms-item">
                            <div class="kmrms-left">
                                <div class="kmrmsl-in">
                                    <img src="images/room_img_01.jpg" alt="" />
                                    <span class="kmrs-aStatus">Available</span>
                                </div>
                            </div>
                            <div class="kmrms-middle">
                                <div class="kmrmsm-head">
                                    <h5><?php echo $availableRoom['Room']['room_type']; ?></h5>
                                    
                                </div>
                                <span class="append">
                                    <p><?php echo $availableRoom['Room']['description']; ?></p>
                                    <div class="kmrms-person">Max Occupancy: <span class="icon-adult"><?php echo $availableBeds['BedType']['adult_beds']; ?></span><span class="icon-child"><?php echo $availableBeds['BedType']['child_beds']; ?></span></div>
                                    <?php  if(!empty($Roomfacility)):?>
                                        <ul class="kmhl-facilities">
                                            <?php foreach($Roomfacility as $facility): ?>
                                                <li><?php echo $facility['RoomFacilityInfo']['title']; ?></li>
                                            <?php endforeach; ?>    
                                        </ul>
                                    <?php endif; ?>
                                </span>
                                <ul class="kmhlfb-link">
                                    <li><a href="javascript:void(0);" data-roomId="<?php echo $roomId;  ?>" data-bedId="<?php echo $bedTypeId;  ?>" class="active get_highlights">Highlights</a></li>
                                    <li><a href="javascript:void(0);" data-hotelId="<?php echo $hotelId;  ?>" class="how_to_reach">How to Reach</a></li>
                                    <li><a href="javascript:void(0);" data-hotelId="<?php echo $hotelId;  ?>" class="facility">Facilities</a></li>
                                    <li><a href="javascript:void(0);" data-hotelId="<?php echo $hotelId;  ?>" class="attraction">Attractions</a></li>
                                    <li><a href="javascript:void(0);">Review</a></li>
                                </ul>
                            </div>
                            <div class="kmrms-right">
                                <div class="kmrms-in">
                                    <p>Rs 2300</p>
                                    <span>Room 1: Adult 1</span>
                                    <a href="hotel-search-services.html" class="btn btn-pink">Book Now</a>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>