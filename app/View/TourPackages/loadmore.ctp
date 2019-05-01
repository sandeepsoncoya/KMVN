<?php if(!empty($tourPackages)): ?>
                    <?php foreach ($tourPackages as $key => $tourPackage) : ?>
                    <div class="col-lg-6 tours">
                        <div class="khpc-bx">
                            <div class="khpcb-img">
                                <img src="<?php echo Configure::read('siteUrlfront');  ?>uploads/tour/<?php echo $tourPackage['TourPackage']['featured_image'] ?>" alt="<?php if (isset($tourPackage['TourPackage']['title'])) {
                                             echo $tourPackage['TourPackage']['title'];
                                        } ?>" />
                            </div>
                            <div class="khpcb-dtl">
                                <div class="khpcb-ttl">
                                    <h5><?php if (isset($tourPackage['TourPackage']['title'])) {
                                             echo $tourPackage['TourPackage']['title'];
                                        } ?> <!-- <span class="khpc-rate"><span class="khpcr-in" style="width:80%;"></span></span> --></h5>
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
                                    <a href="#" class="btn btn-pink">Read More..</a>
                                    <a href="#" class="btn btn-pink">Book Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>