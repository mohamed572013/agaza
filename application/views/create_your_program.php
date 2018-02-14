<!-- Page Header
============================================================== -->
<div class="page-head" style="background-repeat: no-repeat;background-position: center top;background-image: url('<?= base_url("assets/front/images/page-title-bg.jpg"); ?>'); background-size: cover ">
	<div class="page-head-wrap">
        <h1 class="page-head-title"><span>صمم برنامجك</span></h1>
		<div class="page-head-subtitle">صمم برنامجك</div>
    </div>
</div>

<div class="container">
    <div class="row">
        <!-- News Wrap
        ============================================================== -->
		<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">

            <form action="" method="post" id="create_your_program">
                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label class="control-label">موسم العمره:</label>
                    <select id="program_season" name="program_season" class="form-control">
						<option value="الكل">الكل</option>
						<?php
							foreach ($programs_seasons as $value) {
								echo "<option value='" . $value->title_ar . "'>$value->title_ar</option>";
							}
						?>
                    </select>
                </div>
                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label class="control-label">  المستوى:</label>
					<select class="form-control" name="programs_levels">

						<option value="الكل">الكل</option>
						<?php
							foreach ($programs_levels as $value) {
								echo "<option value='" . $value->title_ar . "'>$value->title_ar</option>";
							}
						?>
					</select>
                </div>


                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label class="control-label">  تاريخ الرحلة:</label>
                    <div class='input-group date' id='datetimepicker2'>
                        <input type='text' class="form-control" name="program_date"/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
				<div class="clearfix"></div>
				<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label class="control-label sub-title-form">الفنادق  </label>
                </div>


                <div class="form-group col-lg-5 col-md-5 col-sm-6 col-xs-12">
                    <label class="control-label">فنادق مكة:</label>
                    <select id="program_mecca_hotel" name="program_mecca_hotel" class="form-control">
                        <option value="الكل">الكل</option>
						<?php
							foreach ($maka_hotels as $value) {
								echo "<option value='" . $value->title_ar . "'>$value->title_ar</option>";
							}
						?>
                    </select>
                </div>
                <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <label class="control-label">عدد الليالى:</label>
                    <input class="form-control input-md" name="program_nights_in_mecca" type="number">
                </div>
                <div class="form-group col-lg-5 col-md-5 col-sm-6 col-xs-12">
                    <label class="control-label">اضافه فندق مكة غير موجود بالقائمه:</label>
                    <input class="form-control input-md" name="makka_hotel_additional" type="text">
                </div>

                <div class="form-group col-lg-5 col-md-5 col-sm-6 col-xs-12">
                    <label class="control-label">فنادق المدينة:</label>
                    <select id="program_medina_hotel" name="program_medina_hotel" class="form-control">
						<option value="الكل">الكل</option>
						<?php
							foreach ($madina_hotels as $value) {
								echo "<option value='" . $value->title_ar . "'>$value->title_ar</option>";
							}
						?>
                    </select>
                </div>
                <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <label class="control-label">عدد الليالى:</label>
                    <input class="form-control input-md" name="program_nights_in_medina" type="number">
                </div>
                <div class="form-group col-lg-5 col-md-5 col-sm-6 col-xs-12">
                    <label class="control-label">اضافه فندق المدينة غير موجود بالقائمه:</label>
                    <input class="form-control input-md" name="medina_hotel_additional" type="text">
                </div>
                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label class="control-label sub-title-form">إتجاة الطيران</label>
                </div>
                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label class="control-label">من:</label>
                    <select id="program_go_direction_from" name="program_go_direction_from" class="form-control input-md">
						<option value="الكل">الكل</option>
						<?php
							foreach ($TravelFromCity as $value) {
								echo "<option value='" . $value->title_ar . "'>$value->title_ar</option>";
							}
						?>
                    </select>
                </div>
                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label class="control-label">الى:</label>
                    <select id="program_go_direction_to" name="program_go_direction_to" class="form-control input-md">
                        <option value="الكل">الكل</option>
						<?php
							foreach ($TravelToCity as $value) {
								echo "<option value='" . $value->title_ar . "'>$value->title_ar</option>";
							}
						?>
                    </select>
                </div>
                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label class="control-label sub-title-form">اتجاه العوده</label>
                </div>
                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label class="control-label">من:</label>
                    <select id="program_return_direction_from" name="program_return_direction_from" class="form-control input-md">
                        <option value="الكل">الكل</option>
						<?php
							foreach ($TravelReturnFromCity as $value) {
								echo "<option value='" . $value->title_ar . "'>$value->title_ar</option>";
							}
						?>
                    </select>
                </div>
                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label class="control-label">الى:</label>
                    <select id="program_return_direction_to" name="program_return_direction_to" class="form-control input-md">
						<option value="الكل">الكل</option>
						<?php
							foreach ($TravelReturnToCity as $value) {
								echo "<option value='" . $value->title_ar . "'>$value->title_ar</option>";
							}
						?>
                    </select>
                </div>

                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label class="control-label" for="programs_features">المميزات:</label>
                    <ul>
						<?php foreach ($programs_advantage as $value) {
								?>
								<li class="pull-right col-xs-12 col-sm-6 col-md-4 col-lg-4 list-group-item padding-0-4">
									<label class="checkbox-inline nopadding">
										<input class="margin-10-0 nomargin-bottom" type="checkbox" name="programs_features[]" id="programs_features" value="<?= $value->title_ar ?>">&nbsp;&nbsp;&nbsp;<img src="<?= \base_url("theme/features_image") . "/" . $value->image; ?>" class="image-32 margin-4"> <?= $value->title_ar ?>
									</label>
								</li>
							<?php }
						?>

                    </ul>
                </div>



                <div class="user_booking_data">
                    <div class="booking_list col-md-12 nopadding">
                        <br>
                        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
                            <label class="control-label col-md-12 nopadding" >نوع الغرفه</label><br>
                            <select name="hotel_rooms[]" class="form-control">
								<?php
									foreach ($hotel_rooms as $value) {
										echo "<option value='" . $value->title_ar . "'>$value->title_ar</option>";
									}
								?>
                            </select>
                        </div>

                        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
                            <label class="control-label col-md-12 nopadding" >عدد الغرف</label><br>
                            <input class="form-control input-sm" name="room_count[]" type="number" min="0" value="0">
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
                            <label class="control-label col-md-12 nopadding" >عدد الافراد بالغين</label><br>
                            <input class="form-control input-sm" name="room_count_adult[]" type="number" min="1" value="1">
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
                            <label class="control-label col-md-12 nopadding" >عدد الافراد طفل</label><br>
                            <input class="form-control input-sm" name="room_count_kid[]"  type="number" min="0" value="0">
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
                            <label class="control-label col-md-12 nopadding" >عدد الافراد  رضيع</label><br>
                            <input class="form-control input-sm" name="room_count_infant[]"  type="number" min="0" value="0">
                        </div>
                     </div>

                    <div class="inline-table w100pr clearfix padding-0-10  margin-0-8">
                        <br>
                        <button class="btn btn_default btn-sm btn-primary add_more_prices" type="button">  اضافة المزيد </button>
                    </div>
                </div>


                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label class="control-label">التفاصيل:</label>
                    <textarea class="form-control" name="program_details" type="text"></textarea>
                </div>

                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label class="control-label">الاسم بالكامل:</label>
                    <input class="form-control" name="full_name" type="text" required="required"></input>
                </div>
                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <label class="control-label">بريدك الالكترونى:</label>
                    <input class="form-control" name="email" type="email" required="required"></input>
                </div>
                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <label class="control-label">هاتفك:</label>
                    <input class="form-control" name="phone" type="text" required="required"></input>
                </div>
				
				<div class="clearfix"></div>
				<br>
                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="g-recaptcha" data-sitekey="6LdxfAgUAAAAAEUxVfJnUVohw_RMT634xhAAbLDR"></div>

				</div>
				<div class="clearfix">
				</div>
					
				<br>
				<div id="create_your_program_error"></div>
				<div class="clearfix"></div>

                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label class="control-label"></label>
					<div class="col-lg-4">
						
						<button class="btn btn-primary btn-lg btn-block " type="submit">ارسال الطلب</button>
					</div>
					<div class="col-lg-4  pull-left">
					 
						<button class="btn btn-warning btn-lg   btn-block " id="reset_all" type="reset">تفريغ الحقول  </button>
						
					</div>
					<!--<input type="reset" id="configreset" value="Reset">-->
                </div>
            </form>
        </div>
		
		
<div class="hidden booking_list_hide" style="display: none"> 
    <div class="booking_list col-md-12 nopadding">
		<br>
		<div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
			<label class="control-label col-md-12 nopadding" >نوع الغرفه</label><br>
			<select name="hotel_rooms[]" class="form-control">
				<?php
					foreach ($hotel_rooms as $value) {
						echo "<option value='" . $value->title_ar . "'>$value->title_ar</option>";
					}
				?>
			</select>
		</div>

		<div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
			<label class="control-label col-md-12 nopadding" >عدد الغرف</label><br>
			<input class="form-control input-sm" name="room_count[]" type="number" min="0" value="0">
		</div>
		<div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
			<label class="control-label col-md-12 nopadding" >عدد الافراد بالغين</label><br>
			<input class="form-control input-sm" name="room_count_adult[]" type="number" min="1" value="1">
		</div>
		<div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
			<label class="control-label col-md-12 nopadding" >عدد الافراد طفل</label><br>
			<input class="form-control input-sm" name="room_count_kid[]"  type="number" min="0" value="0">
		</div>
		<div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
			<label class="control-label col-md-12 nopadding" >عدد الافراد  رضيع</label><br>
			<input class="form-control input-sm" name="room_count_infant[]"  type="number" min="0" value="0">
		</div>
		 <div class="col-lg-1 col-md-1 col-sm-2 col-xs-12 margin-10-0 padding-4-0">
            <button class="btn btn_default btn-sm btn-primary margin-10-0 remove_this_prices" type="button"> X </button>
        </div>
     </div>
</div>





		<!-- Sidebar
		============================================================== -->
		<?php $this->load->view("components/side_bar"); ?>


	</div></div> 

<script src='https://www.google.com/recaptcha/api.js'></script>
