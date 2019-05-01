<?php 
$userData = $this->Session->read('UserData')

?>
<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-light">
        <div class="navbar-header">
            <!-- This is for the sidebar toggle which is visible on mobile only -->
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                <i class="ti-menu ti-close"></i>
            </a>
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <div class="navbar-brand">
                <a href="<?php echo Configure::read('siteUrl'); ?>users/dashboard" class="logo">
                    <!-- Logo icon -->
                    <b class="logo-icon">
                        <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                        <!-- Dark Logo icon -->
                        <img src="<?php echo Configure::read('siteUrl'); ?>assets/images/logo_white.png" alt="homepage" class="dark-logo" />
                        <!-- Light Logo icon -->
                        <img src="<?php echo Configure::read('siteUrl'); ?>assets/images/logo_white.png" alt="homepage" class="light-logo" />
                    </b>
                    <!--End Logo icon -->
                    <!-- Logo text -->
                    
                </a>
                <a class="sidebartoggler d-none d-md-block" href="javascript:void(0)" data-sidebartype="mini-sidebar">
                    <i class="mdi mdi-toggle-switch mdi-toggle-switch-off font-20"></i>
                </a>
            </div>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Toggle which is visible on mobile only -->
            <!-- ============================================================== -->
            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="ti-more"></i>
            </a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse collapse" id="navbarSupportedContent">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-left mr-auto">
                
            </ul>
            <!-- ============================================================== -->
            <!-- Right side toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-right">              
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        
                        <i class="m-r-10 mdi mdi-account rounded-circle"></i>
                        <span class="m-l-5 font-medium d-none d-sm-inline-block"><?php echo $userData['Users']['name']; ?><i class="mdi mdi-chevron-down"></i></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                        <span class="with-arrow">
                            <span class="bg-primary"></span>
                        </span>
                        <div class="d-flex no-block align-items-center p-15 bg-primary text-white m-b-10">
                            <div class="">
                                
                            </div>
                            <div class="m-l-10">
                                <h4 class="m-b-0"><?php echo $userData['Users']['name']; ?></h4>
                                <p class=" m-b-0"><?php echo $userData['Users']['email']; ?></p>
                            </div>
                        </div>
                        <div class="profile-dis scrollable">
                           
                            <?php
                                echo $this->Html->link(
                                    '<i class="ti-user m-r-5 m-l-5"></i> Profile',
                                    array(
                                        'controller' => 'users',
                                        'action' => 'profile',
                                        'plugin'=>'admin'                                            
                                    ),
                                    [
                                    'escape' => false,
                                    'class'=>'dropdown-item'
                                    ]
                                );
                            ?>
                            <div class="dropdown-divider"></div>
                            
                            <?php
                                echo $this->Html->link(
                                    '<i class="ti-settings m-r-5 m-l-5"></i> Change Password',
                                    array(
                                        'controller' => 'users',
                                        'action' => 'change_password',
                                        'plugin'=>'admin'                                            
                                    ),
                                    [
                                    'escape' => false,
                                    'class'=>'dropdown-item'
                                    ]
                                );
                            ?>
                            <div class="dropdown-divider"></div>
                           
                            <?php
                                echo $this->Html->link(
                                    '<i class="fa fa-power-off m-r-5 m-l-5"></i> Logout',
                                    array(
                                        'controller' => 'admin',
                                        'action' => 'logout',
                                        'plugin'=>'admin'                                            
                                    ),
                                    [
                                    'escape' => false,
                                    'class'=>'dropdown-item'
                                    ]
                                );
                            ?>
                            <div class="dropdown-divider"></div>
                        </div>
                        
                    </div>
                </li>
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
            </ul>
        </div>
    </nav>
</header>