<div class="modal fade" id="addEditUsers" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="addEditUsersLabel"></h4>
            </div>

            <div class="modal-body">


                <form role="form" class="form-horizontal" id="addEditUsersForm"  enctype="multipart/form-data" method="post">
                    <input type="hidden" name="user_id" id="user_id" value=""/>
                    <div class="form-group">

                        <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label text-capitalize"><?= _lang('images'); ?></label>
                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                            <input type="file" class="form-control" id="program_images" name="program_images[]"  multiple>
                            <div class="help-block"></div>
                        </div>
                    </div>



                </form>
                <div id="program-images-box">

                </div>
                <div class="clearfix"></div>
                <ul class="list-group" id="files-not-uploaded">

                </ul>
            </div>

            <div class="modal-footer">
                <span class="margin-right-10 loading hide"><i class="fa fa-spin fa-spinner"></i></span>
                <button type="button" class="btn btn-info submit-form"
                        data-dismiss="modal">خفظ</button>
                <button type="button" class="btn btn-white"
                        data-dismiss="modal"><?= _lang("close") ?></button>
            </div>
        </div>
    </div>
</div>
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
                        <li class="active"><a href="<?= \base_url('admin/users/show') ?>"><?= $lang['users']; ?></a></li>
                    </ol>
                    <!--Top breadcrumb start -->
                </div>
            </div>

            <a class="btn btn-sm btn-info pull-right" href="<?= \base_url('admin/users/add') ?>"><?= $lang['add']; ?> <?= $lang['user']; ?></a>
            <br>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?= $lang['users']; ?></h3>
                        </div>
                        <div class="panel-body">
                            <!--Table Wrapper Start-->
                            <div class="ls-editable-table table-responsive ls-table">
                                <table class="table table-bordered table-striped table-bottomless" id="ls-editable-table">
                                    <thead>
                                        <tr>
                                            <th><?= $lang['user_name']; ?></th>
                                            <th><?= _lang('company'); ?></th>
                                            <th><?= $lang['controll']; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($user_list as $user_key => $user) { ?>
                                                <tr>
                                                    <td><?= $user->user_name; ?><br><span class="text-info"><?= $user->group_name; ?></span></td>
                                                    <td><?= $user->admin_or_reservarion == 0 ? "Adminstration" : "Reservation"; ?> </td>
                                                    <td class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                                        <a class="btn btn-xs btn-warning" title="<?= $lang['edit']; ?>" href="<?= \base_url('admin/users/edit') . '/' . $user->user_id; ?>"><i class="fa fa-pencil-square-o"></i> </a>
                                                        <!--<a class="btn btn-xs btn-danger" title="<?= $lang['delete']; ?>" href="<?= \base_url('admin/users/delete') . '/' . $user->user_id; ?>"><i class="fa fa-minus"></i></a>-->
                                                    </td>
                                                </tr>
                                            <?php } ?>
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