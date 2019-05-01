<section class="kh-banner" style="background-image:url('<?php echo Configure::read('siteUrlfront');  ?>/images/banner_destinations.jpg');">
        <div class="khb-in">
            <div class="container">
                <h2>Destinations</h2>
                <ul class="breadcrumb">
                    <li><?php echo $this->Html->link('Home','/pages/home'); ?></li>
                    <li><span>destinations</span></li>
                </ul>
            </div>
        </div>
    </section>
    <section class="khp-block">
        <div class="container khpd-details">
            <div class="khpb-content kmdst-list">
                <div class="kmdst-bx">
                    <div class="kmdstb-img"><img src="<?php echo Configure::read('siteUrlfront');  ?>uploads/destination/<?php echo $destinationDetails['Destination']['featured_image'] ?>" alt="Destination Image" /></div>
                    <div class="kmdst-dtl">
                        <h5><?php echo $destinationDetails['Destination']['title'] ?></h5>
                        <div class="kmdstd-in">
                            <p><?php echo $destinationDetails['Destination']['description'] ?></p>
                        </div>
                    </div>
                </div>
                <?php if ($destinationDetails['DestinationImages']) {
                    ?>
                <div class="kmg-block">
                    <h3>Image Gallery</h3>
                    <div class="kmg-content">
                        <div class="kmg-grid" id="gallery_destination">
                            <?php foreach ($destinationDetails['DestinationImages'] as $key => $value) { ?>
                            <div class="kmg-bx">
                                <div class="kmgb-in">
                                    <a href="<?php echo Configure::read('siteUrlfront');  ?>uploads/destination/<?php echo $value['file'] ?>"><img src="<?php echo Configure::read('siteUrlfront');  ?>uploads/destination/<?php echo $value['file'] ?>" alt=""></a>
                                </div>
                            </div>
                        <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
                <div class="kmg-block">
                    <h3>Location Map View</h3>
                    <div class="kmg-content">
                        <div class="kmhd-map" id="hotel_map"></div>
                    </div>
                </div>
                <?php if(!empty($destinationDetails['DestinationAttraction'])): ?>
                        <div class="kmbdtb-block p-0 bg-transparent">
                            <div class="kmbdtb-head">
                                <h4>Attraction:</h4>
                            </div>
                            <div class="kmbdtb-content">
                                <div class="kmatr-list">
                                    <?php foreach ($destinationDetails['DestinationAttraction'] as $key => $tourAttraction) : $att_slug = $tourAttraction['Attraction']['slug']; ?>
                                    <div class="kmatr-bx">
                                            <div class="kmatr-img">
                                                <?php if ($tourAttraction['Attraction']['featured_image'] != '') { ?>
                                                     <a href="javascript:;"><img src="<?php echo Configure::read('siteUrlfront');  ?>uploads/attraction/<?php echo $tourAttraction['Attraction']['featured_image'] ?>" alt=""></a>
                                                <?php }else{ ?>
                                                <img src="<?php echo Configure::read('siteUrlfront');  ?>uploads/imagenot.png" alt="">
                                                    <?php } ?>
                                            </div>
                                            <div class="kmatr-ttl">
                                                <?php echo $this->Html->link($tourAttraction['Attraction']['title'], array('controller' => 'attractions', 'action' => 'details', $att_slug),array('class'=>'')); ?>
                                            </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
            </div>
        </div>
    </section>
        
<script type="text/javascript">
    var lat = <?php echo $destinationDetails['Destination']['lat'] ?>;
    var long = <?php echo $destinationDetails['Destination']['long'] ?>;
    // Initialize and add the map
    loc = { lat: lat, lng: long };

</script>
