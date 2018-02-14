 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="search"  >
                <div class="container-fluid">

                    <form class="form-inline mainsearch" method="GET" action="<?=  \base_url("programs/search")?>">
                        <fieldset>
                            <div class="row">
                                <!-- Select Basic -->
                                <div class="form-group col-md-3 ">
                                    <div class="row">
                                        <label class="col-md-3 control-label" for="selectbasic">الموسم</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="programs_seasons">

                                                <option value="0">الكل</option>
 													<?php
														foreach ($programs_seasons as $value) {
															echo "<option value='". $value->id ."'>$value->title_ar</option>";
														}
													?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-3 ">
                                    <div class="row">
                                        <label class="col-md-3 control-label" for="selectbasic">المستوى</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="programs_levels">

                                                <option value="0">الكل</option>
 													<?php
														foreach ($programs_levels as $value) {
															echo "<option value='". $value->id ."'>$value->title_ar</option>";
														}
													?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-3 ">
                                    <div class="row">
                                        <label class="col-md-4 control-label" for="selectbasic">السفر من </label>
                                        <div class="col-md-8">
                                            <select class="form-control" name="going_from_place">
                                                 <option value="0">الكل</option>
 													<?php
														foreach ($TravelFromCities as $value) {
															echo "<option value='". $value->id ."'>$value->title_ar</option>";
														}
													?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-2">
                                    <div class="row">
                                        <label class="col-md-3 control-label" for="selectbasic">التاريخ</label>
										<div class="col-md-9">
                                            <div class='input-group date'  id='datetimepicker1'>
                                                <input type='text' required="required" name="date" class="form-control" />
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                
                                 

                                <div class="form-group col-md-1">
                                    <button id="#"    type="submit" class="btn-search btn btn-primary pull-left">بـحـث</button>
                                 </div>


                            </div>




                        </fieldset>
                    </form>


                </div>
            </div>
        </div>