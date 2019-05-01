<section class="kh-banner" style="background-image:url('<?php echo Configure::read('siteUrlfront');  ?>/uploads/SiteSettings/<?php  echo $siteSettings['SiteSettings']['destination_inner_banner'] ?>');">
        <div class="khb-in">
            <div class="container">
                <h2>Contact</h2>
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><span>Contact</span></li>
                </ul>
            </div>
        </div>
    </section>
    <style type="text/css">.error-show{font-size: 11px;color: #dc3545;}</style>
    <section class="khp-block pt-0">
        <div class="khpd-contact">
            <div class="khpdco-left">
                <?php echo $siteSettings['SiteSettings']['contact_page_address_info']; ?>
            </div>
            <div class="khpdco-right">
                <div class="kmpdco-in">
                    <div class="kmpbco-form">
                        <div class="kmpdcof-head">
                            <h3>Write to Us</h3>
                        </div>
                        <div class="kmpdcof-content">
                             <?php 
                                echo $this->Form->create('ContactInquiries', ['type' => 'file','id'=>'contactForm']); 
                            ?> 
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php
                                                echo $this->Form->input('first_name', [
                                                    'type' => 'text',                                         
                                                    'label' =>false,                                         
                                                    'class'=>'form-control required',
                                                    'required'   => false,
                                                    'placeholder'=>'First Name',
                                                ]);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php
                                                echo $this->Form->input('last_name', [
                                                    'type' => 'text',                                         
                                                    'label' =>false,                                         
                                                    'class'=>'form-control required',
                                                    'required'   => false,
                                                    'placeholder'=>'Last Name',
                                                ]);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php
                                                echo $this->Form->input('email', [
                                                    'type' => 'text',                                         
                                                    'label' =>false,                                         
                                                    'class'=>'form-control required',
                                                    'required'   => false,
                                                    'placeholder'=>'Email Id',
                                                ]);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php
                                                echo $this->Form->input('phone', [
                                                    'type' => 'text',                                         
                                                    'label' =>false,                                         
                                                    'class'=>'form-control required',
                                                    'required'   => false,
                                                    'placeholder'=>'Phone Number',
                                                ]);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                        echo $this->Form->input('message', [
                                            'type' => 'textarea',                                         
                                            'label' =>false,    
                                            'rows' => '5',                                     
                                            'class'=>'form-control required',
                                            'required'   => false,
                                            'placeholder'=>'Message',
                                        ]);
                                    ?>
                                </div>
                                <div class="errors">
                                    
                                </div>
                                <div id="msg">
                                    
                                </div>
                                
                                <?php 
                                    echo $this->Form->button('Contact Now', ['type' => 'button','class'=>'btn btn-pink','id'=>'applyBtn']);
                                 ?>
                                <?php echo $this->Form->end(); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="khpb-content">
                <div class="kmpbc-btm">
                    <div class="kmpbcb-head">
                        <h3>Head Office:</h3>
                    </div>
                    <div class="kmpbcb-content">
                        <div class="kmpbcbc-grid">
                            <?php if(!empty($headOffices)): ?>
                    <?php foreach ($headOffices as $key => $headOffice) : ?>
                            <div class="kmpbcbg-bx">
                                <div class="kmpbcbgb-in">
                                    <h5><?php echo $headOffice['Contacts']['title'] ?></h5>
                                    <?php echo $headOffice['Contacts']['address'] ?>
                                    
                                </div>
                            </div>
                            <?php endforeach; ?>
                    <?php endif; ?>
                           
                        </div>
                    </div>
                </div>
                <div class="kmpbc-btm">
                    <div class="kmpbcb-head">
                        <h3>Reservation Offices:</h3>
                    </div>
                    <div class="kmpbcb-content">
                        <div class="kmpbcbc-grid">
                                 <?php if(!empty($reservationOffices)): ?>
                    <?php foreach ($reservationOffices as $key => $reservationOffice) : ?>
                            <div class="kmpbcbg-bx">
                                <div class="kmpbcbgb-in">
                                    <h5><?php echo $reservationOffice['Contacts']['title'] ?></h5>
                                    <?php echo $reservationOffice['Contacts']['address'] ?>
                                    
                                </div>
                            </div>
                            <?php endforeach; ?>
                    <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="kmpbc-btm">
                    <div class="kmpbcb-head">
                        <h3>Public Relation Officers (PRO) Offices:</h3>
                    </div>
                    <div class="kmpbcb-content">
                        <div class="kmpbcbc-grid">
                             <?php if(!empty($proOffices)): ?>
                    <?php foreach ($proOffices as $key => $proOffice) : ?>
                            <div class="kmpbcbg-bx">
                                <div class="kmpbcbgb-in">
                                    <h5><?php echo $proOffice['Contacts']['title'] ?></h5>
                                    <?php echo $proOffice['Contacts']['address'] ?>
                                    
                                </div>
                            </div>
                            <?php endforeach; ?>
                    <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="kmpbc-btm">
                    <div class="kmpbcb-head">
                        <h3>Tourist Rest House (TRH) Contact Number:</h3>
                    </div>
                    <?php echo $siteSettings['SiteSettings']['trh_contacts']; ?>
                </div>
            </div>
        </div>
    </section>
         <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<script>
  $(document).ready(function() {
    $("#applyBtn").click(function(event) {
      if(!$('#contactForm').valid()){
          return false;
      }
      else{
        event.preventDefault();
        var formData = $('#contactForm').serialize();
        var FormAction = 'ajax/contactform';
        $.ajax({
            type : 'POST',
            url : FormAction,
            data: formData,       
            dataType: "json",
            beforeSend: function(){
                $('#applyBtn').html('<i class="fas fa-spin fa-spinner"></i> Saving...');
                $('#applyBtn').attr('disabled', true);
                $(".error-show").remove();
            },
            success : function(response) {
              
                $('#applyBtn').attr('disabled', false);
                $('#applyBtn').html('Contact Now');
                if(response.status==true){
                     $('input[type="text"]').val('');
                     $('#ContactInquiriesMessage').val('');
                    $(".errors").html('');
                    $('#msg').html('<div class="alert alert-success"  ><strong>Success!</strong> Your Message sent successfully.</div>').fadeIn('slow');
                     $('#msg').delay(5000).fadeOut('slow');


                    
                }else{
                    $(".errors").html('');
                      $(".errors").append("<p>" + response.message + " </p>");

                }
            },
            error : function() {
            }
        });
        return true;
      }
    });

    $('#contactForm').validate({
        ignore: [],
        errorElement: 'div',
        errorClass: 'error-show',
        focusInvalid: false,
        rules:
        {
          "first_name": {
            required: true,
            customvalidation: true

          }, 
          "last_name": {
            required: true,
            customvalidation: true

          },

          "email": {
            required: true,
            email :true
          },
          "phone": {
             required: true,
             minlength: 10
          },
          "message": {
             required: true
          }
        },
        messages:
        {
         "first_name": {
            required: "Please enter first name.",
            customvalidation: "Sorry, no special characters and number allowed"
          },
         "last_name": {
            required: "Please enter last name.",
            customvalidation: "Sorry, no special characters and number allowed"
          },

          "email": {
             required: "Please enter email id.",
             email: "Please enter a valid email address"
          },
          "phone": {
             required: "Please enter phone number.",
             minlength: "Please enter valid phone number"
          },
          "message": {
             required: "Please enter message."
          }
        }
    });
     $.validator.addMethod("customvalidation",
           function(value, element) {
                   return /^[a-zA-Z]+$/.test(value);
           },
        "Sorry, no special characters and number allowed"
   );

  });
</script>