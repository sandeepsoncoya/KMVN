<div class="row mb-3">
    <div class="col-lg-12 text-right">
        <?php
            echo $this->Html->link(
                '<i class="fa fa-plus"></i> Add Slide',
                array(
                    'controller' => 'slider',
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
<input type="hidden" value="list_slider" id="action"/>
<input type="hidden" value="Slider" id="model"/>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">   
                 
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Title</th>                              
                                <th class="nosort">Action(s)</th>
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