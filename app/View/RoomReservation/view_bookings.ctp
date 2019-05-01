<section class="kh-banner" style="background-image:url('<?php echo Configure::read('siteUrlfront');  ?>images/package_banner.jpg');">
    <div class="khb-in">
        <div class="container">
            <h2>View Booking</h2>
            <ul class="breadcrumb">
                <li><?php echo $this->Html->link('Home','/pages/home'); ?></li>
                <li><span>View Booking </span></li>
            </ul>
        </div>
    </div>
</section>
<section class="khp-block khp-booking">
    <div class="container">
        <div class="kmpbf-wizard">
            <div class="kmpbfw-head">
                <div class="kmpbfwh-left-btn">
                    <a href="<?= $referer ?>" class="btn btn-pink">Back to Home</a>
                </div>
            </div>
            <?php 
            if(!empty($room_reservations)){ ?>
                <div class="kmpbfw-content">
                    <div class="kmpbfwh-review">
                        <div class="card card-dark">
                            <div class="card-header">Review booking detail</div>
                            <div class="card-body">
                                <div class="kmpbfwhr-block">


                                    <div class="kmpbfhr-bx">
                                        <h4>Reservation#   : <?php echo !empty($room_reservations['RoomReservation']['booking_id']) ? $room_reservations['RoomReservation']['booking_id'] : 0; ?></h4>
                                        <div class="kmpbfhrb-content">
                                            <div class="review-row">
                                                <div class="review-label">Hotel</div>
                                                <div class="review-col"><?php echo !empty($room_reservations['Hotel']['title']) ? $room_reservations['Hotel']['title'] : ''; ?></div>
                                            </div>
                                            <div class="review-row">
                                                <div class="review-label">Address</div>
                                                <div class="review-col"><?php echo !empty($room_reservations['Hotel']['address']) ? $room_reservations['Hotel']['address'] : ''; ?></div>
                                            </div>
                                            <div class="review-row">
                                                <div class="review-label">Contact</div>
                                                <div class="review-col"><?php echo !empty($room_reservations['Hotel']['contact_person_name']) ? $room_reservations['Hotel']['contact_person_name'] : ''; ?> <?php echo !empty($room_reservations['Hotel']['contact_person_designation']) ? '( '.$room_reservations['Hotel']['contact_person_designation'].' )': ''; ?></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="review-row">
                                                        <div class="review-label">Telephone</div>
                                                        <div class="review-col"><?php echo !empty($room_reservations['Hotel']['phone']) ? $room_reservations['Hotel']['phone'] : ''; ?> <?php echo !empty($room_reservations['Hotel']['phone2']) ? '/ '.$room_reservations['Hotel']['phone2'] : ''; ?></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="review-row">
                                                        <div class="review-label">Fax</div>
                                                        <div class="review-col"><?php echo !empty($room_reservations['Hotel']['fax']) ? $room_reservations['Hotel']['fax'] : 'N/A'; ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="review-row">
                                                        <div class="review-label">Email</div>
                                                        <div class="review-col"><?php echo !empty($room_reservations['Hotel']['email']) ? $room_reservations['Hotel']['email'] : ''; ?></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="review-row">
                                                        <div class="review-label">Website</div>
                                                        <div class="review-col"><?php echo !empty($room_reservations['Hotel']['website']) ? $room_reservations['Hotel']['website'] : ''; ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="kmpbfwhr-block">
                                    <div class="kmpbfhr-bx">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="review-row">
                                                    <div class="review-label">Arrival On</div>
                                                    <div class="review-col"><?php echo !empty($room_reservations['RoomReservation']['check_in']) ? date('d-M-Y D', strtotime($room_reservations['RoomReservation']['check_in'])) : ''; ?></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="review-row">
                                                    <div class="review-label">Arrival On</div>
                                                    <div class="review-col"><?php echo !empty($room_reservations['RoomReservation']['check_out']) ? date('d-M-Y D', strtotime($room_reservations['RoomReservation']['check_out'])) : ''; ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="review-row">
                                            <div class="review-label">Traveler Name</div>
                                            <div class="review-col"><?php 
                                                $fullname = [];

                                                if(!empty($room_reservations['TravelerDetails']['title'])){
                                                    $fullname[] = $room_reservations['TravelerDetails']['title'];
                                                }

                                                if(!empty($room_reservations['TravelerDetails']['first_name'])){
                                                    $fullname[] = $room_reservations['TravelerDetails']['first_name'];
                                                }

                                                if(!empty($room_reservations['TravelerDetails']['middle_name'])){
                                                    $fullname[] = $room_reservations['TravelerDetails']['middle_name'];
                                                }

                                                if(!empty($room_reservations['TravelerDetails']['last_name'])){
                                                    $fullname[] = $room_reservations['TravelerDetails']['last_name'];
                                                }

                                               $username = implode(' ', $fullname);

                                               echo $username;


                                             ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="review-row">
                                                    <div class="review-label">Mobile#</div>
                                                    <div class="review-col"><?php echo !empty($room_reservations['TravelerContactDetails']['mobile_no']) ? $room_reservations['TravelerContactDetails']['mobile_no'] : ''; ?></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="review-row">
                                                    <div class="review-label">Address</div>
                                                    <div class="review-col"><?php echo !empty($room_reservations['TravelerContactDetails']['address_1']) ? $room_reservations['TravelerContactDetails']['address_1'] : ''; ?></div>
                                                </div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                </div>
                                <div class="kmpbfwhr-block">
                                    <div class="kmpbfhr-bx">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="review-row">
                                                    <div class="review-label">Booked By</div>
                                                    <div class="review-col"><?php echo !empty($room_reservations['CompanyUsers']['username']) ? $room_reservations['CompanyUsers']['username'] : ''; ?></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="review-row">
                                                    <div class="review-label">Contact:#</div>
                                                    <div class="review-col"><?php echo !empty($room_reservations['CompanyUsers']['phone_1']) ? $room_reservations['CompanyUsers']['phone_1'] : ''; ?> <?php echo !empty($room_reservations['CompanyUsers']['phone_2']) ? '/ '.$room_reservations['CompanyUsers']['phone_2'] : ''; ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="review-row">
                                                    <div class="review-label">Email Id</div>
                                                    <div class="review-col"><?php echo !empty($room_reservations['CompanyUsers']['email']) ? $room_reservations['CompanyUsers']['email'] : ''; ?></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="review-row">
                                                    <div class="review-label">Booked On</div>
                                                    <div class="review-col"><?php echo !empty($room_reservations['RoomReservation']['created']) ? date('d-M-Y D', strtotime($room_reservations['RoomReservation']['created'])) : ''; ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php 
                                $room = ClassRegistry::init('RoomReservation')->find('all', [ 'fields' => array('sum(no_of_rooms) AS num_room', 'sum(total_amount) AS tot_room_amt', 'sum(adults) AS num_adults', 'sum(child) AS num_child'), 'conditions' => ['booking_id' => $room_reservations['RoomReservation']['booking_id'] ] ]);
                                //pr($room); die;

                                $num_room = !empty($room[0][0]['num_room']) ? $room[0][0]['num_room'] : 0;
                                $num_adults = !empty($room[0][0]['num_adults']) ? $room[0][0]['num_adults'] : 0;
                                $num_child = !empty($room[0][0]['num_child']) ? $room[0][0]['num_child'] : 0;
                                $tot_room_amt = !empty($room[0][0]['tot_room_amt']) ? $room[0][0]['tot_room_amt'] : 0;
                                ?>

                                <div class="kmpbfwhr-block">
                                    <div class="kmpbfhr-bx">
                                        <div class="review-row">
                                            <div class="review-label">Room Details</div>
                                            <div class="review-col"><?= $num_room; ?> Room |  <?= $num_adults; ?> Adult |  <?= $num_child; ?> Child </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="review-row">
                                                    <div class="review-label">Total Charge</div>
                                                    <div class="review-col">INR <?= $tot_room_amt; ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        $reservationAll = ClassRegistry::init('RoomReservation')->find('all', [ 'conditions' => ['booking_id' => $room_reservations['RoomReservation']['booking_id'] ] ]);
                        //pr($rervationAll); die;
                        $i = 1;
                        foreach ($reservationAll as $reservation) {
                        ?>
                        <div class="card card-dark">
                            <div class="card-header">- Room #<?= $i; ?> : <?= $reservation['RoomReservation']['room_type']; ?>;<?= $reservation['RoomReservation']['bed_type_name']; ?> | <?= $reservation['RoomReservation']['adults']; ?> Adult | <?php echo !empty($reservation['RoomReservation']['child']) ? $reservation['RoomReservation']['child'] : 0; ?> Child</div>
                            <div class="card-body">
                                <div class="kmpbfwhr-block">
                                    <div class="kmpbfhr-bx">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="review-row">
                                                    <div class="review-label">Traveler#1</div>
                                                    <div class="review-col"><?= $username ?></div>
                                                </div>
                                                <div class="review-row">
                                                    <div class="review-label">Booking Status</div>
                                                    <div class="review-col"><?php echo !empty($reservation['RoomReservation']['order_status']) ? 'confirmed' : 'awaited'; ?></div>
                                                </div>
                                                <div class="review-row">
                                                    <div class="review-label">Extra Service Charge</div>
                                                    <div class="review-col">INR <?= $reservation['RoomReservation']['extra_service_charge']; ?></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="review-row">
                                                    <div class="review-label">Payment Status</div>
                                                    <div class="review-col"><?php echo !empty($reservation['RoomReservation']['order_status']) ? 'confirmed' : 'Ignore'; ?></div>
                                                </div>
                                                <div class="review-row">
                                                    <div class="review-label">Room Charge</div>
                                                    <div class="review-col">INR <?= $reservation['RoomReservation']['room_rate']; ?></div>
                                                </div>
                                                <div class="review-row">
                                                    <div class="review-label">Taxes+Fees</div>
                                                    <div class="review-col"><?= $reservation['RoomReservation']['tax'] ?></div>
                                                </div>
                                                <div class="review-row">
                                                    <div class="review-label">Total</div>
                                                    <div class="review-col">INR <?= $reservation['RoomReservation']['total_amount'] ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <?php 
                            
                            $cancelAll = ClassRegistry::init('RoomCancellation')->find('all', [ 'conditions' => ['bed_type_id' => $reservation['RoomReservation']['bed_id'], 'room_id' => $reservation['RoomReservation']['room_id'] ] ]);

                            if(!empty($cancelAll)){
                            ?>
                                <div class="card card-dark">
                                    <div class="card-header">View Cancel Charges</div>
                                    <div class="card-body">
                                    <div class="kmpbfwhr-block">
                                        <div class="kmpbfhr-bx">
                                            <div class="kmpbfhrb-content">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Day Befores</th>
                                                                <th>Refund Percentage</th>
                                                                <th>Amount</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($cancelAll as $cancel) { 
                                                                $refund_amt = $reservation['RoomReservation']['total_amount'] * $cancel['RoomCancellation']['refund_percentage'] / 100;
                                                                ?>
                                                            <tr>
                                                                <td><?= $cancel['RoomCancellation']['days'] ?> </td>
                                                                <td><?= $cancel['RoomCancellation']['refund_percentage'] ?></td>
                                                                <td><span class="text-pink">INR <?php echo $reservation['RoomReservation']['total_amount'] -  $refund_amt ?></span></td>
                                                            </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            <?php } ?>

                        </div>
                        <?php 
                        $i++;
                        } ?>



                        
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

