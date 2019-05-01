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
                  <a href="index.html" class="btn btn-pink">Back to Home</a>
               </div>
               <div class="kmpbfwh-steps">
                  <ul>
                     <li><?php echo $this->Html->link('<span>01</span> Hotels',['controller'=>'hotel_search','action'=>'index'],['class'=>'active','escape'=>false]); ?></li>
                     <li><?php echo $this->Html->link('<span>02</span> Extra Services >>',['controller'=>'hotel_search','action'=>'services'],['class'=>'active','escape'=>false]); ?></li>
                     <li><?php echo $this->Html->link('<span>03</span> Review >>>',['controller'=>'hotel_search','action'=>'review'],['class'=>'active','escape'=>false]); ?></li>
                     <li><?php echo $this->Html->link('<span>04</span> Travellers >>>',['controller'=>'hotel_search','action'=>'travellers'],['class'=>'active','escape'=>false]); ?>
                     </li>
                  </ul>
               </div>
            </div>
            <div class="kmpbfw-content">
               <div class="kmpbfwh-review">
                  <div class="card card-dark">
                     <div class="card-header">Review booking detail</div>
                     <div class="card-body">
                        <?php echo $this->Form->create('', ['url'=>['controller'=>'hotel_search','action'=>'payment'],'id'=>'form_check']); ?>
                        <?php 
                        $totalPayableAmt =0;
                         if(!empty($HotelData)): ?>
                           
                           <?php foreach($HotelData as $data):?>
                              <div class="kmpbfwhr-block">
                                 <div class="row">
                                    <div class="col-md-9">
                                       <div class="kmpbfhr-bx">
                                          <h4 class="text-pink"><?php echo ucwords($data['room_type']).'('.$data['bedType']['BedType']['title'].')'; ?></h4>
                                          <div class="kmpbfhrb-content">
                                             <div class="row">
                                                <div class="col-md-4">
                                                   <div class="review-row">
                                                      <div class="review-label">Check In</div>
                                                      <div class="review-col">12:00 AM <?= !empty($data['check_in_date']) ? date("d F Y", strtotime($data['check_in_date'])) : '' ?></div>
                                                   </div>
                                                   <div class="review-row">
                                                      <div class="review-label">Check Out</div>
                                                      <div class="review-col">12:00 AM <?= !empty($data['check_out_date']) ? date("d F Y", strtotime($data['check_out_date'])) : '' ?></div>
                                                   </div>
                                                </div>
                                                <div class="col-md-4">
                                                   <div class="review-row">
                                                      <div class="review-label">Rooms</div>
                                                      <div class="review-col"><?= !empty($data['no_of_rooms']) ? $data['no_of_rooms'] : 0 ?> Room</div>
                                                   </div>
                                                   <div class="review-row">
                                                      <div class="review-label">Persons </div>
                                                      <div class="review-col"><?php echo $data['adult']." Adult ".$data['child']." Child"; ?></div> 
                                                   </div>
                                                </div>
                                                <div class="col-md-4">
                                                   <div class="review-row">
                                                      <div class="review-label"># of Nights</div>
                                                      <?php 
                                                         $date1 = new DateTime($data['check_in_date']);
                                                         $date2 = new DateTime($data['check_out_date']);
                                                         $numberOfNights= $date2->diff($date1)->format("%a"); 
                                                         ?>
                                                      <div class="review-col"><?= $numberOfNights; ?></div>
                                                   </div>
                                                   <div class="review-row">
                                                      <div class="review-label">Extra Person</div>
                                                      <div class="review-col"><?php
                                                      if (isset($data['extraBed']) && $data['extraBed'] == true) {
                                                          echo "Yes";
                                                        }else{
                                                          echo "No";  
                                                        } ?>
                                                       </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="kmpbfhr-bx">
                                          <h4>Total Charges:</h4>
                                          <div class="kmpbfhrb-content">
                                             <?php 
                                                $adultrate = (($data['no_of_rooms']) * ($data['RoomRates']['RoomRates']['adult_one_rate']))*$numberOfNights;
                                                
                                                $taxrate = (($data['no_of_rooms']) * ($data['RoomRates']['RoomRates']['adult_one_tax']))*$numberOfNights;
                                                $total = $adultrate + $taxrate;
                                                
                                                $extra = 0;
                                               
                                                      if (isset($userServices) && !empty($userServices)) {
                                                         foreach ($userServices as $key => $userService) { 
                                                            
                                                            $extra +=  ($userService['Services']['price'] + $userService['Services']['tax'] * ($userService['Services']['qty']));
                                                         }
                                                      }
                                                
                                                ?>
                                             <p class="text-pink font-weight-bold price-top">INR <?php 
                                                $totalPayable = $adultrate+$taxrate;
                                               
                                                if (isset($data['extraBed']) && $data['extraBed'] == true) {
                                                   $totalPayable =$totalPayable + $data['totalExtraBedChnage'];
                                                }
                                                $totalPayableAmt +=$totalPayable;
                                                echo $totalPayable;  ?></p>

                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           <?php endforeach;?>
                        <?php endif; ?>
                        <div class="row">
                           <div class="col-md-12">
                              <div class="kmpbfhr-bx">
                                <h6 class="text-pink">Services</h6>
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
                                                   <span class="text-pink" >INR 
                                                   <span id="total_charge">
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
                       <div class="kmtra-bx">
                           <h4>1. Traveller Details:</h4>
                           <div class="kmtrab-form">
                          
                              <div class="row align-items-md-center">
                                 
                                 <div class="col-md-10 col-lg-11">
                                    <div class="form-inline">
                                       <div class="form-group mb-md-0">
                                          <?php
                                      echo $this->Form->input('Travellers.title', [ 'type' => 'select','class'=>'form-control',
                                                 'options'   => ['Mr'=>'Mr','Ms'=>'Ms'],
                                                 'empty'   => 'Select title...',
                                                 'label'=>false,
                                                 'required'=>true
                                             ]);
                                             ?>
                                       </div>
                                       <div class="form-group mb-md-0">
                                          <?php
                                             echo $this->Form->input('Travellers.first_name', ['class'=>'form-control','placeholder'=>'First name','label'=>false,
                                                 'required'=>true ]);
                                                             ?>
                                       </div>
                                       <div class="form-group mb-md-0">
                                          <?php
                                             echo $this->Form->input('Travellers.middle_name', ['class'=>'form-control','placeholder'=>'Middle name','label'=>false]);
                                                             ?>
                                       </div>
                                       <div class="form-group mb-md-0">
                                          <?php
                                             echo $this->Form->input('Travellers.last_name', ['class'=>'form-control','placeholder'=>'Last name','label'=>false,
                                                 'required'=>true ]);
                                                             ?>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                             
                           </div>
                        </div>
                        <div class="kmtra-bx">
                           <h4>2. Traveler Contact Details:</h4>
                           <div class="kmtrab-form">
                              <div class="row">
                                 <div class="col-md-2 col-lg-1"></div>
                                 <div class="col-md-10 col-lg-11">
                                    <div class="row">
                                       <div class="col-md-3">
                                          <div class="form-group">
                                             <?php
                                             echo $this->Form->input('TravellersDetails.city', ['class'=>'form-control','placeholder'=>'City','label'=>false,
                                                 'required'=>true ]);
                                                             ?>
                                          </div>
                                       </div>
                                       <div class="col-md-3">
                                          <div class="form-group">
                                             <?php
                                             echo $this->Form->input('TravellersDetails.pin_code', ['class'=>'form-control','placeholder'=>'Pin Code','label'=>false,
                                                 'required'=>true ]);
                                                             ?>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-md-3">
                                          <div class="form-group">
                                             <?php
                                             echo $this->Form->input('TravellersDetails.mobile_no', ['class'=>'form-control','placeholder'=>'Mobile No.','label'=>false,
                                                 'required'=>true ]);
                                                             ?>
                                          </div>
                                       </div>
                                       <div class="col-md-3">
                                          <div class="form-group">
                                             <?php
                                             echo $this->Form->input('TravellersDetails.email_id', ['type'=>'text','class'=>'form-control','placeholder'=>'Email Id','label'=>false,
                                                 'required'=>true ]);
                                                             ?>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-md-6">
                                          <div class="form-group">
                                             <?php
                                             echo $this->Form->input('TravellersDetails.address_1', ['class'=>'form-control','type'=>'textarea','placeholder'=>'Address','label'=>false,
                                                 'required'=>true ]);
                                                             ?>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="kmtra-bx">
                           <h4>3. Payment Details:</h4>
                           <div class="row">
                              <div class="col-md-2 col-lg-1"></div>
                              <div class="col-md-10 col-lg-11">
                                 <div class="kmtrap-options">
                                    <h5>Payment Options</h5>
                                    <?php $customerData =  $this->Session->read('CustomerData');
                                    if ($customerData['Customers']['remaining_amount'] != null) {
                                         $walletAmount = $customerData['Customers']['remaining_amount'];
                                         }else{
                                          $walletAmount = 0;
                                         }  ?>
                                           <?php
                                       $customer = $this->Session->read('CustomerData');
                                       
                                        if ($customer != null && $customer['Customers']['is_gsa'] == 1) { 
                                          ?>

                                       <div class="form-check">
                                          <input class="form-check-input" <?php if($walletAmount == 0) echo "checked" ?>  type="radio" name="paymentOption" id="Gateway" value="Gateway" >
                                          <label class="form-check-label" for="Gateway">
                                          Payment Gateway
                                          </label>
                                       </div>
                                       
                                       <div class="form-check">
                                          <input class="form-check-input"   type="radio" name="paymentOption" id="Wallet" value="Wallet" checked>
                                          <label class="form-check-label" for="Wallet">
                                          Wallet ( Balance <?php echo $walletAmount; ?> )
                                          </label>
                                       </div>

                                    <?php }elseif($customer['Customers']['is_gsa'] != null && $customer['Customers']['is_gsa'] == 0) {  ?>
                                  

                                       <div class="form-check">
                                          <input class="form-check-input"   type="radio" name="paymentOption" id="BookingId" value="BookingId" checked>
                                          <label class="form-check-label" for="BookingId" >
                                          Enter Booking number
                                          </label>
                                       </div>
                                       <div class="row">
                                       <div class="col-md-6">
                                          <div class="form-group">
                                          <?php
                                            echo $this->Form->input('Booking.bookingid', ['class'=>'form-control','type'=>'text','placeholder'=>'Enter Booking number','label'=>false,
                                                   'required'=>true]);
                                          ?>
                                          </div>
                                       </div>
                                    </div>
                                      <?php }else{  ?>

                                       <div class="form-check">
                                          <input class="form-check-input" <?php if($walletAmount == 0) echo "checked" ?>  type="radio" name="paymentOption" id="Gateway" value="Gateway" checked>
                                          <label class="form-check-label" for="Gateway" >
                                          Payment Gateway
                                          </label>
                                       </div>

                                      <?php } ?>

                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="text-right kmtra-bx pt-0 border-bottom-0">
                           <div class="kmpbfhr-bx">
                              <?php echo $this->Html->link('<< Back ',['controller'=>'hotel_search','action'=>'review'],['class'=>'btn btn-pink','escape'=>false]); ?>
                              <input type="hidden" name="totalAmountToPay" value="<?php echo $totalPayableAmt; ?>">
                              <button id="contbutton" name="submit" type="submit" class="btn btn-pink">Continue >></button>
                           </div>
                        </div>
                        <?php echo $this->Form->end(); ?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<script type="text/javascript">
     $(document).ready(function(){
      $('#form_check').on('submit', function (e) {
        if ($("input[name=paymentOption]:checked").length === 0) {
            e.preventDefault();
            alert('Select payment option');
            return false;
        }else{
            return true;
        }
      });

      var walletAmt = '<?php echo $walletAmount ?>';
      var totalPayable = '<?php echo $totalPayableAmt ?>';
        $('input[name="paymentOption"]').click(function(){
            if($(this).prop("checked") == true){
               if ($(this).val() == 'Wallet' && walletAmt < totalPayable ) {
                  $("#contbutton").prop('disabled', true);
                  alert('Please manage sufficient balance in wallet first.');
               }else{
                  $("#contbutton").prop('disabled', false);
               }
            }
            else if($(this).prop("checked") == false){
            }
        });
    });
</script>