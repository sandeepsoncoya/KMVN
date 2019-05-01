<div class="row">
    <div class="col-md-12">
        <!-- DATA TABLE-->
        <?php echo $this->Flash->render(); ?>
        <h3 class="title-5 m-b-35">Applied Leaves</h3>
        <div class="table-data__tool">
            <div class="table-data__tool-right">
                <?php
                  echo $this->Html->link(
                      '<i class="zmdi zmdi-plus"></i> Apply Leave',
                       array(
                          'controller' => 'Users',
                          'action' => 'applyleave',
                      ),
                      [
                        'escape' => false,
                        'class'=>'au-btn au-btn-icon au-btn--green au-btn--small'

                      ]
                  );
                ?>
                
            </div>
        </div>
        <div class="table-responsive m-b-40">
            <table class="table table-borderless table-data3">
                <thead>
                    <tr>
                        <th>Sr.No.</th>
                        <th>Leave Type</th>
                        <th>Duration</th>                     
                        <th>Day Part</th>                     
                        <th>From Date</th>                     
                        <th>To Date</th>               
                        <th>Reason</th>               
                        <th>No of Leaves</th>               
                        <th>Status</th>               
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($appliedLeaves)): $i = 1; ?>
                        <?php foreach ($appliedLeaves as $appliedLeave): ?>
                            <tr>
                                <td><?php echo $i; ?></td>                        
                                <td ><?php echo $appliedLeave['LeaveType']['title']; ?></td>           
                                <td >
                                    <?php 

                                        echo ($appliedLeave['AppliedLeave']['leave_type']==1)?"Full Day":"Half Day"; 
                                    ?>
                                        
                                </td>            
                                <td>
                                    <?php 
                                        if($appliedLeave['AppliedLeave']['leave_type']==2){
                                            echo ($appliedLeave['AppliedLeave']['day_part']==1)?"First Half":"Second Half";
                                        }else{
                                            echo "NA";
                                        } 
                                    ?>
                                </td>
                                <td ><?php echo date('d-m-Y',strtotime($appliedLeave['AppliedLeave']['from'])); ?></td> 
                                <td ><?php echo ($appliedLeave['AppliedLeave']['leave_type']==1)?date('d-m-Y',strtotime($appliedLeave['AppliedLeave']['to'])):'NA'; ?></td>
                                 <td ><?php echo $appliedLeave['AppliedLeave']['reason']; ?></td>
                                 <td ><?php echo $appliedLeave['AppliedLeave']['no_of_days']; ?></td>
                                <td>
                                    <?php 
                                        if($appliedLeave['AppliedLeave']['status']==0){
                                            echo '<button type="button" class="btn btn-warning btn-sm">Pending</button>';
                                        }elseif($appliedLeave['AppliedLeave']['status']==1 && $appliedLeave['AppliedLeave']['cancel_request']==0){
                                            echo '<button type="button" class="btn btn-success btn-sm">Approved</button>';
                                        }elseif($appliedLeave['AppliedLeave']['status']==2 ){
                                            echo '<button type="button" class="btn btn-danger btn-sm">cancelled</button>';
                                        }elseif($appliedLeave['AppliedLeave']['status']==3 && $appliedLeave['AppliedLeave']['cancel_request']==0){
                                            echo '<button type="button" class="btn btn-danger btn-sm">Rejected</button>';
                                        }elseif($appliedLeave['AppliedLeave']['status']!=2 && $appliedLeave['AppliedLeave']['cancel_request']==1){
                                            echo '<button type="button" class="btn btn-warning btn-sm">Requested for cancellation</button>';
                                        }  
                                    ?>
                                </td>
                                <td>
                                    <div class="table-data-feature">
                                        <?php 
                                            $id = $appliedLeave['AppliedLeave']['id'];
                                            if(($appliedLeave['AppliedLeave']['status']==0 || $appliedLeave['AppliedLeave']['status']==1 ) && $appliedLeave['AppliedLeave']['from'] > date('Y-m-d')){
                                                
                                                echo $this->Html->link(
                                                  'Cancel',
                                                    array(
                                                      'controller' => 'users',
                                                      'action' => 'cancel',                                         
                                                       $id
                                                    ),
                                                    [
                                                        'escape' => false,
                                                        'class'=>'btn btn-warning'

                                                    ]
                                                );
                                            }elseif((($appliedLeave['AppliedLeave']['status']==0 || $appliedLeave['AppliedLeave']['status']==1) && $appliedLeave['AppliedLeave']['cancel_request']==0 ) && $appliedLeave['AppliedLeave']['from'] <= date('Y-m-d')){
                                                $id = $appliedLeave['AppliedLeave']['id'];
                                                echo '<button type="button" class="btn btn-success btn-sm" id="cancel_req_btn" data-cancle_id="'.$id.'">Cancel Request</button>';
                                            } 
                                        ?>
                                        
                                    </div>
                                </td>
                            </tr>
                        <?php $i++; endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="10" align="center">No data available</td>
                        </tr>
                    <?php endif; ?>
                    
                </tbody>
            </table>
        </div>
        <!-- END DATA TABLE-->
    </div>
<?php echo $this->element('pagnation'); ?>
</div>
