<div class="get-quote">
    <button class="btn btn-primary" data-toggle="modal" data-target="#modal_quote">Get Quote</button>
</div>
<div id="modal_quote" class="modal modal-full fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="modal-header">
                            <h5 class="modal-title">Get a Quote</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><i class="material-icons">close</i></span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="job-detail job-form mt-4">
                                <?php 
                                    echo $this->Form->create('Contact', ['type' => 'file','id'=>'GetQuote']); 
                                ?> 
                                    <?php
                                        echo $this->Form->input('quote', [
                                            'type' => 'text',						                  
                                            'class'=>'form-control required d-none',
                                            'required'   => false,
                                            'label'=>false,
                                        ]);
                                    ?>
                                    <div class="form-group">
                                        <?php
                                            echo $this->Form->input('name', [
                                                'type' => 'text',						                  
                                                'class'=>'form-control required',
                                                'required'   => false,
                                                'label'=>'Full Name',
                                               
                                            ]);
                                        ?>
                                        <span id="nameq" class="form-text text-danger"></span>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                            echo $this->Form->input('email', [
                                                'type' => 'text',						                  
                                                'class'=>'form-control required',
                                                'required'   => false,
                                                'label'=>'e-Mail',
                                               
                                            ]);
                                        ?>
                                        <span id="emailq" class="form-text text-danger"></span>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                            echo $this->Form->input('phone', [
                                                'type' => 'text',						                  
                                                'class'=>'form-control required',
                                                'required'   => false,
                                                'label'=>'Contact No.',
                                               
                                            ]);
                                        ?>
                                        <span id="phoneq" class="form-text text-danger"></span>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                            echo $this->Form->input('comment', [
                                                'type' => 'textarea',						                  
                                                'class'=>'form-control required',
                                                'required'   => false,
                                                'label'=>'Description',
                                               
                                            ]);
                                        ?>
                                        <span id="commentq" class="form-text text-danger"></span>
                                    </div>
                                    <?php 
                                        echo $this->Form->button('Send Your Enquiry', ['type' => 'submit','class'=>'btn btn-primary','id'=>'applyBtn']);
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