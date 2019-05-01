<section class="km-newsticker">
	<div class="kmnws-in">
		<div id="km_news">
			<?php /* <div class="kmnws-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sit amet lobortis lectus. Morbi hendrerit justo eget lacus congue viverra. Ut urna mauris</div>
			<div class="kmnws-text">Nam vestibulum laoreet augue consectetur vulputate. In finibus dignissim vestibulum. Donec porttitor nisl magna, commodo imperdiet sapien auctor sed. Donec aliquet</div>
			<div class="kmnws-text">Etiam vitae pulvinar erat, vitae scelerisque tellus. Sed gravida massa eget lacus luctus posuere. Aliquam varius mi quis tellus eleifend lobortis. Pellentesque ac urna fermentum</div>
			<div class="kmnws-text">Nam vestibulum laoreet augue consectetur vulputate. In finibus dignissim vestibulum. Donec porttitor nisl magna, commodo imperdiet sapien auctor sed. Donec aliquet</div> */ ?>
		</div>
	</div>
</section>

<section class="kh-welcome">
	<div class="khw-row">
		<div class="khw-left" style="background-image:url('<?php echo Configure::read('siteUrlfront');  ?>images/background_sunset.jpg')">
			<div class="khw-in">
				<div class="border-box b-left b-bottom">
					<h3>Sunset Time</h3>
				</div>
			</div>
		</div>
		<div class="khw-right" style="background-image:url('<?php echo Configure::read('siteUrlfront');  ?>images/map_bg.png')">
			<div class="khw-in">
				<div class="khw-txt">
					<h1>Welcome to Kumaon</h1>
					<p><?php if (isset($siteSettings['SiteSettings']['home_content'])) {
							 echo $siteSettings['SiteSettings']['home_content'];
						} ?></p>
				</div>
			</div>
		</div>
	</div>
</section>
