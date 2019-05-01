<section class="amin-page">
    <div class="aminp-head">
        <div class="container">
            <h1 class="page-title">Contact Us</h1>
        </div>
    </div>
    <div class="aminp-body">
        <div class="container">
            <div class="aminp-contact">
                <div class="amcb-out">
                    <div class="amc-bx">
                        <div class="ambcb-icn">
                            <i class="material-icons">place</i>
                        </div>
                        <div class="ambcb-dtl">
                            <h4>Our Address</h4>
                            <address><?php echo $siteSettings['SiteSettings']['address']; ?></address>
                        </div>
                    </div>
                </div>
                <div class="amcb-out">
                    <div class="amc-bx">
                        <div class="ambcb-icn">
                            <i class="material-icons">mail</i>
                        </div>
                        <div class="ambcb-dtl">
                            <h4>Send Us an Email</h4>
                            <p><a href="mailto:<?php echo $siteSettings['SiteSettings']['email']; ?>"><?php echo $siteSettings['SiteSettings']['email']; ?></a></p>
                        </div>
                    </div>
                </div>
                <div class="amcb-out">
                    <div class="amc-bx">
                        <div class="ambcb-icn">
                            <i class="material-icons">phone</i>
                        </div>
                        <div class="ambcb-dtl">
                            <h4>Call Us All Time</h4>
                            <p><a href="tel:<?php echo $siteSettings['SiteSettings']['phone']; ?>"><?php echo $siteSettings['SiteSettings']['phone']; ?></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="amgm-outer">
            <div class="map-main" id="googleMap"></div>
        </div>
        <div class="eq-container">
            <div class="container">
                <div class="aminp-enquiry">
                    <h3>Get In Touch</h3>
                    <?php 
                        echo $this->Form->create('Contact', ['type' => 'file','id'=>'contactForm']); 
                    ?> 
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <?php
                                        echo $this->Form->input('name', [
                                            'type' => 'text',						                  
                                            'class'=>'form-control required',
                                            'required'   => false,
                                            'placeholder'=>'Full Name',
                                        ]);
                                    ?>
                                    <span id="name" class="form-text text-danger"></span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <?php
                                        echo $this->Form->input('email', [
                                            'type' => 'text',						                  
                                            'class'=>'form-control required',
                                            'required'   => false,
                                            'placeholder'=>'E-Mail',
                                        ]);
                                    ?>
                                    <span id="email" class="form-text text-danger"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <?php
                                        echo $this->Form->input('phone', [
                                            'type' => 'text',						                  
                                            'class'=>'form-control required',
                                            'required'   => false,
                                            'placeholder'=>'Contact No.',
                                        ]);
                                    ?>
                                    <span id="phone" class="form-text text-danger"></span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <?php
                                        echo $this->Form->input('subjet', [
                                            'type' => 'text',						                  
                                            'class'=>'form-control required',
                                            'required'   => false,
                                            'placeholder'=>'Subject',
                                        ]);
                                    ?>
                                    <span id="subject" class="form-text text-danger"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php
                                echo $this->Form->input('comment', [
                                    'type' => 'textarea',						                  
                                    'class'=>'form-control required',
                                    'required'   => false,
                                    'placeholder'=>'Comments',
                                ]);
                            ?>
                            <?php
                                echo $this->Form->input('phone2', [
                                    'type' => 'text',						                  
                                    'class'=>'form-control d-none',
                                    'required'   => false,
                                    'placeholder'=>'Comments',
                                    'label'=>false
                                ]);
                            ?>
                        </div>
                        <div class="text-center">
                            <?php 
                                echo $this->Form->button('Send Message', ['type' => 'submit','class'=>'btn btn-red','id'=>'applyBtn']);
                            ?>
                        </div>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>    

        </div>
    </div>
</section>