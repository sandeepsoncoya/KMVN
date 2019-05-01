
<div class="row">
   <div class="col-lg-12">
      <div class="card">
         <div class="card-header bg-info">
            <h4 class="m-b-0 text-white">Rates & Taxes</h4>
         </div>
         <?php echo $this->Form->create('RoomRates', ['type' => 'file']); ?>
         
         <div class="form-body">
            <div class="card-body">
               <div class="row p-t-20">
                  <div class="col-md-6">
                     <div class="form-group">
                        <?php
                           echo $this->Form->input('room_id', [
                               'type' => 'select',                                         
                               'class'=>'form-control required',
                               'required'   => false,
                               'options'=>$rooms,
                               'empty'=>'Please select...'
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
                           ]);
                           ?>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <?php
                           echo $this->Form->input('currency', [
                               'type' => 'select',                                         
                               'class'=>'form-control required',
                               'required'   => false,
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
                           echo $this->Form->input('tax', [
                               'type' => 'text',                                         
                               'class'=>'form-control required',
                               'label'=>'Quick Tax Calculation',
                               'required'   => false,
                           ]);
                           ?>
                     </div>
                  </div>
                  
                 
               </div>
               <hr>
               <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <th>1 Adult</th>
                            <th>2 Adult</th>
                            <th>Extra Bed</th>
                            <th>Child</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Rate</td>
                            <td>
                                <?php
                                    echo $this->Form->input('adult_one_rate', [
                                    'type' => 'text',                                         
                                    'class'=>'form-control required',
                                    'required'   => false,
                                    'label'=>false
                                    
                                ]);
                                ?>
                            </td>
                            <td>
                                <?php
                                    echo $this->Form->input('adult_two_rate', [
                                    'type' => 'text',                                         
                                    'class'=>'form-control required',
                                    'required'   => false,
                                    'label'=>false
                                    
                                ]);
                                ?>
                            </td>
                            <td>
                                <?php
                                    echo $this->Form->input('extra_bed', [
                                    'type' => 'text',                                         
                                    'class'=>'form-control required',
                                    'required'   => false,
                                    'label'=>false
                                    
                                ]);
                                ?>
                            </td>
                            <td>
                                <?php
                                    echo $this->Form->input('child', [
                                    'type' => 'text',                                         
                                    'class'=>'form-control required',
                                    'required'   => false,
                                    'label'=>false
                                    
                                ]);
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Tax</td>
                            <td>
                                <?php
                                    echo $this->Form->input('adult_one_rate', [
                                    'type' => 'text',                                         
                                    'class'=>'form-control required',
                                    'required'   => false,
                                    'label'=>false
                                    
                                ]);
                                ?>
                            </td>
                            <td>
                                <?php
                                    echo $this->Form->input('adult_two_rate', [
                                    'type' => 'text',                                         
                                    'class'=>'form-control required',
                                    'required'   => false,
                                    'label'=>false
                                    
                                ]);
                                ?>
                            </td>
                            <td>
                                <?php
                                    echo $this->Form->input('extra_bed', [
                                    'type' => 'text',                                         
                                    'class'=>'form-control required',
                                    'required'   => false,
                                    'label'=>false
                                    
                                ]);
                                ?>
                            </td>
                            <td>
                                <?php
                                    echo $this->Form->input('child', [
                                    'type' => 'text',                                         
                                    'class'=>'form-control required',
                                    'required'   => false,
                                    'label'=>false
                                    
                                ]);
                                ?>
                            </td>
                        </tr>

                    </tbody>

               </table>
               <hr>
               <h4>Rate Includes</h4>
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
               <div class="block-fee">
                  <div class="row">
                     <div class="col-md-6">
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
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="">How many days prior to arrival is the cancellation fee applicable..?</label>
                           <input type="text" class="form-control" />
                           <small class="form-text text-muted">days prior to arrival</small>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="">At what time would the cancellation fee be applicable on that day..? {e.g. 12:00 pm}</label>
                           <div class="input-group mb-3">
                              <input type="text" class="form-control" />
                              <div class="input-group-append">
                                 <select name="" id="" class="form-control">
                                    <option value="">AM</option>
                                    <option value="">PM</option>
                                 </select>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="">Define the percentage advance received that has to be refunded from rate..? </label>
                           <div class="input-group mb-3">
                              <input type="text" class="form-control" />
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
                              <input type="text" class="form-control" />
                              <div class="input-group-append">
                                 <span class="input-group-text">%</span>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 text-right mt-4">
                        <button type="button" class="btn btn-primary">Add New Cutoff</button>
                     </div>
                  </div>
               </div>



               <div class="custom-control custom-checkbox">
                  <input type="checkbox" id="check_01" name="customRadio" class="custom-control-input check_addOn">
                  <label class="custom-control-label" for="check_01">Apply Bar</label>
               </div>
               <div class="check-form" id="apply_bar">
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="">Display Name for BAR</label>
                           <input type="text" class="form-control">
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="">Enter a marketing slogan to display along with rate..? </label>
                           <input type="text" class="form-control">
                        </div>
                     </div>
                     <div class="col-md-12">
                        <div class="form-group">
                           <label for="">Define the hotel occupancy levels and applicable discounts-</label>
                           <div class="input-group">
                              <div class="input-group-prepend"><span class="input-group-text">When Occupancy is between</span></div>
                              <input type="text" class="form-control" />
                              <div class="input-group-append"><span class="input-group-text">% -</span></div>
                              <div class="input-group-append"><input type="text" class="form-control"></div>
                              <div class="input-group-append"><span class="input-group-text">Discount Rate By</span></div>
                              <div class="input-group-append"><input type="text" class="form-control"></div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="">How much advance has to be deposited along with booking</label>
                           <div class="input-group">
                              <div style="flex-grow:1;">
                                 <select name="" id="" class="form-control">
                                    <option value="">Not Required</option>
                                    <option value="">One Night</option>
                                    <option value="">Full</option>
                                    <option value="">Percentage</option>
                                 </select>
                              </div>
                              <div class="input-group-append"><input type="text" class="form-control"></div>
                              <div class="input-group-append"><span class="input-group-text">%</span></div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="">Is Deposit Amount refundable, if booking is subsequently cancelled ? </label>
                           <select name="" id="" class="form-control">
                              <option value="">Yes</option>
                              <option value="">No</option>
                           </select>
                        </div>
                     </div>
                  </div>
               </div>


               <div class="custom-control custom-checkbox">
                  <input type="checkbox" id="check_02" name="customRadio" class="custom-control-input check_addOn">
                  <label class="custom-control-label" for="check_02">Apply Advance Purchase</label>
               </div>
               <div class="check-form"  id="advance_purchase">
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group"><label for="">Display Name for APEX Rate</label><input type="text" class="form-control"></div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group"><label for="">Enter a marketing slogan to display along with rate..? </label><input type="text" class="form-control"></div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="">How many days prior to arrival is the cancellation fee applicable..?</label>
                           <div class="input-group">
                              <input type="text" class="form-control" />
                              <div class="input-group-append">
                                 <span class="input-group-text">Days in advance</span>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-12">
                        <div class="form-group">
                           <label for="">Define the hotel occupancy levels and applicable discounts-</label>
                           <div class="input-group">
                              <div class="input-group-prepend"><span class="input-group-text">When Occupancy is between</span></div>
                              <input type="text" class="form-control" />
                              <div class="input-group-append"><span class="input-group-text">% -</span></div>
                              <div class="input-group-append"><input type="text" class="form-control"></div>
                              <div class="input-group-append"><span class="input-group-text">Discount Rate By</span></div>
                              <div class="input-group-append"><input type="text" class="form-control"></div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="">Tax to be calculated on</label>
                           <select name="" id="" class="form-control">
                              <option value="">Tax On Rate</option>
                              <option value="">Tax After Discount</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="">Should the tax amount calculated be Rounded Up to nearest whole number </label>
                           <select name="" id="" class="form-control">
                              <option value="">Yes</option>
                              <option value="">No</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="">Round Up to nearest</label>
                           <input type="text" class="form-control">
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="">How much advance has to be deposited along with booking </label>
                           <select name="" id="" class="form-control">
                              <option value="">Not Required</option>
                              <option value="">One Night</option>
                              <option value="">Full</option>
                              <option value="">Percentage</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="">Is a Refund to be offered is booking is subsequently cancelled ? </label>
                           <select name="" id="" class="form-control">
                              <option value="">Yes</option>
                              <option value="">No</option>
                           </select>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="custom-control custom-checkbox">
                  <input type="checkbox" id="check_03" name="customRadio" class="custom-control-input check_addOn">
                  <label class="custom-control-label" for="check_03">Allow Sale of Distressed Inventory</label>
               </div>
               <div class="check-form" id="sale_inventory">
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group"><label for="">Display Name for Distressed Inventory </label><input type="text" class="form-control"></div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group"><label for="">Enter a marketing slogan to display along with rate..? </label><input type="text" class="form-control"></div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="">Offer a discount only when the date of arrival is within the next</label>
                           <div class="input-group">
                              <input type="text" class="form-control" />
                              <div class="input-group-append">
                                 <span class="input-group-text">Days</span>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="">Offer a discount only when the maximum stay is </label>
                           <div class="input-group">
                              <input type="text" class="form-control" />
                              <div class="input-group-append">
                                 <span class="input-group-text">Nights</span>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="">Offer discount </label>
                           <div class="input-group">
                              <input type="text" class="form-control" />
                              <div class="input-group-append">
                                 <span class="input-group-text">%</span>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="">Offer discount </label>
                           <div class="input-group">
                              <input type="text" class="form-control" />
                              <div class="input-group-append">
                                 <span class="input-group-text">% Level</span>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="">How much advance has to be deposited along with booking ? </label>
                           <select name="" id="" class="form-control">
                              <option value="">Not Required</option>
                              <option value="">One Night</option>
                              <option value="">Full</option>
                              <option value="">Percentage</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="">Is a Refund to be offered is booking is subsequently cancelled </label>
                           <select name="" id="" class="form-control">
                              <option value="">Yes</option>
                              <option value="">No</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="">Tax to be calculated on </label>
                           <<select name="" id="" class="form-control">
                              <option value="">Tax On Rate</option>
                              <option value="">Tax After Discount</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="">Should tax amount calculated be Rounded Up to nearest whole number </label>
                           <select name="" id="" class="form-control">
                              <option value="">Yes</option>
                              <option value="">No</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="">Round Up to nearest</label>
                           <input type="text" class="form-control">
                        </div>
                     </div>
                  </div>
               </div>
               <div class="custom-control custom-checkbox">
                  <input type="checkbox" id="check_04" name="customRadio" class="custom-control-input check_addOn">
                  <label class="custom-control-label" for="check_04">Complimentary Nights Offers</label>
               </div>
               <div class="check-form" id="night_offers">
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group"><label for="">Display Name for Complimentary Night Offer ..?</label><input type="text" class="form-control"></div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group"><label for="">Display Name for Complimentary Night Offer ..?</label><input type="text" class="form-control"></div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="">Define date during which this offer will be valid</label>
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
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="">Define the number of paid nights </label>
                           <input type="text" class="form-control" />
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="">Define the number of complimentary / discounted night/s </label>
                           <input type="text" class="form-control" />
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="">Define the discount percentage on the complimentary / discounted night/s </label>
                           <div class="input-group mb-3">
                              <input type="text" class="form-control" />
                              <div class="input-group-append">
                                 <span class="input-group-text">%</span>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="">How many times can this discount be availed during 1 continuous stay..?</label>
                           <input type="text" class="form-control" />
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="">How much advance has to be deposited along with booking ?</label>
                           <select name="" id="" class="form-control">
                              <option value="">Not Required</option>
                              <option value="">One Night</option>
                              <option value="">Full</option>
                              <option value="">Percentage</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="">Is a Refund to be offered is booking is subsequently cancelled ?</label>
                           <select name="" id="" class="form-control">
                              <option value="">Yes</option>
                              <option value="">No</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="">Tax to be calculated on  </label>
                           <select name="" id="" class="form-control">
                              <option value="">Tax On Rate</option>
                              <option value="">Tax After Discount</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="">Should the tax amount calculated be Rounded Up to nearest whole number </label>
                           <select name="" id="" class="form-control">
                              <option value="">Yes</option>
                              <option value="">No</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="">Round Up to nearest</label>
                           <input type="text" class="form-control">
                        </div>
                     </div>
                     <div class="col-md-12 text-right">
                        <button type="button" class="btn btn-primary">Add New</button>
                     </div>
                  </div>
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
                             'plugin'=>'admin'                                        
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