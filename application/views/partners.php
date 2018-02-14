<div class="page-head" style="background-repeat: no-repeat;background-position: center top;background-image: url('<?= base_url("assets/front/images/page-title-bg.jpg") ?>'); background-size: cover ">
    <div class="page-head-wrap">

        <h1 class="page-head-title"><span> <?= $seo->title_ar ?></span></h1>
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
                        <h3>  <?= $seo->title_ar ?></h3>
                    </div>
                </div>

                <div class="row">
					<?php
						if (\count($partners) > 0) {
							foreach ($partners as $value) {
								?>
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
									<div class="property-item clearfix hvr-float-shadow" data-aos="flip-left">
										<div class="list-property-img">
											<img src="<?= \base_url("uploads/branches/$value->image") ?>" title="<?= $value->title_ar ?>" alt="<?= $value->title_ar ?>" />
										</div>
										<div class="">
											<h4> <a><?= $value->title_ar ?> </a></h4>

										</div>
									</div>
								</div> 


								<?php
							}
							 
						} else {
							echo '<div class="col-lg-12"><li>لا يوجد فنادق حاليا</li></div>';
						}
					?>
                </div>
				<div class="row" >
					<?php echo $links; ?>
				</div>
				<style>
					.pagination > li {
						display: inline;
						float: right;
					}
				</style>


            </div>
        </div>



        <!-- Sidebar
        ============================================================== -->
		<?php $this->load->view("components/side_bar"); ?>



