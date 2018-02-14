<!--Page main section start-->
<!-- Modal -->
<div class="modal fade" id="addEditHotelsAdvantages" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="addEditHotelsAdvantagesLabel"></h4>
            </div>

            <div class="modal-body">


                <form role="form" class="form-horizontal" id="addEditHotelsAdvantagesForm" name="user-form" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id" value="0">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 control-label text-capitalize">الخاصية</label>
                            <div class="col-xs-12 col-sm-8">
                                <input type="text" class="form-control" id="title_ar" name="title_ar">
                                <div class="help-block"></div>
                            </div>

                        </div>
                    
                    </div>

                   

                </form>

            </div>

            <div class="modal-footer">
                <span class="margin-right-10 loading hide"><i class="fa fa-spin fa-spinner"></i></span>
                <button type="button" class="btn btn-info submit-form"
                        >حفظ</button>
                <button type="button" class="btn btn-white"
                        data-dismiss="modal"><?= _lang("close") ?></button>
            </div>
        </div>
    </div>
</div>
<section id="min-wrapper">
    <div id="main-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">

                    <!--Top breadcrumb start -->
                    <ol class="breadcrumb">
                        <li> <i class="fa fa-home"></i> </li>
                        <li> <?= _lang('restaurants'); ?></li>
                        <li class="active"><a href="<?= base_url('admin/restaurants_advantage'); ?>"><?= _lang('restaurants_advantage'); ?></a></li>
                    </ol>
                    <!--Top breadcrumb start -->
                </div>
            </div>


            <br>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?= _lang('restaurants_advantage'); ?></h3>
                        </div>
                        <div class="panel-body">
                            <!--Table Wrapper Start-->
                            <a class="btn btn-sm btn-info pull-left" style="margin-bottom: 40px;" href="" onclick="Restaurants_advantages.add(); return false;"><?= $lang['add_new']; ?> </a>
                            <div class="ls-editable-table table-responsive ls-table">
                                <table class="table table-bordered table-striped table-bottomless dataTable">
                                    <thead>
                                        <tr>
                                            <th><?= _lang('title_ar') ?></th>
                                            
                                            <th>خيارات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
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
<script>
        var new_lang = {
            'edit_user': 'تعديل مستخدم',
            messages: {
                title_ar: {
                    required: "ادخل العنوان بالعربية"
                },
              
            }
        };
</script>
<?php
    global $_require;
    $_require['js'] = array('restaurants_advantages.js');
?>
