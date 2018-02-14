<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

	<?php if (\count($first_ads) > 0) { ?>
			<div class="news-img-vid mb20" data-aos="fade-right">
				<div class="post-gal-slider">
					<ul class="slides">
						<?php
						foreach ($first_ads as $value) {
							?>

							<li><a <?php if ($value->url != "" && $value->url != "#") echo "href='$value->url'"; ?> title="<?= $value->title_ar ?>"><img src="<?= base_url("uploads/ads/$value->image") ?>" title="<?= $value->title_ar ?>" alt="<?= $value->title_ar ?>"></a></li>
							<?php
						}
						?>
					</ul>
				</div>
			</div>
		<?php } ?>



	<!--	<div class="adv" data-aos="fade-up-right">
			<a href="#"><img src="<?= base_url("assets/front") ?>/images/adv1.jpg" alt="" ></a>
		</div>
		<div class="adv" data-aos="fade-up-right">
			<a href="#"><img src="<?= base_url("assets/front") ?>/images/adv2.jpg" alt="" ></a>
		</div>-->
	<?php if (\count($secand_ads) > 0) { ?>

			<div class="news-img-vid mb20" data-aos="fade-down-right">
				<div class="post-gal-slider">
					<ul class="slides">
						<?php
						foreach ($secand_ads as $value) {
							?>

							<li><a <?php if ($value->url != "" && $value->url != "#") echo "href='$value->url'"; ?> title="<?= $value->title_ar ?>"><img src="<?= base_url("uploads/ads/$value->image") ?>" title="<?= $value->title_ar ?>" alt="<?= $value->title_ar ?>"></a></li>
							<?php
						}
						?> 
					</ul>
				</div>
			</div>
		<?php } ?>

</div>
<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
</div>
</div>
</div><!-- Close container d-layout -->