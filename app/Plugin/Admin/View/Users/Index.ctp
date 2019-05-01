<div class="row">
    <div class="col-md-12">
        <!-- DATA TABLE-->
        <?php echo $this->Flash->render(); ?>
        <h3 class="title-5 m-b-35">Employees</h3>
        <div class="table-data__tool">
            <div class="table-data__tool-right">
                <?php
                  echo $this->Html->link(
                      '<i class="zmdi zmdi-plus"></i> add Employee',
                       array(
                          'controller' => 'users',
                          'action' => 'add',
                          'plugin'=>'admin'
                          
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
                        <th>Emp Code</th>
                        <th>Name</th>                        
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Degination</th>
                        <th>Action(s)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($data)): $i = 1; ?>
                        <?php foreach ($data as $user): ?>
                            <tr>
                                <td><?php echo $i; ?></td>                        
                                <td ><?php echo $user['Users']['emp_code']; ?></td>
                                <td ><?php echo $user['Users']['name']; ?></td>
                                <td ><?php echo $user['Users']['email']; ?></td>
                                <td ><?php echo $user['Users']['phone']; ?></td>
                                <td ><?php echo $user['Users']['degnation']; ?></td>
                                <td>
                                    <div class="table-data-feature">
                                        <?php
                                            $id = $user['Users']['id'];
                                            echo $this->Html->link(
                                              '<i class="zmdi zmdi-edit"></i>',
                                                array(
                                                  'controller' => 'users',
                                                  'action' => 'add',
                                                  'plugin'=>'admin',
                                                   $id
                                                ),
                                                [
                                                    'escape' => false,
                                                    'class'=>'item'

                                                ]
                                          );
                                        ?>
                                        <?php
                                            $id = $user['Users']['id'];
                                            echo $this->Html->link(
                                              '<i class="zmdi zmdi-delete"></i>',
                                                array(
                                                    'controller' => 'users',
                                                    'action' => 'delete',
                                                    'plugin'=>'admin',
                                                    $id
                                                ),
                                                [
                                                    'escape' => false,
                                                    'class'=>'item',
                                                    'confirm' => 'Are you sure you want to delete?'

                                                ]
                                          );
                                        ?>                                          
                                        
                                    </div>
                                </td>
                            </tr>
                        <?php $i++; endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" style="align:center">No data available</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <!-- END DATA TABLE-->
        <?php echo $this->element('pagnation'); ?>
    </div>
</div>
