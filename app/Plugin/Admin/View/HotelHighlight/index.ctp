<div class="row mb-3">
    <div class="col-lg-12 text-right">
        <?php
            echo $this->Html->link(
                '<i class="fa fa-plus"></i> Hotel Highlight',
                'javascript:void(0)',
                [
                    'escape' => false,
                    'class'=>'btn btn-success load_modal',
                    'data-action'=>'form',
                    'data-model'=>'HotelHighlight'

                ]
            );
        ?>
    </div>
</div>
<input type="hidden" value="listing" id="action"/>
<input type="hidden" value="HotelHighlight" id="model"/>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">   
                <div class="table-responsive">
                    <table id="datatable" class="table dataTables_wrapper container-fluid dt-bootstrap4 no-footer" style="width:100%">
                        <thead>
                            <tr>
                                <th>Name</th>                                
                                <th>Status</th>                                                           
                                <th class="nosort">Action</th>
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