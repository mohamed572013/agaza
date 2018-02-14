<!-- Page Header
============================================================== -->
<div class="page-head" style="background-repeat: no-repeat;background-position: center top;background-image: url('<?= base_url("assets/front/images/page-title-bg.jpg"); ?>'); background-size: cover ">
	<div class="page-head-wrap">
        <h1 class="page-head-title"><span><?= $program_detail->programs_seasons_title; ?></span></h1>
        <div class="page-head-subtitle"><?= $program_detail->title_ar; ?></div>
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
									if ($program_detail->image != "") {
										?>
										<li>
											<img src="<?= \base_url("uploads/programs/$program_detail->image") ?>" title="<?= $program_detail->title_ar; ?>"  alt="<?= $program_detail->title_ar; ?>" >
										</li>
										<?php
									}
									if (\count($programs_slider) > 0) {
										foreach ($programs_slider as $value) {
											?>
											<li>
												<img src="<?= \base_url("uploads/programs_slider/$value->image") ?>" title="<?= $program_detail->title_ar; ?>"  alt="<?= $program_detail->title_ar; ?>" >
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
									if ($program_detail->image != "") {
										?>
										<li>
											<img src="<?= \base_url("uploads/programs/$program_detail->image") ?>" title="<?= $program_detail->title_ar; ?>"  alt="<?= $program_detail->title_ar; ?>" >
										</li>
										<?php
									}
									if (\count($programs_slider) > 0) {
										foreach ($programs_slider as $value) {
											?>
											<li>
												<img src="<?= \base_url("uploads/programs_slider/$value->image") ?>" title="<?= $program_detail->title_ar; ?>"  alt="<?= $program_detail->title_ar; ?>" >
											</li>
											<?php
										}
									}
								?>

                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 details" data-aos="fade-right">
                        <h4 class="pro-dtl-title"><?= $program_detail->title_ar; ?></h4>
                        <div class="pro-dtl-btn-box">
                            <div class="pro-dtl-status">كود الرحلة : <?= $program_detail->our_code; ?></div>
                            <div class="pro-dtl-price">السعر يبدا من : <?= $program_detail->price_start_from; ?> جنية مصرى</div>
                        </div>
                        <ul class="pro-dtl-meta clearfix">
                            <li>مدة الرحلة: <?= $program_detail->nights + 1; ?> أيام / <?= $program_detail->nights; ?> ليالى | <?= $program_detail->stars; ?>نجوم  / <?= $program_detail->programs_levels_title; ?></li>
							<?php
//                            if (\count($program_dates) > 0) {
//                                $value = $program_dates[0];
//                                echo '<li>تاريخ الرحلة: ';
//                                echo date("d / m / Y ", strtotime($value->going_date));
//                                echo '</li>';
//                            }
							?>
                            <li> <a href="<?= base_url("maka_and_madina_hotels/detail") . "/0/" . $program_detail->maka_hotel_id . "-" . str_replace(" ", "_", $program_detail->maka_name); ?>" target="_blank"><?= $program_detail->maka_name ;?> <?= " - مكة المكرمه - " . $program_detail->maka_nights . " ليالي"; ?> </a></li>
                            <li> <a href="<?= base_url("maka_and_madina_hotels/detail") . "/1/" . $program_detail->madina_hotel_id . "-" . str_replace(" ", "_", $program_detail->madina_name); ?>" target="_blank"><?= $program_detail->madina_name . " -   المدينة المنوره - "  . $program_detail->madina_nights . " ليالي"; ?> </a></li>
                         </ul>


                    </div>
                    <div class="clearfix"><br></div>
					<?php
						if (\count($ProgramAdvantage) > 0) {
							?>
							<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<label class="control-label" for="programs_features">المميزات:</label>
								<ul>

									<?php
									foreach ($ProgramAdvantage as $value) {
										?>
										<li class="pull-right col-xs-12 col-sm-6 col-md-4 col-lg-4 list-group-item padding-0-4">
											<label class="checkbox-inline nopadding">
												<img src="<?=base_url("theme/features_image/$value->image")?>" class="image-32 margin-4"> <?=$value->title_ar?>
											</label>
										</li>
										<?php
									}
									?>	</ul>
							</div>
					<div class="clearfix"><br></div><br><hr/>
							<?php
						}
					?>


					<?php
						if (\count($program_dates) > 0) {
							?>
							<div class="row margin-10-0 ">
								<div class="col-lg-12">
									<form action="<?= base_url("programs/booking") ?>"  method="post" id="booking_request_form">
										<div class="col-lg-8">
											<label class="col-md-4 line40">تاريخ الرحلة :</label>
											<div class="col-md-8">
												<select class="form-control" required="required"  id="flight_reservation_id" name="flight_reservation_id"  >
													<?php
													foreach ($program_dates as $program_date) {
														echo "<option value='$program_date->flight_reservation_id'>$program_date->going_date</option>";
													}
													?>
												</select>
											</div>
										</div>
										<div class="col-lg-2">
											<input  style="display: none" id="program_id" name="program_id" value="<?= $program_detail->id ?>"/>
											<input  style="display: none" id="program_id" name="program_id" value="<?= $program_detail->id ?>"/>
											<input  readonly="readonly" class="btn btn-warning right mr30" onclick="GetProgramFlightReservationPrices()" value="بحث"/>
										</div>
										<button type="submit"  class="btn btn-success right mr30" href="#tabs_book">احجز الان</button>
									</form>

								</div>
							</div>
						<?php } ?>
					<div id="search_dates_result">
						<?php
							if (\count($program_dates) > 0) {
								?>
								<div class="col-md-12">
									<h4>السعر حسب طبيعة الدور	</h4>
									<table class="table table-bordered table-hover">
										<thead class="alert-success">
											<tr>
												<!--<th>تاريخ الرحلة</th>-->
												<th>المتاح طيران  </th>

												<th>المتاح حسب طبيعة الدور </th>
												<th>السعر حسب طبيعة الدور </th>
												<th>  سعر الطفل  </th>
												<th> سعر الرضيع</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$value = $program_dates[0];
											$avaliable = $value->no_of_beds - $value->no_of_beds_reserved;

//												<td>$value->going_date</td>
											echo "<tr>
												<td>$value->flight_available</td>
												<td>$avaliable</td>
												<td>$value->price_for_bed</td>
												<td>$value->child_price</td>
												<td>$value->infant_price</td>
 											</tr>";
											?>

										</tbody>
									</table>
								</div>
								<?php
							}
						?>
						<?php
							if (\count($program_dates) > 0 && \count($ProgramRooms_prices) > 0) {
								?>
								<div class="col-md-12">
									<h4>سعر الفرد فى الغرفة</h4>
									<table class="table table-bordered table-hover">
										<thead class="alert-success">
											<tr>
												<!--<th>تاريخ الرحلة</th>-->
												<th>  نوع الغرفة</th>
												<th>  السعر    </th>
												<th>   المتاح</th>
											</tr>
										</thead>
										<tbody>
											<?php
											foreach ($ProgramRooms_prices as $value) {
												if ($value->going_date == $program_dates[0]->going_date) {
													$avaliable = $value->number_of_rooms - $value->number_of_rooms_reserved;
//															<td>$value->going_date</td>
													echo "<tr>
															<td>$value->title_ar</td>
															<td>$value->price</td>
															<td>$avaliable</td>
														</tr>";
												}
											}
											?>

										</tbody>
									</table>
								</div>
								<?php
							}
						?>
					</div>


				</div>


				<div id="sectiona" class="tab-pane fade in active">
					<div class="pro-dtl-text">
						<h3 class="main-widget-title">البرنامج يشتمل على :</h3> 
						<div>
							<?= $program_detail->program_include ?>
						</div>
						<h3 class="main-widget-title2"> البرنامج لا يشتمل على :</h3>
						<div>
							<?= $program_detail->program_not_include ?>
						</div>
					</div>
				</div>









			</div>
		</div>



		<!-- Sidebar
		============================================================== -->
		<?php $this->load->view("components/side_bar"); ?>


	</div></div>
<button data-toggle="modal" data-target="#sitelogincheak" style="display: none"  id="signup_check">signup_check</button>
<div class="modal slideDown" id="sitelogincheak" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<!--                        <h4 class="modal-title" id="myModalLabel">تسجيل الاعضاء</h4>-->
			</div>
			<div class="modal-body">
				<h1 class="text-center">برجاء تسجيل الدخول اولا</h1>
			</div>
		</div>
	</div>
</div>
