<section class="kh-banner" style="background-image:url('../images/package_banner.jpg');">
   <div class="khb-in">
      <div class="container">
         <h2>Hotels</h2>
         <ul class="breadcrumb">
            <li><?php echo $this->Html->link('Home','/pages/home'); ?></li>
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
                     <li><?php echo $this->Html->link('<span>03</span> Review >>>',['controller'=>'hotel_search','action'=>'review'],['class'=>'','escape'=>false]); ?></li>
                     <li><a href="javascript:;"><span>04</span> Travellers >>>></a></li>
                  </ul>
               </div>
            </div>
            <div class="kmpbfw-content">
               <div class="text-right mb-3">
                <?php echo $this->Form->create('Services', ['url'=>['controller'=>'hotel_search','action'=>'review']]);

                if (empty($this->Session->read('HotelData.userServices'))) {
                  ?>
                     <button name="submit" type="submit" class="btn btn-pink">Skip</button>
                  <?php }
                   echo $this->Form->end(); ?>

               </div>
               <div class="kmpb-hlist">
                  <?php if (isset($services) && !empty($services)) {
                     foreach ($services as $key => $service) {

                      ?>
                  <div class="kmbdes-bx">
                     <div class="kmbdesb-img"><img src="<?php echo Configure::read('siteUrlfront');  ?>/uploads/services/<?php echo $service['Services']['featured_image'] ?>" alt=""/></div>
                     <div class="kmbdesb-dtl">
                        <h4><?php echo $service['Services']['title'] ?></h4>
                        <p><?php echo $service['Services']['description'] ?></p>
                        <div class="kmbdes-price"><span>Rs <?php echo $service['Services']['total_price'] ?></span> 
                           <a  data-toggle="modal" data-target="#myModal_<?php echo $service['Services']['id'] ?>">(Terms & Condition apply)</a> 
                        </div>
                        <div id="myModal_<?php echo $service['Services']['id'] ?>" class="modal fade" role="dialog">
                           <div class="modal-dialog">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h4 class="modal-title">Terms & Conditions</h4>
                                 </div>
                                 <div class="modal-body">
                                    <p><?php if (isset($service['Services']['terms_and_conditions'])) {
                                       echo $service['Services']['terms_and_conditions'];
                                       } ?></p>
                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="kmrms-right">
                        <div class="kmrms-in">
                          
                           <p>Rs <?php echo $service['Services']['total_price'] ?></p>
                           
                           <?php
                              $checkServices = $this->Session->read('HotelData.userServices');

                            if ( isset($checkServices) && array_key_exists($service['Services']['id'], $checkServices)) { 

                             $qtys = $checkServices[$service['Services']['id']]['Services']['qty'];
                             ?>
                              <div class="form-group">
                               <label>Qty.</label>
                               <select name="data[Services][qty]" class="form-control" id="qty_<?php echo $service['Services']['id'] ?>">
                                <option value="1" <?php if ($qtys == 1) {
                                  echo "selected";
                                } ?>>1</option>
                                <option value="2" <?php if ($qtys == 2) {
                                  echo "selected";
                                } ?>>2</option>
                                <option value="3" <?php if ($qtys == 3) {
                                  echo "selected";
                                } ?>>3</option>
                                <option value="4" <?php if ($qtys == 4) {
                                  echo "selected";
                                } ?>>4</option>
                                <option value="5" <?php if ($qtys == 5) {
                                  echo "selected";
                                } ?>>5</option> 
                              </select></div>
                               <button class="removeservice btn btn-pink" name="submit" type="submit" data-serviceID="<?php echo $service['Services']['id'] ?>" >Remove</button>
                              
                            <?php }else{
                              ?>
                              <div class="form-group">
                                   <label>Qty.</label>
                                   <select name="data[Services][qty]" class="form-control" id="qty_<?php echo $service['Services']['id'] ?>">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option> 
                                  </select></div>
                              <button class="addservice btn btn-pink" name="submit" type="submit" data-serviceID="<?php echo $service['Services']['id'] ?>" >Add Service</button>
                              <?php } ?>
                         
                        </div>
                     </div>
                  </div>
                  <?php }
                     }else{ ?>
                  <p>Oopss !.. No Extra services are available at this moment.</p>
                  <?php } ?>
               </div>
               <div class="text-right mb-3">
                  <?php echo $this->Form->create('Services', ['url'=>['controller'=>'hotel_search','action'=>'review']]); ?>
                  <button name="submit" type="submit" class="btn btn-pink">Next</button>
                  <?php echo $this->Form->end(); ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<script type="text/javascript">
   $(document).on('click', '.addservice', function () {
     var ins = $(this);
     var serviceID = ins.attr('data-serviceID');
     var qty = $('#qty_'+serviceID).val();
     $.ajax({
       url: siteUrlfront + 'ajax/addServices',
       type: "POST",
       data: { serviceid: serviceID,qty: qty},
       dataType: "json",
       success: function (response) {
          if (response.res == true) {
                ins.removeClass('addservice');
                ins.addClass('removeservice');
                ins.html('Remove');
                window.location.reload();

             }
       },
       error: function (xhr, ajaxOptions, thrownError) {
         swal("Error deleting!", "Please try again", "error");
       }
   
     });
   });
   
   
   $(document).on('click', '.removeservice', function () {
    var qty = $('#qty').val();
     var ins = $(this);
     var serviceID = ins.attr('data-serviceID');
     $.ajax({
       url: siteUrlfront + 'ajax/removeServices',
       type: "POST",
       data: { serviceid: serviceID,qty: qty},
       dataType: "json",
       success: function (response) {
          if (response.res == true) {
                ins.removeClass('removeservice');
                ins.addClass('addservice');
                ins.html('Add Service');
                window.location.reload();

             }
       },
       error: function (xhr, ajaxOptions, thrownError) {
         swal("Error deleting!", "Please try again", "error");
       }
   
     });
   });
</script>
