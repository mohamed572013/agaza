<?php
$type = $this->uri->segment(4);
?>
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
                        <li class="active"><a href="<?= \base_url('admin/reservation/show') ?>"><?= $lang['reservation']; ?></a></li>
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
                            <h3 class="panel-title"><?= $lang['reservation']; ?></h3>
                        </div>
                        <div class="panel-body">
                            <!--Table Wrapper Start-->
                            <div class="ls-editable-table table-responsive ls-table">
                                <table class="table table-bordered table-striped table-bottomless" id="ls-editable-table">
                                    <thead>
                                        <tr>
                                            <th><?= $lang['serial']; ?></th>
                                            <th> كود الاستمارة</th>
                                            <th> البرنامج </th>
                                            <th> الرحلة </th>
											<th><?= $lang['controll']; ?></th>

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
                                                     <td><?= $page->reservation_code; ?></td>
                                                     <td><?= $page->our_code."<br/>".$page->title_ar; ?></td>
                                                     <td><?= $page->going_date; ?></td>

                                                    <td class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                                        <a class="btn btn-xs btn-warning" title="عرض" target="_blank" href="<?= \base_url('programs/print_reservation') . '/' . $page->id; ?>"><i class="fa fa-print"></i> </a>
                                                        <a class="btn btn-xs btn-success" title="تسكين الفنادق للاستماره" target="_blank" href="<?= \base_url('admin/reservation_closed_rooms_living') . '/show/' . $page->id; ?>"><i class="fa fa-users"></i> </a>
 														<a class="btn btn-xs btn-danger" title="<?= $lang['delete']; ?>"   onclick="delete_action_masa('<?= $page->reservation_code ; ?>',<?= $page->id; ?>)"  ><i class="fa fa-trash-o"></i>  </a>

                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
							<div>
								<?php echo $links;?>
							</div>
                             
                            <!--Table Wrapper Finish-->
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


</section> 

<script type="text/javascript" src="assets/admin/ltr/js/lib/jquery-1.11.min.js"></script>

<style>
    .switchery,.switchery > small{
        height: 20px  !important;
    }
    .switchery{
        width: 30px  !important;
    }
    .switchery > small{
        width: 15px !important;
    }
</style>

<script>

    function delete_action_masa(title, id) {
        $.confirm({
            title: '<span style="color:#333">هل انت متاكد من انك تريد مسح   الاستمارة  '+ title +'   </span>',
            content: '<span style="color:#333">لديك 6 ثوانى للاختيار</span>',
            autoClose: 'cancel|6000',
            rtl: true,
            confirmButton: 'نعم متاكد',
            confirmButtonClass: 'btn-danger',
            cancelButton: 'الغاء',
            confirm: function () {
                delete_item_masa(title, id);
            }

        });
    }

    function delete_item_masa(title, id) {
        $('.amaran').remove();
        $.ajax({
            type: "post",
            url: "<?= base_url("admin/reservation/delete") ?>" + "/" + id,
            success: function (data) {
                if (data == "yes" || data == "	yes") {
                    $('#ls-editable-table').DataTable().row('#tr_' + id).remove().draw();
                    $.amaran({
                        content: {
                            message: '<b>تم الحذف</b>',
                            size: 'الاستمارة   #' + title,
                            file: '<b>تم حذف جميع البيانات المتعلقة بالعنصر</b>',
                            icon: 'glyphicon glyphicon-ok'
                        },
                        theme: 'default green',
                        position: 'top right',
                        inEffect: 'slideLeft',
                        outEffect: 'slideTop',
                        closeButton: true,
                        delay: 7000
                    });

                }  else if(data == "pemision_denied"){
                    $.amaran({
                        content: {
                            message: '<b> فشل فى  حذف الاستمارة</b>',
                            size: title,
                            file: '<b> غير مصرح لك بامكانية الحذف</b>',
                            icon: 'fa fa-times'
                        },
                        theme: 'default error',
                        position: 'top right',
                        inEffect: 'slideLeft',
                        outEffect: 'slideTop',
                        closeButton: true,
                        delay: 7000
                    });
                }  else {
                    $.amaran({
                        content: {
                            message: '<b> فشل فى  حذف الاستمارة</b>',
                            size: title,
                            file: '<b>لا يمكن حذف هذا العنصر لوجود عناصر متعلقة به</b>',
                            icon: 'fa fa-times'
                        },
                        theme: 'default error',
                        position: 'top right',
                        inEffect: 'slideLeft',
                        outEffect: 'slideTop',
                        closeButton: true,
                        delay: 7000
                    });
                }
            }

        });

    }
   
</script>