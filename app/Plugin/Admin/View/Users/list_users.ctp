
<div class="row mb-3">
    <div class="col-lg-12 text-right">
        
        <?php
            echo $this->Html->link(
                '<i class="fa fa-plus"></i> Add User',
                array(
                    'controller' => 'users',
                    'action' => 'add_user',
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
<input type="hidden" value="listing_user" id="action"/>
<input type="hidden" value="Users" id="model"/>
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
                                <th>Role</th>
                                <th>Email</th>
                                <th>Phone</th>                               
                                <th>Action(s)</th>
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