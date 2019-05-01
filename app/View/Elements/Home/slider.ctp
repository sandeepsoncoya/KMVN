<section class="km-carousel">
		<?php if(!empty($slider)): ?>
		<div id="km_carousel" class="carousel slide" data-ride="carousel">
			<div class="carousel-inner">
				<?php $i=1; foreach($slider as $slide):
				if($slide['Slider']['image'] != ""){
					$bannerDirPath = Configure::read('RelativeUrl').'slider/'.$slide['Slider']['image'];
					$bannerWebPath = Configure::read('AbsoluteUrl').'slider/'.$slide['Slider']['image'];
				}
			?>
				<div class="carousel-item <?php echo ($i==1)?'active':''; ?>">
					<?php 
						if(file_exists($bannerDirPath)){ 
							echo $this->Html->image($bannerWebPath, array('alt' =>$slide['Slider']['title'],'class'=>''));
						} 
					 ?>
					<div class="carousel-caption">
						<div class="container">
							<div class="cc-in">
								<h2><?php echo $slide['Slider']['title']; ?></h2>
								<?php echo $this->Html->link('Book Tour','/tour-packages',array('class'=>'btn btn-pink')); ?>
							</div>
						</div>
					</div>
				</div>
				<?php $i++; endforeach; ?>
			</div>
			<div class="kmc-nav">
				<a class="carousel-control-prev" href="#km_carousel" role="button" data-slide="prev">
					<img src="<?php echo Configure::read('siteUrlfront');  ?>/images/nav_backward.png" alt="Nav Backward" />
					<span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control-next" href="#km_carousel" role="button" data-slide="next">
						<img src="<?php echo Configure::read('siteUrlfront');  ?>/images/nav_forward.png" alt="Nav Forward" />
					<span class="sr-only">Next</span>
				</a>
			</div>
		</div>
		<?php endif; ?>

		<div class="km-booking-form">
			<div class="container">
				<div class="kmbf-in">
				<?php 
					echo $this->Form->create('HotelSearch', ['type' => 'file','url'=>['controller'=>'hotel_search','action'=>'index']]); 
				?>
						<div class="form-row align-items-end flex-wrap">
							<div class="col-6 col-sm-6 col-lg">
								<div class="form-group">
									<?php
                                        echo $this->Form->input('city', [
                                            'type' => 'select',						                  
                                            'class'=>'form-control citylist',
                                            'options'   => $cityList,
                                            'empty'   => 'Select...',
                                        ]);
                                    ?>
								</div>
							</div>
							<div class="col-6 col-sm-6 col-lg">
								<div class="form-group">
									<?php
                                        echo $this->Form->input('hotel_select', [
                                            'type' => 'select',						                  
                                            'class'=>'form-control hotelList',                                           
											'empty'   => 'Select...',
											'id'=>'hotelSelect',
											'label'=>'Hotel'
                                        ]);
                                    ?>
								</div>
							</div>
							<div class="col-6 col-sm-6 col-md-3 col-lg-auto">
								<div class="form-group">
									<?php
                                        echo $this->Form->input('room_type', [
                                            'type' => 'select',						                  
                                            'class'=>'form-control roomList',                                           
                                            'empty'   => 'Select...',
                                        ]);
                                    ?>
								</div>
							</div>
							<!-- <div class="col-auto">
								<div class="form-group">
									<?php
                                        /*echo $this->Form->input('bed_type', [
                                            'type' => 'select',						                  
                                            'class'=>'form-control bedList',                                           
                                            'empty'   => 'Select...',
                                        ]);*/
                                    ?>		
								</div>
							</div> -->
							<div class="col-6 col-sm-6 col-md-auto">
								<div class="form-group">
									
									<?php
                                        echo $this->Form->input('no_of_rooms', [
                                            'type' => 'number',						                  
											'class'=>'form-control ',
											'min'=>'1',
											'value'=>'1'                                           
                                           
                                        ]);
                                    ?>	
								</div>
							</div>
							<div class="col-6 col-sm col-md col-lg-auto">
								<div class="form-group">
									<label for="">Check In</label>
									<input type="date" name="data[HotelSearch][check_in]" class="form-control" />
								</div>
							</div>
							<div class="col-6 col-sm col-md col-lg-auto">
								<div class="form-group">
									<label for="">Check Out</label>
									<input type="date" name="data[HotelSearch][check_out]" class="form-control" />
								</div>
							</div>
							
							<!-- <div class="col-auto">
								<div class="form-group">
									<?php
                                        /*echo $this->Form->input('guest', [
                                            'type' => 'select',						                  
                                            'class'=>'form-control guestList',                                           
											'empty'   => 'Select...',
                                        ]);*/
                                    ?>
								</div>
							</div> -->
							
							
							<div class="col-auto">
								<button type="submit" class="btn btn-pink"><i class="material-icons">search</i> <span>Find</span></button>
							</div>
						</div>
						<?php 
							echo $this->Form->end(); 
						?>
					<div class="kmbf-msg ">
						<div class="row">
							<div class="col-12 col-sm">
								<?php echo $this->Html->link('KMVN PRO / GSA Login',
				                        array('controller' => 'customers', 'action' => 'login'),
				                        array('escape' => FALSE)
				                    ); ?>

								 / <?php echo $this->Html->link('View Booking',
				                        array('controller' => 'ViewBookings', 'action' => 'index'),
				                        array('escape' => FALSE)
				                    ); ?></div>
							<div class="col-12 col-sm-auto text-sm-right">Taxes Extra As Applicable**</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>