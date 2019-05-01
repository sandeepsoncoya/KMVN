<p><?php echo $availableRoom['Room']['description']; ?></p>
<div class="kmrms-person">Max Occupancy: <span class="icon-adult"><?php echo $availableBeds['BedType']['adult_beds']; ?></span><span class="icon-child"><?php echo $availableBeds['BedType']['child_beds']; ?></span></div>
<?php  if(!empty($Roomfacility)):?>
    <ul class="kmhl-facilities">
        <?php foreach($Roomfacility as $facility): ?>
            <li><?php echo $facility['RoomFacilityInfo']['title']; ?></li>
        <?php endforeach; ?>    
    </ul>
<?php endif; ?>