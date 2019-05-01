<?php if(!empty($activities)): ?>
    <?php foreach ($activities as $key => $activity) : 
        $activity_slug = $activity['Activities']['slug']; ?>
        <div class="kmdst-bx dest">
            <div class="kmdstb-img"><?php echo $this->Html->link($this->Html->image(Configure::read('siteUrlfront').'/uploads/activity/'.$activity['Activities']['featured_image'], array('alt' => $activity['Activities']['name'])),
                    array('controller' => 'activities', 'action' => 'details', $activity_slug),
                    array('escape' => false, 'rel' => 'nofollow')
                ); ?></div>
            <div class="kmdst-dtl">
                <h5><?php if (isset($activity['Activities']['name'])) {
                                     echo $this->Html->link($activity['Activities']['name'], array('controller' => 'activities', 'action' => 'details', $activity_slug));
                                } ?></h5>
                <div class="kmdstd-in">
                    <p><?php if (isset($activity['Activities']['description'])) {
                                    $description = $activity['Activities']['description'];
                                     echo $description;
                                } ?></p>
                </div>
                <?php echo $this->Html->link('Read More...', array('controller' => 'activities', 'action' => 'details', $activity_slug),array('class'=>'btn btn-pink')); ?>

            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>