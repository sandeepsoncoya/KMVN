<?php
   $id = (isset($this->request->params['pass'][0]))?$this->request->params['pass'][0]:0;
   $lbl = ($id==0)?'Add':'Update';
    $type = '';
    //echo $this->data['Gallery']['type'];
   if (isset($this->data['Gallery']['type'])) {
     $type = $this->data['Gallery']['type'];
   }
   ?>
<div class="row">
   <div class="col-lg-12">
      <div class="card">
         <div class="card-header bg-info">
            <h4 class="m-b-0 text-white">Add to gallery</h4>
         </div>
         <?php echo $this->Form->create('Gallery', ['type' => 'file']); ?>
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
                  
               </div>
               <div class="row">
                 <div class="col-md-6">
                  <div class="form-group has-danger">
                     <?php
                        echo $this->Form->input('type', [
                            'type' => 'select',                                       
                            'class'=>'form-control required',                                            
                            'options'=>['image'=>'Image','video'=>'Video'],
                            'empty'=>'Please Select...',
                            'required'   => false,
                            'default'=>'image'
                        ]);
                        ?>
                  </div>
               </div>
               </div>
             
               <div class="row" id="imagediv">
                  <?php
                     $fileExistFeatured =  false;
                     if(isset($this->data['Gallery']['file']) && $this->data['Gallery']['file']!=""){
                       
                        $filePath = Configure::read('RelativeUrl').'gallery/';
                        $fileNameFeatured = $this->data['Gallery']['file'];                                   
                        if(file_exists($filePath.$fileNameFeatured)){
                            $fileExistFeatured =  true;                                       
                            $fileAbsolutePathFeatured = Configure::read('AbsoluteUrl').'gallery/'.$fileNameFeatured;
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
                               'label'=>'File'
                           ]);
                           ?>
                     </div>
                  </div>
                  <?php if($fileExistFeatured == true){ ?>
                  <div class='col-md-3'>
                     <?php
                        echo $this->Form->input('file', [
                            'type' => 'hidden',
                            'value'=>$fileNameFeatured              
                        ]);
                        echo $this->Html->image($fileAbsolutePathFeatured, array('class'=>'d-block w-100'));
                        ?>

                  </div>
                  <?php  } ?>
               </div>
            
               <div class="row" id="videodiv">
                 <div class="col-md-6">
                 <div class="form-group">
                        <?php
                           echo $this->Form->input('file', [
                               'type' => 'textarea',                                         
                               'label' => 'Video iframe ',                                         
                               'placeholder' => '<iframe width="260" height="215" src="https://www.youtube.com/embed/ht-Ghd7fzJA" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',                                         
                               'class'=>'form-control required',
                               'required'   => false,
                           ]);
                           ?>
                     </div>
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
                             'controller' => 'Gallery',
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
  $(function() {
    var divtype = '<?php echo $type; ?>';
    if (divtype == 'image') {
      $('#videodiv').hide(); 
      $('#imagediv').show(); 
    }else if(divtype == 'video'){
      $('#videodiv').show(); 
      $('#imagediv').hide(); 
    }else{
       $('#videodiv').hide(); 
    }
    
    $('#GalleryType').on('change',function(){
        if($('#GalleryType').val() == 'video') {
            $('#videodiv').show(); 
            $('#imagediv').hide(); 
        } else {
            $('#imagediv').show(); 
            $('#videodiv').hide(); 
        } 
    });
});
</script>