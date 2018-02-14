<!--Page main section start-->
<section id="min-wrapper">
	<div id="main-content">
		<div class="container-fluid">

			<div class="row">
				<div class="col-md-12">

					<!--Top breadcrumb start -->
					<ol class="breadcrumb">
						<li> <i class="fa fa-home"></i> </li>
						<li> <?php echo $lang['basic_data']; ?></li>
						<li class="active"><a href="<?= \base_url('admin/pages/show') ?>"><?= $lang['pages']; ?></a></li>
					</ol>
					<!--Top breadcrumb start -->
				</div>
			</div>

			<a class="btn btn-sm btn-info pull-right" href="<?= \base_url("admin/pages/add") ?>"><?= $lang['add_new']; ?> </a>
			<br>
			<br>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title"><?= $lang['pages']; ?></h3>
						</div>
						<div class="panel-body">
							<!--Table Wrapper Start-->
							<div class="ls-editable-table table-responsive ls-table">
								<table class="table table-bordered table-striped table-bottomless" id="ls-editable-table">
									<thead>
										<tr>
											<th><?= $lang['serial']; ?></th>
											<th><?= $lang['name']; ?></th>
											<th>Controller</th>
 											<th></th>
										</tr>
									</thead>
									<tbody>
										<?php
											$i = 0;
											if (count($page_list) > 0) {
												foreach ($page_list as $page_key => $page) {
													$i++;
													$page_id = $page->id;
													?>
													<tr id="tr_<?= $page->id; ?>">
														<td><?= $i; ?></td>
														<td><?= $lang["$page->name"]; ?></td>
														<td><?= $page->controller; ?></td>
 
														<td class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
															<a class="btn btn-xs btn-warning" title="<?= $lang['edit']; ?>" href="<?= \base_url('admin/pages/edit') . '/' . $page->id; ?>"><i class="fa fa-pencil-square-o"></i> </a>

														</td>
													</tr>
													<?php
												}
											}
										?>
									</tbody>
								</table>
							</div>
							 
							<!--Table Wrapper Finish-->
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>


</section> 
