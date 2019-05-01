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
            <div class="kmpbf-wizard">
                <div class="kmpbfw-head">
                    <div class="kmpbfwh-left-btn">
                        <?php
                            echo $this->Html->link('Back to Home',['controller' => 'customers','action' => 'home'],['class'=>'btn btn-pink']);
                            ?>
                    </div>
                    <div class="kmpbfwh-steps">
                        <ul>
                            <li><?php
                            echo $this->Html->link('View Bookings',['controller' => 'customers','action' => 'myBookings'],['class'=>'']);
                            ?></li>
                            <li><a href="#">View Statement</a></li>
                            <li><?php
                            echo $this->Html->link('View Reports',['controller' => 'customers','action' => 'searchReports'],['class'=>'active']);
                            ?></li>
                        </ul>
                    </div>
                </div>
                <div class="kmpbfw-content">
                    <div class="kmpbfwh-review">
                        <div class="card card-dark">
                            <div class="card-header">Generate Reports</div>
                            <div class="card-body">
                                <div class="kmpbfhr-bx">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>