<?php if(!empty($tourPackages)): ?>
                    <?php foreach ($tourPackages as $key => $tourPackage) : 
                        $tour_slug = $tourPackage['TourPackage']['slug']; ?>
                    <div class="col-md-6 tours">
                        <div class="khpc-bx">
                            <div class="khpcb-img">
                                <?php echo $this->Html->link($this->Html->image(Configure::read('siteUrlfront').'/uploads/tour/'.$tourPackage['TourPackage']['featured_image'], array('alt' =>$tourPackage['TourPackage']['title'])),
                                    array('controller' => 'tourPackages', 'action' => 'details', $tour_slug),
                                    array('escape' => false, 'rel' => 'nofollow')
                                ); ?>
                            </div>
                            <div class="khpcb-dtl">
                                <div class="khpcb-ttl">
                                    <h5><?php echo $this->Html->link($tourPackage['TourPackage']['title'], array('controller' => 'tourPackages', 'action' => 'details', $tour_slug),array('class'=>'')); ?><span class="khpc-rate"><span class="khpcr-in" style="width:80%;"></span></span></h5>
                                </div>
                                <div class="khpcb-desc">
                                    <p><b><?php if (isset($tourPackage['TourPackage']['duration'])) {
                                             echo $tourPackage['TourPackage']['duration'];
                                        } ?> </b></p>
                                    <p>Departure From: <?php if (isset($tourPackage['TourPackage']['departure_from'])) {
                                             echo $tourPackage['TourPackage']['departure_from'];
                                        } ?></p>
                                    <p>Rates: Rs <?php if (isset($tourPackage['TourPackage']['price'])) {
                                             echo number_format($tourPackage['TourPackage']['price']);
                                        } ?> /- per person for full tour</p>
                                    <p>Delhi-Nainital-Kausani-Ranikhet-Delhi</p>
                                    <?php echo $this->Html->link('Read More..', array('controller' => 'tourPackages', 'action' => 'details', $tour_slug),array('class'=>'btn btn-pink')); ?>
                                    <a href="#" class="btn btn-pink">Book Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>