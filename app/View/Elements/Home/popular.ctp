<?php if(!empty($featuredDestinations)): ?>
	<section class="kh-popular kmh-block">
		<div class="container">
			<div class="kmhb-head">
				<h2>Popular Destinations</h2>
			</div>
			<div class="kmhb-body">
				<div class="khpd-grid g4-12">
					<?php foreach ($featuredDestinations as $key => $featuredDestination) : ?>
						<div class="khpdg-bx">
							<div class="khpdgb-in" style="background-image:url('<?php echo Configure::read('siteUrlfront');  ?>uploads/destination/<?php echo $featuredDestination['Destination']['featured_image'] ?>')">
								<div class="khpgdb-overlay">
									<h5><?php if (isset($featuredDestination['Destination']['title'])) {
										 echo $featuredDestination['Destination']['title'];
									} ?></h5>
									<p>
										<?php if (isset($featuredDestination['Destination']['description'])) {
												$dest = $featuredDestination['Destination']['description'];
	                                    		echo $this->Text->truncate(
	                                            strip_tags($dest),
	                                            200,
	                                            array(
	                                                'ellipsis' => '...',
	                                                'exact' => false
	                                            )
	                                        	);
                                        } ?>

									</p>
									<?php echo $this->Html->link('Read More', array('controller' => 'destinations', 'action' => 'details',$featuredDestination['Destination']['slug']),array('class'=>'btn btn-pink')) ?>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>