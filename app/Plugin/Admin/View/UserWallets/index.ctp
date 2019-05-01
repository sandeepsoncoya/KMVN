<div class="row mb-3">
    <div class="col-lg-12 text-right">
        <?php
            echo $this->Html->link(
                '<i class="fa fa-plus"></i> Wallet Add',
                ['controller'=>'user_wallets','action'=>'add',$user_id],
                [
                    'class'=>'btn btn-success',
                    'escape' => false,
                ]
            );
            
        ?>
    </div>
</div>
<input type="hidden" value="listing_user_wallets" id="action"/>
<input type="hidden" value="UserWallets" id="model"/>
<input type="hidden" value="<?php echo $user_id ?>" id="userId"/>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">  
                <h3>Total Balance Amount : <?= $current_amt; ?></h3> 
                <div class="table-responsive">
                    <table id="datatable" class="table dataTables_wrapper container-fluid dt-bootstrap4 no-footer" style="width:100%">
                        <thead>
                            <tr>
                                <th>Amount</th>                                
                                <th>Amount Type</th>                                
                                <th>Description</th>  
                                <th>Date</th>                                
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