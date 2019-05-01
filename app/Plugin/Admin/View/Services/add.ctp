<?php
   $id = (isset($this->request->params['pass'][0]))?$this->request->params['pass'][0]:0;
   $lbl = ($id==0)?'Add':'Update';
   
   ?>
<div class="row">
   <div class="col-lg-12">
      <div class="card">
         <div class="card-header bg-info">
            <h4 class="m-b-0 text-white">Add Service</h4>
         </div>
         <?php echo $this->Form->create('Services', ['type' => 'file']); ?>
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
                 
               </div>
               <div class="row">
                  <?php
                     $fileExistFeatured =  false;
                     if(isset($this->data['Services']['featured_image']) && $this->data['Services']['featured_image']!=""){
                       
                        $filePath = Configure::read('RelativeUrl').'services/';
                        $fileNameFeatured = $this->data['Services']['featured_image'];                                   
                        if(file_exists($filePath.$fileNameFeatured)){
                            $fileExistFeatured =  true;                                       
                            $fileAbsolutePathFeatured = Configure::read('AbsoluteUrl').'services/'.$fileNameFeatured;
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
                             'controller' => 'services',
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
<script type="text/javascript">
  $('#ServicesPrice, #ServicesTax').on('input',function() {
    var price = parseInt($('#ServicesPrice').val());
    var tax = parseFloat($('#ServicesTax').val());
    $('#ServicesTotalPrice').val((price +(price * tax/100) ? price +(price * tax/100) : 0).toFixed(2));
});
</script>