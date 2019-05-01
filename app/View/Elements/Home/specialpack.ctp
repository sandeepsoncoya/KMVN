<?php if(!empty($featuredTourPackages)): ?>
<section class="km-spackage kmh-block">
	<div class="container">
		<div class="kmhb-head">
			<h2>Special Tour Package</h2>
		</div>
		<div class="kmhb-body">
			<div class="khpd-grid g4-12">
				<?php foreach ($featuredTourPackages as $key => $featuredTourPackage) : ?>
					<div class="khpdg-bx">
						<div class="khpdgb-in" style="background-image:url('<?php echo Configure::read('siteUrlfront');  ?>uploads/tour/<?php echo $featuredTourPackage['TourPackage']['featured_image'] ?>')">
							<div class="khpgdb-overlay">
								<div class="stp-info">
									<div class="stpi-top"><?php if (isset($featuredTourPackage['TourPackage']['title'])) {
										$title = strlen($featuredTourPackage['TourPackage']['title']) > 37 ? substr($featuredTourPackage['TourPackage']['title'],0,34)."..." : $featuredTourPackage['TourPackage']['title'];
										 echo $title;
									} ?></div>
									<div class="stpi-bottom">
										<h5>Rs <?php echo number_format($featuredTourPackage['TourPackage']['price']); ?> /-</h5>
										<p><?php if (isset($featuredTourPackage['TourPackage']['duration'])) {
										$duration = strlen($featuredTourPackage['TourPackage']['duration']) > 34 ? substr($featuredTourPackage['TourPackage']['duration'],0,37)."..." : $featuredTourPackage['TourPackage']['duration'];
										 echo $duration;
									} ?></p>
									<?php echo $this->Html->link('Book Now', array('controller' => 'tourPackages', 'action' => 'details',$featuredTourPackage['TourPackage']['slug']),array('class'=>'btn btn-pink')) ?>
									
										<?php echo $this->Html->link('Read More', array('controller' => 'tourPackages', 'action' => 'details',$featuredTourPackage['TourPackage']['slug']),array('class'=>'btn btn-pink')) ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>