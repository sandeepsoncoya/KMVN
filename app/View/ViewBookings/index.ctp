<section class="kh-banner" style="background-image:url('images/package_banner.jpg');">
        <div class="khb-in">
            <div class="container">
                <h2>View Bookings</h2>
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><span>View Booking</span></li>
                </ul>
            </div>
        </div>
    </section>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-heading">
                <h3 class="text-center">View booking</h3>
                <p class="text-center">Enter your booking id to see the booking details.</p>
            </div>
            <hr />
            <div class="modal-body">
                <?php echo $this->Form->create('',['id' => 'bookingSearch']); ?>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">
                            <span class="glyphicon glyphicon-user"></span>
                            </span>
                            <input id="booking_id" name="booking_id" type="text" class="form-control" placeholder="Booking id" required />
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <button type="button" onclick="submitViewForm()" class="btn btn-pink">View</button>
                    </div>
                    <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
    <div class="view-contentq"></div>
<script>
        function submitViewForm(){
            var booking_id   = $('#booking_id').val();

            if(booking_id.trim() == '' ){
                alert('Please enter booking id.');
                $('#booking_id').focus();
                return false;
            }else{
                $.ajax({
                    type:'POST',
                    dataType : 'html',
                    url: siteUrlfront+'ajax/view_bookings',
                    data: $("#bookingSearch").serialize(),
                    beforeSend: function () {
                        $('.submitBtn').attr("disabled","disabled");
                        $('.modal-body').css('opacity', '.5');
                    },
                    success:function(data){
                        $('.view-contentq').html(data);
                        $('.submitBtn').attr("disabled",false);
                    }
                });
            }
        }
    </script>