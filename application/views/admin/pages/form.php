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
						<li class="active"><a href="<?= \base_url('admin/pages/show') ?>"><?= $lang['pages']; ?></a></li>
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
							<h3 class="panel-title"><?= $lang['add'] . " " . $lang['pages']; ?></h3>
						</div>
						<div class="panel-body">
							<?php if (!empty($error)) { ?>
									<div class="alert alert-danger">
										<?= $error; ?>
									</div>
								<?php } ?>
							<!--Table Wrapper Start-->
							<form action="<?= \base_url('admin/pages') . $action; ?>" method="post" class="form-horizontal ls_form form-horizontal ls_form bv-form">




								<div class="form-group">
 										<label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"> Choose main menu</label>
									<div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
										<select class="form-control"   name="parent_id"   >
											<option value="0">Choose main menu</option>
											<?php
												if (\count($main_menu) > 0) {
													$selected = "";
													foreach ($main_menu as $value) {
														if ( isset($edit->parent_id)&& $edit->parent_id== $value->id) {
															$selected = "selected";
														} else {
															$selected = "";
														}
														echo "<option value='" . $value->id . "' $selected  >".$lang[$value->name]."    </option>";
													}
												}
											?>
										</select>									</div>
								</div>

								<div class="form-group">
									<label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"> order</label>
									<div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
										<input type="number" min="0" class="form-control" id="this_order" name="this_order" value="<?php if (isset($edit->this_order)) echo $edit->this_order;else if (isset($_POST['this_order'])) echo xss_clean($_POST['this_order']); ?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['name']; ?></label>
									<div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
										<input type="text" class="form-control" id="name" name="name" value="<?php if (isset($edit->name)) echo $edit->name;else if (isset($_POST['name'])) echo xss_clean($_POST['name']); ?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">controller</label>
									<div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
										<input type="text" class="form-control" id="controller" name="controller" value="<?php if (isset($edit->controller)) echo $edit->controller;else if (isset($_POST['controller'])) echo xss_clean($_POST['controller']); ?>">
									</div>
								</div> 




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
