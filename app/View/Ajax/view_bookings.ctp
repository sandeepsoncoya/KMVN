
<div class="col-md-12">
	<div class="bk-table">
	    <div class="table-responsive">
	        <table class="table table-bordered">
	            <thead>
	                <tr>
	                    <th>Sr</th>
	                    <th>Booking id </th>
	                    <th>Hotel Details</th>
	                </tr>
	            </thead>
	            <tbody>

	                <?php
	                if(!empty($bookings)){
	                    $sr = 1;
	                    $i = 0;
	                    foreach ($bookings as $booking_id =>  $reservation) {
	                    	//$currentDate = date("Y-m-d");
	                    	$currentDate = '2019-04-15';
	                    	$check_in_date = $reservation[$i]['RoomReservation']['check_in'];
	                    	$bed_id = $reservation[$i]['RoomReservation']['bed_id'];
	                    	$room_id = $reservation[$i]['RoomReservation']['room_id'];
	                    ?>
	                        <tr>
	                            <td><?= $sr; ?></td>
	                            <td><?= $booking_id; ?> <?php if ($currentDate < $check_in_date) { ?> <br><br> <button onclick="cancelBooking('<?php echo $booking_id ?>', '<?php echo $room_id ?>', '<?php echo $bed_id ?>')" class="btn btn-pink cancel">Cancel</button> <?php }else{ ?> 
	                            	<br><br> <button class="btn btn-pink">Rating</button> <?php }?> </td>
	                            <td>
	                                <table>
	                                    <tbody>
	                                        <tr>
	                                            <th>Room</th>
	                                            <th>Bed Type</th>
	                                            <th>Adults</th>
	                                            <th>Child</th>
	                                            <th>Total amount</th>
	                                            <th>Checkin</th>
	                                            <th>checkout</th>
	                                            <th>No of rooms</th>
	                                        </tr>
	                                        <?php foreach ($reservation as $data) { ?>
	                                        <tr>
	                                            <td><?= $data['RoomReservation']['room_type']; ?></td>
	                                            <td><?= $data['RoomReservation']['bed_type_name']; ?></td>
	                                            <td><?= $data['RoomReservation']['adults']; ?></td>
	                                            <td><?= $data['RoomReservation']['child']; ?></td>
	                                            <td><?= $data['RoomReservation']['total_amount']; ?></td>
	                                            <td><?= date('d-M-Y D', strtotime($data['RoomReservation']['check_in'])); ?></td>
	                                            <td><?= date('d-M-Y D', strtotime($data['RoomReservation']['check_out'])); ?></td>
	                                            <td><?= $data['RoomReservation']['no_of_rooms']; ?></td>
	                                        </tr>
	                                        <?php } ?>
	                                    </tbody>
	                                </table>    
	                                
	                            </td>
	                        </tr>
	                    <?php
	                        $sr++;
	                        $i++;
	                    }
	                }else{ ?>
	                    <tr>
	                        <td colspan="6"><?= 'no data found'; ?></td>
	                    </tr>
	                <?php } ?>    
	            </tbody>
	        </table>
	    </div>
	</div>
</div>

<div id="testmodal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cancel Booking</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <?php echo $this->Form->create('', ['url'=>['controller'=>'ViewBookings','action'=>'cancel']]); ?>
            <div class="modal-body cancel-modal">
            	
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Cancel</button>
            </div>
            </form>
        </div>
    </div>
</div>


<script type="text/javascript"> 
	function cancelBooking(booking_id,room_id,bed_id){
		$('#bookingid').val(booking_id);
		$.ajax({
                    type:'POST',
                    dataType : 'html',
                    url: siteUrlfront+'ajax/cancel_booking',
                    data: {booking_id:booking_id,room_id:room_id,bed_id:bed_id},
                    beforeSend: function () {
                        $('.cancel').attr("disabled","disabled");
                    },
                    success:function(data){
                        $('.cancel-modal').html(data);
                        $("#testmodal").modal('show');
                    }
                });
	}
</script>