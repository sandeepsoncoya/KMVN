<?php 
    echo $this->Html->script([
        'slick.min',
    ], array('block' => 'scriptBottom'));
   
 ?>
<section class="amin-page">
    <div class="aminp-head">
        <div class="container">
            <h1 class="page-title"><?php echo $productData['Product']['name']; ?></h1>
        </div>
    </div>
    <div class="aminp-body">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-7">
                    <?php if(!empty($productData)): ?>
                        <div class="aminpd-crsl">
                            <div class="aminpdlg-out">
                                <div class="aminpd-large" id="pdSlick_large">
										<?php foreach($productData['ProductImages'] as $product): ?>
                                        <div class="ampdth-img">
                                        <?php 
                                            $image =  Configure::read('AbsoluteUrl').'product/main/'.$product['file'];
                                        ?>
                                        <?php echo $this->Html->image($image, array('alt' =>$product['alt'])); ?>
                                        </div>
										<?php endforeach; ?>
                                </div>
                            </div>
                            <div class="aminpdth-out">
                                <div class="aminpd-thumb" id="pdSlick_thumb">
                                    <?php foreach($productData['ProductImages'] as $product): ?>
                                        <div class="ampdth-img">
                                        <?php 
                                            $image =  Configure::read('AbsoluteUrl').'product/sidebar/'.$product['file'];
                                        ?>
                                        <?php echo $this->Html->image($image, array('alt' =>$product['alt'])); ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-12 col-lg-5">
                    <div class="aminpd-short">
                        <?php echo $productData['Product']['short_description']; ?>
                        <a href="javascript:void(0)" data-target="#modal_quote" data-toggle="modal" class="btn btn-red btn-block">Get Quotation</a>
                        <div class="aminpd-share">
                            <ul class="am-social top">  
                                <div class="addthis_inline_share_toolbox"></div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="aminpd-btm">
                <ul class="nav nav-tabs justify-content-center">
                    <li><a class="active" data-toggle="tab" data-target="#pd_desc" href="javascript:void(0)">Description</a></li>
                    <li><a data-toggle="tab" data-target="#pd_spec" href="javascript:void(0)">Specification</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane in active fade show" id="pd_desc">
                        <?php echo $productData['Product']['description']; ?>
                    </div>
                    <div class="tab-pane fade" id="pd_spec">
                        <?php echo $productData['Product']['specification']; ?>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</section>

<div class="modal fade" id="modal_quote" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header mh-custom">
		<div class="mt-left">
			<h5 class="modal-title">Get a Quote</h5>	
		</div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="material-icons">close</i>
        </button>
      </div>
      <div class="modal-body">
        <?php echo  $this->Form->create('Quotation', ['type' => 'post','class'=>'aminp-enquiry','id'=>'addFrom','url' => 'save_quotation']); ?>	
			<div class="p-info">
                <?php
                    echo $this->Form->input('product_id', [
                        'type' => 'hidden',
                        'value'=>$productData['Product']['id']						                  
                    ]);
                ?>
				<p id="productName"><?php echo $productData['Product']['name']; ?></p>
			</div>
			<div class="form-group">
                <?php
                    echo $this->Form->input('name', [
                        'type' => 'text',						                  
                        'class'=>'form-control required',
                        'required'   => false,
                    ]);
                ?>
			</div>
			<div class="form-group">
                <?php
                    echo $this->Form->input('email', [
                        'type' => 'text',						                  
                        'class'=>'form-control required',
                        'required'   => false,
                    ]);
                ?>
			</div>
			<div class="form-group">
                <?php
                    echo $this->Form->input('contact_no', [
                        'type' => 'text',						                  
                        'class'=>'form-control required',
                        'required'   => false,
                    ]);
                ?>
			</div>
			<div class="form-group">
                <?php
                    echo $this->Form->input('comment', [
                        'type' => 'textarea',						                  
                        'class'=>'form-control required',
                        'required'   => false,
                        'rows'=>'4'
                    ]);
                ?>
			</div>
			<div class="text-center">
                <?php 
                    echo $this->Form->button('Send Message', ['type' => 'submit','class'=>'btn btn-red','id'=>'save']);
                ?>
			</div>
        <?php echo $this->Form->end(); ?>
      </div>
    </div>
  </div>
</div>