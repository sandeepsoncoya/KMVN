<section class="kh-banner" style="background-image:url('<?php echo Configure::read('siteUrlfront');  ?>/images/banner_destinations.jpg');">
        <div class="khb-in">
            <div class="container">
                <h2>Attraction</h2>
                <ul class="breadcrumb">
                    <li><?php echo $this->Html->link('Home','/pages/home'); ?></li>
                    <li><span>Attraction</span></li>
                </ul>
            </div>
        </div>
    </section>
    <section class="khp-block">
        <div class="container khpd-details">
            <div class="khpb-content kmdst-list">
                <div class="kmdst-bx">
                    <div class="kmdstb-img"><img src="<?php echo Configure::read('siteUrlfront');  ?>uploads/attraction/<?php echo $attractionDetails['Attraction']['featured_image'] ?>" alt="Attraction Image" /></div>
                    <div class="kmdst-dtl">
                        <h5><?php echo $attractionDetails['Attraction']['title'] ?></h5>
                        <div class="kmdstd-in">
                            <p><?php echo $attractionDetails['Attraction']['description'] ?></p>
                        </div>
                    </div>
                </div>
                <?php if ($attractionDetails['AttractionImages']) {
                    ?>
                <div class="kmg-block">
                    <h3>Image Gallery</h3>
                    <div class="kmg-content">
                        <div class="kmg-grid" id="gallery_destination">
                            <?php foreach ($attractionDetails['AttractionImages'] as $key => $value) { ?>
                            <div class="kmg-bx">
                                <div class="kmgb-in">
                                    <a href="<?php echo Configure::read('siteUrlfront');  ?>uploads/attraction/<?php echo $value['file'] ?>"><img src="<?php echo Configure::read('siteUrlfront');  ?>uploads/attraction/<?php echo $value['file'] ?>" alt=""></a>
                                </div>
                            </div>
                        <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
                
            </div>
        </div>
    </section>
      