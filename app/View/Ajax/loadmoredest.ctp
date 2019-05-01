<?php if(!empty($destinations)): ?>
                    <?php foreach ($destinations as $key => $destination) : 
                    $destination_slug = $destination['Destination']['slug']; ?>
                <div class="kmdst-bx dest">
                    <div class="kmdstb-img"><?php echo $this->Html->link($this->Html->image(Configure::read('siteUrlfront').'/uploads/destination/'.$destination['Destination']['featured_image'], array('alt' => $destination['Destination']['title'])),
                            array('controller' => 'destinations', 'action' => 'details', $destination_slug),
                            array('escape' => false, 'rel' => 'nofollow')
                        ); ?></div>
                    <div class="kmdst-dtl">
                        <h5><?php if (isset($destination['Destination']['title'])) {
                                             echo $this->Html->link($destination['Destination']['title'], array('controller' => 'destinations', 'action' => 'details', $destination_slug));
                                        } ?></h5>
                        <div class="kmdstd-in">
                            <p> <?php if (isset($destination['Destination']['description'])) {
                                    echo $this->Text->truncate(
                                            $destination['Destination']['description'],
                                            570,
                                            array(
                                                'ellipsis' => '...',
                                                'exact' => false
                                            )
                                        );
                                            
                                        } ?></p>
                        </div>
                        <?php echo $this->Html->link('Read More...', array('controller' => 'destinations', 'action' => 'details', $destination_slug),array('class'=>'btn btn-pink')); ?>

                    </div>
                </div>
                <?php endforeach; ?>
                <?php endif; ?>