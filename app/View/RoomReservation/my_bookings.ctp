<!-- Datatable CSS -->
<link href='//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'>
<!-- jQuery Library -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<!-- Datatable JS -->
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>


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
                            echo $this->Html->link('View Bookings',['controller' => 'roomreservation','action' => 'myBookings'],['class'=>'active']);
                            ?></li>
                            <li><?php echo $this->Html->link('View Statment',['controller' => 'customers','action' => 'myWallet'],['class'=>'']); ?></li>
                            <li><?php
                            echo $this->Html->link('View Reports',['controller' => 'roomreservation','action' => 'viewReport'],['class'=>'']);
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
                            <?php echo $this->Form->create("RoomReservation", array( 'method' => 'Post', 'id' => 'booking')); ?>  
                                <div class="kmpbks-form">
                                    <div class="kmbksf-row">
                                        <div class="form-group">
                                            <div class="label-outer">
                                                <label for="">Booking date from :</label>
                                            </div>
                                            <div class="form-input">
                                                <input type="date" id="created" name="created" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="label-outer">
                                                <label for="">Booking date to :</label>
                                            </div>
                                            <div class="form-input">
                                                <input type="date" id="check_in" name="check_in" class="form-control" />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-input">
                                                <button type="button" id="book_button" name="submit" class="btn btn-pink">View Booking</button>
                                                <button type="button" id="reset_button" name="submit" class="btn btn-pink">Reset</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php echo $this->Form->end(); ?>
                            </div>
                        </div>

                        <div id="reservation">
                            <table id='empTable' class='display dataTable'>

                              <thead>
                                <tr>
                                    <th>Sr</th>
                                    <th>Booking No.</th>
                                    <th>Booking Date</th>
                                    <th>Hotel Name</th>
                                    <th>Check In</th>
                                    <th>Action</th>
                                </tr>
                              </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<script type="text/javascript">
    
    $(document).ready(function(){

        var dataTable = $('#empTable').DataTable({
          'processing': true,
          'serverSide': true,
          'serverMethod': 'post',
          //'searching': false, // Remove default Search Control
          'ajax': {
             'url':'<?php echo Router::url(array("controller" => "Ajax", "action" => "bookingList")); ?>',
             'data': function(data){
                var created = $('#created').val();
                data.created = created;

                var check_in = $('#check_in').val();
                data.check_in = check_in;
             }
          },
          'columns': [
             { data: 'sr' },
             { data: 'booking_id' },
             { data: 'created' },
             { data: 'title' },
             { data: 'check_in' },
             { data: 'action' },
          ]
        });

        $(document).on('click','#book_button',function(){
            dataTable.draw();
        });

        $(document).on('click','#reset_button',function(){
            $('#booking')[0].reset();

            //reset search button of datatable
            dataTable
             .search( '' )
             .columns().search( '' )
             .draw();
       
        });
    });
</script>