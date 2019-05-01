<div class="widget-group">
    <div class="row">
        <?php if(!empty($pl)): ?>
            <div class="col-sm-6 col-lg-3">
                <div class="overview-item">
                    <div class="overview__inner">
                        <div class="overview-box">
                            <div class="overview-top">
                                <div class="icon">
                                    <i class="material-icons">calendar_today</i>
                                </div>
                                <div class="count-text"><?php echo $pl; ?></div>
                            </div>
                            <div class="text">
                                <span>Leaves Current Quarter</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if(!empty($indiviualLeaves)): ?>
            <?php foreach($indiviualLeaves as $indiviualLeave): ?>
<<<<<<< .mine
                <?php if($indiviualLeave[0]['leaves'] - $indiviualLeave[0]['consumed'] > 0): ?>
                    <div class="col-sm-6 col-lg-3">
                        <div class="overview-item overview-item--c1">
                            <div class="overview__inner">
                                <div class="overview-box clearfix">
                                    <div class="icon">
                                        <i class="zmdi zmdi-calendar-note"></i>
                                    </div>
                                    <div class="text">
                                        <h2><?php echo $indiviualLeave[0]['leaves'] - $indiviualLeave[0]['consumed']; ?></h2>
                                        <span><?php echo $indiviualLeave['LeaveType']['title']; ?></span>
                                    </div>
||||||| .r16
                <div class="col-sm-6 col-lg-3">
                    <div class="overview-item overview-item--c1">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="zmdi zmdi-calendar-note"></i>
=======
            <?php if($indiviualLeave[0]['leaves'] - $indiviualLeave[0]['consumed'] > 0): ?>
                <div class="col-sm-6 col-lg-3">
                    <div class="overview-item overview-item--c1">
                        <div class="overview__inner">
                            <div class="overview-box">
                                <div class="overview-top">
                                    <div class="icon">
                                        <i class="material-icons">event</i>
                                    </div>
>>>>>>> .r18
                                </div>
                                
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

</div>
<div class="calendar-header">
    <div class="cal-head-in text-auto p-6 Oct">
        <!-- HEADER CONTENT-->
        <div class="header-content d-flex flex-column justify-content-between">
            <!-- HEADER TOP -->
            <div class="header-top d-flex flex-column flex-sm-row align-items-center  justify-content-center justify-content-sm-between">
                <div class="logo row align-items-center no-gutters mb-4 mb-sm-0">
                    <i class="logo-icon zmdi zmdi-calendar mr-2"></i>
                    <span class="logo-text h4">Calendar</span>
                </div>

                <!-- TOOLBAR -->
                <div class="toolbar row no-gutters align-items-center">

                    <button id="calendar-today-button" type="button" class="btn btn-icon fuse-ripple-ready" aria-label="Today">
                        <i class="zmdi zmdi-calendar"></i>
                    </button>

                    <button type="button" class="btn btn-icon change-view fuse-ripple-ready" data-view="agendaDay" aria-label="Day">
                        <i class="zmdi zmdi-view-day"></i>
                    </button>

                    <button type="button" class="btn btn-icon change-view fuse-ripple-ready" data-view="agendaWeek" aria-label="Week">
                        <i class="zmdi zmdi-view-week"></i>
                    </button>

                    <button type="button" class="btn btn-icon change-view fuse-ripple-ready" data-view="month" aria-label="Month">
                        <i class="zmdi zmdi-view-module"></i>
                    </button>
                </div>
                <!-- / TOOLBAR -->
            </div>
            <!-- / HEADER TOP -->

            <!-- HEADER BOTTOM -->
            <div class="header-bottom row align-items-center justify-content-center">

                <button id="calendar-previous-button" type="button" class="btn btn-icon fuse-ripple-ready" aria-label="Previous">
                    <i class="zmdi zmdi-chevron-left"></i>
                </button>

                <div id="calendar-view-title" class="h5">October 2018</div>

                <button id="calendar-next-button" type="button" class="btn btn-icon fuse-ripple-ready" aria-label="Next">
                    <i class="zmdi zmdi-chevron-right"></i>
                </button>
            </div>
            <!-- / HEADER BOTTOM -->
        </div>
        <!-- / HEADER CONTENT -->
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div id='calendar'></div>
    </div>
</div>