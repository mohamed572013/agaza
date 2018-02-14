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
                        <li class="active"><a href="<?= \base_url('admin/home_slider/show') ?>">Home slider</a></li>
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
                            <h3 class="panel-title"><?= $lang['add'] . " Home slider" ; ?></h3>
                        </div>
                        <div class="panel-body">
							<?php if (!empty($error)) { ?>
									<div class="alert alert-danger">
										<?= $error; ?>
									</div>
								<?php } ?>
                            <!--Table Wrapper Start-->
                            <form  enctype="multipart/form-data" action="<?= \base_url('admin/home_slider') . $action; ?>" method="post" class="form-horizontal ls_form form-horizontal ls_form bv-form">


								<?php
									$active[0] = "  غير مفعل";
									$active[1] = "مفعل";
									if (!isset($edit->active)) {
										$active_val = 1;
									} else {
										$active_val = $edit->active;
									}
								?>
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['state']; ?></label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
										<?php echo form_dropdown('active', $active, $active_val, 'class="form-control"') ?>
                                    </div>
                                </div>


 



                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['order']; ?></label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <input type="number" class="form-control" id="this_order" name="this_order" value="<?php if (isset($edit->this_order)) echo $edit->this_order;else if (isset($_POST['this_order'])) echo xss_clean($_POST['this_order']); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">Image Link</label>
                                    <div class="col-xs-12 col-sm-8 col-md-10 col-lg-10">
                                        <input type="text" class="form-control" id="url" name="url" value="<?php if (isset($edit->url)) echo $edit->url;else if (isset($_POST['url'])) echo xss_clean($_POST['url']); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['title_ar']; ?></label>
                                    <div class="col-xs-12 col-sm-8 col-md-10 col-lg-10">
                                        <input type="text" class="form-control" id="title_ar" name="title_ar" value="<?php if (isset($edit->title_ar)) echo $edit->title_ar;else if (isset($_POST['title_ar'])) echo xss_clean($_POST['title_ar']); ?>"  required="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['desc_ar']; ?></label>
                                    <div class="col-xs-12 col-sm-8 col-md-10 col-lg-10">
                                        <input type="text" class="form-control" id="desc_ar" name="desc_ar" value="<?php if (isset($edit->desc_ar)) echo $edit->desc_ar;else if (isset($_POST['desc_ar'])) echo xss_clean($_POST['desc_ar']); ?>" required="required">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">السعر يبدا من</label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <input type="number" class="form-control" id="start_from_price" name="start_from_price" value="<?php if (isset($edit->start_from_price)) echo $edit->start_from_price;else if (isset($_POST['start_from_price'])) echo xss_clean($_POST['start_from_price']); ?>">
                                    </div>
                                </div>

								<?php if (isset($edit->image)) {
										?>
										<div class="form-group">

											<label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['image']; ?></label>
											<div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">

												<img src="<?php echo base_url('uploads/home_slider/' . $edit->image); ?>" width="200" height="100" />
											</div>						
										</div>

									<?php }
								?>
                                <div class="form-group">

                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['image']; ?>  : gif | jpeg | jpg | png</label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <input type="file" class="form-control" id="image" name="image"  >
                                    </div>
                                </div> 







                                <div class="form-group text-center">
                                    <button class="btn btn-sm btn-success" type="submit"><?= $lang['save_data']; ?></button>
                                </div>

                                <!--Table Wrapper Finish-->
                        </div>
                        </form>


                    </div>
					<div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?= $lang['add'] . " " . $lang['multi_upload']; ?></h3>
                        </div>

						<br>
						<form  enctype="multipart/form-data" action="<?= \base_url('admin/home_slider/do_upload_images'); ?>" method="post" class="form-horizontal ls_form form-horizontal ls_form bv-form">
							 
							<div class="form-group">

								<label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['image']; ?>  : gif | jpeg | jpg | png</label>
								<div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
									<input type="file" name="images[]" multiple="multiple" class="form-control" id="image"   >
								</div>
							</div> 
							<div class="form-group text-center">
								<button class="btn btn-sm btn-success" type="submit"><?= $lang['save_data']; ?></button>
							</div>
						</form>
                    </div>

                </div>
            </div>
            <!-- Main Content Element  End-->

        </div>
    </div>



</section>
