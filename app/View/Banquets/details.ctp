<section class="kh-banner" style="background-image:url('<?php echo Configure::read('siteUrlfront');  ?>/images/banner_destinations.jpg');">
        <div class="khb-in">
            <div class="container">
                <h2>Banquets</h2>
                <ul class="breadcrumb">
                    <li><?php echo $this->Html->link('Home','/pages/home'); ?></li>
                    <li><span>banquets</span></li>
                </ul>
            </div>
        </div>
    </section>
    <section class="khp-block">
        <div class="container khpd-details">
            <div class="khpb-content kmdst-list">
                <div class="kmdst-bx">
                    <div class="kmdstb-img">

                        <?php
                        $pathfile = Configure::read('RelativeUrl').'banquet/'.$banquetDetails['Banquets']['featured_image'];
                        if (file_exists($pathfile)) { 
                        ?>
                            <img src="<?php echo Configure::read('siteUrlfront');  ?>uploads/banquet/<?php echo $banquetDetails['Banquets']['featured_image'] ?>" alt="Banquets Image" />
                        <?php }else{ ?>
                          <img src="<?php echo Configure::read('siteUrlfront');  ?>uploads/imagenot.png" alt="No Image">
                        <?php } ?>

                    </div>
                    <div class="kmdst-dtl">
                        <h5><?php echo $banquetDetails['Banquets']['title'] ?></h5>
                        <div class="kmdstd-in">
                            <p><?php echo $banquetDetails['Banquets']['description'] ?></p>
                        </div>
                        <div class="kmdstd-in">
                            <p><b>Complementary: </b><?php echo $banquetDetails['Banquets']['complementary'] ?></p>
                        </div>
                        <div class="kmdstd-in">
                            <p><b>Max Capacity People:</b> <?php echo $banquetDetails['Banquets']['max_capacity_people'] ?></p>
                        </div>
                        <a href="javascript:void(0)" class="btn btn-pink banquet_cls" data-toggle="modal" id="banquet_model_<?php echo $banquetDetails['Banquets']['id'] ?>" data-id="<?php echo $banquetDetails['Banquets']['id'] ?>" data-price="<?php echo $banquetDetails['Banquets']['total_price'] ?>" data-target="#modalForm">Book Now</a> 

                    </div>
                </div>
                <?php if ($banquetDetails['BanquetImages']) {
                    ?>
                <div class="kmg-block">
                    <h3>Image Gallery</h3>
                    <div class="kmg-content">
                        <div class="kmg-grid" id="gallery_banquet">
                            <?php foreach ($banquetDetails['BanquetImages'] as $key => $value) { ?>
                            <div class="kmg-bx">
                                <div class="kmgb-in">
                                    <?php
                                    $pathfile = Configure::read('RelativeUrl').'banquet/'.$value['file'];
                                    if (file_exists($pathfile)) { 
                                    ?>
                                        <a href="<?php echo Configure::read('siteUrlfront');  ?>uploads/banquet/<?php echo $value['file'] ?>"><img src="<?php echo Configure::read('siteUrlfront');  ?>uploads/banquet/<?php echo $value['file'] ?>" alt=""></a>
                                    <?php }else{ ?>
                                        <img src="<?php echo Configure::read('siteUrlfront');  ?>uploads/imagenot.png" alt="No Image">
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
            </div>
        </div>
    </section>
        
    <div class="modal fade" id="modalForm" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Book Banquet</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                </div>
                
                <!-- Modal Body -->
                <div class="modal-body">
                    <p class="statusMsg"></p>
                    <p class="tot_per_price">Per Day Price : </p>
                    <p class="tot_price"> </p>
                    <?php echo $this->Form->create('BanquetBookings', ['type' => 'file','id' => 'banquet_book']); ?>
                        
                        <?php
                            echo $this->Form->input('banquet_id', [
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
                                   'label'=>'Full name',                                          
                                ]);
                            ?>   
                        </div>   
                        <div class="form-group">
                            <?php
                                echo $this->Form->input('email', [
                                   'type' => 'email',                                        
                                   'class'=>'form-control ',
                                   'label'=>'email',                                          
                                ]);
                            ?>   
                        </div> 
                        <div class="form-group">
                            <?php
                                echo $this->Form->input('phone', [
                                   'type' => 'text', 
                                   'maxlength'=>'10',                                  
                                   'class'=>'form-control ',
                                   'label'=>'phone',                                          
                                ]);
                            ?>   
                        </div> 
                        <div class="form-group">
                            <?php
                                echo $this->Form->input('number_of_day', [
                                   'type' => 'number',    
                                   'min'=>1,                                    
                                   'class'=>'form-control',
                                   'label'=>'Number of days',                                          
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

            $('.banquet_cls').click(function(){

                var dataId=$(this).attr('data-id');
                var dataPrice=$(this).attr('data-price');

                $('#BanquetBookingsBanquetId').val(dataId);
                $('.tot_per_price').text('Per Day Price : ' + dataPrice +' INR');
                $('.tot_per_price').attr('data-per-price', dataPrice);
            });


            $('#BanquetBookingsNumberOfDay').keyup(function(e) {
                var tot_book  = $('#BanquetBookingsNumberOfDay').val()
                var price_per = $('.tot_per_price').attr('data-per-price');
                var tot_amt   = parseFloat(price_per) * parseInt(tot_book);
                
                if(isNaN(tot_amt)) {
                    $('.tot_price').text('Total Ticket Price : ' + 0 +' INR');
                    $('#BanquetBookingsTotalPrice').val(0);
                }else{
                    $('.tot_price').text('Total Price on per day booking : ' + tot_amt +' INR');
                    $('#BanquetBookingsTotalPrice').val(tot_amt);
                }
            });
        });
    </script>

    <script>
        function submitActivityForm(){

            var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
            var regP = /^\d{10}$/;
            var banquetId   = $('#BanquetBookingsBanquetId').val();
            var name        = $('#BanquetBookingsName').val();
            var email       = $('#BanquetBookingsEmail').val();
            var phone       = $('#BanquetBookingsPhone').val();
            var numDay      = $('#BanquetBookingsNumberOfDay').val();

            if(name.trim() == '' ){
                alert('Please enter name.');
                $('#BanquetBookingsName').focus();
                return false;
            }else if(email.trim() == '' ){
                alert('Please enter email.');
                $('#BanquetBookingsEmail').focus();
                return false;
            }else if(email.trim() != '' && !reg.test(email)){
                alert('Please enter valid email.');
                $('#BanquetBookingsEmail').focus();
                return false;
            }else if(phone.trim() != '' && !regP.test(phone)){
                alert('Please enter valid phone.');
                $('#BanquetBookingsPhone').focus();
                return false;
            }else if(numDay.trim() == '' || numDay.trim() == '0'){
                alert('Please enter number of day.');
                $('#BanquetBookingsNumberOfDay').focus();
                return false;
            }else{

                $.ajax({
                    type:'POST',
                    url: siteUrlfront+'ajax/bookingBanquet',
                    data: $("#banquet_book").serialize(),
                    beforeSend: function () {
                        $('.submitBtn').attr("disabled","disabled");
                        $('.modal-body').css('opacity', '.5');
                    },
                    success:function(data){
                        console.log(JSON.parse(data));
                        var result = JSON.parse(data);
                        if(result.msg == 'success'){

                            $('#BanquetBookingsName').val('');
                            $('#BanquetBookingsEmail').val('');
                            $('#BanquetBookingsPhone').val('');
                            $('#BanquetBookingsNumberOfDay').val('');
                            $('#BanquetBookingsTotalPrice').val('0');

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