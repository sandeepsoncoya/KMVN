
<div class="bk-table">
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sr</th>
                    <th>Booking Date</th>
                    <th>Hotel Details</th>
                </tr>
            </thead>
            <tbody>

                <?php
                if(!empty($room_reservations)){
                    $sr = 1;
                    foreach ($room_reservations as $reservation) {
                    ?>
                        <tr>
                            <td><?= $sr; ?></td>
                            <td><?= $reservation['RoomReservation']['booking_id']; ?></td>
                            <td>
                                <?php  
                                    $roomData = ClassRegistry::init('RoomReservation')->find('all', [ 'conditions' => ['booking_id' => $reservation['RoomReservation']['booking_id'] ] ]);

                                    if(!empty($roomData)){
                                ?>
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
                                        <?php foreach ($roomData as $data) { ?>
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
                                <?php } ?>
                            </td>
                        </tr>
                    <?php
                        $sr++;
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


