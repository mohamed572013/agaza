<!--Page main page start-->
<section id="min-wrapper">
	<div id="main-content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<!--Top header start-->
					<!--Top header end -->

					<!--Top breadcrumb start -->
					<ol class="breadcrumb">
						<li> <i class="fa fa-home"></i> </li>
						<li> <?php echo $lang['basic_data']; ?></li>
						<li class="active"><a href="<?= \base_url('admin/flight_reservation/show') ?>"><?= $lang['flight_reservation']; ?></a></li>
					</ol>
					<!--Top breadcrumb start -->
				</div>
			</div>

			<?php
				$action = "/add";
				if ($view_type != 'add') {
					if (isset($_id)) {
						$action = "/edit/$_id";
					}
				}
			?>

			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title"><?= $lang['add'] . " " . $lang['flight_reservation']; ?></h3>
						</div>
						<div class="panel-body">
							<?php if (!empty($error)) { ?>
									<div class="alert alert-danger">
										<?= $error; ?>
									</div>
								<?php } ?>
							<!--Table Wrapper Start-->
							<form action="<?= \base_url('admin/flight_reservation') . $action; ?>" method="post" id="flight_form" class="form-horizontal ls_form form-horizontal ls_form bv-form">


								<?php
									$active[0] = "  غير مفعل";
									$active[1] = "مفعل";
									if (!isset($edit->active)) {
										$active_val = 1;
									} else {
										$active_val = $edit->active;
									}
								?>


								<div class="control-group col-lg-4" >
									<label class="control-label"><?= $lang['state']; ?></label>
									<?php echo form_dropdown('active', $active, $active_val, 'class="form-control"') ?>
								</div>

								<div class="control-group col-lg-4" >
									<label class="control-label">   <?= $lang['flight_company_name']; ?>  </label>

									<input type="text" class="form-control" required="required" id="flight_company_name" name="flight_company_name" value="<?php
										if (isset($_POST['flight_company_name']))
											echo xss_clean($_POST['flight_company_name']);
										else if (isset($edit->flight_company_name))
											echo $edit->flight_company_name;
									?>">
								</div>
								
								
								<div class="control-group col-lg-4" >
									<label class="control-label">      وسيلة السفر    </label>
									<select class="form-control  " id="travel_way_id" name="travel_way_id"  required="required">
										<option value="">اختر</option>
										<?php
											foreach ($travel_way as $value) {
												if (isset($edit->travel_way_id) && $edit->travel_way_id == $value->id) {
													$selected = "selected";
												} else {
													$selected = " ";
												}
												if (isset($_POST) && $_POST['travel_way_id'] == $value->id) {
													$selected = "selected";
												}
												?>
												<option value="<?= $value->id ?>"  <?= $selected; ?>><?= $value->title_ar; ?></option>
											<?php } ?>
									</select>
								</div>
								
								<div class="control-group col-lg-4" >
									<label class="control-label">    الذهاب من مدينة  </label>
									<select class="form-control  " id="going_from_place" name="going_from_place"  required="required">
										<option value="">اختر</option>
										<?php
											foreach ($places as $value) {
												if (isset($edit->going_from_place) && $edit->going_from_place == $value->id) {
													$selected = "selected";
												} else {
													$selected = " ";
												}
												if (isset($_POST) && $_POST['going_from_place'] == $value->id) {
													$selected = "selected";
												}
												?>
												<option value="<?= $value->id ?>"  <?= $selected; ?>><?= $value->title_ar; ?></option>
											<?php } ?>
									</select>
								</div>
								
								
								
								<div class="control-group col-lg-4" >
									<label class="control-label">    الذهاب  الى  مدينة  </label>
									<select class="form-control  " id="going_to_place" name="going_to_place"  required="required">
										<option value="">اختر</option>
										<?php
											foreach ($places as $value) {
												if (isset($edit->going_to_place) && $edit->going_to_place == $value->id) {
													$selected = "selected";
												} else {
													$selected = " ";
												}
												if (isset($_POST) && $_POST['going_to_place'] == $value->id) {
													$selected = "selected";
												}
												?>
												<option value="<?= $value->id ?>"  <?= $selected; ?>><?= $value->title_ar; ?></option>
											<?php } ?>
									</select>
								</div>
								<div class="control-group col-lg-4" >
									<label class="control-label">  تاريخ الذهاب </label>

									<input type="date" class="form-control" required="required" id="going_date" name="going_date" value="<?php
										if (isset($_POST['going_date']))
											echo xss_clean($_POST['going_date']);
										else if (isset($edit->going_date))
											echo $edit->going_date;
									?>">
								</div>
								<div class="control-group col-lg-4" >
									<label class="control-label">    العوده  من مدينة  </label>
									<select class="form-control  " id="return_from_place" name="return_from_place"  required="required">
										<option value="">اختر</option>
										<?php
											foreach ($places as $value) {
												if (isset($edit->return_from_place) && $edit->return_from_place == $value->id) {
													$selected = "selected";
												} else {
													$selected = " ";
												}
												if (isset($_POST) && $_POST['return_from_place'] == $value->id) {
													$selected = "selected";
												}
												?>
												<option value="<?= $value->id ?>"  <?= $selected; ?>><?= $value->title_ar; ?></option>
											<?php } ?>
									</select>
								</div>
								<div class="control-group col-lg-4" >
									<label class="control-label">    العوده  الى  مدينة  </label>
									<select class="form-control  " id="return_to_place" name="return_to_place"  required="required">
										<option value="">اختر</option>
										<?php
											foreach ($places as $value) {
												if (isset($edit->return_to_place) && $edit->return_to_place == $value->id) {
													$selected = "selected";
												} else {
													$selected = " ";
												}
												if (isset($_POST) && $_POST['return_to_place'] == $value->id) {
													$selected = "selected";
												}
												?>
												<option value="<?= $value->id ?>"  <?= $selected; ?>><?= $value->title_ar; ?></option>
											<?php } ?>
									</select>
								</div>
								<div class="control-group col-lg-4" >
									<label class="control-label">  تاريخ العوده </label>

									<input type="date" class="form-control" required="required" id="return_date" name="return_date" value="<?php
										if (isset($_POST['return_date']))
											echo xss_clean($_POST['return_date']);
										else if (isset($edit->return_date))
											echo $edit->return_date;
									?>">
								</div>
								<div class="control-group col-lg-4" >
									<label class="control-label">   عدد  المسافرين  </label>

									<input type="number" min="1" class="form-control" required="required" id="passenger_num" name="passenger_num" value="<?php
										if (isset($_POST['passenger_num']))
											echo xss_clean($_POST['passenger_num']);
										else if (isset($edit->passenger_num))
											echo $edit->passenger_num;
									?>">
								</div>
								<div class="control-group col-lg-4" >
									<label class="control-label">   سعر التذكرة     </label>

									<input type="number" min="1" class="form-control" required="required" id="price" name="price" value="<?php
										if (isset($_POST['price']))
											echo xss_clean($_POST['price']);
										else if (isset($edit->price))
											echo $edit->price;
									?>">
								</div>
								<div class="control-group col-lg-4" >
									<label class="control-label">     ملحوظه      </label>

									<input type="text"   class="form-control"  id="note" name="note" value="<?php
										if (isset($_POST['note']))
											echo xss_clean($_POST['note']);
										else if (isset($edit->note))
											echo $edit->note;
									?>">
								</div>
								<div class="clearfix"></div>
								<hr>





								<div class="form-group text-center">
									<button class="btn btn-sm btn-success" type="submit"><?= $lang['save_data']; ?></button>
								</div>

								<!--Table Wrapper Finish-->
						</div>
						</form>
					</div>
				</div>
			</div>
			<!-- Main Content Element  End-->

		</div>
	</div>



</section>


<script type="text/javascript" src="assets/admin/ltr/js/lib/jquery-1.11.min.js"></script>

<script type="text/javascript" language="javascript">
		$(document).ready(function () {

			$("#flight_form").submit(function () {
				var going_from_place = $("#going_from_place").val();
				var going_to_place = $("#going_to_place").val();
				var return_from_place = $("#return_from_place").val();
				var return_to_place = $("#return_to_place").val();

				var going_date = $("#going_date").val();
				var return_date = $("#return_date").val();
				var today = "<?php echo \date("Y-m-d"); ?>";

				if (going_from_place == going_to_place || return_from_place == return_to_place || going_from_place == return_from_place || going_to_place == return_to_place) {
					$('.amaran').remove();
					$.amaran({
						content: {
							message: '<b>  من فضلك تاكد من ان خطوط السير صحيحة</b>',
							size: '    ',
							file: ' ',
							icon: 'fa fa-times'
						},
						theme: 'default error ',
						position: 'top right',
						inEffect: 'slideLeft',
						outEffect: 'slideTop',
						closeButton: true,
						delay: 7000
					});
					return false;

				} else if (going_date < today) {
					$('.amaran').remove();
					$.amaran({
						content: {
							message: '<b>  لابد ان يكون تاريخ    الذهاب اكبر من او يساوى    تاريخ اليوم  </b>',
							size: '    ',
							file: ' ',
							icon: 'fa fa-times'
						},
						theme: 'default error ',
						position: 'top right',
						inEffect: 'slideLeft',
						outEffect: 'slideTop',
						closeButton: true,
						delay: 7000
					});
					return false;

				} else if (going_date >= return_date) {
					$('.amaran').remove();
					$.amaran({
						content: {
							message: '<b>  لابد ان يكون تاريخ    الذهاب اقل من تاريخ العودة </b>',
							size: '    ',
							file: ' ',
							icon: 'fa fa-times'
						},
						theme: 'default error ',
						position: 'top right',
						inEffect: 'slideLeft',
						outEffect: 'slideTop',
						closeButton: true,
						delay: 7000
					});

					return false;
				} else {


					return true;
				}



			});

		});
</script>
