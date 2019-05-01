<div class="kmrms-list">
    <div class="kmrms-item">
        <div class="kmrms-left">
            <div class="kmrmsl-in">
                <?php 
                    if (!empty($roomdata[0]['BedType']['RoomImages'])) {
                    ?>
                 <img src="<?php echo Configure::read('siteUrlfront');  ?>uploads/room/<?php  echo $roomdata[0]['BedType']['RoomImages'][0]['file'] ?>" alt="" />
                    <?php  } ?>
            </div>
        </div>
        <div class="kmrms-middle">
            <div class="kmrmsm-head">
                <h5><?php echo $room[0]['Room']['room_type'] ?></h5>
                <div class="kmrmsm-input">
                    <?php     if (!empty($roomdata[0]['BedType']) && isset($roomdata[0]['BedType'])) { ?>
                    <select name="bed_type_id" id="BedTypeHotel" class="form-control BedTypeHotel">
                        <option value="">Select bed type</option>
                        <?php 
                        foreach ($bedTypeHotel as $key => $bedTypeHotel) { 
                            if ( $bedTypeHotel['BedType']['id'] == $bed_type_id) {
                            	$selected = 'selected';
                            }else{
                            	$selected = '';
                            }
                          ?>
                        <option value="<?php echo $bedTypeHotel['BedType']['id']; ?>" <?php echo $selected; ?>><?php echo $bedTypeHotel['BedType']['title']; ?></option>
                        <?php }  ?>
                    </select>
                    <input type="hidden" class="room-id" name="roomid" value="<?php echo $room[0]['Room']['id'] ?>">
                    <?php } ?>
                </div>
            </div>
            <p>
            	<?php if (isset($room[0]['Room']['description'])) {
                                $description = strlen($room[0]['Room']['description']) > 100 ? substr($room[0]['Room']['description'],0,100)."..." : $room[0]['Room']['description'];
                                 echo $description;
                            } ?>
                        <a href="javascript:;" data-toggle="modal" data-target="#myModal_<?php echo $room[0]['Room']['id'] ?>"> More Details</a>
                    <div id="myModal_<?php echo $room[0]['Room']['id'] ?>" class="modal fade" role="dialog">
                          <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title">Description</h4>
                              </div>
                              <div class="modal-body">
                                <p><?php echo $room[0]['Room']['description'] ?></p>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            </div>

                          </div>
                    </div>

         
            <div class="kmrms-person">Max Occupancy: <span class="icon-adult"><?php echo $roomdata[0]['BedType']['adult_beds']; ?></span><span class="icon-child"><?php echo $roomdata[0]['BedType']['child_beds']; ?></span></div>
         
            <ul class="kmhl-facilities">
                <?php 
                if (!empty($roomdata[0]['BedType']['RoomSelectedFacility'])) {
                    foreach ($roomdata[0]['BedType']['RoomSelectedFacility'] as $key => $selectedFacility) {
                    foreach ($selectedFacility['RoomFacilityInfo'] as $key => $roomFacility) {
                 ?>
                <li><?php echo $roomFacility['title'] ?></li>
                <?php }} } ?>
            </ul>
           
        </div>
        <div class="kmrms-right">
            <div class="kmrms-in">
                <?php echo $this->Form->create('HotelSearch', ['url'=>['controller'=>'hotel_search','action'=>'index']]); ?>
            <input type="hidden" name="data[HotelSearch][hotel_select]" value="<?php echo $hotelid ?>">
            <input type="hidden" name="data[HotelSearch][city]" value="<?php echo $hotelCity['Hotel']['city'] ?>">

            <input type="hidden" name="data[HotelSearch][room_type]" value="<?php echo $room[0]['Room']['id'] ?>">
            <input type="hidden" name="data[HotelSearch][bed_type]" value="<?php echo $bed_type_id ?>">
            <input type="hidden" name="data[HotelSearch][no_of_rooms]" value="1">
            <input type="hidden" name="data[HotelSearch][adult]" value="1">
            <input type="hidden" name="data[HotelSearch][child]" value="1">
            <input type="hidden" name="data[HotelSearch][guest]" value="1">
            <input type="hidden" name="data[HotelSearch][check_in]" value="<?php echo date('Y-m-d', time()) ?>">
            <input type="hidden" name="data[HotelSearch][check_out]" value="<?php echo date('Y-m-d', strtotime(' +1 day')) ?>">
                <?php
                  $rateData = $this->App->getBedRates($hotelid,$room[0]['Room']['id'],$bed_type_id);
                if(isset($rateData['RoomRates']['adult_one_rate']))
                    { ?>
                    <p>
               <?php echo $rateData['RoomRates']['adult_one_rate'];
                 ?></p> <button name="submit" type="submit" class="btn btn-pink">Book Now</button>
                 </form>
            <?php } ?>
            </div>
        </div>
    </div>
</div>
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