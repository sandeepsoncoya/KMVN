<section class="km-gallery">
		<div class="container">
			<div class="kmsp-head">
				<h2>Image &amp; Video Gallery</h2>
			</div>
			<div class="kmsp-content">
				<div class="kmg-nav">
					<button class="btn btn-prev" id="gallery_prev"><i class="material-icons">keyboard_arrow_left</i></button>
					<button class="btn btn-next" id="gallery_next"><i class="material-icons">keyboard_arrow_right</i></button>
				</div>
				<div class="khg-in">
					<div class="owl-carousel" id="km_gallery">
						<?php if(!empty($galleryImages)): ?>
						<?php foreach ($galleryImages as $key => $galleryImage) :  ?>
							<?php if ($galleryImage['Gallery']['type'] == 'image') { ?>
						<div class="khgi-img"><a href="<?php echo Configure::read('siteUrlfront');  ?>uploads/gallery/<?php echo $galleryImage['Gallery']['file'] ?>"><img src="<?php echo Configure::read('siteUrlfront');  ?>uploads/gallery/<?php echo $galleryImage['Gallery']['file'] ?>" title="<?php echo $galleryImage['Gallery']['title'] ?>" alt="Gallery Thumb"/></a></div>
					<?php }else{ ?>
						<div class="khgi-img"><a href="#"><?php echo $galleryImage['Gallery']['file'] ?></a></div>
						<?php } 
						endforeach; ?>
						<?php endif; ?>
						
					</div>
				</div>
			</div>
		</div>
	</section>