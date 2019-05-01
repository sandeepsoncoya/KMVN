<?php
   $id = (isset($this->request->params['pass'][0]))?$this->request->params['pass'][0]:0;
   $lbl = ($id==0)?'Add':'Update';
   $attArray = [];
   if(isset($this->data['TourAttraction'])){
    foreach ($this->data['TourAttraction'] as $key => $att) {
      $attArray[] = $att['attraction_id'];
      
    }
   }else{
     
   }
   ?>
<div class="row">
   <div class="col-lg-12">
      <div class="card">
         <div class="card-header bg-info">
            <h4 class="m-b-0 text-white">Add TourPackage</h4>
         </div>
         <?php echo $this->Form->create('TourPackage', ['type' => 'file']); ?>
         <?php 
            if($id > 0): 
                echo $this->Form->input('id', [
                            'type' => 'hidden'                              
                        ]);
            endif; 
            ?>
         <div class="form-body">
            <div class="card-body">
               <div class="row p-t-20">
                  <div class="col-md-6">
                     <div class="form-group">
                        <?php
                           echo $this->Form->input('tour_category_id', [
                               'type' => 'select',    
                               'options'=>$tourCats,                                     
                               'class'=>'form-control required',
                               'required'   => false,
                           ]);
                           ?>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <?php
                           echo $this->Form->input('title', [
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
                           echo $this->Form->input('departure_from', [
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
                           echo $this->Form->input('best_period', [
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
                           echo $this->Form->input('duration', [
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
                           echo $this->Form->input('pax', [
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
                           echo $this->Form->input('price', [
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
                           echo $this->Form->input('tax', [
                               'type' => 'text',                                         
                               'class'=>'form-control required',
                               'required'   => false,
                               'placeholder'   => 'Tax %',
                           ]);
                           ?>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <?php
                           echo $this->Form->input('total_price', [
                               'type' => 'text',                                         
                               'class'=>'form-control required',
                               'required'   => false,
                               'readonly'   => 'readonly',
                           ]);
                           ?>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <?php
                           echo $this->Form->input('trek_length', [
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
                           echo $this->Form->input('route', [
                               'type' => 'text',                                         
                               'class'=>'form-control required',
                               'required'   => false,
                           ]);
                           ?>
                     </div>
                  </div>
                  <div class="col-md-6">
                  <div class="form-group has-danger">
                     <?php
                        echo $this->Form->input('TourAttraction.attraction', [
                          'label'=>'Attraction (You can select multiple)',   
                            'type' => 'select',                                       
                            'selected' => $attArray,                                       
                            'class'=>'form-control required',                                            
                            'options'=>$attarctions,
                            'empty'=>'Please Select...',
                            'required'   => false,
                            'multiple' => 'true'
                        ]);
                        ?>
                  </div>
               </div>
               </div>
               <div class="row">
                  <?php
                     $fileExistFeatured =  false;
                     if(isset($this->data['TourPackage']['featured_image']) && $this->data['TourPackage']['featured_image']!=""){
                       
                        $filePath = Configure::read('RelativeUrl').'tour/';
                        $fileNameFeatured = $this->data['TourPackage']['featured_image'];                                   
                        if(file_exists($filePath.$fileNameFeatured)){
                            $fileExistFeatured =  true;                                       
                            $fileAbsolutePathFeatured = Configure::read('AbsoluteUrl').'tour/'.$fileNameFeatured;
                        }
                     }
                     ?>
                  <div class="<?php echo ($fileExistFeatured==true)?"col-md-3":"col-md-6"; ?>">
                     <div class="form-group has-success">
                        <?php
                           echo $this->Form->input('featured_img', [
                               'type' => 'file',                                         
                               'class'=>'form-control required',
                               'required'   => false,
                               'label'=>'Featured Image'
                           ]);
                           ?>
                     </div>
                  </div>
                  <?php if($fileExistFeatured == true){ ?>
                  <div class='col-md-3'>
                     <?php
                        echo $this->Form->input('featured_image', [
                            'type' => 'hidden',
                            'value'=>$fileNameFeatured              
                        ]);
                        echo $this->Html->image($fileAbsolutePathFeatured, array('class'=>'d-block w-100'));
                        ?>
                  </div>
                  <?php  } ?>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <?php
                           echo $this->Form->input('terms_and_conditions', [
                               'type' => 'textarea',                                         
                               'class'=>'form-control required',
                               'required'   => false,
                               'id'=>'editor2'
                           ]);
                           ?>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <?php
                           echo $this->Form->input('inclusion', [
                               'type' => 'textarea',                                         
                               'class'=>'form-control required',
                               'required'   => false,
                               'id'=>'editor3'
                           ]);
                           ?>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <?php
                           echo $this->Form->input('exclusion', [
                               'type' => 'textarea',                                         
                               'class'=>'form-control required',
                               'required'   => false,
                               'id'=>'editor4'
                           ]);
                           ?>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <?php
                           echo $this->Form->input('description', [
                               'type' => 'textarea',                                         
                               'class'=>'form-control required',
                               'required'   => false,
                               'id'=>'editor1'
                           ]);
                           ?>
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group has-danger">
                     <?php echo $this->Form->input('is_featured', 
                        array(
                          'label'=>' is featured ?', 
                          'type'=>'checkbox',
                        
                        )); ?>
                  </div>
               </div>
               <div class="row">
               <div class="col-md-6">
                  <div class="form-group has-danger">
                     <?php
                        echo $this->Form->input('is_active', [
                            'type' => 'select',                                       
                            'class'=>'form-control required',                                            
                            'options'=>['1'=>'Active','0'=>'In-avtive'],
                            'empty'=>'Please Select...',
                            'required'   => false,
                        ]);
                        ?>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <?php
                        echo $this->Form->input('grade', [
                            'type' => 'text',                                       
                            'class'=>'form-control required',                                            
                            'required'   => false,
                        ]);
                        ?>
                  </div>
               </div>
               </div>
               <ul id="images">
                  <?php if(isset($this->data['TourPackageImages']) && !empty($this->data['TourPackageImages'])): ?>
                  <?php foreach($this->data['TourPackageImages']  as $image): 
                     $imageName = $image['file'];
                     $fileAbPath = Configure::read('AbsoluteUrl').'tour/thumb/';
                     
                     ?>
                  <li >
                     <div class="img-thumb" style="background-image:url(<?php echo $fileAbPath.$imageName;?>)">
                        <a href="javascript:void(0)" class="imgdel" data-imgId="<?php echo $image['id']; ?>" data-action="delete_tour_image" data-imgName="<?php echo $imageName; ?>" >
                        <i class="fas fa-times"></i>
                        </a>
                        <input type="hidden" name="data[TourPackage][images][]" value="<?php echo $imageName; ?>">
                        <input type="hidden" name="data[TourPackage][alt][]" value="<?php echo $image['alt']; ?>">
                     </div>
                  </li>
                  <?php endforeach; ?>                                            
                  <?php endif; ?>
               </ul>
               <div class="position-relative clearfix">
                  <div class="drop">
                     <div class="cont">
                        <i class="mdi mdi-cloud-download"></i>
                        <div class="tit">
                           Drag &amp; Drop
                        </div>
                        <div class="desc">
                           your files to Assets, or 
                        </div>
                        <button class="btn btn-warning btn-sm">click here to browse</button>
                     </div>
                     <input id="files" multiple="true" data-action="tour_images" data-deleteAction="delete_tour_image" data-model="TourPackage" name="files[]" type="file">
                  </div>
               </div>
               <div class="clearfix"></div>
               <div style="height: 40px;"></div>
               <button class="btn btn-sm btn-primary add_more_itinerary">Add More itinerary</button>
               <div style="height: 20px;"></div>
               <div class="row route_block ">
                  <?php
                     $cardcount = 0;

                      if(isset($this->data['TourItineraries']) && !empty($this->data['TourItineraries'])){
                     $cardcount = count($this->data['TourItineraries']); ?>
                  <?php
                     foreach($this->data['TourItineraries']  as $key =>  $TourItinery){
                     ?>
                  <div class="col-md-4 route_block_remove" id="Day <?php echo $key+1 ?>">
                     <div class="card border-info">
                        <div class="card-header bg-info text-white">
                           <input type="hidden" name="itinerarytitle[]" class="day_hidden" value="<?php echo $TourItinery['title'] ?>">
                           <span class="day_span">Day <?php echo $TourItinery['title'] ?></span> 
                           <div class="card-actions">
                              <a class="btn-close removeblock" data-action="close"><i class="ti-close"></i></a>
                           </div>
                        </div>
                        <div class="card-body">
                           <div class="row p-t-20">
                              <div class="col-md-12">
                                <div class="form-group">
                                    <input  class="form-control" placeholder="title" type="text" name="itineraryname[]" value="<?php echo $TourItinery['name'] ?>">
                                 </div>
                                 <div class="form-group">
                                    <textarea class="form-control" placeholder="Description" type="text" name="itinerarydescription[]" required><?php echo $TourItinery['description'] ?></textarea>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <?php } 
                     }else{ ?>
                  <div class="col-md-4 route_block_remove">
                     <div class="card border-info">
                        <div class="card-header bg-info text-white">
                           <input type="hidden" name="itinerarytitle[]" value="1">
                           <span class="day_span">Day 1</span> 
                           <div class="card-actions">
                              <a class="btn-close removeblock" data-action="close"><i class="ti-close"></i></a>
                           </div>
                        </div>
                        <div class="card-body">
                           <div class="row p-t-20">
                              <div class="col-md-12">
                                <div class="form-group">
                                    <input  class="form-control" placeholder="title" type="text" name="itineraryname[]" >
                                 </div>
                                 <div class="form-group">
                                    <textarea class="form-control" placeholder="Description" type="text" name="itinerarydescription[]" required></textarea>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <?php  } ?>
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
                             'controller' => 'tourPackage',
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
   $(document).ready(function() {
   var max_fields_limit      = 50; //set limit for maximum input fields
   var x = '<?php if($cardcount != 0) {echo $cardcount;}else{echo $cardcount+1;}?>'; //initialize counter for text box
   $('.add_more_itinerary').click(function(e){ //click event on add more fields button having class add_more_itinerary
       e.preventDefault();
       if(x < max_fields_limit){ 
           x++; 
           $('.route_block').append('<div class="col-md-4 route_block_remove" id="Day '+x+'"> <div class="card border-info"> <div class="card-header bg-info text-white"><input type="hidden" name="itinerarytitle[]" value="'+x+'" class="day_hidden"> <span class="day_span">Day'+x+'</span> <div class="card-actions"> <a class="btn-close removeblock" data-action="close"><i class="ti-close"></i></a> </div> </div> <div class="card-body"> <div class="row p-t-20"> <div class="col-md-12"><div class="form-group"><input  class="form-control" placeholder="title" type="text" name="itineraryname[]"></div> <div class="form-group"> <textarea class="form-control" placeholder="Description" type="text" name="itinerarydescription[]" required></textarea> </div> </div> </div> </div> </div> </div>'); //add input field
       }
   });  
   $(document).on('click','.removeblock',function(){ 
    $(this).closest('.route_block_remove').remove();
    var fields = $('.route_block_remove');
    var x = '<?php if($cardcount != 0) {echo $cardcount;}else{echo $cardcount+1;}?>';
        $.each(fields, function() {
            var days ='Day ' + x;
            $(this).attr('id',days);
            $(this).find('.day_hidden').val(days);
            $(this).find('.day_span').html(days);
            x++;
        });

     });
   
   });
</script>
<script type="text/javascript">
  $('#TourPackagePrice, #TourPackageTax').on('input',function() {
    var price = parseInt($('#TourPackagePrice').val());
    var tax = parseFloat($('#TourPackageTax').val());
    $('#TourPackageTotalPrice').val((price +(price * tax/100) ? price +(price * tax/100) : 0).toFixed(2));
});
</script>