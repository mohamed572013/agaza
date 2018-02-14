<!-- Home Slider
============================================================== -->
<div class="home-slider clearfix fadeIn">
    <ul class="slides">
		<?php
			if (\count($home_slider) > 0) {
				foreach ($home_slider as $value) {
					?>
					<li>
						<a href="#"><img src="<?= base_url("uploads/home_slider") . "/" . $value->image ?>" alt="<?= $value->title_ar ?>" title="<?= $value->title_ar ?>" ></a>
						<div class="container">
							<div class="slider-wrap">
								<div class="slider-desc">
									<h3><?= $value->title_ar ?></h3>
									<p><?= $value->desc_ar; ?></p>
								</div>
								<?php
								if ($value->url != "" && $value->url != "#") {
									echo '<a href="' . $value->url . '" class="slider-lrn-more">التفاصيل</a>';
								}
								?>
								<?php
								if ($value->start_from_price > 0) {
									echo '<div class="slider-price">يبدأمن : ' . $value->start_from_price . ' جنية</div>';
								}
								?>


							</div>
						</div>
					</li>
					<?php
				}
			} else {
				?>	
				<li>
					<a href="#"><img src="<?= base_url("assets/front") ?>/images/slider/slider1.jpg" alt="<?= $value->title_ar ?>" title="<?= $value->title_ar ?>" ></a>

				</li>
			<?php }
		?>

    </ul>
</div>

<div class="container d-layout bigEntrance">
    <div class="row">
        <!-- News Wrap
        ============================================================== -->
        <!--search Form-->
		<?php $this->load->view("components/search_form"); ?>


        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <div class="news-wrap">
                <div class="listing-type-blk clearfix" data-aos="fade-up">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 filter">
                        <h3>  اخر الرحلات المضافة</h3>
                    </div>
                </div>

                <div class="row">
					<?php
						if (\count($HomePrograms) > 0) {
							foreach ($HomePrograms as $value) {
								?>
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
									<div class="property-item clearfix hvr-float-shadow" data-aos="flip-left">
										<div class="list-property-img">
											<a href="<?= base_url("programs/detail") . "/" . $value->id . "-" . str_replace(" ", "_", $value->title_ar); ?>">
												<img src="<?= \base_url("uploads/programs/$value->image") ?>" title="<?= $value->title_ar ?>" alt="<?= $value->title_ar ?>" />
											</a>
											<div class="pro-stat">كود الرحلة : <?= $value->our_code ?></div>
										</div>
										<div class="list-property-desc">
											<h4><a href="<?= base_url("programs/detail") . "/" . $value->id . "-" . str_replace(" ", "_", $value->title_ar); ?>"><?= $value->title_ar ?></a></h4>
											<p><?= \character_limiter(\strip_tags($value->program_include), 150) ?></p>
											<div class="pro-btn-box">
												<div class="pro-price">يبدأمن : <?= $value->price_start_from ?> جنية</div>
												<a href="<?= base_url("programs/detail") . "/" . $value->id . "-" . str_replace(" ", "_", $value->title_ar); ?>" class="pro-ln-mor">التفاصيل</a>
											</div>
										</div>
									</div>
								</div> 
								<?php
							}
						} else {
							echo '<div class="col-lg-12"><li>لا يوجد برامج حاليا</li></div>';
						}
					?>
                </div>



            </div>
        </div>



        <!-- Sidebar
        ============================================================== -->
		<?php $this->load->view("components/side_bar"); ?>



		<!-- Our Partners
		============================================================== -->
		<div class="partners" data-aos="zoom-in-up">
			<div class="container-fluid">
				<div class="row">
					<div class="partners-blk">
						<div class="partner-head">
							<h3>شركائنا</h3>
							<div class="part-prev"><i class="fa fa-chevron-left"></i></div>
							<div class="part-next"><i class="fa fa-chevron-right"></i></div>
						</div>
						<div class="part-caro owl-carousel" id="partners">
							<?php
								foreach ($branches as $value) {
									if ($value->image != "") {
										?>
										<div class="partner-blk">
											<a href="#partners"><img class="grayscale" src="<?= base_url("uploads/branches/$value->image") ?>" alt="<?=$value->title_ar?>"  title="<?=$value->title_ar?>" ></a>
										</div>
										<?php
									}
								}
								 
							?>

						</div>
					</div>
				</div>
			</div>
		</div>
