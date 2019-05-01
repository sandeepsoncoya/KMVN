<section class="kh-banner" style="background-image:url('<?php echo Configure::read('siteUrlfront');  ?>images/package_banner.jpg');">
        <div class="khb-in">
            <div class="container">
                <h2>PRO/GSA</h2>
                <ul class="breadcrumb">
                    <li><?php echo $this->Html->link('Home','/pages/home'); ?></li>
                    <li><span>PRO/GSA </span></li>
                </ul>
            </div>
        </div>
    </section>
    <section class="khp-block khp-booking">
        <div class="container">
            <div class="kmpbk-list">
                <div class="kmprlb-head">
                    <span>TRH Nenital, Utrakhand</span>
                    <?php
                        echo $this->Html->link(
                            'Logout',
                            array(
                                'controller' => 'customers',
                                'action' => 'logout',
                                'plugin'=>false                                            
                            )
                        );
                    ?>
                </div>
                <div class="kmpbfw-head">
                    <div class="kmpbfwh-left-btn">
                        <?php
                            echo $this->Html->link('Back to Home',['controller' => 'customers','action' => 'home'],['class'=>'btn btn-pink']);
                            ?>
                    </div>
                    <div class="kmpbfwh-steps">
                        <ul>
                            <li><?php
                            echo $this->Html->link('View Bookings',['controller' => 'roomreservation','action' => 'myBookings'],['class'=>'']);
                            ?></li>
                            <li><?php echo $this->Html->link('View Statment',['controller' => 'customers','action' => 'myWallet'],['class'=>'']); ?></li>
                            <li><?php
                            echo $this->Html->link('View Reports',['controller' => 'roomreservation','action' => 'viewReport'],['class'=>'active']);
                            ?></li>
                        </ul>
                    </div>
                </div>

                <div class="card card-dark">
                    <div class="card-header">View My Booking</div>
                    <div class="card-body">
                        <div class="kmpbfhr-bx">
                            <h4>To view bookings based on booking date, select date and click on search.</h4>
                            <div class="kmpbfhrb-content">
                            <?php echo $this->Form->create("RoomReservation", array( 'method' => 'Post', 'id' => 'report')); ?>  
                                <div class="kmpbks-form">
                                    <div class="kmbksf-row">
                                        <div class="form-group">
                                            <div class="label-outer">
                                                <label for="">Date from :</label>
                                            </div>
                                            <div class="form-input">
                                                <input type="date" name="date_from" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="label-outer">
                                                <label for="">Date to :</label>
                                            </div>
                                            <div class="form-input">
                                                <input type="date" name="date_to" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="label-outer">
                                                <label for="">TRH (optional) :</label>
                                            </div>
                                            <div class="form-input">
                                                <select id="hotel" name="hotel_id">
                                                    <option value="">Select Hotel</option>
                                                    <?php if(!empty($hotels)){ 
                                                        foreach ($hotels as $value) {
                                                        ?>
                                                        <option value="<?= $value['Hotel']['id']; ?>"><?= $value['Hotel']['title']; ?></option>
                                                    <?php }
                                                    } ?>    
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kmbksf-divider"><span>&nbsp;</span></div>
                                    <div class="kmbksf-row">
                                        
                                        <div class="form-group">
                                            <div class="label-outer">
                                                <label for="">Booking Status :</label>
                                            </div>
                                            <div class="form-input">
                                                <select id="order_status" name="order_status">
                                                    <option value="">Select Booking Status</option>
                                                    <option value="1">CONFIRMED</option>
                                                    <option value="2">ON REQUEST</option>
                                                    <option value="3">CANCELLED</option>
                                                    <option value="4">CANCELLED WITH PENALTY</option>
                                                    <option value="5">NO SHOW</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="label-outer">
                                                <label for="">Payment Type :</label>
                                            </div>
                                            <div class="form-input">
                                                <select id="payment_mode" name="payment_mode">
                                                    <option value="">Select Payment Type</option>
                                                    <option value="Cash">CASH</option>
                                                    <option value="Credit Card">Credit Card</option>
                                                    <option value="Net Banking">Net Banking</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-input">
                                                <button type="button" id="book_button" name="submit" class="btn btn-pink">Generate Report</button>
                                                <button type="button" id="reset_button" name="submit" class="btn btn-pink">Reset</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            <?php echo $this->Form->end(); ?>
                            </div>
                        </div>

                        <div id="reservation">
                            <?php echo $this->element('room_reservation/listing'); ?>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript">
        $(document).ready(function() {

            $("#book_button").click(function() {
                $.ajax({
                    type: "POST",
                    url: '<?php echo Router::url(array("controller" => "room_reservation", "action" => "viewReport")); ?>' ,
                    data: $("#report").serialize(),
                    cache: false,
                    success: function(response) {
                        $('#reservation').html(response);
                    } 
                });
            });

            $(document).on('click','#reset_button',function(){
                $('#report')[0].reset();
                $('tbody').html('<tr><td colspan="6">no data found</td></tr>');
            });
        });
    </script>
   