<section class="kh-banner" style="background-image:url('<?php echo Configure::read('siteUrlfront');  ?>/uploads/SiteSettings/<?php  echo $siteSettings['SiteSettings']['package_inner_banner'] ?>');">
        <div class="khb-in">
            <div class="container">
                <h2>packages</h2>
                <ul class="breadcrumb">
                    <li><?php echo $this->Html->link('Home','/pages/home'); ?></li>
                    <li><span>Packages</span></li>
                </ul>
            </div>
        </div>
    </section>
    <section class="khp-block">
        <div class="container">
            <div class="khpb-content">
                <div class="khpb-dtl">
                    <div class="khpbd-main">
                        <div class="khpbd-left">
                            <div class="khp-carousel owl-carousel" id="pDetails_carousel">
                                <?php if(!empty($tourDetails['TourPackageImages'])): ?>
                                <?php foreach ($tourDetails['TourPackageImages'] as $key => $tourDetail) : ?>
                                <div class="kmpd-img">
                                    <img src="<?php echo Configure::read('siteUrlfront');  ?>uploads/tour/<?php echo $tourDetail['file'] ?>" alt="Details Banner" />
                                </div>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="khpbd-right">
                            <div class="kmpbdr-head">
                                <h3><?php if (!empty($tourDetails['TourPackage']['title'])) {
                                             echo $tourDetails['TourPackage']['title'];
                                        } ?> </br> <?php

                                         if (!empty($tourDetails['TourPackage']['route'])) {
                                             echo ',('. $tourDetails['TourPackage']['route'] .')';
                                        } ?> </h3>
                            </div>
                            <div class="kmpbdr-body">
                                <div class="kmpdrb-bx">
                                    <h5>Trip Summry:</h5>
                                    <p> <?php if (!empty($tourDetails['TourCategories']['name'])) { echo "<b>Category: </b>";
                                             echo $tourDetails['TourCategories']['name'];
                                        } ?></p>
                                        <p> <?php if (!empty($tourDetails['TourPackage']['departure_from'])) {
                                            echo "<b>Departure From: </b>";
                                             echo $tourDetails['TourPackage']['departure_from'];
                                        } ?></p>
                                    <p> <?php if (!empty($tourDetails['TourPackage']['best_period'])) {
                                            echo "<b>Best Season: </b>";
                                             echo $tourDetails['TourPackage']['best_period'];
                                        } ?>  </p>
                                    <p> <?php if (!empty($tourDetails['TourPackage']['trek_length'])) {
                                        echo "<b>Trek Length: </b>";
                                             echo $tourDetails['TourPackage']['trek_length'];
                                        } ?> </p>

                                        <p> <?php if (!empty($tourDetails['TourPackage']['grade'])) {
                                        echo "<b> Trek Grading: </b>";
                                             echo ucwords($tourDetails['TourPackage']['grade']);
                                        } ?> </p>
                                </div>
                                <div class="kmpdrb-bx">
                                    <h5>Description:</h5>
                                    <p><?php if (!empty($tourDetails['TourPackage']['description'])) {
                                             echo $tourDetails['TourPackage']['description'];
                                        } ?></p>
                                </div>
                            </div>
                            <div class="kmpbdr-ftr">
                                <div class="kmpbdrf-left">
                                    <h5>Minimum Number of Pax- <?php if (strlen($tourDetails['TourPackage']['pax']) < 2) {
                                        echo '0'.$tourDetails['TourPackage']['pax'];
                                    }else{
                                        echo $tourDetails['TourPackage']['pax'];
                                    } ?> </h5>
                                    <p>Rs. <?php if (!empty($tourDetails['TourPackage']['price'])) {
                                             echo number_format($tourDetails['TourPackage']['price']);
                                        } ?> /-</p>
                                    <p>per person for full tour.</p>
                                </div>
                                <div class="kmpbdrf-right">
                                    <a href="javascript:void(0)" class="btn btn-pink tour_cls" data-toggle="modal" id="tour_model_<?php echo $tourDetails['TourPackage']['id'] ?>" data-id="<?php echo $tourDetails['TourPackage']['id'] ?>" data-price="<?php echo $tourDetails['TourPackage']['total_price'] ?>" data-pax="<?php echo $tourDetails['TourPackage']['pax'] ?>"  data-target="#modalForm">Book Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kmbdt-btm">
                        <div class="kmbdtb-block">
                            <div class="kmbdtb-head">
                                <h4>Itinerary:</h4>
                            </div>
                            <div class="kmbdtb-content">
                                <div class="kmitn-list">
                                    <?php if(!empty($tourDetails['TourItineraries'])): ?>
                                    <?php foreach ($tourDetails['TourItineraries'] as $key => $tourItinerary) : ?>
                                    <div class="kmitn-item">
                                        <span>Day <?php if (!empty($tourItinerary['title'])) {
                                             echo $tourItinerary['title'];
                                        } ?>:</span>
                                        <p><?php if (!empty($tourItinerary['name'])) {
                                             echo ucwords($tourItinerary['name']);
                                        } ?></p>
                                        <p><?php if (!empty($tourItinerary['description'])) {
                                             echo ucfirst($tourItinerary['description']);
                                        } ?></p>
                                    </div>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                   
                                </div>
                            </div>
                        </div>

                        <div class="row rp-0">
                            <div class="col-md-6">
                                <div class="kmbdtb-block">
                                    <div class="kmbdtb-head">
                                        <h4>Inclusions:</h4>
                                    </div>
                                    <div class="kmbdtb-content">
                                        <?php if (isset($tourDetails['TourPackage']['inclusion'])) {
                                             echo $tourDetails['TourPackage']['inclusion'];
                                        } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="kmbdtb-block">
                                    <div class="kmbdtb-head">
                                        <h4>Exclusions:</h4>
                                    </div>
                                    <div class="kmbdtb-content">
                                        <?php if (isset($tourDetails['TourPackage']['exclusion'])) {
                                             echo $tourDetails['TourPackage']['exclusion'];
                                        } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="kmbdtb-block">
                            <div class="kmbdtb-head">
                                <h4>Terms and Conditions:</h4>
                            </div>
                            <div class="kmbdtb-content">
                                <?php if (isset($tourDetails['TourPackage']['terms_and_conditions'])) {
                                             echo $tourDetails['TourPackage']['terms_and_conditions'];
                                        } ?>
                            </div>
                        </div>
                         <?php if(!empty($tourDetails['TourAttraction'])): ?>
                        <div class="kmbdtb-block p-0 bg-transparent">
                            <div class="kmbdtb-head">
                                <h4>Attraction:</h4>
                            </div>
                            <div class="kmbdtb-content">
                                <div class="kmatr-list">
                                    <?php foreach ($tourDetails['TourAttraction'] as $key => $tourAttraction) : 
                                        if (!empty($tourAttraction['Attraction'])) {
                                            
                                        $att_slug = $tourAttraction['Attraction']['slug']; ?>
                                        
                                    <div class="kmatr-bx">
                                            <div class="kmatr-img">
                                                <?php if ($tourAttraction['Attraction']['featured_image'] != '') { ?>
                                                     <a href="javascript:;"><img src="<?php echo Configure::read('siteUrlfront');  ?>uploads/attraction/<?php echo $tourAttraction['Attraction']['featured_image'] ?>" alt=""></a>
                                                <?php }else{ ?>
                                                <img src="<?php echo Configure::read('siteUrlfront');  ?>uploads/imagenot.png" alt="">
                                                    <?php } ?>

                                                
                                            </div>
                                            <div class="kmatr-ttl">
                                                <?php echo $this->Html->link($tourAttraction['Attraction']['title'], array('controller' => 'attractions', 'action' => 'details', $att_slug),array('class'=>'')); ?>
                                            </div>
                                    </div>

                                    <?php } endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="modal fade" id="modalForm" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Book Tour Package</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                </div>
                
                <!-- Modal Body -->
                <div class="modal-body">
                    <p class="statusMsg"></p>
                    <p class="tot_per_price">Per Ticket Price : </p>
                    <p class="tot_price">Total Ticket Price : </p>
                    <p class="tot_pax">Min Person  : </p>
                    <?php echo $this->Form->create('TourPackageBookings', ['type' => 'file','id' => 'tour_book']); ?>
                        
                        <?php
                            echo $this->Form->input('tour_package_id', [
                               'type' => 'hidden',                                        
                               'class'=>'form-control ',
                               'label'=> false,                                          
                            ]);
                        ?>
                        
                        <div class="form-group">
                            <?php
                                echo $this->Form->input('name', [
                                   'type' => 'text',                                        
                                   'class'=>'form-control ',
                                   'label'=>'Full Name',                                          
                                ]);
                            ?>   
                        </div>  
                        <div class="form-group">
                            <?php
                                echo $this->Form->input('phone', [
                                   'type' => 'text', 
                                   'maxlength'=>'10',                                 
                                   'class'=>'form-control ',
                                   'label'=>'Phone',                                          
                                ]);
                            ?>   
                        </div>  
                        <div class="form-group">
                            <?php
                                echo $this->Form->input('email', [
                                   'type' => 'email',                                        
                                   'class'=>'form-control ',
                                   'label'=>'Email',                                          
                                ]);
                            ?>   
                        </div> 
                        <div class="form-group">
                            <?php
                                echo $this->Form->input('number_of_people', [
                                   'type' => 'number',                                        
                                   'class'=>'form-control',
                                   'label'=>'Number of person',                                          
                                ]);
                            ?>   
                        </div>

                        <div class="form-group">
                            <?php
                                echo $this->Form->input('total_price', [
                                   'type' => 'hidden',
                                   'readonly' => 'readonly',                                       
                                   'class'=>'form-control ',
                                   'label'=>'Total Price',                                          
                                ]);
                            ?>   
                        </div> 
                    
                </div>
                
                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary submitBtn" onclick="submitActivityForm()">SUBMIT</button>
                </div>

                <?php echo $this->Form->end(); ?>

                <form method="post" id="tourPay" name="redirect"
                  action="https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction">
                    <?php
                    echo "<input id=encrypted_data type=hidden name=encRequest>";
                    echo "<input id=access_code type=hidden name=access_code>";
                    ?>
                </form>
            
                
            </div>
        </div>
    </div>


     <script type="text/javascript">
        $(document).ready(function(){

            $('.tour_cls').click(function(){
                var dataId=$(this).attr('data-id');
                var dataPrice=$(this).attr('data-price');
                var dataPax=$(this).attr('data-pax');
                $('#TourPackageBookingsTourPackageId').val(dataId);
                $('.tot_per_price').text('Per Ticket Price : ' + dataPrice +' INR');
                $('.tot_per_price').attr('data-per-price', dataPrice);

                $('.tot_pax').text('Min Person : ' + dataPax);
                $('.tot_pax').attr('data-pax', dataPax);
            });


            $('#TourPackageBookingsNumberOfPeople').keyup(function(e) {
                var tot_book  = $('#TourPackageBookingsNumberOfPeople').val()
                var price_per = $('.tot_per_price').attr('data-per-price');
                var tot_amt   = parseFloat(price_per) * parseInt(tot_book);
                
                var min_person = $('.tot_pax').attr('data-pax');

                if(parseInt(min_person) > parseInt(tot_book)){
                    $('.submitBtn').prop('disabled', true);
                }else{
                    $('.submitBtn').prop('disabled', false);
                }

                if(isNaN(tot_amt)) {
                    $('.tot_price').text('Total Ticket Price : ' + 0 +' INR');
                    $('#TourPackageBookingsTotalPrice').val(0);
                }else{
                    $('.tot_price').text('Total Ticket Price : ' + tot_amt +' INR');
                    $('#TourPackageBookingsTotalPrice').val(tot_amt);
                }
                
            });
        });
    </script>


    <script>
        function submitActivityForm(){

            var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
            var regP = /^\d{10}$/;
            var tourPackageId= $('#TourPackageBookingsTourPackageId').val();
            var name        = $('#TourPackageBookingsName').val();
            var phone       = $('#TourPackageBookingsPhone').val();
            var email       = $('#TourPackageBookingsEmail').val();
            var numPeople   = $('#TourPackageBookingsNumberOfPeople').val();

            if(name.trim() == '' ){
                alert('Please enter name.');
                $('#TourPackageBookingsName').focus();
                return false;
            }else if(email.trim() == '' ){
                alert('Please enter email.');
                $('#TourPackageBookingsEmail').focus();
                return false;
            }else if(email.trim() != '' && !reg.test(email)){
                alert('Please enter valid email.');
                $('#TourPackageBookingsEmail').focus();
                return false;
            }else if(phone.trim() != '' && !regP.test(phone)){
                alert('Please enter valid phone.');
                $('#BanquetBookingsPhone').focus();
                return false;
            }else if(numPeople.trim() == '' || numPeople.trim() == '0'){
                alert('Please enter number of people.');
                $('#TourPackageBookingsNumberOfPeople').focus();
                return false;
            }else{

                $.ajax({
                    type:'POST',
                    url: siteUrlfront+'ajax/bookingTour',
                    data: $("#tour_book").serialize(),
                    beforeSend: function () {
                        $('.submitBtn').attr("disabled","disabled");
                        $('.modal-body').css('opacity', '.5');
                    },
                    success:function(data){
                        console.log(JSON.parse(data));
                        var result = JSON.parse(data);
                        if(result.msg == 'success'){

                            $('#TourPackageBookingsName').val('');
                            $('#TourPackageBookingsEmail').val('');
                            $('#TourPackageBookingsPhone').val('');
                            $('#TourPackageBookingsNumberOfPeople').val('');
                            $('#TourPackageBookingsTotalPrice').val('0');

                            setTimeout(function(){ 
                                //document.redirect.submit(); 
                                var encrypted_data = $('#encrypted_data').val(result.data.encrypted_data);
                                var access_code = $('#access_code').val(result.data.access_code);
                                $('#tourPay').submit();
                            }, 1000);

                            $('.statusMsg').html('<span style="color:green;">Your booking details has been saved successfully.</p>');
                            $('#encrypted_data').val('');
                            $('#access_code').val('');

                        }else{
                            $('.statusMsg').html('<span style="color:red;">Some problem occurred, please try again.</span>');
                        }
                        $('.submitBtn').removeAttr("disabled");
                        $('.modal-body').css('opacity', '');
                    }
                });
            }
        }
    </script>