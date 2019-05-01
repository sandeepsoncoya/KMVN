<?php if(!empty($hotels)): ?>
<section class="kh-bHotels kmh-block">
	<div class="container">
		<div class="kmhb-head">
			<h2>Best Hotels</h2>
		</div>
		<div class="kmhb-body">
			<div class="row">
				<div class="col-12 col-lg-6">
					<div class="kmhb-vCarousel">
						<div class="kmhb-vCarouselIn">
							<div id="hotel_Carousel" class="owl-carousel">
								<?php
								if (!empty($hotels)) {
								 foreach ($hotels as $key => $hotel) {
								 $path = 	Configure::read('siteUrlfront').'uploads/hotels/'.$hotel['Hotel']['video'];
							  ?>
								<div class="kmh-video-frame">
									<video width="600" height="400" controls>
										<source src="<?php echo $path; ?>" type="video/mp4" />
									</video>
								</div>
								<?php } } ?>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-lg-6">
					<div class="khpd-grid g6-12">
					 <?php foreach ($hotels as $key => $hotel) :
					 	$hotel_slug = $hotel['Hotel']['slug']; 
					  ?>
						<div class="khpdg-bx">
							<div class="khpdgb-in" style="background-image:url('<?php echo Configure::read('siteUrlfront');  ?>uploads/hotels/<?php echo $hotel['Hotel']['featured_image'] ?>')">
								<div class="khpgdb-overlay">
									<h5><?php if (isset($hotel['Hotel']['title'])) {
											$title = strlen($hotel['Hotel']['title']) > 37 ? substr($hotel['Hotel']['title'],0,34)."..." : $hotel['Hotel']['title'];
											 echo $title;
										} ?></h5>
									<p>
										<?php if (isset($hotel['Hotel']['description'])) {
												$hot = $hotel['Hotel']['description'];
	                                    		echo $this->Text->truncate(
	                                            strip_tags($hot),
	                                            200,
	                                            array(
	                                                'ellipsis' => '...',
	                                                'exact' => false
	                                            )
	                                        	);
                                        } ?>
										
										</p>
										<?php echo $this->Html->link('Read More..', array('controller' => 'hotels', 'action' => 'details', $hotel_slug),array('class'=>'btn btn-pink')); ?>
								</div>
							</div>
						</div>
					 <?php endforeach; ?>

					</div>
				</div>
				
			</div>
		</div>
	</div>
	</section>
<?php endif; ?>
