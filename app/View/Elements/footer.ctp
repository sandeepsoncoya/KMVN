
<footer class="md-footer">
        <div class="container">
            <div class="mdf-in">
                <div class="mdf-bx">
                    <div class="mdfb-head newsletter">
                        <h3>Contact Us</h3>
                    </div>
                    <div class="mdfb-content">
                        <div class="mdfb-about">
                            <div class="gMap" id="GoogleMap"></div>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy.</p>
                            <ul class="mdfbc-list">
                                <li class="ic-location"><address>  <?php if ($siteSettings['SiteSettings']['address']) {
                                    echo $siteSettings['SiteSettings']['address'];
                                } ?></address></li>
                                <li class="ic-phone"><a href="tel:<?php if ($siteSettings['SiteSettings']['phone']) {
                                    echo $siteSettings['SiteSettings']['phone'];
                                } ?>"><?php if ($siteSettings['SiteSettings']['phone']) {
                                    echo $siteSettings['SiteSettings']['phone'];
                                } ?></a></li>
                                <li class="ic-mail"><a href="mailto:<?php if ($siteSettings['SiteSettings']['email']) {
                                    echo $siteSettings['SiteSettings']['email'];
                                } ?>"><?php if ($siteSettings['SiteSettings']['email']) {
                                    echo $siteSettings['SiteSettings']['email'];
                                } ?></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="mdf-bx">
                    <div class="mdfb-head links">
                        <h3>Quick Links</h3>
                    </div>
                    <div class="mdfb-content">
                        <div class="mdfb-link">
                            <ul>
                                <li><?php echo $this->Html->link('Home','/pages/home'); ?></li>
                                <li><?php echo $this->Html->link('About Us','/pages/about'); ?></li>
                                <li><?php echo $this->Html->link('Destinations','/destinations'); ?></li>
                                <li><?php echo $this->Html->link('Packages','/tour-packages'); ?></li>
                                <li><?php echo $this->Html->link('Privacy Policy','/pages/privacy-policy'); ?></li>
                                <li><?php echo $this->Html->link('Terms & Conditions','/pages/terms-conditions'); ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="mdf-bx">
                    <div class="mdfb-head contact">
                        <h3>Facebook Page</h3>
                    </div>
                    <div class="mdfb-content">
                        <div class="kmf-pgbx">
                            <div class="fb-page" data-href="https://www.facebook.com/kmvnl" data-tabs="timeline" data-height="290" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/kmvnl" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/kmvnl">Kumaon Mandal Vikas Nigam Limited (KMVN)</a></blockquote></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </footer>
    <section class="acf-bottom">
        &copy; Copyright 2019 <a href="javascript:void(0)">Kumaon Mandal</a> All Right Reserved &reg;
        <div class="mdt-btn" id="to_top">
            <button type="button" class="btn btn-top">
                <i class="material-icons">keyboard_arrow_up</i>
            </button>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- key=AIzaSyAJi3omveElhdVRHbZX5OJi8xJFNYHfc6g& -->
	<script async defer src="https://maps.googleapis.com/maps/api/js?callback=initMap&callback=initFMap"></script>
	<script type="text/javascript">
			 var lat = <?php if ($siteSettings['SiteSettings']['lat']) {
							echo $siteSettings['SiteSettings']['lat'];
						} ?>;
			var long = <?php if ($siteSettings['SiteSettings']['long']) {
							echo $siteSettings['SiteSettings']['long'];
						} ?>;
			// Initialize and add the map
		var kumaon, map1_options, map1_s, map2_s, map2_options;
		kumaon = { lat: lat, lng: long };
		var map1_s = document.getElementById('GoogleMap');
		map1_options = {
		  zoom: 10,
		  center: kumaon
		}

		map2_s = document.getElementById('hotel_map');
		if(loc){
			map2_options= { 
			  zoom: 14, 
			  center: loc
			}                    
		}
		function initFMap() {
		  if(map1_s){
			  var map = new google.maps.Map(map1_s, map1_options);
			  var marker = new google.maps.Marker({ position: kumaon, map: map });
			}
			if(map2_s){
			  var map2 = new google.maps.Map(map2_s, map2_options);
			  var marker2 = new google.maps.Marker({ position: loc, map: map2 });
			}
		}
		</script>

<?php
     echo $this->Html->script([
        'slick.min',
        'wow.min',
        'jquery.validate.min',
        'lightgallery.min',
        '/admin/dist/js/sweetalert',
        'jquery.teletype.min.js',
        'scripts'
    ]);
    ?>
	
<script type="text/javascript">
	var topPos;
	var topBtn = $("#to_top button");
	var body = $("body, html");
	topBtn.on("click", function(){
		body.stop().animate({
			scrollTop:0
		},1000)
	})
	$(window).on("scroll", function(){
		topPos = $(this).scrollTop();
		if(topPos > 5){
			$("#to_top").fadeIn(300);
		}
		else{
			$("#to_top").fadeOut(300);
		}
	})
</script>
