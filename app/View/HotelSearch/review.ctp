<style type="text/css">
   .perdtl-row {
   display: flex;
   margin: 0 -0.5rem;
   align-items: flex-end;
   padding: 0.5rem 0;
   }
   .perdtl-col {
   flex: 0 0 auto;
   -ms-flex: 0 0 auto;
   max-width: none;
   padding: 0 0.5rem;
   font-family: "Poppins",sans-serif;
   }
   .perdtl-col .form-group {
   margin-bottom: 0;
   }
   .perdtl-col .form-group > label {
   font-size: 0.75rem;
   margin: 0 0 0.25rem 0;
   color: #626262;
   }
   .perdtl-col .form-group .form-control {
   border-radius: 0;
   padding: 0.25rem 1.25rem 0.25rem 0.5rem;
   font-size: 0.75rem;
   height: auto;
   -webkit-apperance:none;
   -moz-appearance:none;
   background:#ffffff url("../images/icon_dropdown_pink.png") no-repeat right 5px center;
   }
   .perdtl-col .form-group .form-check {
   margin-bottom: 0.25rem;
   }
</style>
<section class="kh-banner" style="background-image:url('../images/package_banner.jpg');">
   <div class="khb-in">
      <div class="container">
         <h2>Hotels</h2>
         <ul class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><span>Hotel</span></li>
         </ul>
      </div>
   </div>
</section>
<section class="khp-block">
   <div class="container">
      <div class="khpb-content">
         <div class="kmpbf-wizard">
            <div class="kmpbfw-head">
               <div class="kmpbfwh-left-btn">
                  <?php echo $this->Html->link('Back to home',['controller'=>'hotels','action'=>'index'],['class'=>'btn btn-pink']); ?>
               </div>
               <div class="kmpbfwh-steps">
                  <ul>
                     <li><?php echo $this->Html->link('<span>01</span> Hotels',['controller'=>'hotel_search','action'=>'index'],['class'=>'active','escape'=>false]); ?></li>
                     <li><?php echo $this->Html->link('<span>02</span> Extra Services >>',['controller'=>'hotel_search','action'=>'services'],['class'=>'active','escape'=>false]); ?></li>
                     <li><?php echo $this->Html->link('<span>03</span> Review >>>',['controller'=>'hotel_search','action'=>'review'],['class'=>'active','escape'=>false]); ?></li>
                     <li><?php echo $this->Html->link('<span>04</span> Travellers >>>',['controller'=>'hotel_search','action'=>'travellers'],['class'=>'','escape'=>false]); ?>
                     </li>
                  </ul>
               </div>
            </div>
            <?php 
               if( !empty($HotelData)){
               ?>
            <?php 
               if (!empty($this->Session->read('HotelData'))) {
                  echo $this->Form->create('Services', ['url'=>['controller'=>'hotel_search','action'=>'travellers']]);
               ?>
            <div class="kmpbfw-content">
               <div class="kmpbfwh-review">
                  <div class="card card-dark">
                     <div class="card-header">Review booking detail</div>
                     <div class="card-body">
                        <?php if(!empty($HotelData)){ 
                           $totalPayableAmt = 0;
                         ?>
                        <?php foreach($HotelData as $key => $selectedHotel){
                           $date1 = new DateTime($selectedHotel['check_in_date']);
                           $date2 = new DateTime($selectedHotel['check_out_date']);
                           $numberOfNights= $date2->diff($date1)->format("%a"); 
                           
                           ?>
                        <?php 
                           $adultrate = (($selectedHotel['no_of_rooms']) * ($selectedHotel['RoomRates']['RoomRates']['adult_one_rate']))*$numberOfNights;
                           
                           $taxrate = (($selectedHotel['no_of_rooms']) * ($selectedHotel['RoomRates']['RoomRates']['adult_one_tax']))*$numberOfNights;
                           $total = $adultrate + $taxrate;
                           
                           ?>
                        <div class="kmpbfwhr-block">
                           <div class="kmpbfhr-bx">
                              <h4>Person Details</h4>
                              <div class="kmpbfhrb-content">
                                 <div class="perdtl-row">
                                    <div class="perdtl-col">
                                       <div class="form-group">
                                          <label for="">Adult</label>
                                          <select name="data[Room][adult][<?php echo $selectedHotel['bedType']['BedType']['id']; ?>]" id="<?php echo $selectedHotel['bedType']['BedType']['id']; ?>" class="form-control">
                                             <?php if(isset($selectedHotel['bedType']['BedType'])): ?>
                                             <?php for($i=1;$i<=$selectedHotel['bedType']['BedType']['adult_beds'];$i++): ?>
                                             <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                             <?php endfor; ?>
                                             <?php endif; ?>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="perdtl-col">
                                       <div class="form-group">
                                          <label for="">Child</label>
                                          <select name="data[Room][child][<?php echo $selectedHotel['bedType']['BedType']['id']; ?>]" id="" class="form-control">
                                             <option value="0">0</option>
                                             <option value="1">1</option>
                                             <option value="2">2</option>
                                             <option value="3">3</option>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="perdtl-col">
                                       <div class="form-group">
                                          <div class="form-check">
                                             <?php 
                                                $selectedExtra = $this->Session->read('HotelData.RoomSelected');


                                                $chkSelected = '';
                                                if ( isset($selectedExtra) && array_key_exists($selectedHotel['bedType']['BedType']['id'], $selectedExtra)) {

                                                   if (isset($selectedExtra[$selectedHotel['bedType']['BedType']['id']]['extraBed']) && !empty($selectedExtra[$selectedHotel['bedType']['BedType']['id']]['extraBed'])) {
                                                     
                                                      $chkSelected = "checked"; } 
                                                   }
                                                
                                                ?>
                                             <input class="form-check-input extabed" data-night="<?=  $numberOfNights ?>" data-rate="<?= $selectedHotel['RoomRates']['RoomRates']['adult_one_rate']?>" data-bedId="<?php echo $selectedHotel['bedType']['BedType']['id']; ?>" name="data[Room][extra_person][]" type="checkbox" value="" id="check_eperson_<?php echo $selectedHotel['bedType']['BedType']['id']; ?>" <?php echo $chkSelected; ?> >
                                             <label class="form-check-label" for="check_eperson_<?php echo $selectedHotel['bedType']['BedType']['id']; ?>">
                                             Extra Person
                                             </label>

                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="kmpbfwhr-block">
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="kmpbfhr-bx">
                                    <h4>Review Rate Details:</h4>
                                    <div class="kmpbfhrb-content">
                                       <div class="review-row">
                                          <div class="review-label">Room Type</div>
                                          <div class="review-col">
                                             <?php echo ucwords($selectedHotel['room_type']).'('.$selectedHotel['bedType']['BedType']['title'].')'; ?>
                                          </div>
                                       </div>
                                       <div class="review-row">
                                          <div class="review-label">Refundable</div>
                                          <div class="review-col"> <?php if($selectedHotel['is_deposit_refundable'] == 1){ echo 'Refund Will Be Allowed'; }else{ echo 'Partial Refund Will Be Allowed'; } ?> </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="kmpbfhr-bx">
                                    <h4 class="text-pink"> Rate Details</h4>
                                    <div class="kmpbfhrb-content">
                                       <div class="table-responsive">
                                          <table class="table">
                                             <thead>
                                                <tr>
                                                   <th></th>
                                                   <th>Rate x total rooms x  nights</th>
                                                   <th>Total</th>
                                                </tr>
                                             </thead>
                                             <tbody>
                                                <tr>
                                                   <td>For <?= !empty($selectedHotel['check_in_date']) ? date("d-M-Y D", strtotime($selectedHotel['check_in_date'])) : '' ?></td>
                                                   <td><?= $selectedHotel['RoomRates']['RoomRates']['adult_one_rate']?> x <?= $selectedHotel['no_of_rooms']; ?> x <?=  $numberOfNights ?></td>
                                                   <td><?= $adultrate; ?></td>
                                                </tr>
                                                <tr>
                                                   <td>Taxes + Fees</td>
                                                   <td><?= $selectedHotel['RoomRates']['RoomRates']['adult_one_tax']?> x <?= $selectedHotel['no_of_rooms']; ?> x <?= $numberOfNights ?> </td>
                                                   <td><?= $taxrate; ?> </td>
                                                </tr>
                                                <?php 
                                                  if (isset($selectedHotel['extraBed']) && !empty($selectedHotel['extraBed'])) { 
                                                    ?>
                                                   <tr id="extra_<?php echo $selectedHotel['bedType']['BedType']['id']; ?>">
                                                      <td>Extra Bed Charge</td>
                                                      <td> <?php echo $selectedHotel['extraBed']; ?></td>
                                                      <td><?php echo $selectedHotel['totalExtraBedChnage']; ?></td>
                                                   </tr>
                                                <?php }else{ ?>
                                                      <tr style="display:none;" id="extra_<?php echo $selectedHotel['bedType']['BedType']['id']; ?>">
                                                         <td>Extra Bed Charge</td>
                                                         <td> <?php echo $selectedHotel['extraBed']; ?></td>
                                                         <td><?php echo $selectedHotel['totalExtraBedChnage']; ?></td>
                                                      </tr>    
                                                <?php } ?>
                                             </tbody>
                                             <tfoot>
                                                <tr>
                                                   <td colspan="2" >Room Charges</td>
                                                   <td><span class="text-pink" >INR <span id="room_charge_<?php echo $selectedHotel['bedType']['BedType']['id']; ?>"><?php
                                                   if(!empty($selectedHotel['extraBed'])){
                                                     echo $adultrate+$taxrate+ $selectedHotel['totalExtraBedChnage']; 
                                                   }else{
                                                     echo $adultrate+$taxrate; 
                                                   }
                                                    ?></span></span></td>
                                                </tr>
                                                <tr>
                                                   <td colspan="2"><span class="text-pink">Total Room Payable</span></td>
                                                   <td>
                                                      <span class="text-pink" >INR 
                                                      <span id="total_charge_<?php echo $selectedHotel['bedType']['BedType']['id']; ?>">
                                                      <?php 
                                                         if (isset($selectedHotel['extraBed']) && !empty($selectedHotel['extraBed'])) {
                                                            $textra = $selectedHotel['totalExtraBedChnage'];
                                                         }else{
                                                            $textra = 0;
                                                         }
                                                         $totalPayable = $adultrate+$taxrate+$textra ;

                                                         $totalPayableAmt +=$totalPayable;
                                                         echo $totalPayable;  
                                                         ?>
                                                      </span>
                                                      </span>
                                                   </td>
                                                </tr>
                                             </tfoot>
                                          </table>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="kmpbfwhr-block">
                           <div class="kmpbfhr-bx">
                              <?php if ($selectedHotel['roomcancel']) { ?>
                              <!-- Trigger the modal with a button -->
                              <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal_<?php echo $key; ?>"> View Cancellations</button>
                              <!-- Modal -->
                              <div id="myModal_<?php echo $key; ?>" class="modal fade" role="dialog">
                                 <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                       <div class="modal-header">
                                          <h2 class="modal-title">Cancellations policy</h2>
                                       </div>
                                       <div class="modal-body">
                                          <div class="table-responsive">
                                             <table class="table">
                                                <thead>
                                                   <tr>
                                                      <th class="border-top-0">Days Before</th>
                                                      <th class="border-top-0">Percent</th>
                                                      <th class="border-top-0">Amount</th>
                                                   </tr>
                                                </thead>
                                                <tbody>
                                                   <?php 
                                                      foreach ($selectedHotel['roomcancel'] as $key => $value) {
                                                      ?>
                                                   <tr>
                                                      <td><?= $value['RoomCancellation']['days']; ?></td>
                                                      <td><?= $value['RoomCancellation']['refund_percentage']; ?></td>
                                                      <td><?php echo ($value['RoomCancellation']['refund_percentage']/100)*$adultrate ?></td>
                                                   </tr>
                                                   <?php  }?>
                                                </tbody>
                                             </table>
                                          </div>
                                       </div>
                                       <div class="modal-footer">
                                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <?php  } ?>
                           </div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="kmpbfhr-bx">
                                 <h4>Services</h4>
                                 <div class="kmpbfhrb-content">
                                    <div class="review-row">
                                       <div class="review-col">
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="kmpbfhr-bx">
                                 <div class="kmpbfhrb-content">
                                    <div class="table-responsive">
                                       <table class="table">
                                          <tfoot>
                                             <?php
                                                $userServices =  $this->Session->read('HotelData.userServices');
                                                 $extra = 0;
                                                 if (isset($userServices) && !empty($userServices)) {
                                                    foreach ($userServices as $key => $userService) { 
                                                       $extra +=( $userService['Services']['price']+$userService['Services']['tax']) * ($userService['Services']['qty']);
                                                 if(empty($serviceData) && !empty($HotelData)){
                                                       ?>
                                             <tr>
                                                <td><?php echo $userService['Services']['title'] ?></td>
                                                <td><?= $userService['Services']['price'];?> + <?= $userService['Services']['tax']; ?> * <?= $userService['Services']['qty']; ?> </td>
                                                <td><?php
                                                   $price = $userService['Services']['price'];
                                                   $tax = $userService['Services']['tax'];
                                                   $qty = $userService['Services']['qty'];
                                                   
                                                   $totatlService = ($price+$tax) * ($qty);
                                                    echo $totatlService; ?></td>
                                             </tr>
                                             <?php } 
                                                } 
                                                }?>
                                             <tr>
                                                <td colspan="2"><span class="text-pink">Total Payable amount</span></td>
                                                <td>
                                                   <span id="text-pink" class="text-pink" >INR 
                                                   <span id="total_charge_<?php echo $selectedHotel['bedType']['BedType']['id']; ?>">
                                                   <?php 
                                                      $totalPayableAmt = $totalPayableAmt+ $extra;
                                                      echo $totalPayableAmt;  
                                                      
                                                      ?>
                                                   </span>
                                                   </span>
                                                </td>
                                             </tr>
                                          </tfoot>
                                       </table>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="kmpbfwhr-block">
                           <div class="row align-items-center">
                              <div class="col-md-8">
                                 <div class="kmpbfhr-bx">
                                    <h4>Review Terms and Conditions</h4>
                                    <div class="kmpbfhrb-content">
                                       <div class="form-check">
                                          <input name="terms" class="form-check-input" type="checkbox" value="1" required="required">
                                          <label class="form-check-label">
                                          <a href="javascript:;">I have read and accept the rules governing this booking</a>
                                          </label>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4 text-right">
                                 <div class="kmpbfhr-bx">
                                    <button name="submit" type="submit" class="btn btn-pink">Continue</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <?php echo $this->Form->end();  }
               ?>
            <?php
               }
               ?>
         </div>
      </div>
   </div>
</section>
