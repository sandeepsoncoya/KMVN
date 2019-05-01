<style type="text/css">
  .kmrms-in .form-group {
    font-family: "Poppins";
}
.kmrms-in .form-group label {
    font-size: 0.75rem;
    color: #fff;
    font-weight: 600;
    margin: 0;
}
.kmrms-in .form-control {
    font-size: 0.875rem;
    padding: 0.25rem 0.75rem;
    min-width: 0;
    width: 45px;
    margin: auto;
    border-radius: 0.25rem;
    border: 1px solid #ffffff;
    height: auto;
    background: transparent url("images/dropdown_select.png") no-repeat center right 5px;
    color: #fff;
    -webkit-appearance: none;
    -moz-appearance: none;
}
.kmrms-in .form-control option {
    color: #000;
}

</style>
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
                <?php echo $this->Html->link('Back to home',['controller'=>'hotels','action'=>'index'],['class'=>'btn btn-pink']); ?>
               </div>
               <div class="kmpbfwh-steps">
                  <ul>
                     <li><?php echo $this->Html->link('<span>01</span> Hotels',['controller'=>'hotel_search','action'=>'index'],['class'=>'active','escape'=>false]); ?></li>
                     <li><?php echo $this->Html->link('<span>02</span> Extra Services >>',['controller'=>'hotel_search','action'=>'services'],['class'=>'','escape'=>false]); ?></li>
                     <li><?php echo $this->Html->link('<span>03</span> Review >>>',['controller'=>'hotel_search','action'=>'review'],['class'=>'','escape'=>false]); ?></li>
                     <li><a href="javascript:;"><span>04</span> Travellers >>>></a></li>

                  </ul>
               </div>
            </div>
            <div class="kmpbfw-content">
               <?php echo $this->Form->create('HotelSearch', ['type' => 'file','id' => 'hotelSearch']); ?>
               <div class="kmpbfw-filter">
                  <div class="kmpbfwf-col city">
                      <?php
                        echo $this->Form->input('city', [
                            'type' => 'select',                                       
                            'class'=>'form-control citylist',
                            'options'   => $cityList,
                            'empty'   => 'Select city...',
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
                            'empty'   => 'Select hotel...',
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
                 
                  <div class="kmpbfwf-col btn">
                     <button type="submit" class="btn btn-pink "><i class="material-icons">search</i></button>
                  </div>
               </div>
               </form>
               <div class="text-right mb-3" id="nextdiv">
               <?php
                  $checkServices1 = $this->Session->read('HotelData.RoomSelected');
                  if (!empty($checkServices1)) { 
                   ?>
               <div class="text-right mb-3" id="nextdiv1">
                  <?php echo $this->Form->create('Next', ['url'=>['controller'=>'hotel_search','action'=>'services']]); ?>
                  <button name="submit" type="submit" class="btn btn-pink">Next</button>
                  <?php echo $this->Form->end(); ?>
                </div>
              <?php } ?>
                </div>
               <div class="kmpb-hlist " id="list_hotels">
                  <?php if (!empty($getHotelData)) { 
                     foreach ($getHotelData as $key => $getHotelinfo) { 
                     if ($getHotelinfo['RoomRates']['adult_one_rate'] != null) {
                       ?>
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
                           <?php echo $this->Form->create('HotelData', ['url'=>['controller'=>'hotel_search','action'=>'services'],'class'=>'HotelDataForm']); ?>
                           <div class="form-group">
                             <label>No of Rooms.</label>
                             <select name="data[HotelData][no_of_rooms]" class="form-control">
                              <?php
                                $checkServices1 = $this->Session->read('HotelData.RoomSelected');
                       
                                if ( isset($checkServices1) && array_key_exists($getHotelinfo['BedType']['id'], $checkServices1)) { 
                                 $no_of_rooms =  $checkServices1[$getHotelinfo['BedType']['id']]['no_of_rooms'];
                                 ?>
                               <option value="1" <?php if ($no_of_rooms == 1) echo "selected"; ?> >1</option>
                               <option value="2" <?php if ($no_of_rooms == 2) echo "selected"; ?> >2</option>
                               <option value="3" <?php if ($no_of_rooms == 3) echo "selected"; ?> >3</option>
                               <option value="4" <?php if ($no_of_rooms == 4) echo "selected"; ?> >4</option>
                               <option value="5" <?php if ($no_of_rooms == 5) echo "selected"; ?> >5</option>
                                <?php }else{
                                  ?>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>

                                <?php } ?>
                             </select>
                            
                           </div>
                                <input type="hidden" name="data[HotelData][city]" value="<?php echo $getHotelinfo['Hotel']['city'];  ?>">
                                <input type="hidden" name="data[HotelData][hotel_id]" value="<?php echo $getHotelinfo['Hotel']['id'];  ?>">

                                <input type="hidden" name="data[HotelData][room_id]" value="<?php echo $getHotelinfo['Room']['id'];  ?>">
                                <input type="hidden" name="data[HotelData][rate_id]" value="<?php echo $getHotelinfo['RoomRates']['id'];  ?>">

                                <input type="hidden" name="data[HotelData][room_type]" value="<?php echo $getHotelinfo['Room']['room_type'];  ?>">

                                <input type="hidden" name="data[HotelData][bed_type_id]" value="<?php echo $getHotelinfo['BedType']['id'];  ?>">

                                <input type="hidden" name="data[HotelData][bed_type_title]" value="<?php echo $getHotelinfo['BedType']['title'];  ?>">
                                <input type="hidden" name="data[HotelData][deposit_required]" value="<?php echo $getHotelinfo['RoomRates']['deposit_required'];  ?>">
                                <input type="hidden" name="data[HotelData][is_deposit_refundable]" value="<?php echo $getHotelinfo['RoomRates']['is_deposit_refundable'];  ?>">

                                <input type="hidden" name="data[HotelData][check_in_date]" value="<?php echo $checkIn;  ?>">

                                <input type="hidden" name="data[HotelData][check_out_date]" value="<?php echo $checkOut;  ?>">
                                <input type="hidden" name="data[HotelData][step]" value="1">

                                 <?php
                                $checkServices1 = $this->Session->read('HotelData.RoomSelected');
                                if ( isset($checkServices1) && array_key_exists($getHotelinfo['BedType']['id'], $checkServices1)) { ?>

                                 <button class="btn btn-pink" name="submit" type="submit">Remove</button>
                                <input type="hidden" class="removeid" value="<?php echo $getHotelinfo['BedType']['id'] ?>" name="data[HotelData][removeId]">
                                <?php }else{
                                  ?>
                                  <button class="btn btn-pink" name="submit" type="submit" >Book Now</button>
                                <?php } ?>
                           <?php echo $this->Form->end(); ?>  
                        </div>
                     </div>
                  </div>
                  <?php  } else{ ?>

                  <?php  } ?>

                  <?php } }else{ ?>
                  <p> Please fill all search criteria to get better search results.</p>
                  <?php }?>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<script type="text/javascript">
  $(document).on('submit','.HotelDataForm',function(e){
    e.preventDefault();
    var eve = $(this);
    var formData =  $(this).serialize();
    $.ajax({
      url: siteUrlfront + 'ajax/add_hotel',
      type: "POST",
      data:formData,
      dataType: "json",
      success: function (response) {
         if(response.res == true){
            if(response.remove ==  false){
               $("#nextdiv").load(" #nextdiv1");
               eve.append('<input type="hidden" class="removeid" value="'+response.bedId+'" name="data[HotelData][removeId]" />');
               eve.find('button').html('Remove');
            }else{
               $("#nextdiv").load(" #nextdiv1");
               eve.find('.removeid').remove();
               eve.find('button').html('Book Now');
            }
         }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        swal("Error!", "Please try again", "error");
      }
    });
    return false;

  })
  
</script>