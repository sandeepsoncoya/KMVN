<div class="row mb-3">
    <div class="col-lg-12 text-right">
        <?php
            echo $this->Html->link(
                '<i class="fa fa-plus"></i> Add Category',
                array(
                    'controller' => 'category',
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
<input type="hidden" value="list_category" id="action"/>
<input type="hidden" value="Category" id="model"/>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">   
            <?php echo $this->Flash->render(); ?>           
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Title</th>                                
                                <th>Type</th>
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