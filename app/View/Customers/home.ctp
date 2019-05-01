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
	<section class="khp-block pt-0 pb-0">
        <div class="khpd-contact mb-0 kmlm-container">
            <div class="khpdco-left">
                <div class="kmpdco-in">
                    <div class="kmpl-head">
                        <h3>Welcome...</h3>
                        <p>Make a fresh booking...</p>
                    </div>
                    <div class="kmpl-content">
                        <?php echo $this->Form->create('HotelSearch', ['type' => 'file','url'=>['controller'=>'hotel_search','action'=>'index']]);  ?>
                            <div class="kmplc-form">
                                <div class="kmplcf-in">
                                    <div class="form-group">
                                        <?php
                                            echo $this->Form->input('city', [
                                                'type' => 'select',                                       
                                                'class'=>'form-control citylist',
                                                'options'   => $cityList,
                                                'empty'   => 'Select...',
                                            ]);
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                            echo $this->Form->input('hotel_select', [
                                                'type' => 'select',                                       
                                                'class'=>'form-control hotelList',                                           
                                                'empty'   => 'Select...',
                                                'id'=>'hotelSelect',
                                                'label'=>'Hotel'
                                            ]);
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                            echo $this->Form->input('room_type', [
                                                'type' => 'select',                                       
                                                'class'=>'form-control roomList',                                           
                                                'empty'   => 'Select...',
                                            ]);
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                            echo $this->Form->input('no_of_rooms', [
                                                'type' => 'number',                                       
                                                'class'=>'form-control ',                                           
                                            ]);
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Check In</label>
                                        <input type="date" name="data[HotelSearch][check_in]" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="">Check Out</label>
                                        <input type="date" name="data[HotelSearch][check_out]" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <?php
                                            echo $this->Form->input('adult', [
                                                'type' => 'select',                                       
                                                'class'=>'form-control adultList',                                           
                                                'empty'   => 'Select...',
                                                'label'=>'Adult(>5yrs)'
                                            ]);
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                            echo $this->Form->input('child', [
                                                'type' => 'select',                                       
                                                'class'=>'form-control childList',                                           
                                                'empty'   => 'Select...',
                                                'label'=>'Child(0-5yrs)'
                                            ]);
                                        ?>
                                    </div>
                                </div>
                                <div class="kmplc-btn">
                                    <button type="submit" class="btn btn-pink"><i class="material-icons">search</i> Search</button>
                                    <p>Taxes as extra applicapable**</p>
                                </div>
                                <div class="kmplc-bottom">
                                    <p>To view bookings made earlier click here - <a href="#">View Bookings</a></p>
                                </div>
                            </div>
                        <?php $this->Form->end(); ?>
                    </div>
                </div>
            </div>
            <div class="khpdco-right">
                <div class="kmpdco-in">
                    <div class="kmprla-bx">
                        <div class="kmprlb-head">
                            <span>TRH Nenital, Utrakhand</span>
                            <?php
                                echo $this->Html->link(
                                    'Logout',
                                    array(
                                        'controller' => 'customers',
                                        'action' => 'logout',
                                        'plugin'=>false                                            
                                    )
                                );
                            ?>
                        </div>
                        <div class="kmprlb-content">
                            <div class="kmprlb-in">
                         
                            <?php
                            echo $this->Html->link('View Bookings',['controller' => 'roomreservation','action' => 'myBookings'],['class'=>'btn btn-pink btn-block']);
                            
                            echo $this->Html->link('View Statment',['controller' => 'customers','action' => 'myWallet'],['class'=>'btn btn-pink btn-block']);
                            
                            echo $this->Html->link('View Reports',['controller' => 'roomreservation','action' => 'viewReport'],['class'=>'btn btn-pink btn-block']);
                            
                            echo $this->Html->link('Wallet History',['controller' => 'customers','action' => 'myWallet'],['class'=>'btn btn-pink btn-block']);
                            ?>
                                <a href="#" class="btn btn-pink btn-block">Remaining Balance - <?php echo $current_amt;  ?> INR</a>
                            </div>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
	</section>