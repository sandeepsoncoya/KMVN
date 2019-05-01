<div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url(<?php echo Configure::read('siteUrl'); ?>assets/images/big/auth-bg.jpg) no-repeat center center;">
    <div class="auth-box">
        <div id="loginform">
            <div class="logo">
                <span class="db"><img src="<?php echo $siteLogo; ?>" alt="logo" /></span>
                <p></p>
                <h5 class="font-medium m-b-20">Sign In to Admin</h5>
                <br>
            </div>
            <!-- Form -->
            <div class="row">
                <div class="col-12">
                    <?php echo $this->Flash->render(); ?>
                    <?php echo $this->Form->create('Login', ['type' => 'file']); ?>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span>
                            </div>
                            <?php                                
                                echo $this->Form->control('email', [
                                'type' => 'email',  
                                'placeholder'=>'E-mail',                
                                'class'=>'form-control form-control-lg'
                                ]);
                            ?>
                            
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon2"><i class="ti-pencil"></i></span>
                            </div>
                            <?php
                                echo $this->Form->control('password', [
                                    'type' => 'password',
                                    'class'=>'form-control form-control-lg',
                                    'placeholder'=>"Password"
                                ]);
                            ?>
                            
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="custom-control custom-checkbox">
                                    
                                    <a href="javascript:void(0)" id="to-recover" class="text-dark float-right"><i class="fa fa-lock m-r-5"></i> Forgot pwd?</a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <div class="col-xs-12 p-b-20">
                                <?php 
                                    echo $this->Form->button('Log In', ['type' => 'submit','class'=>'btn btn-block btn-lg btn-info']);
                                ?>
                            </div>
                        </div>
                       
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
        <div id="recoverform">
            <div class="logo">
                <span class="db"><img src="<?php echo Configure::read('siteUrl'); ?>/assets/images/logo-icon.png" alt="logo" /></span>
                <h5 class="font-medium m-b-20">Recover Password</h5>
                <span>Enter your Email and instructions will be sent to you!</span>
            </div>
            <div class="row m-t-20">
                <!-- Form -->
               
                <?php echo $this->Form->create('Login', ['type' => 'file','class'=>'col-12']); ?>
                    <!-- email -->
                    <div class="form-group row">
                        <div class="col-12">
                            <?php
                                echo $this->Form->control('password', [
                                    'type' => 'email',
                                    'class'=>'form-control form-control-lg',
                                    'placeholder'=>"Username"
                                ]);
                            ?>
                            
                        </div>
                    </div>
                    <!-- pwd -->
                    <div class="row m-t-20">
                        <div class="col-12">
                            <?php 
                                echo $this->Form->button('Log In', ['type' => 'submit','class'=>'btn btn-block btn-lg btn-danger']);
                            ?>
                            
                        </div>
                    </div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>