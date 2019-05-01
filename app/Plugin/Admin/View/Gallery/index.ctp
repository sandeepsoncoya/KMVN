<div class="row mb-3">
    <div class="col-lg-12 text-right">
        <?php
            echo $this->Html->link(
                '<i class="fa fa-plus"></i> Add to gallery',
                array(
                    'controller' => 'Gallery',
                    'action' => 'add',
                    'plugin'=>'admin'
                ),
                [
                'escape' => false,
                'class'=>'btn btn-success'
                ]
            );
        ?>
    </div>
</div>
<input type="hidden" value="listing_gallery" id="action"/>
<input type="hidden" value="Gallery" id="model"/>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">   
                <div class="table-responsive">
                    <table id="datatable" class="table dataTables_wrapper container-fluid dt-bootstrap4 no-footer" style="width:100%">
                        <thead>
                            <tr>
                                <th>Title</th>                                
                                <th>Type</th>                                
                                <th>Preview</th>                                
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