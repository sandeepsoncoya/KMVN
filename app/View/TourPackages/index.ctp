<section class="kh-banner" style="background-image:url('<?php echo Configure::read('siteUrlfront');  ?>/uploads/SiteSettings/<?php  echo $siteSettings['SiteSettings']['package_inner_banner'] ?>');">
        <div class="khb-in">
            <div class="container">
                <h2> <?php if (isset($catSlug)) {
                    echo $catSlug;
                } ?> Packages</h2>
                <ul class="breadcrumb">
                    <li><?php echo $this->Html->link('Home','/pages/home'); ?></li>
                    <li><span>Packages</span></li>
                </ul>
            </div>
        </div>
    </section>
    <section class="khp-block">
        <div class="container">
            <!-- <div class="khpb-head">
                <h3><?php // echo $siteSettings['SiteSettings']['package_inner_title'] ?></h3>
            </div> -->
            <div class="khpb-content kmpc-list">
                <div class="row">
                    <?php if(!empty($tourPackages)): ?>
                    <?php foreach ($tourPackages as $key => $tourPackage) : 
                        $tour_slug = $tourPackage['TourPackage']['slug']; ?>

                    <div class="col-lg-6 tours">
                        <div class="khpc-bx">
                            <div class="khpcb-img">
                                <?php echo $this->Html->link($this->Html->image(Configure::read('siteUrlfront').'/uploads/tour/'.$tourPackage['TourPackage']['featured_image'], array('alt' =>$tourPackage['TourPackage']['title'])),
                                    array('controller' => 'tourPackages', 'action' => 'details', $tour_slug),
                                    array('escape' => false, 'rel' => 'nofollow')
                                ); ?>
                            </div>
                            <div class="khpcb-dtl">
                                <div class="khpcb-ttl">
                                    <h5><?php echo $this->Html->link($tourPackage['TourPackage']['title'], array('controller' => 'tourPackages', 'action' => 'details', $tour_slug),array('class'=>'')); ?>
                                    <!-- <span class="khpc-rate"><span class="khpcr-in" style="width:80%;"></span></span> --></h5>
                                </div>
                                <div class="khpcb-desc">
                                    <p><b><?php if (isset($tourPackage['TourPackage']['duration'])) {
                                             echo $tourPackage['TourPackage']['duration'];
                                        } ?> </b></p>
                                    <p>Departure From: <?php if (isset($tourPackage['TourPackage']['departure_from'])) {
                                             echo $tourPackage['TourPackage']['departure_from'];
                                        } ?></p>
                                    <p>Rates: Rs <?php if (isset($tourPackage['TourPackage']['price'])) {
                                             echo number_format($tourPackage['TourPackage']['price']);
                                        } ?> /- per person for full tour</p>
                                    <p><?php if (isset($tourPackage['TourPackage']['route'])) {
                                             echo $tourPackage['TourPackage']['route'];
                                        } ?></p>
                                   <?php echo $this->Html->link('Read More..', array('controller' => 'tourPackages', 'action' => 'details', $tour_slug),array('class'=>'btn btn-pink')); ?>
                                    <a href="javascript:void(0)" class="btn btn-pink tour_cls" data-toggle="modal" id="tour_model_<?php echo $tourPackage['TourPackage']['id'] ?>" data-id="<?php echo $tourPackage['TourPackage']['id'] ?>" data-price="<?php echo $tourPackage['TourPackage']['total_price'] ?>" data-pax="<?php echo $tourPackage['TourPackage']['pax'] ?>" data-target="#modalForm">Book Now</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php endforeach; ?>
                <?php endif; ?>
                </div>
                
            </div>
            <?php 
            $page =  Configure::read('pagecount');
          
            $style = '';
            if ($allcount <= $page) {
                $style = "display:none";
            } ?>
            <div class="btn-load-more" style="<?= $style;?>">
                    <button class="btn btn-pink load-more">Load More..</button>
                    <input type="hidden" id="row" value="0">
                    <input type="hidden" id="all" value="<?php echo $allcount; ?>">
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

    

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function(){

            $('.tour_cls').click(function(){
                var dataId=$(this).attr('data-id');
                var dataPrice=$(this).attr('data-price');
                var dataPax=$(this).attr('data-pax');
                $('#TourPackageBookingsTourPackageId').val(dataId);
                $('.tot_per_price').text('Per Ticket Price : ' + dataPrice +' INR');
                $('.tot_per_price').attr('data-per-price', dataPrice);

                $('.tot_pax').text('Min People : ' + dataPax);
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


            // Load more data
            $('.load-more').click(function(){
                var page = "<?php echo $page =  Configure::read('pagecount'); ?>";
                var row = Number($('#row').val());
                var allcount = Number($('#all').val());
                row = row + page;

                if(row <= allcount){
                    $("#row").val(row);

                    $.ajax({
                        url: siteUrlfront+'ajax/loadmore',
                        type: 'post',
                        data: {row:row},
                        beforeSend:function(){
                            $(".load-more").html("<i class='fas fa-spinner fa-spin'></i> Loading");
                        },
                        success: function(response){

                            // Setting little delay while displaying new content
                            setTimeout(function() {
                                // appending tour after last tour with class="tours"
                                $(".tours:last").after(response).show().fadeIn("slow");

                                var rowno = row + page ;

                                // checking row value is greater than allcount or not
                                if(rowno > allcount){
                                    // Change the text and background

                                    $('.load-more').css('display', 'none');

                                }else{
                                    $(".load-more").text("Load more...");
                                }
                            }, 2000);


                        }
                    });
                }else{
                    $('.load-more').html("<i class='fas fa-spinner fa-spin'></i> Loading");

                    // Setting little delay while removing contents
                    setTimeout(function() {

                        // When row is greater than allcount then remove all class='tours' element after 2 element
                        $('.tours:nth-child(2)').nextAll('.tours').remove().fadeIn("slow");

                        // Reset the value of row
                        $("#row").val(0);

                        // Change the text 
                        $('.load-more').text("Load more...");

                    }, 2000);
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