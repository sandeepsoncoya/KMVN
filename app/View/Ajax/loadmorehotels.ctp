<?php if(!empty($hotels)): ?>
                    <?php foreach ($hotels as $key => $hotel) : 
                        $hotel_slug = $hotel['Hotel']['slug']; ?>
                <div class="kmhl-bx morehotels">
                    <div class="kmhlb-img">
                        <?php
                        $pathfile = Configure::read('RelativeUrl').'hotels/'.$hotel['Hotel']['featured_image'];
                        if (file_exists($pathfile) && $hotel['Hotel']['featured_image'] != '') {
                             echo $this->Html->link($this->Html->image(Configure::read('siteUrlfront').'/uploads/hotels/'.$hotel['Hotel']['featured_image'], array('alt' => $hotel['Hotel']['title'])),
                            array('controller' => 'hotels', 'action' => 'details', $hotel_slug),
                            array('escape' => false, 'rel' => 'nofollow')
                        );
                        }else{ ?>
                          <img src="<?php echo Configure::read('siteUrlfront');  ?>uploads/imagenot.png" alt="">
                       <?php }?>
                    </div>
                    <div class="kmhlb-dtls">
                        <h3> <?php  echo $hotel['Hotel']['title']; ?></h3>
                        <div class="kmhlbd-in">
                            <div class="kmhlbdi-left">
                                <div class="kmhll-top">
                                    <h5><?php echo $this->Html->link($hotel['Hotel']['title'], array('controller' => 'hotels', 'action' => 'details', $hotel_slug),array('class'=>'')); ?></h5>
                                    <p><?php if (isset($hotel['Hotel']['description'])) {
                                            $description = strlen($hotel['Hotel']['description']) > 570 ? substr($hotel['Hotel']['description'],0,570). $this->Html->link(' read more...', array('controller' => 'hotels', 'action' => 'details', $hotel_slug),array('class'=>'')) : $hotel['Hotel']['description'];
                                             echo $description;
                                        } ?></p>
                                </div>

                                <ul class="kmhl-facilities">
                                     <?php if(!empty($hotel['HotelHighlightSelected'])):  ?>
                                    <?php foreach ($hotel['HotelHighlightSelected'] as $key => $hotelHighlight) : ?>

                                    <?php if(isset($hotelHighlight['HotelHighlight']['title'])){ ?>
                                        <li>
                                        <?php
                                        echo $hotelHighlight['HotelHighlight']['title']; ?>
                                        </li>
                                        <?php
                                        } 
                                         ?>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </ul>
                                <div class="kmhl-bottom">
                                    <?php if(!empty($hotel['HotelAttraction'])):  ?>
                                    <p><b>Attraction Near Hotel:</b> 
                                    <?php foreach ($hotel['HotelAttraction'] as $key => $hotelAttraction) : ?>
                                    <?php echo $hotelAttraction['Attraction']['title'].','; ?> 
                                        
                                    <?php endforeach; ?>
                                    <?php endif; ?></p>
                                </div>
                            </div>
                            <div class="kmhlbdi-right">
                                <div class="kmhlr-btns">

                                    <?php echo $this->Form->create('HotelSearch', ['url'=>['controller'=>'hotel_search','action'=>'index']]); ?>
                                    <input type="hidden" name="data[HotelSearch][city]" value="<?php echo $hotel['Hotel']['city'];  ?>">

                                <input type="hidden" name="data[HotelSearch][hotel_id]" value="<?php echo $hotel['Hotel']['id'];  ?>">

                                <input type="hidden" name="data[HotelSearch][room_id]" value="">

                                <input type="hidden" name="data[HotelSearch][room_type]" value="">

                                <input type="hidden" name="data[HotelSearch][bed_type_id]" value="">

                                <input type="hidden" name="data[HotelSearch][no_of_childs]" value="1">

                                <input type="hidden" name="data[HotelSearch][no_of_adults]" value="2">

                                <input type="hidden" name="data[HotelSearch][no_of_rooms]" value="1">
                                <input type="hidden" name="data[HotelSearch][check_in]" value="<?php echo date('Y-m-d', time()) ?>">

                                <input type="hidden" name="data[HotelSearch][check_out]" value="<?php echo date('Y-m-d', strtotime(' +1 day')) ?>">

                            <button name="submit" type="submit" class="btn btn-black btn-block">Book Now</button>
                           <?php echo $this->Form->end(); ?>


                                    <?php //echo $this->Html->link('Book Now', array('controller' => 'hotels', 'action' => 'details', $hotel_slug),array('class'=>'btn btn-black btn-block')); ?>



                                    <?php echo $this->Html->link('Basic Information', array('controller' => 'hotels', 'action' => 'details', $hotel_slug),array('class'=>'btn btn-black btn-block')); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php endif; ?>