<?php if(!empty($featuredProduct)): ?>
<section class="amp-block pt-0">
    <div class="container">
        <div class="ampb-head">
            <h2 class="ampb-title">Featured Products</h2>
        </div>
        <div class="ampb-content">
            <div class="owl-carousel" id="ampb_carousel">
                <?php foreach($featuredProduct as $product): 
                   $title =  $product['Product']['name'];
                    $image =  Configure::read('AbsoluteUrl').'product/home_page/'.$product['ProductImages'][0]['file'];
                    $imageTag =  '<img src="'.$image.'" alt="'.$title.'" />';
                    
                ?>
                    <div class="ampd-bx">
                        <div class="ampd-img">
                           <?php
                            echo $this->Html->link(
                                $imageTag,
                                ['controller' => 'details', 'action' => 'index','category'=>$product['Category']['slug'],'slug'=>$product['Product']['slug']],
                                ['escape' => false]
                            );

                           ?>
                        </div>
                        <div class="ampd-dtl">
                            <h4>
                                
                            <?php 
                                echo $this->Html->link(
                                    $title,
                                    ['controller' => 'details', 'action' => 'index','category'=>$product['Category']['slug'],'slug'=>$product['Product']['slug']]
                                );
                            ?>
                            </h4>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
