<?php if(!empty($tenders)){ ?>
<?php foreach ($tenders as $key => $tender) :
	if (!empty($tender['Tenders']['name'])) {
	$fileAbsolutePathFeatured = Configure::read('AbsoluteUrl').'tenders/'.$tender['Tenders']['file'];
?>
	<div class="kmtndr-item">
		<p><?php echo $tender['Tenders']['name']; ?></p>
		<a href="<?php echo $fileAbsolutePathFeatured ?>" target="_blank" class="btn btn-pink" download>Download</a>
	</div>

<?php } endforeach; ?>
<?php }else{ ?>

	<p>No active tenders are available in this category. </p>

	<?php } ?>