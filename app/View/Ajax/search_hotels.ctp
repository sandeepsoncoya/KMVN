<?php if (!empty($getHotelData)) { 
                        foreach ($getHotelData as $key => $getHotelinfo) {   ?>
                        <div class="kmrms-item">
                            <div class="kmrms-left">
                                <div class="kmrmsl-in">
                                    <img src="<?php echo Configure::read('siteUrlfront');  ?>uploads/room/<?php  echo $getHotelinfo['RoomImages']['file'] ?>" alt="" />
                                    <span class="kmrs-aStatus">Available</span>
                                </div>
                            </div>
                            <div class="kmrms-middle">
                                <div class="kmrmsm-head">
                                    <h5><?php echo $getHotelinfo['Room']['room_type'].'-'.$getHotelinfo['BedType']['title']; ?></h5>
                                </div>
                                <span class="append_<?php echo $getHotelinfo['BedType']['id']; ?>">
                                    <p><?php echo $getHotelinfo['Room']['description']; ?></p>
                                    <div class="kmrms-person">Max Occupancy: <span class="icon-adult"><?php echo $getHotelinfo['BedType']['adult_beds']; ?></span><span class="icon-child"><?php echo $getHotelinfo['BedType']['child_beds']; ?></span></div>
                                    <?php  if(isset($Roomfacility)):?>
                                        <ul class="kmhl-facilities">
                                            <?php foreach($Roomfacility as $facility): ?>
                                                <li><?php echo $facility['RoomFacilityInfo']['title']; ?></li>
                                            <?php endforeach; ?>    
                                        </ul>
                                    <?php endif; ?>
                                </span>
                                <ul class="kmhlfb-link bedtype_<?php echo $getHotelinfo['BedType']['id'];  ?>">
                                    <li><a href="javascript:void(0);" data-roomId="<?php echo $getHotelinfo['Room']['id'];  ?>" data-bedId="<?php echo $getHotelinfo['BedType']['id'];  ?>" class="active get_highlights" >Highlights</a></li>

                                    <li><a href="javascript:void(0);" data-hotelId="<?php echo $getHotelinfo['Hotel']['id'];  ?>" data-bedId="<?php echo $getHotelinfo['BedType']['id'];  ?>" class="how_to_reach" >How to Reach</a></li>

                                    <li><a href="javascript:void(0);" data-hotelId="<?php echo $getHotelinfo['Hotel']['id'];   ?>" data-bedId="<?php echo $getHotelinfo['BedType']['id'];  ?>" class="facility" >Facilities</a></li>

                                    <li><a href="javascript:void(0);" data-hotelId="<?php echo $getHotelinfo['Hotel']['id'];   ?>" data-bedId="<?php echo $getHotelinfo['BedType']['id'];  ?>" class="attraction" >Attractions</a></li>

                                    <li><a href="javascript:void(0);">Review</a></li>
                                </ul>
                            </div>
                            <div class="kmrms-right">
                                <div class="kmrms-in">
                                    <p><?php echo $getHotelinfo['RoomRates']['adult_one_rate']  ?></p>
                                    <span>Room 1: Adult <?php echo $getHotelinfo['BedType']['adult_beds']; ?></span>
                                    <?php echo $this->Form->create('HotelData', ['url'=>['controller'=>'hotel_search','action'=>'services']]); ?>
                                    <input type="hidden" name="data[HotelData][city]" value="<?php echo $getHotelinfo['Hotel']['city'];  ?>">

                                <input type="hidden" name="data[HotelData][hotel_id]" value="<?php echo $getHotelinfo['Hotel']['id'];  ?>">

                                <input type="hidden" name="data[HotelData][room_id]" value="<?php echo $getHotelinfo['Room']['id'];  ?>">

                                <input type="hidden" name="data[HotelData][room_type]" value="<?php echo $getHotelinfo['Room']['room_type'];  ?>">

                                <input type="hidden" name="data[HotelData][bed_type_id]" value="<?php echo $getHotelinfo['BedType']['id'];  ?>">

                                <input type="hidden" name="data[HotelData][bed_type_title]" value="<?php echo $getHotelinfo['BedType']['title'];  ?>">

                                <input type="hidden" name="data[HotelData][adult_one_rate]" value="<?php echo $getHotelinfo['RoomRates']['adult_one_rate'];  ?>">

                                <input type="hidden" name="data[HotelData][adult_one_tax]" value="<?php echo $getHotelinfo['RoomRates']['adult_one_tax'];  ?>">

                                <input type="hidden" name="data[HotelData][extra_bed]" value="<?php echo $getHotelinfo['RoomRates']['extra_bed'];  ?>">

                                <input type="hidden" name="data[HotelData][extra_bed_tax]" value="<?php echo $getHotelinfo['RoomRates']['extra_bed_tax'];  ?>">

                                <input type="hidden" name="data[HotelData][deposit_required]" value="<?php echo $getHotelinfo['RoomRates']['deposit_required'];  ?>">

                                <input type="hidden" name="data[HotelData][is_deposit_refundable]" value="<?php echo $getHotelinfo['RoomRates']['is_deposit_refundable'];  ?>">
                                <input type="hidden" name="data[HotelData][rate_id]" value="<?php echo $getHotelinfo['RoomRates']['id'];  ?>">

                                <input type="hidden" name="data[HotelData][no_of_childs]" value="<?php echo $childId;  ?>">

                                <input type="hidden" name="data[HotelData][no_of_adults]" value="<?php echo $adultId;  ?>">

                                <input type="hidden" name="data[HotelData][no_of_rooms]" value="<?php echo $no_of_rooms;  ?>">

                                <input type="hidden" name="data[HotelData][check_in_date]" value="<?php echo $checkIn;  ?>">
                                
                                <input type="hidden" name="data[HotelData][check_out_date]" value="<?php echo $checkOut;  ?>">

                            <button name="submit" type="submit" class="btn btn-pink">Book Now</button>
                           <?php echo $this->Form->end(); ?>

                                </div>
                            </div>
                        </div>
                        <?php } }else{ ?>
                            <p> Please fill all search criteria to get better search results.</p>
                        <?php }?>