
<?php if(!empty($howtoreach)){ ?>
<?php foreach($howtoreach as $item): 
    
    if($item['HowToReach']['type'] == 1){
        $title = "By Train";
        $icon = 'train';

    }elseif($item['HowToReach']['type'] == 2){
        $title = "By Bus";
        $icon = 'directions_bus';

    }elseif($item['HowToReach']['type'] == 3){
        $title = "By Airplane";
        $icon = 'flight_takeoff';
    }
    
?>
<div class="kmrch-item">
    <div class="kmrch-head">
        <span><i class="material-icons"><?php echo $icon; ?></i></span>
        <h4><?php echo $title; ?>:</h4>
    </div>
    <div class="kmrch-content">
        <p><?php echo $item['HowToReach']['description']; ?></p>
    </div>
</div>
<?php endforeach; ?>
<?php }else{ ?>
    <p>No data available.</p>
<?php } ?>