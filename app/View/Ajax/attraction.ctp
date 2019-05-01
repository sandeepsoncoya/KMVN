<?php if(!empty($attraction)){ ?>
<div class="kmrms-attraction">
<?php foreach($attraction as $key=>$value): ?>
    <div class="kmrmsa-bx">
        <div class="kmrmsab-img">
            <a href="#"><img src="images/room_img_01.jpg" alt=""></a>
        </div>
        <h6><a href="#"><?php echo $value['Attraction']['title']; ?></a></h6>
    </div>
<?php endforeach; ?>
</div>
<?php }else{ ?>
	<p>No data available.</p>
	<?php } ?>