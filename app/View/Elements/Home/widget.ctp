<style type="text/css">
	.btn-link {
    font-weight: 400;
    color: #fff;
    text-decoration: none;
}
.card{
	     background-color: #093d78 !important; 

}
.btn-link:hover {
    color: #fff;
    text-decoration: underline;
}
</style>
<section class="kh-widget">
	<div class="container">
		<div class="row">
			<div class="col-12 col-sm-6 col-lg-4">
				<div class="widget weather-widget">
					<div class="w-city-bx">
						<select id="widget_city" class="form-control">
							<option value="0">Nainital</option>
							<option value="1">Bageshwar</option>
							<option value="2">Ranikhet</option>
							<option value="3">Almora</option>
							<option value="4">Haldwani</option>
							<option value="5">Kedarnath</option>
						</select>
					</div>
					<div class="tab-content">
					  <div class="tab-pane active" id="nainital" role="tabpanel" aria-labelledby="home-tab">
						<div class="ww-in">
							<a class="weatherwidget-io" href="https://forecast7.com/en/29d3879d46/nainital/" data-label_1="NAINITAL" data-label_2="WEATHER" data-theme="pure" data-basecolor="rgba(255,255,255,0)" data-textcolor="#ffffff" data-highcolor="#ffffff" data-lowcolor="#ffffff" data-suncolor="#ffffff" data-mooncolor="#ffffff" data-cloudcolor="#ffffff" data-cloudfill="#ffffff" data-raincolor="#ffffff" data-snowcolor="#ffffff" >NAINITAL WEATHER</a>
						</div>
					  </div>
					  <div class="tab-pane" id="bageshwar" role="tabpanel" aria-labelledby="settings-tab">
						<div class="ww-in">
							<a class="weatherwidget-io" href="https://forecast7.com/en/29d8479d77/bageshwar/" data-label_1="BAGESHWAR" data-label_2="WEATHER" data-theme="pure" data-basecolor="rgba(255,255,255,0)" data-textcolor="#ffffff" data-highcolor="#ffffff" data-lowcolor="#ffffff" data-suncolor="#ffffff" data-mooncolor="#ffffff" data-cloudcolor="#ffffff" data-cloudfill="#ffffff" data-raincolor="#ffffff" data-snowcolor="#ffffff" >BAGESHWAR WEATHER</a>
						</div>
					  </div>
					  <div class="tab-pane" id="ranikhet" role="tabpanel" aria-labelledby="profile-tab">
						<div class="ww-in">
							<a class="weatherwidget-io" href="https://forecast7.com/en/29d6479d43/ranikhet/" data-label_1="RANIKHET" data-label_2="WEATHER" data-theme="pure" data-basecolor="rgba(255,255,255,0)" data-textcolor="#ffffff" data-highcolor="#ffffff" data-lowcolor="#ffffff" data-suncolor="#ffffff" data-mooncolor="#ffffff" data-cloudcolor="#ffffff" data-cloudfill="#ffffff" data-raincolor="#ffffff" data-snowcolor="#ffffff" >RANIKHET WEATHER</a>
						</div>
					  </div>
					  <div class="tab-pane" id="almora" role="tabpanel" aria-labelledby="messages-tab">
						<div class="ww-in">
							<a class="weatherwidget-io" href="https://forecast7.com/en/29d5979d65/almora/" data-label_1="ALMORA" data-label_2="WEATHER" data-theme="pure" data-basecolor="rgba(255,255,255,0)" data-textcolor="#ffffff" data-highcolor="#ffffff" data-lowcolor="#ffffff" data-suncolor="#ffffff" data-mooncolor="#ffffff" data-cloudcolor="#ffffff" data-cloudfill="#ffffff" data-raincolor="#ffffff" data-snowcolor="#ffffff" >ALMORA WEATHER</a>
						</div>
					  </div>
					  <div class="tab-pane" id="haldwani" role="tabpanel" aria-labelledby="settings-tab">
						<div class="ww-in">
							<a class="weatherwidget-io" href="https://forecast7.com/en/29d2279d51/haldwani/" data-label_1="HALDWANI" data-label_2="WEATHER" data-theme="pure" data-basecolor="rgba(255,255,255,0)" data-textcolor="#ffffff" data-highcolor="#ffffff" data-lowcolor="#ffffff" data-suncolor="#ffffff" data-mooncolor="#ffffff" data-cloudcolor="#ffffff" data-cloudfill="#ffffff" data-raincolor="#ffffff" data-snowcolor="#ffffff" >HALDWANI WEATHER</a>
						</div>
					  </div>
					  <div class="tab-pane" id="kedarnath" role="tabpanel" aria-labelledby="settings-tab">
						<div class="ww-in">
							<a class="weatherwidget-io" href="https://forecast7.com/en/30d7379d07/kedarnath/" data-label_1="KEDARNATH" data-label_2="WEATHER" data-theme="pure" data-basecolor="rgba(255,255,255,0)" data-textcolor="#ffffff" data-highcolor="#ffffff" data-lowcolor="#ffffff" data-suncolor="#ffffff" data-mooncolor="#ffffff" data-cloudcolor="#ffffff" data-cloudfill="#ffffff" data-raincolor="#ffffff" data-snowcolor="#ffffff" >KEDARNATH WEATHER</a>
						</div>
					  </div>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-lg-4">
				<div class="widget tender-widget">
					<div class="khwi-head">
						<h4>Tender Notice</h4>
					</div>
					<div class="khwi-content">
						<div class="khwic-in">
							<div class="khwicin-scroll">
								<div class="sscroll">
									<ol class="widget-list">
										<?php if(!empty($tenders)): ?>
										<?php foreach ($tenders as $key => $tender) :
											$fileAbsolutePathFeatured = Configure::read('AbsoluteUrl').'tenders/'.$tender['Tenders']['file'];
										 ?>
										 <li><a href="<?php echo $fileAbsolutePathFeatured ?>" target="_blank"><?php if (isset($tender['Tenders']['name'])) {
										$name = strlen($tender['Tenders']['name']) > 252 ? substr($tender['Tenders']['name'],0,252)."..." : $tender['Tenders']['name'];
										 echo $name;
										} ?></a></li>
										<?php endforeach; ?>
										<?php endif; ?>
										
									</ol>
								</div>
							</div>
						</div>
						<div class="khwic-ftr">
							<?php echo $this->Html->link('View More', array('controller' => 'tenders', 'action' => 'index'),array('class'=>'')); ?>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-lg-4">
				<div class="row">
					<div class="col-12 col-sm-6 col-lg-12">
						<div class="widget faq-widget">
							<div class="khwi-head">
								<h4>FAQ</h4>
							</div>
							<div class="khwi-content">
								<div class="khwic-in ">
									<div class="khwicin-scroll">
										<div class="sscroll">
											<div class="accordion" id="accordionExample">
												<?php if (!empty($faqs)) {
													foreach ($faqs as $key => $value) { ?>
											  <div class="card z-depth-0 bordered">
												<div class="card-header" id="heading_<?php echo $key ?>">
												  <h5 class="mb-0">
													<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse_<?php echo $key ?>"
													  aria-expanded="true" aria-controls="collapse_<?php echo $key ?>">
													  <?php echo $value['Faqs']['title']; ?>
													</button>
												  </h5>
												</div>
												<div id="collapse_<?php echo $key ?>" class="collapse <?php if($key == 0) echo 'show'; ?>" aria-labelledby="heading_<?php echo $key ?>" data-parent="#accordionExample">
												  <div class="card-body">
													<?php echo $value['Faqs']['answer']; ?>
												  </div>
												</div>
											  </div>
											  <?php } } ?>

											</div>
										</div>
									</div>
								</div>
								<!-- <div class="khwic-ftr">
									<a href="#">View More</a>
								</div> -->
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-6 col-lg-12">
						<div class="widget ebook-widget">
							<div class="khwi-head">
								<h4>e-Book</h4>
							</div>
							<div class="khwi-content">
								<div class="khwic-in ">
									<div class="khwicin-scroll">
										<div class="sscroll">
											<ol class="widget-list">
												<?php if (!empty($ebooks)) {
													foreach ($ebooks as $key => $ebook) {
														$fileAbsolutePathFeatured = Configure::read('AbsoluteUrl').'ebooks/'.$ebook['Ebooks']['file'];

													 ?>
												<li><a href="<?php echo $fileAbsolutePathFeatured ?>" target="_blank"><?php echo $ebook['Ebooks']['name']; ?></a></li>
												<?php }} ?> 
											</ol>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</section>
<script>
	!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','weatherwidget-io-js');
</script>