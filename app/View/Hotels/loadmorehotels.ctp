<?php if(!empty($hotels)): ?>
                    <?php foreach ($hotels as $key => $hotel) : 
                        $tour_slug = $hotel['Hotel']['slug']; ?>
                <div class="kmhl-bx morehotels">
                    <div class="kmhlb-img">
                        <img src="<?php echo Configure::read('siteUrlfront');  ?>images/hotels/05.jpg" alt="Hotel Image">
                    </div>
                    <div class="kmhlb-dtls">
                        <h3>TRH Almora</h3>
                        <div class="kmhlbd-in">
                            <div class="kmhlbdi-left">
                                <div class="kmhll-top">
                                    <h5><?php if (isset($hotel['Hotel']['title'])) {
                                             echo $hotel['Hotel']['title'];
                                        } ?></h5>
                                    <p><?php if (isset($hotel['Hotel']['description'])) {
                                             echo $hotel['Hotel']['description'];
                                        } ?></p>
                                </div>
                                <ul class="kmhl-facilities">
                                    <li>Free Breakfast</li>
                                    <li>Cable</li>
                                    <li>Room Service</li>
                                    <li>Restaurant</li>
                                </ul>
                                <div class="kmhl-bottom">
                                    <p><b>Attraction Near Hotel:</b> Havamahal, Jalmahal, Amer Palace</p>
                                </div>
                            </div>
                            <div class="kmhlbdi-right">
                                <div class="kmhlr-btns">
                                    <a href="#" class="btn btn-black btn-block">Book Rooms</a>
                                    <a href="#" class="btn btn-black btn-block">Basic Information</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php endif; ?>