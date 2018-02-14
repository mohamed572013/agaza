<!-- Page Header
============================================================== -->
<div class="page-head" style="background-repeat: no-repeat;background-position: center top;background-image: url('<?= base_url("assets/front/images/page-title-bg.jpg"); ?>'); background-size: cover ">
	<div class="page-head-wrap">
        <h1 class="page-head-title"><span><?= $seo->title_ar; ?></span></h1>
		<div class="page-head-subtitle"><?= $hotel_detail->title_ar; ?></div>
    </div>
</div>

<div class="container">
    <div class="row">
        <!-- News Wrap
        ============================================================== -->
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <div class="news-wrap">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 details-gallery" data-aos="fade-up">
                        <div id="slider" class="property-slider">
                            <ul class="slides">
								<?php
									if ($hotel_detail->image != "") {
										?>
										<li>
											<img src="<?= \base_url("uploads/maka_madina_hotels/$hotel_detail->image") ?>" title="<?= $hotel_detail->title_ar; ?>"  alt="<?= $hotel_detail->title_ar; ?>" >
										</li>
										<?php
									}
									if (\count($maka_madina_hotels_slider) > 0) {
										foreach ($maka_madina_hotels_slider as $value) {
											?>
											<li>
												<img src="<?= \base_url("uploads/maka_madina_hotels_slider/$value->image") ?>" title="<?= $hotel_detail->title_ar; ?>"  alt="<?= $hotel_detail->title_ar; ?>" >
											</li>
											<?php
										}
									}
								?>


                            </ul>
                        </div>
                        <div id="carousel" class="flexslider">
                            <ul class="slides">
								<?php
									if ($hotel_detail->image != "") {
										?>
										<li>
											<img src="<?= \base_url("uploads/maka_madina_hotels/$hotel_detail->image") ?>" title="<?= $hotel_detail->title_ar; ?>"  alt="<?= $hotel_detail->title_ar; ?>" >
										</li>
										<?php
									}
									if (\count($maka_madina_hotels_slider) > 0) {
										foreach ($maka_madina_hotels_slider as $value) {
											?>
											<li>
												<img src="<?= \base_url("uploads/maka_madina_hotels_slider/$value->image") ?>" title="<?= $hotel_detail->title_ar; ?>"  alt="<?= $hotel_detail->title_ar; ?>" >
											</li>
											<?php
										}
									}
								?>

                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 details" data-aos="fade-right">
                        <h4 class="pro-dtl-title"><?= $hotel_detail->title_ar; ?></h4>
                        <div class="pro-dtl-btn-box">
                            <div class="pro-dtl-status"> البعد عن الحرم بالمتر   : <?= $hotel_detail->far_from_campus; ?></div>
						</div>
                        <ul class="pro-dtl-meta clearfix">
                            <li>   عدد النجوم: <?= $hotel_detail->stars; ?> </li>
                            <li> 
								<div class=" col-lg-4">  مميزات الفندق:  </div>

								<?php
									$hotels_advantage_ids = $hotel_detail->hotels_advantage_ids;
									$hotels_advantage_ids = explode(',', $hotels_advantage_ids);
									foreach ($hotels_advantage as $value) {
										$image = $value->image;
										if (in_array($value->id, $hotels_advantage_ids)) {
											?>
											<div class=" col-lg-4">
												<img src="<?= \base_url("theme/features_image/$image"); ?>" class="max-image-40" style="  max-width: 24px; max-height: 24p">
												<?= $value->title_ar; ?>

											</div>

										<?php }
									}
								?>

							</li>
						</ul>


                    </div>
<!--                    <div class="clearfix"><br></div>
					<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<label class="control-label" for="maka_madina_hotels_features">المميزات:</label>
						<ul>
							<?php
								$hotels_advantage_ids = $hotel_detail->hotels_advantage_ids;
								$hotels_advantage_ids = explode(',', $hotels_advantage_ids);
								foreach ($hotels_advantage as $value) {
									$image = $value->image;
									if (in_array($value->id, $hotels_advantage_ids)) {
										?>

										<?php ?>
										<li class="pull-right col-xs-12 col-sm-6 col-md-4 col-lg-4 list-group-item padding-0-4">
											<label class="checkbox-inline nopadding">
												<img src="<?= base_url("theme/features_image/$value->image") ?>" class="image-32 margin-4"> <?= $value->title_ar ?>
											</label>
										</li>
										<?php
									}
								}
							?>	</ul>
					</div>-->
					<div class="clearfix"><br></div><br><hr/>



				</div>


				<div id="sectiona" class="tab-pane fade in active">
					<div class="pro-dtl-text">
						<h3 class="main-widget-title"> وصف الفندق:</h3> 
						<div>
							<?= $hotel_detail->body_ar; ?>
						</div>

					</div>
				</div>









			</div>
		</div>



		<!-- Sidebar
		============================================================== -->
		<?php $this->load->view("components/side_bar"); ?>


	</div></div> 