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
            <div class="kmpbk-list">
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
                <div class="kmpbfw-head">
                    <div class="kmpbfwh-left-btn">
                        <?php
                            echo $this->Html->link('Back to Home',['controller' => 'customers','action' => 'home'],['class'=>'btn btn-pink']);
                            ?>
                    </div>
                    <div class="kmpbfwh-steps">
                        <ul>
                            <li><?php
                            echo $this->Html->link('View Bookings',['controller' => 'customers','action' => 'myBookings'],['class'=>'active']);
                            ?></li>
                            <li><a href="#">View Statement</a></li>
                            <li><?php
                            echo $this->Html->link('View Reports',['controller' => 'customers','action' => 'searchReports'],['class'=>'']);
                            ?></li>
                        </ul>
                    </div>
                </div>
                <div class="card card-dark">
                    <div class="card-header">View My Booking</div>
                    <div class="card-body">
                        <div class="kmpbfhr-bx">
                            <h4>To view bookings based on booking date, select date and click on search.</h4>
                            <div class="kmpbfhrb-content">
                                <div class="kmpbks-form">
                                    <div class="kmbksf-row">
                                        <div class="form-group">
                                            <div class="label-outer">
                                                <label for="">Booking no. :</label>
                                            </div>
                                            <div class="form-input">
                                                <input type="text" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kmbksf-divider"><span>Or</span></div>
                                    <div class="kmbksf-row">
                                        <div class="form-group">
                                            <div class="label-outer">
                                                <label for="">Booking date from :</label>
                                            </div>
                                            <div class="form-input">
                                                <input type="date" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="label-outer">
                                                <label for="">Booking date to :</label>
                                            </div>
                                            <div class="form-input">
                                                <input type="date" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-input">
                                                <button class="btn btn-pink">View Booking</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bk-table">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Sr.</th>
                                            <th>Booking No.</th>
                                            <th>Booking Date</th>
                                            <th>Hotel Name</th>
                                            <th>Check In</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>KU-20120507-53</td>
                                            <td>7-May-2012 Mon</td>
                                            <td>TRH Naukuchiyatal</td>
                                            <td>26-May-2012 Sat</td>
                                            <td><a class="link-pink" href="#">View Booking</a></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>KU-20120507-53</td>
                                            <td>7-May-2012 Mon</td>
                                            <td>TRH Naukuchiyatal</td>
                                            <td>26-May-2012 Sat</td>
                                            <td><a class="link-pink" href="#">View Booking</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>KU-20120507-53</td>
                                            <td>7-May-2012 Mon</td>
                                            <td>TRH Naukuchiyatal</td>
                                            <td>26-May-2012 Sat</td>
                                            <td><a class="link-pink" href="#">View Booking</a></td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>KU-20120507-53</td>
                                            <td>7-May-2012 Mon</td>
                                            <td>TRH Naukuchiyatal</td>
                                            <td>26-May-2012 Sat</td>
                                            <td><a class="link-pink" href="#">View Booking</a></td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>KU-20120507-53</td>
                                            <td>7-May-2012 Mon</td>
                                            <td>TRH Naukuchiyatal</td>
                                            <td>26-May-2012 Sat</td>
                                            <td><a class="link-pink" href="#">View Booking</a></td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>KU-20120507-53</td>
                                            <td>7-May-2012 Mon</td>
                                            <td>TRH Naukuchiyatal</td>
                                            <td>26-May-2012 Sat</td>
                                            <td><a class="link-pink" href="#">View Booking</a></td>
                                        </tr>
                                        <tr>
                                            <td>7</td>
                                            <td>KU-20120507-53</td>
                                            <td>7-May-2012 Mon</td>
                                            <td>TRH Naukuchiyatal</td>
                                            <td>26-May-2012 Sat</td>
                                            <td><a class="link-pink" href="#">View Booking</a></td>
                                        </tr>
                                        <tr>
                                            <td>8</td>
                                            <td>KU-20120507-53</td>
                                            <td>7-May-2012 Mon</td>
                                            <td>TRH Naukuchiyatal</td>
                                            <td>26-May-2012 Sat</td>
                                            <td><a class="link-pink" href="#">View Booking</a></td>
                                        </tr>
                                        <tr>
                                            <td>9</td>
                                            <td>KU-20120507-53</td>
                                            <td>7-May-2012 Mon</td>
                                            <td>TRH Naukuchiyatal</td>
                                            <td>26-May-2012 Sat</td>
                                            <td><a class="link-pink" href="#">View Booking</a></td>
                                        </tr>
                                        <tr>
                                            <td>10</td>
                                            <td>KU-20120507-53</td>
                                            <td>7-May-2012 Mon</td>
                                            <td>TRH Naukuchiyatal</td>
                                            <td>26-May-2012 Sat</td>
                                            <td><a class="link-pink" href="#">View Booking</a></td>
                                        </tr>
                                        <tr>
                                            <td>11</td>
                                            <td>KU-20120507-53</td>
                                            <td>7-May-2012 Mon</td>
                                            <td>TRH Naukuchiyatal</td>
                                            <td>26-May-2012 Sat</td>
                                            <td><a class="link-pink" href="#">View Booking</a></td>
                                        </tr>
                                        <tr>
                                            <td>12</td>
                                            <td>KU-20120507-53</td>
                                            <td>7-May-2012 Mon</td>
                                            <td>TRH Naukuchiyatal</td>
                                            <td>26-May-2012 Sat</td>
                                            <td><a class="link-pink" href="#">View Booking</a></td>
                                        </tr>
                                        <tr>
                                            <td>13</td>
                                            <td>KU-20120507-53</td>
                                            <td>7-May-2012 Mon</td>
                                            <td>TRH Naukuchiyatal</td>
                                            <td>26-May-2012 Sat</td>
                                            <td><a class="link-pink" href="#">View Booking</a></td>
                                        </tr>
                                        <tr>
                                            <td>14</td>
                                            <td>KU-20120507-53</td>
                                            <td>7-May-2012 Mon</td>
                                            <td>TRH Naukuchiyatal</td>
                                            <td>26-May-2012 Sat</td>
                                            <td><a class="link-pink" href="#">View Booking</a></td>
                                        </tr>
                                        <tr>
                                            <td>15</td>
                                            <td>KU-20120507-53</td>
                                            <td>7-May-2012 Mon</td>
                                            <td>TRH Naukuchiyatal</td>
                                            <td>26-May-2012 Sat</td>
                                            <td><a class="link-pink" href="#">View Booking</a></td>
                                        </tr>
                                        <tr>
                                            <td>16</td>
                                            <td>KU-20120507-53</td>
                                            <td>7-May-2012 Mon</td>
                                            <td>TRH Naukuchiyatal</td>
                                            <td>26-May-2012 Sat</td>
                                            <td><a class="link-pink" href="#">View Booking</a></td>
                                        </tr>
                                        <tr>
                                            <td>17</td>
                                            <td>KU-20120507-53</td>
                                            <td>7-May-2012 Mon</td>
                                            <td>TRH Naukuchiyatal</td>
                                            <td>26-May-2012 Sat</td>
                                            <td><a class="link-pink" href="#">View Booking</a></td>
                                        </tr>
                                        <tr>
                                            <td>18</td>
                                            <td>KU-20120507-53</td>
                                            <td>7-May-2012 Mon</td>
                                            <td>TRH Naukuchiyatal</td>
                                            <td>26-May-2012 Sat</td>
                                            <td><a class="link-pink" href="#">View Booking</a></td>
                                        </tr>
                                        <tr>
                                            <td>19</td>
                                            <td>KU-20120507-53</td>
                                            <td>7-May-2012 Mon</td>
                                            <td>TRH Naukuchiyatal</td>
                                            <td>26-May-2012 Sat</td>
                                            <td><a class="link-pink" href="#">View Booking</a></td>
                                        </tr>
                                        <tr>
                                            <td>20</td>
                                            <td>KU-20120507-53</td>
                                            <td>7-May-2012 Mon</td>
                                            <td>TRH Naukuchiyatal</td>
                                            <td>26-May-2012 Sat</td>
                                            <td><a class="link-pink" href="#">View Booking</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>