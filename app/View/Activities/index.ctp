   
    <section class="kh-banner" style="background-image:url('<?php echo Configure::read('siteUrlfront');  ?>/uploads/SiteSettings/<?php  echo $siteSettings['SiteSettings']['destination_inner_banner'] ?>');">
        <div class="khb-in">
            <div class="container">
                <h2>Activities</h2>
                <ul class="breadcrumb">
                    <li><?php echo $this->Html->link('Home','/pages/home'); ?></li>
                    <li><span>Activities</span></li>
                </ul>
            </div>
        </div>
    </section>

    <section class="khp-block">
        <div class="container">
            <div class="khpb-content kmdst-list">
                <?php if(!empty($activityList)): ?>
                    <?php foreach ($activityList as $key => $activity) : 
                    $activity_slug = $activity['Activities']['slug']; ?>
                <div class="kmdst-bx dest">
                    <div class="kmdstb-img">
                        <?php
                        $pathfile = Configure::read('RelativeUrl').'activity/'.$activity['Activities']['featured_image'];
                        if (file_exists($pathfile)) {
                            echo $this->Html->link($this->Html->image(Configure::read('siteUrlfront').'/uploads/activity/'.$activity['Activities']['featured_image'], array('alt' => $activity['Activities']['name'])),
                            array('controller' => 'activities', 'action' => 'details', $activity_slug),
                            array('escape' => false, 'rel' => 'nofollow')
                        );
                        }else{ ?>
                          <img src="<?php echo Configure::read('siteUrlfront');  ?>uploads/imagenot.png" alt="">
                        <?php } ?>
                        </div>
                    <div class="kmdst-dtl">
                        <h5><?php if (isset($activity['Activities']['name'])) {
                                             echo $this->Html->link($activity['Activities']['name'], array('controller' => 'activities', 'action' => 'details', $activity_slug));
                                        } ?></h5>
                        <div class="kmdstd-in">
                            <p><?php if (isset($activity['Activities']['description'])) {
                                            $description = $activity['Activities']['description'];
                                             echo $this->Text->truncate(
                                                $description,
                                                570,
                                                array(
                                                    'ellipsis' => '...',
                                                    'exact' => false
                                                )
                                            );
                                        } ?></p>
                        </div>
                        <?php echo $this->Html->link('Read More...', array('controller' => 'activities', 'action' => 'details', $activity_slug),array('class'=>'btn btn-pink')); ?>


                        <?php 
                        $tot_book_activity = $this->App->getRemainActivityTickets($activity['Activities']['id']); 

                        $remaining_book = $activity['Activities']['max_tickets'] - $tot_book_activity;

                        ?>
                        
                        <?php if( $tot_book_activity < $activity['Activities']['max_tickets'] ){  ?>
                            <a href="javascript:void(0)" class="btn btn-pink activity_cls" data-toggle="modal" id="activity_model_<?php echo $activity['Activities']['id'] ?>" data-id="<?php echo $activity['Activities']['id'] ?>" data-price="<?php echo $activity['Activities']['total_price'] ?>" data-child-price="<?php echo $activity['Activities']['total_child_price'] ?>" data-remain="<?php echo $remaining_book ?>" data-target="#modalForm">Book Now</a>
                        <?php }else{ ?>
                            <a href="javascript:void(0)" class="btn btn-pink" data-toggle="modal">Today's Booking Closed</a>
                        <?php } ?>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php endif; ?>
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
                    <h4 class="modal-title" id="myModalLabel">Book Activity</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="material-icons">close</i>
                        <!-- <span aria-hidden="true">&times;</span> -->
                        <span class="sr-only">Close</span>
                    </button>
                </div>
                
                <!-- Modal Body -->
                <div class="modal-body">
                    <p class="statusMsg"></p>
                    <p class="remain_ticket">Remaining Booking on Current Date : 0</p>
                    <p class="tot_per_price">Per Ticket Price (for adult) : </p>
                    <p class="tot_per_price_child">Per Ticket Price (for child): </p>
                    <p class="tot_price"> </p>
                    <p class="tot_price_child"> </p>
                    <?php echo $this->Form->create('ActivityBookings', ['type' => 'file','id' => 'activity_book']); ?>
                        
                        <?php
                            echo $this->Form->input('activity_id', [
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
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php
                                        echo $this->Form->input('number_of_ticket_adult', [
                                           'type' => 'number',   
                                           'min'=>1,                                     
                                           'class'=>'form-control',
                                           'label'=>'Number of ticket for Adult',                                          
                                        ]);
                                    ?>   
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php
                                        echo $this->Form->input('number_of_ticket_child', [
                                           'type' => 'number',
                                           'min'=>0,                                        
                                           'class'=>'form-control',
                                           'label'=>'Number of ticket for Child',                                          
                                        ]);
                                    ?>   
                                </div>
                            </div>
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
                    <button type="button" class="btn btn-pink submitBtn" onclick="submitActivityForm()">SUBMIT</button>
                </div>

                <?php echo $this->Form->end(); ?>

                <input type="hidden" id="adult_tot_price" value="0">
                <input type="hidden" id="child_tot_price" value="0">

                <form method="post" id="activityPay" name="redirect"
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

        $('.activity_cls').click(function(){
            var dataId=$(this).attr('data-id');
            var dataPrice=$(this).attr('data-price');
            var dataChildPrice=$(this).attr('data-child-price');
            var remainVal=$(this).attr('data-remain');
            $('#ActivityBookingsActivityId').val(dataId);

            $('.tot_per_price_child').text('Per Ticket Price  (for child): ' + dataChildPrice +' INR');
            $('.tot_per_price_child').attr('data-per-price-child', dataChildPrice);

            $('.tot_per_price').text('Per Ticket Price (for adult): ' + dataPrice +' INR');
            $('.tot_per_price').attr('data-per-price', dataPrice);

            $('.remain_ticket').text('Remaining Booking on Current Date : ' + remainVal);
            $('.remain_ticket').attr('data-remain-ticket', remainVal);
        });

        $(document).ready(function(){

            $('#ActivityBookingsNumberOfTicketAdult').keyup(function(e) {
                var tot_book  = $('#ActivityBookingsNumberOfTicketAdult').val()
               
                var price_per = $('.tot_per_price').attr('data-per-price');
                var tot_amt_adult = parseFloat(price_per) * parseInt(tot_book);

                if(isNaN(tot_amt_adult)) {
                    $('.tot_price').text('Total Ticket Price (for adult): ' + 0 +' INR');
                    $('#adult_tot_price').val(0);
                }else{
                    $('.tot_price').text('Total Ticket Price (for adult): ' + tot_amt_adult +' INR');
                    $('#adult_tot_price').val(tot_amt_adult);
                }
            });

            $('#ActivityBookingsNumberOfTicketChild').keyup(function(e) {

                var tot_child_book  = $('#ActivityBookingsNumberOfTicketChild').val();

                var price_child_per = $('.tot_per_price_child').attr('data-per-price-child');
                var tot_amt_child   = parseFloat(price_child_per) * parseInt(tot_child_book);

                //alert(tot_amt_child);

                if(isNaN(tot_amt_child)) { 
                    $('.tot_price_child').text('Total Ticket Price (for child): ' + 0 +' INR');
                    $('#child_tot_price').val(0);
                }else{
                    $('.tot_price_child').text('Total Ticket Price (for child): ' + tot_amt_child +' INR');
                    $('#child_tot_price').val(tot_amt_child);
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
                        url: siteUrlfront+'ajax/loadmoreact',
                        type: 'post',
                        data: {row:row},
                        beforeSend:function(){
                            $(".load-more").html("<i class='fas fa-spinner fa-spin'></i> Loading");
                        },
                        success: function(response){

                            // Setting little delay while displaying new content
                            setTimeout(function() {
                                // appending tour after last tour with class="tours"
                                $(".dest:last").after(response).show().fadeIn("slow");

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
                        $('.dest:nth-child(2)').nextAll('.dest').remove().fadeIn("slow");

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
        var activityId  = $('#ActivityBookingsActivityId').val();
        var name        = $('#ActivityBookingsName').val();
        var phone       = $('#ActivityBookingsPhone').val();
        var email       = $('#ActivityBookingsEmail').val();
        var numTicketAdult   = $('#ActivityBookingsNumberOfTicketAdult').val();
        var numTicketChild   = $('#ActivityBookingsNumberOfTicketChild').val();

        if(name.trim() == '' ){
            alert('Please enter name.');
            $('#ActivityBookingsName').focus();
            return false;
        }else if(email.trim() == '' ){
            alert('Please enter email.');
            $('#ActivityBookingsEmail').focus();
            return false;
        }else if(email.trim() != '' && !reg.test(email)){
            alert('Please enter valid email.');
            $('#ActivityBookingsEmail').focus();
            return false;
        }else if(phone.trim() != '' && !regP.test(phone)){
            alert('Please enter valid phone.');
            $('#BanquetBookingsPhone').focus();
            return false;
        }else if(numTicketAdult.trim() == '' || numTicketAdult.trim() == '0'){
            alert('Please enter number of ticket for adult.');
            $('#ActivityBookingsNumberOfTicketAdult').focus();
            return false;
        }else{

            var tot_book = parseInt(numTicketAdult) + parseInt(numTicketChild);

            var remainVal=$('.remain_ticket').attr('data-remain-ticket');
            if(parseInt(remainVal) < parseInt(tot_book)){
                alert('Oops ! your total booking ticket is greater than remaining tickets.');
                return false;
                //$('.submitBtn').prop('disabled', true);
            }else{
               
                var child_tot_price = $('#child_tot_price').val();
                var adult_tot_price = $('#adult_tot_price').val();

                var tot_amt = parseFloat(adult_tot_price) + parseFloat(child_tot_price);
                $('#ActivityBookingsTotalPrice').val(tot_amt); 

                $.ajax({
                    type:'POST',
                    url: siteUrlfront+'ajax/booking',
                    data: $("#activity_book").serialize(),
                    beforeSend: function () {
                        $('.submitBtn').attr("disabled","disabled");
                        $('.modal-body').css('opacity', '.5');
                    },
                    success:function(data){
                        console.log(JSON.parse(data));
                        var result = JSON.parse(data);
                        if(result.msg == 'success'){

                            $('#ActivityBookingsName').val('');
                            $('#ActivityBookingsEmail').val('');
                            $('#ActivityBookingsPhone').val();
                            $('#ActivityBookingsNumberOfTicketAdult').val('');
                            $('#ActivityBookingsNumberOfTicketChild').val('');
                            $('#ActivityBookingsTotalPrice').val('0');

                            setTimeout(function(){ //document.redirect.submit(); 
                                var encrypted_data = $('#encrypted_data').val(result.data.encrypted_data);
                                var access_code = $('#access_code').val(result.data.access_code);
                                $('#activityPay').submit();
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
    }
    

    </script>