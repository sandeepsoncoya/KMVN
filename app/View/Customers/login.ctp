 <section class="kh-banner" style="background-image:url('<?php echo Configure::read('siteUrlfront');  ?>images/package_banner.jpg');">
        <div class="khb-in">
            <div class="container">
                <h2>PRO/GSA Login</h2>
                <ul class="breadcrumb">
                    <li><?php echo $this->Html->link('Home','/pages/home'); ?></li>
                    <li><span>Pro/GSA Login</span></li>
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
                        <form action="#">
                            <div class="kmplc-form">
                                <div class="kmplcf-in">
                                    <div class="form-group">
                                        <label for="">City</label>
                                        <select name="" id="" class="form-control">
                                            <option value="">Nainital</option>
                                            <option value="">Almora</option>
                                            <option value="">Bageshwar</option>
                                            <option value="">Pithoragarh</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Hotel</label>
                                        <select name="" id="" class="form-control">
                                            <option value="">Sigri Jungle Camp (Nanital)</option>
                                            <option value="">TRH Almora</option>
                                            <option value="">TRH Bageshwar</option>
                                            <option value="">TRH Baijnath</option>
                                            <option value="">TRH Bhimtal</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">No of Rooms</label>
                                        <select name="" id="" class="form-control">
                                            <option value="">01</option>
                                            <option value="">02</option>
                                            <option value="">03</option>
                                            <option value="">04</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Check In</label>
                                        <input type="date" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="">Check Out</label>
                                        <input type="date" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="">Adult (>5yrs)</label>
                                        <select name="" id="" class="form-control">
                                            <option value="">01</option>
                                            <option value="">02</option>
                                            <option value="">03</option>
                                            <option value="">04</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Extra Person</label>
                                        <select name="" id="" class="form-control">
                                            <option value="">01</option>
                                            <option value="">02</option>
                                            <option value="">03</option>
                                            <option value="">04</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Child Without Bed (0-5yrs)</label>
                                        <select name="" id="" class="form-control">
                                            <option value="">01</option>
                                            <option value="">02</option>
                                            <option value="">03</option>
                                            <option value="">04</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Bed Type</label>
                                        <select name="" id="" class="form-control">
                                            <option value="">Royal</option>
                                            <option value="">Single</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="kmplc-btn">
                                    <button class="btn btn-pink"><i class="material-icons">search</i> Search</button>
                                    <p>Taxes as extra applicapable**</p>
                                </div>
                                <div class="kmplc-bottom">
                                    <p>To view bookings made earlier click here - <a href="#">View Bookings</a></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="khpdco-right">
                <div class="kmpdco-in">
                    <div class="kmpl-head">
                        <h3>KMVN PRO/GSA Login :</h3>
                    </div>
                    <div class="kmpl-content">
                        <div class="kml-main">
                            <div class="kmlm-left">
                                 <?php echo $this->Flash->render(); ?>
                                 <?php echo $this->Form->create('Login'); ?>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="material-icons">person</i></span>
                                            </div>
                                            <?php    echo $this->Form->control('email', [
                                                            'type' => 'email',  
                                                            'placeholder'=>'User Name',                
                                                            'class'=>'form-control'
                                                            ]);
                                                        ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="material-icons">lock</i></span>
                                            </div>
                                             <?php
                                                 echo $this->Form->control('password', [
                                                            'type' => 'password',
                                                            'class'=>'form-control',
                                                            'placeholder'=>"Password"
                                                        ]);
                                                    ?>
                                        </div>
                                    </div>
                                    <?php 
                                        echo $this->Form->button('Login', ['type' => 'submit','class'=>'btn btn-pink']);
                                    ?>
                                <?php echo $this->Form->end(); ?>
                            </div>
                            <div class="kmlm-right">
                                <div class="kmlmr-in">
                                    <p>Registered KMVN</p>
                                    <p>Pro/Gsa Please Login</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kmpl-guide">
                        <h5>Guidelines</h5>
                        <ol>
                            <li>Hotels can be searched for by city OR by a specific name.</li>
                            <li>To check rates and availability, select destination city, travel dates and number of rooms and click SEARCH - OR - select a specific hotel name, travel dates and number of rooms and click SEARCH.</li>
                            <li>To view a booking made earlier, click the VIEW BOOKING link.</li>
                            <li><b>Bed Type -</b> Twin bed type typically indicates two separate beds in the room and a King/Queen bed type indicates one large bed. Both of these bed types are suitable for 2 adults sharing a room.</li>
                            <li>Preferred booking agents are requested to first Log In and then proceed to make bookings. The display of special rates and contracted payment terms will be reflected accordingly.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>