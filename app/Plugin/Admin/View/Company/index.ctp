<div class="row mb-3">
    <div class="col-lg-12 text-right">
        <?php
            echo $this->Html->link(
                '<i class="fa fa-plus"></i> Company',
                ['controller'=>'company','action'=>'add'],
                [
                    'class'=>'btn btn-success',
                    'escape' => false,
                   

                ]
            );
            
        ?>
    </div>
</div>
<input type="hidden" value="listing_company" id="action"/>
<input type="hidden" value="Company" id="model"/>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">   
                <div class="table-responsive">
                    <table id="datatable" class="table dataTables_wrapper container-fluid dt-bootstrap4 no-footer" style="width:100%">
                        <thead>
                            <tr>
                                <th>Name</th>                                
                                <th>Company Type</th>                                
                                <th>Phone</th>                                
                                <th>e-Mail</th>                                
                                <th>Website</th>                                
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