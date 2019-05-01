<section class="kh-banner" style="background-image:url('<?php echo Configure::read('siteUrlfront');  ?>/uploads/SiteSettings/<?php  echo $siteSettings['SiteSettings']['package_inner_banner'] ?>');">
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
      <!-- <div class="khpb-head">
         <h3>KMVN Specials Packages </h3>
         </div> -->
      <div class="khpb-content">
         <div class="khpb-dtl">
            <div class="khpbd-main">
               <div class="khpbd-left">
                  <div class="khp-carousel" id="hDetails_Carousel">
                     <?php   if(!empty($hotelDetails['HotelImages'])): ?>
                     <?php foreach ($hotelDetails['HotelImages'] as $key => $hotelImages) : ?>
                     <div class="kmpd-img">
                        <?php
                        $pathfile = Configure::read('RelativeUrl').'hotels/'.$hotelImages['file'];
                        if (file_exists($pathfile) && $hotelImages['file'] != '') {
                           ?>
                           <img src="<?php echo Configure::read('siteUrlfront');  ?>uploads/hotels/<?php  echo $hotelImages['file'] ?>" alt="Details Banner" />

                         
                        <?php }else{ ?>
                          <img src="<?php echo Configure::read('siteUrlfront');  ?>uploads/imagenot.png" alt="">
                       <?php }?>

                     </div>
                     <?php endforeach; ?>
                     <?php endif; ?>
                  </div>
                  <div class="khp-carousel-thumb" id="hDetails_tCarousel">
                     <?php   if(!empty($hotelDetails['HotelImages'])): ?>
                     <?php foreach ($hotelDetails['HotelImages'] as $key => $hotelImages) : ?>
                     <div class="kmpd-img">
                        <?php
                        $pathfile = Configure::read('RelativeUrl').'hotels/thumb/'.$hotelImages['file'];
                        if (file_exists($pathfile) && $hotelImages['file'] != '') {
                           ?>
                           <img src="<?php echo Configure::read('siteUrlfront');  ?>uploads/hotels/thumb/<?php  echo $hotelImages['file'] ?>" alt="Details Banner" />
                        <?php }else{ ?>
                          <img src="<?php echo Configure::read('siteUrlfront');  ?>uploads/imagenot.png" alt="">
                       <?php }?>
                     </div>
                     <?php endforeach; ?>
                     <?php endif; ?>
                  </div>
               </div>
               <div class="khpbd-right hin-details">
                  <div class="kmpbdr-head">
                     <h3><?php  if (isset($hotelDetails['Hotel']['title'])) {
                        echo $hotelDetails['Hotel']['title'];
                        } ?> </h3>
                     <p><?php  if (isset($hotelDetails['Hotel']['address'])) {
                        echo $hotelDetails['Hotel']['address'];
                        } ?></p>
                     <div class="star-rating">
                        <div class="star-rating-in">
                           <i class="fas fa-star"></i>
                           <i class="fas fa-star"></i>
                           <i class="fas fa-star"></i>
                           <i class="fas fa-star"></i>
                           <i class="far fa-star"></i>
                        </div>
                     </div>
                  </div>
                  <div class="kmpbdr-body">
                     <div class="kmpdrb-bx">
                        <h5>General information:</h5>
                        <p><?php  if (isset($hotelDetails['Hotel']['description'])) {
                           echo $hotelDetails['Hotel']['description'];
                           } ?></p>
                     </div>
                     <div class="kmpdrb-bx">
                        <h5>Hotel Highlights:</h5>
                        <ol class="kmpdh-high">
                           <?php if(!empty($hotelDetails['HotelHighlightSelected'])):  ?>
                           <?php foreach ($hotelDetails['HotelHighlightSelected'] as $key => $hotelHighlight) : ?>
                           <?php if ($key < 2) { ?>
                           <li> <?php echo $hotelHighlight['HotelHighlight']['title'];  ?></li>
                           <?php }else{ ?>
                           <li class="d-none"> <?php echo $hotelHighlight['HotelHighlight']['title'];  ?></li>
                           <?php } ?>
                           <?php endforeach; ?>
                           <li>
                              <?php if (count($hotelDetails['HotelHighlightSelected'])-2 > 0 ) { ?>
                              <a href="javascript:;"  id="showhide">+ <?php echo count($hotelDetails['HotelHighlightSelected'])-2; ?> More</a>
                              <?php } ?>
                           </li>
                           <?php endif; ?>
                        </ol>
                     </div>
                     <div class="kmpdrb-bx">
                        <div class="kmpd-check">
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="kmpdc-bx">
                                    <span class="kmpdcb-icon"><img src="<?php echo Configure::read('siteUrlfront');  ?>images/icon_check_in.jpg" alt=""></span>
                                    <h5>Check In</h5>
                                    <p><?php  if (isset($hotelDetails['Hotel']['check_in'])) {
                                       echo $hotelDetails['Hotel']['check_in'];
                                       } ?></p>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="kmpdc-bx">
                                    <span class="kmpdcb-icon"><img src="<?php echo Configure::read('siteUrlfront');  ?>images/icon_check_out.jpg" alt=""></span>
                                    <h5>Check Out:</h5>
                                    <p><?php  if (isset($hotelDetails['Hotel']['check_out'])) {
                                       echo $hotelDetails['Hotel']['check_out'];
                                       } ?></p>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="kmbdt-btm">
               <div class="kmhd-btm">
                  <div class="kmhdb-head">
                     <h3>Hotel Address:</h3>
                     <p><?php  if (isset($hotelDetails['Hotel']['address'])) {
                        echo $hotelDetails['Hotel']['address'];
                        } ?></p>
                  </div>
                  <div class="kmhdb-content">
                     <div class="kmhd-map" id="hotel_map">
                     </div>
                  </div>
               </div>
               <div class="kmhdb-dtls">
                  <ul class="nav nav-tabs nav-justified">
                     <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#tab_description">Description</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab_reach">How to reach</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link " data-toggle="tab" href="#tab_rooms">Rooms</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab_facilities">Facilities</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab_services">Extra Services</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab_policies">Policies</a>
                     </li>
                  </ul>
                  <div class="tab-content">
                     <div id="tab_description" class="tab-pane fade in show active">
                        <div class="kmhd-desc">
                           <p><?php  if (isset($hotelDetails['Hotel']['description'])) {
                              echo $hotelDetails['Hotel']['description'];
                              } ?> </p>
                        </div>
                     </div>
                     <div id="tab_reach" class="tab-pane fade">
                        <?php if (!empty($hotelDetails['HowToReach'])) {

                           foreach ($hotelDetails['HowToReach'] as $key => $howToReach) {
                               ?>
                        <div class="kmrch-item">
                           <div class="kmrch-head">
                              <span><i class="material-icons"><?php if ($howToReach['type'] == 1) {
                                 echo 'directions_bus';
                                 $by = 'Bus';
                                 }elseif($howToReach['type'] == 2){
                                 echo 'train';
                                 $by = 'Train';
                                 }elseif($howToReach['type'] == 3){
                                 echo 'flight_takeoff';
                                  $by = 'Airplane';
                                 }else{
                                 $by = 'Other';
                                 echo 'directions_walk';
                                 } ?> </i></span>
                              <h4>By <?php echo $by; ?>:</h4>
                           </div>
                           <div class="kmrch-content">
                              <p><?php echo $howToReach['description']; ?> </p>
                           </div>
                        </div>
                        <?php  } }else{
                           echo "<p style='text-align:center;'> No data available </p>";
                           } ?>
                     </div>
                     <div id="tab_rooms" class="tab-pane fade ">
                        <div class="kmrms-list">
                           <?php
                           
                            if ($room) {
                             
                              foreach ($room as $key => $roomData) { 
                                  foreach ($roomData['BedTypeHotel'] as $key => $bedTypeHotel) {
                               ?>
                           <div class="kmrms-item">
                              <div class="kmrms-left">
                                 <div class="kmrmsl-in">
                                    <?php
                                     foreach ($bedTypeHotel['RoomImages'] as $key => $image) { ?>
                                       <?php
                                       $pathfile = Configure::read('RelativeUrl').'room/'.$image['file'];
                                       if (file_exists($pathfile) && $image['file'] != '') {
                                          
                                          ?>
                                          <img src="<?php echo Configure::read('siteUrlfront');  ?>uploads/room/thumb/<?php  echo $image['file'] ?>" alt="Details Banner" />
                                       <?php }else{   ?>
                                         <img src="<?php echo Configure::read('siteUrlfront');  ?>uploads/imagenot.png" alt="">
                                      <?php }?>

                                    <?php   } ?>
                                 </div>
                              </div>
                              <div class="kmrms-middle">
                                 <div class="kmrmsm-head">
                                    <h5> <?php
                                     echo $roomData['Room']['room_type'].'-'. $bedTypeHotel['BedType']['title'] ?></h5>
                                    <div class="kmrmsm-input">
                                    </div>
                                 </div>
                                 <p><?php if (isset($roomData['Room']['description'])) {
                                    $description = strlen($roomData['Room']['description']) > 100 ? substr($roomData['Room']['description'],0,100)."..." : $roomData['Room']['description'];
                                     echo $description;
                                    } ?>
                                    <a href="javascript:;" data-toggle="modal" data-target="#myModal_<?php echo $roomData['Room']['id'] ?>"> More Details</a>
                                 <div id="myModal_<?php echo $roomData['Room']['id'] ?>" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                       <!-- Modal content-->
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <h4 class="modal-title">Description</h4>
                                          </div>
                                          <div class="modal-body">
                                             <p><?php echo $roomData['Room']['description'] ?></p>
                                          </div>
                                          <div class="modal-footer">
                                             <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 </p>
                                 <div class="kmrms-person">Max Occupancy: <span class="icon-adult"><?php echo $bedTypeHotel['BedType']['adult_beds']; ?></span><span class="icon-child"><?php echo $bedTypeHotel['BedType']['child_beds']; ?></span></div>
                                 <ul class="kmhl-facilities">
                                    <?php foreach ($bedTypeHotel['BedType']['RoomSelectedFacility'] as $key => $roomSelectedFacility) {   
                                       foreach ($roomSelectedFacility['RoomFacilityInfo'] as $key => $value) {
                                       ?>
                                    <li><?php echo $value['title'] ?></li>
                                    <?php } }  ?>
                                 </ul>
                              </div>
                              <div class="kmrms-right">
                                 <div class="kmrms-in">

                                    <?php echo $this->Form->create('HotelSearch', ['url'=>['controller'=>'hotel_search','action'=>'index']]); ?>
                                        <input type="hidden" name="data[HotelSearch][hotel_select]" value="<?php echo $hotelid ?>">
                                        <input type="hidden" name="data[HotelSearch][city]" value="<?php echo $hotelDetails['Hotel']['city'] ?>">

                                        <input type="hidden" name="data[HotelSearch][room_type]" value="<?php echo $roomData['Room']['id'] ?>">
                                        <input type="hidden" name="data[HotelSearch][bed_type]" value="<?php echo $bedTypeHotel['BedType']['id']?>">
                                        <input type="hidden" name="data[HotelSearch][no_of_rooms]" value="1">
                                        <input type="hidden" name="data[HotelSearch][adult]" value="1">
                                        <input type="hidden" name="data[HotelSearch][child]" value="1">
                                        <input type="hidden" name="data[HotelSearch][guest]" value="1">
                                        <input type="hidden" name="data[HotelSearch][check_in]" value="<?php echo date('Y-m-d', time()) ?>">
                                        <input type="hidden" name="data[HotelSearch][check_out]" value="<?php echo date('Y-m-d', strtotime(' +1 day')) ?>">
                                       <?php
                                       if (isset($seasionRate['SeasionRate']['id'])) {
                                           $seasionRate_id = $seasionRate['SeasionRate']['id'];
                                       }else{
                                          $seasionRate_id = '';
                                       }
                                       
                                        $rateData = $this->App->getBedRates($hotelid,$roomData['Room']['id'],$bedTypeHotel['BedType']['id'],$seasionRate_id);
                                        if(isset($rateData['RoomRates']['adult_one_rate']))
                                            { ?>
                                            <p>
                                       <?php echo $rateData['RoomRates']['adult_one_rate'];
                                         ?></p> <button name="submit" type="submit" class="btn btn-pink">Book Now</button>
                                         <?php } ?>
                                          <?php echo $this->Form->end(); ?>
                                 </div>
                              </div>
                           </div>
                           <?php } } }else{ ?>
                           <p style='text-align:center;'>No Rooms Available</p>
                           <?php } ?>
                        </div>
                     </div>
                     <div id="tab_facilities" class="tab-pane fade">

                       <?php    if(!empty($hotelDetails['HotelFacilitiesSelected'])){ ?>
                           <?php  $previousTitle =  "";
                           $i= 0;
                           foreach($hotelDetails['HotelFacilitiesSelected'] as $value): 
                           ?>
                           <?php if($value['HotelFacilitiesInfo']['HotelFacilities']['title'] !=  $previousTitle): ?>
                           <?php if($i >0):?>
                           </ul>
                               </div>
                           <?php endif; ?>
                               <div class="kmhdbf-item">
                                   <h5><?php echo $value['HotelFacilitiesInfo']['HotelFacilities']['title']; ?></h5>
                                   <ul class="kmhl-facilities">
                           <?php endif; ?>
                                       <li><?php echo $value['HotelFacilitiesInfo']['title']; ?></li>
                                  
                           <?php       $previousTitle = $value['HotelFacilitiesInfo']['HotelFacilities']['title']; 
                           $i++;
                           endforeach;?>
                        </div>
                           <?php }else{?>
                              <p style='text-align:center;'> No data available </p>
                           <?php } ?>
                           <div class="clearfix"></div>

                  </div>
                     <div id="tab_services" class="tab-pane fade">
                        <?php  if (!empty($hotelDetails['HotelExtraService'])) {
                           foreach ($hotelDetails['HotelExtraService'] as $key => $hotelExtraService) { ?>
                        <div class="kmbdes-bx">
                           <div class="kmbdesb-img"><img src="<?php echo Configure::read('siteUrlfront');  ?>/uploads/services/<?php  echo $hotelExtraService['Services']['featured_image'] ?>" alt=""/></div>
                           <div class="kmbdesb-dtl">
                              <h4><?php if (isset($hotelExtraService['Services']['title'])) {
                                 echo $hotelExtraService['Services']['title'];
                                 } ?></h4>
                              <p><?php if (isset($hotelExtraService['Services']['description'])) {
                                 echo $hotelExtraService['Services']['description'];
                                 } ?></p>
                              <div class="kmbdes-price"><span>Rs 2500</span> 
                                 <a  data-toggle="modal" data-target="#myModal_<?php echo $hotelExtraService['Services']['id'] ?>">(Terms & Condition apply)</a> 
                              </div>
                              <div id="myModal_<?php echo $hotelExtraService['Services']['id'] ?>" class="modal fade" role="dialog">
                                 <div class="modal-dialog">
                                    <div class="modal-content">
                                       <div class="modal-header">
                                          <h4 class="modal-title">Terms & Conditions</h4>
                                       </div>
                                       <div class="modal-body">
                                          <p><?php if (isset($hotelExtraService['Services']['terms_and_conditions'])) {
                                             echo $hotelExtraService['Services']['terms_and_conditions'];
                                             } ?></p>
                                       </div>
                                       <div class="modal-footer">
                                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <?php } }else{
                           echo "<p style='text-align:center;'> No data available </p>";
                           } ?>
                     </div>
                     <div id="tab_policies" class="tab-pane fade">
                        <div class="kmbdtb-block">
                           <div class="kmbdtb-head">
                              <h4>Policies:</h4>
                           </div>
                           <div class="kmbdtb-content">
                              <?php  if (!empty($hotelDetails['Hotel']['hotel_policies'])) {
                                 echo $hotelDetails['Hotel']['hotel_policies'];
                                 }else{
                                 echo "No data available";
                                 } ?>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script type="text/javascript">
   $("#showhide").click(function(){
     $("li").removeClass("d-none");
     $("#showhide ").addClass("d-none");
   });
</script>
<script type="text/javascript">
   $(document).ready(function(){
       // Load more data
       $('.BedTypeHotel').on('change',function(){
           var inst = $(this);
           var bed_type_id = $(this).val();
           if (bed_type_id !='') {
               var hotelid = '<?php echo $hotelid; ?>';
               var roomid = $(this).siblings('.room-id').val();
                   $.ajax({
                       url: siteUrlfront+'ajax/loadhoteldetails',
                       type: 'post',
                       data: {bed_type_id:bed_type_id,hotelid:hotelid,roomid:roomid},
                       success: function(response){
                           $('.filldata_'+inst.siblings('.room-id').val()).html(response);
                       }
                   });
               }
       });
   
   });
</script>
<script type="text/javascript">
   var lat = <?php echo $hotelDetails['Hotel']['lattitude'] ?>;
   var long = <?php echo $hotelDetails['Hotel']['longitude'] ?>;
   // Initialize and add the map
   
   loc = { lat: lat, lng: long };
  
</script>