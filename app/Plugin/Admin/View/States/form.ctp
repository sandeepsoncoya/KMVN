<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Add <?php echo preg_replace('/([a-z])([A-Z])/s','$1 $2', $modelName);  ?></h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <?php echo $this->Form->create($modelName, ['type' => 'file','id'=>'addFrom','url' => 'save_data']); ?>
        <div class="modal-body">
                <?php 
                    if(isset($this->request->data['id'])): 
                        echo $this->Form->input('id', [
                                    'type' => 'hidden'                              
                                ]);
                    endif; 
                ?>
               
                <input type="hidden" value="<?php echo $modelName ?>" name="model" />
                <div class="form-group">
                        <?php
                            echo $this->Form->input('title', [
                                'type' => 'text',						                  
                                'class'=>'form-control required',
                            ]);
                        ?>
                   
                </div>
                
                <div class="form-group">
                    <?php
                        echo $this->Form->input('is_active', [
                            'type' => 'select',						                  
                            'class'=>'form-control required',
                            'options'=>['1'=>'Active','0'=>'In-active']
                        ]);
                    ?>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
            <?php 
                echo $this->Form->button(' <i class="fa fa-check"></i> Save', ['type' => 'submit','class'=>'btn btn-success','id'=>'save']);
            ?>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>
</div>