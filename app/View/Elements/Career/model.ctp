<div id="modal_career" class="modal modal-full fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="container">
                <div class="modal-header">
                    <h5 class="modal-title job_title">iOS Developer</h5>
                    <p class="modal-subtitle"><b>Experience:</b> <span class="exp"></span> Years</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="material-icons">close</i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="job-detail">
                        <h4>Job Description</h4>
                        <div class="job_desciption"></div>
                    </div>
                    <div class="job-detail">
                        <h4>Job Responsibilities</h4>
                        <div class="job_responsibilites"></div>
                    </div>
                    <div class="job-detail">
                        <h4>Key Skills</h4>
                        <div class="key_skills"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modal_resume" class="modal modal-full fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="container">
                
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="modal-header">
                                <h5 class="modal-title job_title">iOS Developer</h5>
                                <p class="modal-subtitle"><b>Experience:</b> <span class="exp">2-3</span> Years</p>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><i class="material-icons">close</i></span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="job-detail job-form mt-4">
                                <?php 
                                    echo $this->Form->create('ApplyJob', ['type' => 'file','id'=>'applyForm']); 
                                    echo $this->Form->input('job_id', [
                                        'type' => 'hidden',						                  
                                        'id'=>'job_id'
                                    ]);
                                
                                ?>
                                        <!-- <h4 class="mb-2">Apply Now</h4> -->
                                        <div class="form-group">
                                            <?php
                                                echo $this->Form->input('name', [
                                                    'type' => 'text',						                  
                                                    'class'=>'form-control required',
                                                    'required'   => false,
                                                ]);
                                            ?>
                                            <span id="name" class="form-text text-danger"></span>
                                            
                                        </div>
                                        <div class="form-group">
                                            <?php
                                                echo $this->Form->input('email', [
                                                    'type' => 'text',						                  
                                                    'class'=>'form-control required',
                                                    'required'   => false,
                                                ]);
                                            ?>
                                            <span id="email" class="form-text text-danger"></span>
                                        </div>
                                        <div class="form-group">
                                            
                                            <?php
                                                echo $this->Form->input('phone', [
                                                    'type' => 'tel',						                  
                                                    'class'=>'form-control required',
                                                    'required'   => false,
                                                ]);
                                            ?>
                                            <span id="phone" class="form-text text-danger"></span>
                                        </div>
                                        
                                        <div class="form-group">
                                            <?php
                                                echo $this->Form->input('Resume', [
                                                    'type' => 'file',						                  
                                                    'class'=>'d-block',
                                                    'required'   => false,
                                                ]);
                                            ?>
                                            <span id="resume" class="form-text text-danger"></span>
                                        </div>
                                        <div class="form-group">
                                            <?php
                                                echo $this->Form->input('comments', [
                                                    'type' => 'textarea',						                  
                                                    'class'=>'form-control required',
                                                    'required'   => false,
                                                ]);
                                            ?>
                                        </div>
                                        <?php 
                                            echo $this->Form->button('Apply Now', ['type' => 'submit','class'=>'btn btn-primary','id'=>'applyBtn']);
                                        ?>
                                        
                                    <?php echo $this->Form->end(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                
            </div>
        </div>
    </div>
</div>