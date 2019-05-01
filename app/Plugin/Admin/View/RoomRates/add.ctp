<?php 
    echo $this->Html->script([
        '/admin/assets/libs/moment/moment',
        '/admin/assets/libs/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker-custom',
           
    ], array('block' => 'scriptBottom'));
    echo $this->Html->css([
        '/admin/assets/libs/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker',                
           
    ], array('block' => 'cssBottom'));
 ?>
 <?php
  $defalutValue =  (isset($this->request->data['RoomRates']['bed_type_id']))?$this->request->data['RoomRates']['bed_type_id']:''; ?>
<div class="row">
   <div class="col-lg-12">
      <div class="card">
         <div class="card-header bg-info">
            <h4 class="m-b-0 text-white">Rates & Taxes</h4>
         </div>
         <?php echo $this->Form->create('RoomRates', ['type' => 'file']); ?>
         <?php 
               
            echo $this->Form->input('id', [
                        'type' => 'hidden'                              
                     ]);
         
         ?>
         <div class="form-body">
            <div class="card-body">
               <div class="row p-t-20">
                  <div class="col-md-6">
                     <div class="form-group">
                        <?php
                           echo $this->Form->input('room_id', [
                               'type' => 'select',                                         
                               'class'=>'form-control required get_bed_type',
                               'required'   => false,
                               'options'=>$rooms,
                               'empty'=>'Please select...',
                               
                           ]);
                           ?>
                     </div>
                  </div>
                  
                  <div class="col-md-6">
                     <div class="form-group">
                        <?php
                           echo $this->Form->input('bed_type_id', [
                               'type' => 'select',                                         
                               'class'=>'form-control required',
                               'required'   => false,
                               'options'=>$bedTypeArr,
                               'selected'=>$defalutValue
                           ]);
                           ?>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <?php
                           echo $this->Form->input('rate_code_id', [
                               'type' => 'select',                                         
                               'class'=>'form-control required',
                               'required'   => false,
                               'options'=>$rateCode,
                               'empty'=>'Please Select...'
                           ]);
                           ?>
                     </div>
                  </div>
                  
                  <div class="col-md-6">
                     <div class="form-group">
                        <?php
                           echo $this->Form->input('season_id', [
                               'type' => 'select',                                         
                               'class'=>'form-control required',
                               'required'   => false,
                               'options'=>$season,
                               'empty'=>'Please Select...'
                           ]);
                           ?>
                     </div>
                  </div>
                  
                 
               </div>
               <hr>
               <div class="row p-t-20">
                  <div class="col-md-6">
                     <div class="form-group">
                        <?php
                            echo $this->Form->input('deposit_required', [
                               'type' => 'select',                                         
                               'class'=>'form-control required',
                               'required'   => false,
                               'options'=>['1'=>'Not Required','2'=>'One Night','3'=>'Full','4'=>'Percentage'],
                               'empty'=>'Please Select..',
                               'label'=>'How much Deposit is required..?'
                               
                           ]);
                        ?>
                     </div>
                  </div>
                  
                  <div class="col-md-6 d-none">
                     <div class="form-group">
                        <?php
                           echo $this->Form->input('deposit_percentage', [
                               'type' => 'text',                                         
                               'class'=>'form-control required',
                               'required'   => false,
                           ]);
                           ?>
                     </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <?php
                           echo $this->Form->input('rate_code_id', [
                               'type' => 'select',                                         
                               'class'=>'form-control required',
                               'required'   => false,
                               'options'=>['1'=>'Yes','0'=>'No'],
                               'label'=>'Is the Deposit Refundable'
                           ]);
                           ?>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <?php
                           echo $this->Form->input('minimum_stay', [
                               'type' => 'text',                                         
                               'class'=>'form-control required',
                               'required'   => false,
                           ]);
                           ?>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <?php
                           echo $this->Form->input('apply_minimum_stay', [
                               'type' => 'select',                                         
                               'class'=>'form-control required',
                               'options'=>['1'=>'Yes','0'=>'No'],
                               'required'   => false,
                           ]);
                           ?>
                     </div>
                  </div>

                  <div class="col-md-6">
                     <div class="form-group">
                        <?php
                           echo $this->Form->input('adult_one_rate', [
                               'class'=>'form-control required',
                               'required'   => false,
                               'min'   => 1,
                               'label'   => 'Room Rate',
                           ]);

                           echo $this->Form->input('tax', [
                               'class'=>'form-control required',
                               'type'=>'hidden',
                               'required'   => false,
                               'label'=>false 
                           ]);

                            echo $this->Form->input('adult_one_tax', [
                                    'type' => 'hidden',                                         
                                    'class'=>'form-control required',
                                    'required'   => false,
                                    'label'=>false 
                                    ]);
                           ?>
                     </div>
                  </div>
                  
                 
               </div>
               <hr>
              
               <hr>
               <h4>Rate Includes</h4>
               <?php 
                
                  if(isset($this->request->data['RoomInclusionSelected'])){
                     $selectedFacility = $this->request->data['RoomInclusionSelected'];
                     $selectedFacility =array_column($selectedFacility, 'include_id');
                     $selectedFacility = array_values($selectedFacility);
                  
                  }
               ?>
               
                  
               <div class="form-row">
                     <?php
                     if(isset($rateInclude) && !empty($rateInclude)): ?>
                        <?php foreach($rateInclude as $info): 
                                 $Facitlyid= $info['RateInclude']['id'];
                           ?>
                           <div class="col-md-3">
                                 <div class="form-check form-control-plaintext">
                                    <input type="checkbox" name="data[RoomInclusionSelected][include_id][]" <?php echo (isset($selectedFacility) && in_array($Facitlyid,$selectedFacility))?'checked="checked"':''; ?> class="form-check-input" value="<?php echo $info['RateInclude']['id']; ?>" >
                                    <label  class="form-check-label"><?php echo $info['RateInclude']['title']; ?></label>
                                 </div>
                           </div>
                        <?php endforeach; ?>
                     <?php endif; ?>
                     
               </div>
              
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <?php
                           echo $this->Form->input('rate_include_description', [
                               'type' => 'textarea',                                         
                               'class'=>'form-control required',
                              
                           ]);
                           ?>
                     </div>
                  </div>
               </div>
               <hr>
               <h4>Cancellation Fee Definition</h4>
               <div class="rate-msg">
                  <p>The rate has been defined as Refundable.</p>
                  <p>In order for the system to calculate the cancellation fee and the subsequent refund that would have to be made to a customer on cancellation of a confirmed booking, the following information needs to be completed.</p>
                  <p class="text-warning">Please note that multiple cancellation periods can be defined </p>
               </div>
               <div class="copy_row">
                  <div class="block-fee">
                     <div class="row">
                        <!-- <div class="col-md-6">
                           <div class="form-group">
                              <label for="">Define cancellation date range </label>
                              <div class="input-group mb-3">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text" id="start_date">Start Date</span>
                                 </div>
                                 <input type="text" class="form-control" aria-describedby="start_date" />
                                 <div class="input-group-prepend">
                                    <span class="input-group-text" id="end_date">End Date</span>
                                 </div>
                                 <input type="text" class="form-control" aria-describedby="end_date" />
                              </div>
                           </div>
                        </div> -->
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="">How many days prior to arrival is the cancellation fee applicable..?</label>
                                 <?php
                                    $days = (isset($this->request->data['RoomCancellation'][0]['days']))?$this->request->data['RoomCancellation'][0]['days']:'';
                                    $time = (isset($this->request->data['RoomCancellation'][0]['time']))?$this->request->data['RoomCancellation'][0]['time']:'';
                                    $refund_percentage = (isset($this->request->data['RoomCancellation'][0]['refund_percentage']))?$this->request->data['RoomCancellation'][0]['refund_percentage']:'';
                                    $refund_tax = (isset($this->request->data['RoomCancellation'][0]['refund_tax']))?$this->request->data['RoomCancellation'][0]['refund_tax']:'';
                                    echo $this->Form->input('days.', [
                                       'type' => 'number',                                         
                                       'class'=>'form-control required',
                                       'required'   => true,
                                       'label'=>false,
                                       'value'=>$days
                                    ]);
                                 ?>
                             
                              <small class="form-text text-muted">days prior to arrival</small>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="">At what time would the cancellation fee be applicable on that day..? {e.g. 12:00 pm}</label>
                              
                                 <?php
                                    echo $this->Form->input('time.', [
                                       'type' => 'text',                                         
                                       'class'=>'form-control time',
                                       'required'   => true,
                                       'label'=>false,
                                       'value'=>$time
                                       
                                    ]);
                                 ?>
                                 
                                
                              
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="">Define the percentage advance received that has to be refunded from rate..? </label>
                              <div class="input-group mb-3">
                                 <?php
                                    echo $this->Form->input('refund_percentage.', [
                                       'type' => 'text',                                         
                                       'class'=>'form-control required',
                                       'required'   => true,
                                       'label'=>false,
                                       'value'=>$refund_percentage
                                      
                                    ]);
                                 ?>
                                 <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="">Define the percentage advance received that has to be refunded from tax ..?</label>
                              <div class="input-group mb-3">
                                 <?php
                                    echo $this->Form->input('refund_tax.', [
                                       'type' => 'text',                                         
                                       'class'=>'form-control required',
                                       'required'   => true,
                                       'label'=>false,
                                       'value'=>$refund_tax
                                      
                                    ]);
                                 ?>
                                 <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-12 text-right mt-4">
                           <button type="button" class="btn btn-primary btn-cancel">Add New Cutoff</button>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="cancel_items">
               <?php 
               if (isset($this->request->data['RoomCancellation'])) {
               if(sizeof($this->request->data['RoomCancellation']) > 1 ): ?>
                  <?php foreach($this->request->data['RoomCancellation'] as $key=>$roomCancel): ?>
                     <?php if($key>0):?>
                        <div class="block-fee">
                           <div class="row">
                              
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="">How many days prior to arrival is the cancellation fee applicable..?</label>
                                       <?php
                                          $days = $roomCancel['days'];
                                          $time = $roomCancel['time'];
                                          $refund_percentage = $roomCancel['refund_percentage'];
                                          $refund_tax = $roomCancel['refund_tax'];
                                          echo $this->Form->input('days.', [
                                             'type' => 'number',                                         
                                             'class'=>'form-control required',
                                             'required'   => false,
                                             'label'=>false,
                                             'value'=>$days
                                          ]);
                                       ?>
                                 
                                    <small class="form-text text-muted">days prior to arrival</small>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="">At what time would the cancellation fee be applicable on that day..? {e.g. 12:00 pm}</label>
                                    
                                       <?php
                                          echo $this->Form->input('time.', [
                                             'type' => 'text',                                         
                                             'class'=>'form-control time',
                                             'required'   => false,
                                             'label'=>false,
                                             'value'=>$time
                                             
                                          ]);
                                       ?>
                                       
                                    
                                    
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="">Define the percentage advance received that has to be refunded from rate..? </label>
                                    <div class="input-group mb-3">
                                       <?php
                                          echo $this->Form->input('refund_percentage.', [
                                             'type' => 'text',                                         
                                             'class'=>'form-control required',
                                             'required'   => false,
                                             'label'=>false,
                                             'value'=>$refund_percentage
                                          
                                          ]);
                                       ?>
                                       <div class="input-group-append">
                                          <span class="input-group-text">%</span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="">Define the percentage advance received that has to be refunded from tax ..?</label>
                                    <div class="input-group mb-3">
                                       <?php
                                          echo $this->Form->input('refund_tax.', [
                                             'type' => 'text',                                         
                                             'class'=>'form-control required',
                                             'required'   => false,
                                             'label'=>false,
                                             'value'=>$refund_tax
                                          
                                          ]);
                                       ?>
                                       <div class="input-group-append">
                                          <span class="input-group-text">%</span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-12 text-right mt-4">
                                 <button type="button" class="btn btn-danger  btn-delete">Remove</button>
                              </div>
                           </div>
                        </div>
                     <?php endif; ?>
                  <?php endforeach; ?>
               <?php endif; } ?>
               
               
               </div>

            </div>
            <div class="form-actions">
               <div class="card-body">
                  <?php 
                     echo $this->Form->button(' <i class="fa fa-check"></i> Save', ['type' => 'submit','class'=>'btn btn-success ']);
                     ?>
                  <?php
                     echo $this->Html->link(
                         'Cancel',
                         array(
                             'controller' => 'hotels',
                             'action' => 'index',
                             'plugin'=>'admin',
                             'hotel'=>$hotelId                                       
                         ),
                         [
                         'escape' => false,
                         'class'=>'btn btn-dark'
                         ]
                     );
                     ?>
               </div>
            </div>
         </div>
         </form>
      </div>
   </div>
</div>

<script>
   $(document).ready(function(){
      $(".check_addOn").on("change",function(){
         if($(this).prop("checked")){
            $(this).closest(".custom-checkbox").next(".check-form").slideDown(300);
         }
         else{
            $(this).closest(".custom-checkbox").next(".check-form").slideUp(300);
         }
      })
   })
</script>