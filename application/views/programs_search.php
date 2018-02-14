 

<div class="page-head" style="background-repeat: no-repeat;background-position: center top;background-image: url('<?= base_url("assets/front/images/page-title-bg.jpg") ?>'); background-size: cover ">
    <div class="page-head-wrap">
		<div class="page-head-subtitle">نتائج البحث</div>
    </div>
</div>

<div class="container d-layout bigEntrance">
    <div class="row">
        <!-- News Wrap
        ============================================================== -->
        <!--search Form-->
		<?php $this->load->view("components/search_form"); ?>


        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <div class="news-wrap">
                <div class="listing-type-blk clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 filter">
                        <h3>  نتائج الابحث</h3>
                    </div>
                </div>

                <div class="row">
					<?php
						if (\count($programs) > 0) {
							foreach ($programs as $value) {
								?>
								<div class="property-item clearfix">
									<div class="row listing">
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
											<div class="list-property-img">
												<a href="<?= base_url("programs/detail") . "/" . $value->id . "-" . str_replace(" ", "_", $value->title_ar); ?>">
													<img src="<?= \base_url("uploads/programs/$value->image") ?>"  title="<?= $value->title_ar ?>" alt="<?= $value->title_ar ?>"  >
												</a>
												<div class="pro-stat">كود الرحلة : <?= $value->our_code ?></div>
											</div>
										</div>
										<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
											<div class="list-property-desc">
												<h4><a href="<?= base_url("programs/detail") . "/" . $value->id . "-" . str_replace(" ", "_", $value->title_ar); ?>"><?= $value->title_ar ?></a></h4>
												<p><?= \character_limiter(\strip_tags($value->program_include), 250) ?></p>
												<div class="pro-btn-box">
													<div class="pro-price">يبدأمن :  <?= $value->price_start_from ?> جنية</div>
													<a href="<?= base_url("programs/detail") . "/" . $value->id . "-" . str_replace(" ", "_", $value->title_ar); ?>" class="pro-ln-mor">التفاصيل</a>
												</div>
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



