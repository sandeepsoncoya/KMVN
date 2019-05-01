<?php
   $id = (isset($this->request->params['pass'][0]))?$this->request->params['pass'][0]:0;
   $lbl = ($id==0)?'Add':'Update';
 
   ?>
<div class="row">
   <div class="col-lg-12">
      <div class="card">
         <div class="card-header bg-info">
            <h4 class="m-b-0 text-white">Add Ebook</h4>
         </div>
         <?php echo $this->Form->create('Ebooks', ['type' => 'file']); ?>
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
                           echo $this->Form->input('name', [
                               'type' => 'text',                                         
                               'class'=>'form-control required',
                               'required'   => false,
                           ]);
                           ?>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <?php
                     $fileExistFeatured =  false;
                     if(isset($this->data['Ebooks']['file']) && $this->data['Ebooks']['file']!=""){
                       
                        $filePath = Configure::read('RelativeUrl').'ebooks/';
                        $fileNameFeatured = $this->data['Ebooks']['file'];                                   
                        if(file_exists($filePath.$fileNameFeatured)){
                            $fileExistFeatured =  true;                                       
                            $fileAbsolutePathFeatured = Configure::read('AbsoluteUrl').'ebooks/'.$fileNameFeatured;
                        }
                     }
                     ?>
                  <div class="<?php echo ($fileExistFeatured==true)?"col-md-3":"col-md-6"; ?>">
                     <div class="form-group has-success">
                        <?php
                           echo $this->Form->input('file', [
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
                        ?>
                  <a href="<?php echo $fileAbsolutePathFeatured; ?>" target="_blank">click to view</a>
                  </div>
                  <?php  } ?>
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
                             'controller' => 'Ebooks',
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