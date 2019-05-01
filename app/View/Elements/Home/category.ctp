<?php if(!empty($featuredCategories)): ?>
<section class="amp-block">
    <div class="container">
        <div class="ampb-head">
            <h2 class="ampb-title">Product Category</h2>
        </div>
        <div class="ampb-content">
            <div class="row">
                <?php foreach($featuredCategories as $cat): ?>
                    <div class="col-md-6">
                        <div class="ampc-bx">
                            <div class="ampc-img">
                                <?php 
                                    $title =  $cat['Category']['title'];
                                    $image =  Configure::read('AbsoluteUrl').'category/thumb/'.$cat['Category']['featured_image'];
                                    $imageTag =  '<img src="'.$image.'" alt="'.$title.'" />';
                                    echo $this->Html->link(
                                        $imageTag,
                                        ['controller' => 'listing', 'action' => 'index','slug'=>$cat['Category']['slug']],
                                        ['escape' => false]
                                    );
                                ?>
                            </div>
                            <div class="ampc-dtl">
                                <div class="ampcd-in">
                                    <h4>
                                        <?php 
                                            echo $this->Html->link(
                                                $title,
                                                ['controller' => 'listing', 'action' => 'index','slug'=>$cat['Category']['slug']]
                                            );
                                        ?>
                                    </h4>
                                    <?php echo $cat['Category']['short_description']; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                
            </div>
        </div>
    </div>
</section>
<?php endif; ?>