<?php
   $id = (isset($this->request->params['pass'][0]))?$this->request->params['pass'][0]:0;
   
   ?>
<div class="row">
   <div class="col-lg-12">
      <div class="card">
         <div class="card-header bg-info">
            <h4 class="m-b-0 text-white">Site Information</h4>
         </div>
         <?php echo $this->Form->create('SiteSettings', ['type' => 'file']); ?>
         <?php 
            if($id > 0): 
                echo $this->Form->input('id', [
                            'type' => 'hidden'                              
                        ]);
            endif; 
            ?>
         <div class="form-body">
            <div class="card-body">
               <div class="row">
                  <div class="col-md-12 ">
                     <nav>
                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                           <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">General</a>
                           <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Packages</a>
                           <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Destination</a>
                           <a class="nav-item nav-link" id="nav-about-tab" data-toggle="tab" href="#nav-about" role="tab" aria-controls="nav-about" aria-selected="false">Home page</a>

                           <a class="nav-item nav-link" id="nav-contacts-tab" data-toggle="tab" href="#nav-contacts" role="tab" aria-controls="nav-contacts" aria-selected="false">Contact</a>
                        </div>
                     </nav>
                     <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
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
                                       echo $this->Form->input('email', [
                                           'type' => 'email',                                        
                                           'class'=>'form-control required',
                                           'required'   => false,
                                          
                                       ]);
                                       ?>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <?php
                                 $fileExistLogo =  false;
                                 if(isset($this->data['SiteSettings']['logo']) && $this->data['SiteSettings']['logo']!=""){
                                   
                                    $filePath = Configure::read('RelativeUrl').'SiteSettings/';
                                    $fileNameLogo = $this->data['SiteSettings']['logo'];    
                                    if(file_exists($filePath.$fileNameLogo)){
                                        $fileExistLogo =  true;                                       
                                        $fileAbsolutePathLogo = Configure::read('AbsoluteUrl').'SiteSettings/'.$fileNameLogo;
                                               
                                    }
                                 }
                                 ?>
                              <div class="<?php echo ($fileExistLogo==true)?"col-md-3":"col-md-6"; ?>">
                                 <div class="form-group has-success">
                                    <?php
                                       echo $this->Form->input('image_logo', [
                                           'type' => 'file',
                                           'class'=>'form-control required',                  
                                           'required'   => false,
                                           
                                       ]);
                                       ?>
                                 </div>
                              </div>
                              <?php if($fileExistLogo == true){ ?>
                              <div class='col-md-3'>
                                 <?php
                                    echo $this->Form->input('logo', [
                                        'type' => 'hidden',
                                        'value'=>$fileNameLogo              
                                    ]);
                                    echo $this->Html->image($fileAbsolutePathLogo, array('class'=>'d-block w-100'));
                                    ?>
                              </div>
                              <?php  } ?>
                              <?php
                                 $fileExistFooter =  false;
                                 if(isset($this->data['SiteSettings']['footer_logo']) && $this->data['SiteSettings']['footer_logo']!=""){
                                   
                                    $filePath = Configure::read('RelativeUrl').'SiteSettings/';
                                    $fileNameFooter = $this->data['SiteSettings']['footer_logo'];                                   
                                    if(file_exists($filePath.$fileNameFooter)){
                                        $fileExistFooter =  true;                                       
                                        $fileAbsolutePathFooter = Configure::read('AbsoluteUrl').'SiteSettings/'.$fileNameFooter;
                                    }
                                 }
                                 ?>
                              <div class="<?php echo ($fileExistFooter==true)?"col-md-3":"col-md-6"; ?>">
                                 <div class="form-group has-success">
                                    <?php
                                       echo $this->Form->input('footer_logo_image', [
                                           'type' => 'file',                                         
                                           'class'=>'form-control required',
                                           'required'   => false,
                                           'label'=>'Footer Logo'
                                       ]);
                                       ?>
                                 </div>
                              </div>
                              <?php if($fileExistFooter == true){ ?>
                              <div class='col-md-3'>
                                 <?php
                                    echo $this->Form->input('footer_logo', [
                                        'type' => 'hidden',
                                        'value'=>$fileNameFooter              
                                    ]);
                                    echo $this->Html->image($fileAbsolutePathFooter, array('class'=>'d-block'));
                                    ?>
                              </div>
                              <?php  } ?>
                              <?php
                                 $fileExist =  false;
                                 if(isset($this->data['SiteSettings']['favion']) && $this->data['SiteSettings']['favion']!=""){
                                   
                                    $filePath = Configure::read('RelativeUrl').'SiteSettings/';
                                    $fileName = $this->data['SiteSettings']['favion'];                                   
                                    if(file_exists($filePath.$fileName)){
                                        $fileExist =  true;                                       
                                        $fileAbsolutePath = Configure::read('AbsoluteUrl').'SiteSettings/'.$fileName;
                                    }
                                 }
                                 ?>
                              <div class="<?php echo ($fileExist==true)?"col-md-3":"col-md-6"; ?>">
                                 <div class="form-group has-success">
                                    <?php
                                       echo $this->Form->input('favion_image', [
                                           'type' => 'file',                                         
                                           'class'=>'form-control required',
                                           'required'   => false,
                                           'label'=>'Favicon'
                                       ]);
                                       ?>
                                 </div>
                              </div>
                              <?php if($fileExist == true){ ?>
                              <div class='col-md-3'>
                                 <?php
                                    echo $this->Form->input('favion', [
                                        'type' => 'hidden',
                                        'value'=>$fileName              
                                    ]);
                                    echo $this->Html->image($fileAbsolutePath, array('class'=>'d-block'));
                                    ?>
                              </div>
                              <?php  } ?>
                           </div>
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <?php
                                       echo $this->Form->input('lat', [
                                           'type' => 'text',                                         
                                           'class'=>'form-control required',
                                           'required'   => false,
                                           'label'=>'Latitude'
                                       ]);
                                       ?>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group has-danger">
                                    <?php
                                       echo $this->Form->input('long', [
                                           'type' => 'text',                                         
                                           'class'=>'form-control required',
                                           'required'   => false,
                                           'label'=>'Longitude'
                                       ]);
                                       ?>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <?php
                                       echo $this->Form->input('phone', [
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
                                       echo $this->Form->input('meta_title', [
                                           'type' => 'text',                                         
                                           'class'=>'form-control required',
                                           'required'   => false,
                                       ]);
                                       ?>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <?php
                                       echo $this->Form->input('meta_description', [
                                           'type' => 'textarea',                                         
                                           'class'=>'form-control required',
                                           'required'   => false,
                                           
                                       ]);
                                       ?>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <?php
                                       echo $this->Form->input('meta_keywords', [
                                           'type' => 'textarea',                                         
                                           'class'=>'form-control required',
                                           'required'   => false,
                                          
                                       ]);
                                       ?>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <?php
                                       echo $this->Form->input('address', [
                                           'type' => 'textarea',                                         
                                           'class'=>'form-control required',
                                           'required'   => false,
                                           
                                       ]);
                                       ?>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                           <div class="row p-t-20">
                              <?php
                                 $fileExist =  false;
                                 if(isset($this->data['SiteSettings']['package_inner_banner']) && $this->data['SiteSettings']['package_inner_banner']!=""){
                                    
                                     $filePath = Configure::read('RelativeUrl').'SiteSettings/';
                                     $fileName = $this->data['SiteSettings']['package_inner_banner'];                                   
                                     if(file_exists($filePath.$fileName)){
                                         $fileExist =  true;                                       
                                         $fileAbsolutePath = Configure::read('AbsoluteUrl').'SiteSettings/'.$fileName;
                                     }
                                 }
                                 ?>
                              <div class="<?php echo ($fileExist==true)?"col-md-3":"col-md-6"; ?>">
                                 <div class="form-group has-success">
                                    <?php
                                       echo $this->Form->input('package_inner_banner_image', [
                                           'type' => 'file',                                         
                                           'class'=>'form-control required',
                                           'required'   => false,
                                           'label'=>'Packages page inner banner'
                                       ]);
                                       ?>
                                 </div>
                              </div>
                              <?php if($fileExist == true){ ?>
                              <div class='col-md-3'>
                                 <?php
                                    echo $this->Form->input('package_inner_banner', [
                                        'type' => 'hidden',
                                        'value'=>$fileName              
                                    ]);
                                    echo $this->Html->image($fileAbsolutePath, array('class'=>'d-block','height'=>'100','width'=>'220'));
                                    ?>
                              </div>
                              <?php  } ?>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <?php
                                       echo $this->Form->input('package_inner_title', [
                                           'type' => 'text',                                         
                                           'class'=>'form-control required',
                                           'required'   => false,
                                           
                                       ]);
                                       ?>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                           <div class="row p-t-20">
                              <?php
                                 $fileExist =  false;
                                 if(isset($this->data['SiteSettings']['destination_inner_banner']) && $this->data['SiteSettings']['destination_inner_banner']!=""){
                                   
                                    $filePath = Configure::read('RelativeUrl').'SiteSettings/';
                                    $fileName = $this->data['SiteSettings']['destination_inner_banner'];                                   
                                    if(file_exists($filePath.$fileName)){
                                        $fileExist =  true;                                       
                                        $fileAbsolutePath = Configure::read('AbsoluteUrl').'SiteSettings/'.$fileName;
                                    }
                                 }
                                 ?>
                              <div class="<?php echo ($fileExist==true)?"col-md-3":"col-md-6"; ?>">
                                 <div class="form-group has-success">
                                    <?php
                                       echo $this->Form->input('destination_inner_banner_image', [
                                           'type' => 'file',                                         
                                           'class'=>'form-control required',
                                           'required'   => false,
                                           'label'=>'Destination page inner banner'
                                       ]);
                                       ?>
                                 </div>
                              </div>
                              <?php if($fileExist == true){ ?>
                              <div class='col-md-3'>
                                 <?php
                                    echo $this->Form->input('destination_inner_banner', [
                                        'type' => 'hidden',
                                        'value'=>$fileName              
                                    ]);
                                    echo $this->Html->image($fileAbsolutePath, array('class'=>'d-block','height'=>'100','width'=>'220'));
                                    ?>
                              </div>
                              <?php  } ?>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <?php
                                       echo $this->Form->input('destination_inner_title', [
                                           'type' => 'text',                                         
                                           'class'=>'form-control required',
                                           'required'   => false,
                                           
                                       ]);
                                       ?>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="tab-pane fade" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                           <div class="row p-t-20">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <?php
                                       echo $this->Form->input('home_content', [
                                           'type' => 'textarea',                                         
                                           'class'=>'form-control required',
                                           'id'=>'editor1',
                                           'required'   => false,
                                           
                                       ]);
                                       ?>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="tab-pane fade" id="nav-contacts" role="tabpanel" aria-labelledby="nav-about-tab">
                           <div class="row p-t-20">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <?php
                                       echo $this->Form->input('trh_contacts', [
                                           'type' => 'textarea',                                         
                                           'class'=>'form-control required',
                                           'id'=>'editor2',
                                           'required'   => false,
                                           
                                       ]);
                                       ?>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <?php
                                       echo $this->Form->input('contact_page_address_info', [
                                           'type' => 'textarea',                                         
                                           'class'=>'form-control required',
                                           'id'=>'editor3',
                                           'required'   => false,
                                           
                                       ]);
                                       ?>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="form-actions">
               <div class="card-body">
                  <?php 
                     echo $this->Form->button(' <i class="fa fa-check"></i> Save', ['type' => 'submit','class'=>'btn btn-success ']);
                     ?>
               </div>
            </div>
         </div>
         </form>
      </div>
   </div>
</div>