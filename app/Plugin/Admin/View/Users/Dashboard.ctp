
<?php 
    
    $userData = $this->Session->read('UserData');
?>


 <div class="card-group">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex no-block align-items-center">
                        <div>
                            <i class="mdi mdi-hotel font-20 "></i>
                            <p class="font-16 m-b-5">Total Hotels</p>
                        </div>
                        <div class="ml-auto">
                            <h1 class="font-light text-right"><?= $hotel_count ?></h1>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="progress">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 75%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex no-block align-items-center">
                        <div>
                            <i class="mdi  mdi-book-multiple font-20 "></i>
                            <p class="font-16 m-b-5">Total Packages</p>
                        </div>
                        <div class="ml-auto">
                            <h1 class="font-light text-right"><?= $Package_count ?></h1>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 60%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex no-block align-items-center">
                        <div>
                            <i class="mdi  mdi-airplane font-20 "></i>
                            <p class="font-16 m-b-5">Total Destinations</p>
                        </div>
                        <div class="ml-auto">
                            <h1 class="font-light text-right"><?= $Destination_count ?></h1>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="progress">
                        <div class="progress-bar bg-purple" role="progressbar" style="width: 65%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex no-block align-items-center">
                        <div>
                            <i class="fa fa-building font-20"></i>
                            <p class="font-16 m-b-5">Total Companies</p>
                        </div>
                        <div class="ml-auto">
                            <h1 class="font-light text-right"><?= $Company_count ?></h1>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="progress">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 70%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">bar-chart-horizontal</h4>
                                <div>
                                    <canvas id="bar-chart-horizontal" height="150"> </canvas>
                                </div>
                            </div>
                        </div>
                    </div> -->

<input type="hidden" value="listing_dashboard" id="action"/>
<input type="hidden" value="RoomReservation" id="model"/>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">   
            <?php echo $this->Flash->render(); ?>           
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Booking id</th>                                
                                <th>Hotel</th>                                
                                <th>Hotel Details</th>                                
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>