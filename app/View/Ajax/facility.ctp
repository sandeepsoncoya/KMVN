<?php
if(!empty($facility)){ ?>
<?php  $previousTitle =  "";
$i= 0;
foreach($facility as $value): 
?>
<?php if($value['HotelFacilitiesInfo']['HotelFacilities']['title'] !=  $previousTitle): ?>
<?php if($i >0):?>
</ul>
    </div>
<?php endif; ?>
    <div class="kmhdbf-item">
        <h5><?php echo $value['HotelFacilitiesInfo']['HotelFacilities']['title']; ?></h5>
        <ul class="kmhl-facilities">
<?php endif; ?>
            <li><?php echo $value['HotelFacilitiesInfo']['title']; ?></li>
       
<?php       $previousTitle = $value['HotelFacilitiesInfo']['HotelFacilities']['title']; 
$i++;
endforeach;?>
<?php }else{ ?>
<p>No data available.</p>
<?php  } ?>