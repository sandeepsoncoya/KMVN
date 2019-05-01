<section class="kh-banner" style="background-image:url('<?php echo Configure::read('siteUrlfront');  ?>/uploads/SiteSettings/<?php  echo $siteSettings['SiteSettings']['package_inner_banner'] ?>');">
        <div class="khb-in">
            <div class="container">
                <h2>Hotels</h2>
                <ul class="breadcrumb">
                    <li><?php echo $this->Html->link('Home','/pages/home'); ?></li>
                    <li><span>Hotels</span></li>
                </ul>
            </div>
        </div>
    </section>
    <section class="khp-block">
        <div class="container">
            <div class="khpb-head">
                <h3><?php // echo $siteSettings['SiteSettings']['package_inner_title'] ?></h3>
            </div>
            <div class="khpb-content kmpc-list">
                <?php   if(!empty($hotels)): ?>
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
                                    <?php foreach ($hotel['HotelAttraction'] as $key => $hotelAttraction) :  ?>
                                    <?php
                                    if (isset($hotelAttraction['Attraction']['title'])) {
                                        
                                     echo $hotelAttraction['Attraction']['title'].',';  
                                    }
                                        ?>
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
            </div>
            <?php 
            $page =  Configure::read('pagecount');
          
            $style = '';
            if ($allcount <= $page) {
                $style = "display:none";
            } ?>
            <div class="btn-load-more" style="<?= $style;?>">
                    <button class="btn btn-pink load-more">Load More..</button>
                    <input type="hidden" id="row" value="0">
                    <input type="hidden" id="all" value="<?php echo $allcount; ?>">
            </div>
        </div>
    </section>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function(){
    // Load more data
    $('.load-more').click(function(){
        var page = "<?php echo $page =  Configure::read('pagecount'); ?>";
        var row = Number($('#row').val());
        var allcount = Number($('#all').val());
        row = row + page;

        if(row <= allcount){
            $("#row").val(row);

            $.ajax({
                url: siteUrlfront+'ajax/loadmorehotels',
                type: 'post',
                data: {row:row},
                beforeSend:function(){
                    $(".load-more").html("<i class='fas fa-spinner fa-spin'></i> Loading");
                },
                success: function(response){

                    // Setting little delay while displaying new content
                    setTimeout(function() {
                        // appending tour after last tour with class="tours"
                        $(".morehotels:last").after(response).show().fadeIn("slow");

                        var rowno = row + page ;

                        // checking row value is greater than allcount or not
                        if(rowno > allcount){
                            // Change the text and background
                            $('.load-more').css('display', 'none');

                        }else{
                            $(".load-more").text("Load more...");
                        }
                    }, 2000);
                }
            });
        }else{
            $('.load-more').html("<i class='fas fa-spinner fa-spin'></i> Loading");

            // Setting little delay while removing contents
            setTimeout(function() {
                // When row is greater than allcount then remove all class='tours' element after 2 element
                $('.morehotels:nth-child(2)').nextAll('.morehotels').remove().fadeIn("slow");

                // Reset the value of row
                $("#row").val(0);

                // Change the text 
                $('.load-more').text("Load more...");

            }, 2000);
        }

    });

});
    </script>