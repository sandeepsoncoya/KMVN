<div class="row mb-3">
    <div class="col-lg-12 text-right">
        <?php
            echo $this->Html->link(
                '<i class="fa fa-plus"></i> Add Rate Code',
                'javascript:void(0)',
                [
                    'escape' => false,
                    'class'=>'btn btn-success load_modal',
                    'data-action'=>'form_ajax',
                    'data-model'=>'RateCode'

                ]
            );
        ?>

    </div>
</div>
<input type="hidden" value="listing_ajax" id="action"/>
<input type="hidden" value="RateCode" id="model"/>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">   
            <?php echo $this->Flash->render(); ?>           
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Name</th>                                
                                <th>Status</th>                               
                                <th class="nosort"> Action(s)</th>
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