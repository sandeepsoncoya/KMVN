
<div class="row mb-3">
    <div class="col-lg-12 text-right">
        
        <?php
            echo $this->Html->link(
                '<i class="fa fa-plus"></i> Add Group',
                array(
                    'controller' => 'users',
                    'action' => 'add_group',
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
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <?php echo $this->Flash->render(); ?>                
                <div class="table-responsive">
                    <table id="list_groups" class="table table-striped table-bordered display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Name</th>
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