<!-- Page Header
============================================================== -->
<div class="page-head" style="background-repeat: no-repeat;background-position: center top;background-image: url('<?= base_url("assets/front/images/page-title-bg.jpg"); ?>'); background-size: cover ">
	<div class="page-head-wrap">
        <h1 class="page-head-title"><span><?= $seo->title_ar; ?></span></h1>
		<div class="page-head-subtitle"><?= $news_detail->title_ar; ?></div>
    </div>
</div>

<div class="container">
    <div class="row">
        <!-- News Wrap
        ============================================================== -->
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <div class="news-wrap">



				<div id="sectiona" class="tab-pane fade in active">
					<div class="pro-dtl-text">
						<h3 class="main-widget-title"> الوصف  :</h3> 
						<div class="row" >
							<div class="col-lg-12">
								<img style="width: 100%;max-height: 400px" src="<?= \base_url("uploads/news/$news_detail->image") ?>" title="<?= $news_detail->title_ar ?>" alt="<?= $news_detail->title_ar ?>" />
							</div>
						</div>
						<div class="clearfix"></div>
						<br/>
						<div>
							<?= $news_detail->body_ar; ?>
						</div>

					</div>
				</div>









			</div>
		</div>



		<!-- Sidebar
		============================================================== -->
		<?php $this->load->view("components/side_bar"); ?>


	</div></div> 