<section class="kh-banner" style="background-image:url('<?php echo Configure::read('siteUrlfront');  ?>/uploads/SiteSettings/<?php  echo $siteSettings['SiteSettings']['destination_inner_banner'] ?>');">
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
        <div class="container">
            <!-- <div class="khpb-head">
                <h3><?php // echo $siteSettings['SiteSettings']['destination_inner_title'] ?></h3>
            </div> -->
            <div class="khpb-content kmdst-list">
                <?php if(!empty($destinations)): ?>
                    <?php foreach ($destinations as $key => $destination) : 
                    $destination_slug = $destination['Destination']['slug']; ?>
                <div class="kmdst-bx dest">
                    <div class="kmdstb-img">
                        <?php echo $this->Html->link($this->Html->image(Configure::read('siteUrlfront').'/uploads/destination/'.$destination['Destination']['featured_image'], array('alt' => $destination['Destination']['title'])),
                            array('controller' => 'destinations', 'action' => 'details', $destination_slug),
                            array('escape' => false, 'rel' => 'nofollow')
                        ); ?>
                        </div>
                    <div class="kmdst-dtl">
                        <h5><?php if (isset($destination['Destination']['title'])) {
                                             echo $this->Html->link($destination['Destination']['title'], array('controller' => 'destinations', 'action' => 'details', $destination_slug));
                                        } ?></h5>
                        <div class="kmdstd-in">
                            <p>

                                <?php if (isset($destination['Destination']['description'])) {

                                    $dest = $destination['Destination']['description'];
                                    echo $this->Text->truncate(strip_tags($dest),
                                            570,
                                            array(
                                                'ellipsis' => '...',
                                                'exact' => false
                                            )
                                        );

                                            
                                        } ?>
                        </p>
                        </div>
                        <?php echo $this->Html->link('Read More...', array('controller' => 'destinations', 'action' => 'details', $destination_slug),array('class'=>'btn btn-pink')); ?>


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
                row = parseInt(row)+parseInt(page) ;

                if(row <= allcount){
                    $("#row").val(row);

                    $.ajax({
                        url: siteUrlfront+'ajax/loadmoredest',
                        type: 'post',
                        data: {row:row},
                        beforeSend:function(){
                            $(".load-more").html("<i class='fas fa-spinner fa-spin'></i> Loading");
                        },
                        success: function(response){

                            // Setting little delay while displaying new content
                            setTimeout(function() {
                                // appending tour after last tour with class="tours"
                                $(".dest:last").after(response).show().fadeIn("slow");

                                var rowno = parseInt(row)+parseInt(page) ;

                                // checking row value is greater than allcount or not
                                if(rowno >= allcount){
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
                        $('.dest:nth-child(2)').nextAll('.dest').remove().fadeIn("slow");

                        // Reset the value of row
                        $("#row").val(0);

                        // Change the text 
                        $('.load-more').text("Load more...");

                    }, 2000);
                }

            });

        });
    </script>