<?php
    $reservation_id = $this->uri->segment(4);
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
                        <li class="active"><a href="<?= \base_url('admin/reservation_closed_rooms_living/show') ?>"><?= $lang['reservation_closed_rooms_living']; ?></a></li>
                    </ol>
                    <!--Top breadcrumb start -->
                </div>
            </div>

            <br>
            <br>
            <div class="clearfix"> </div>
            <br/>
            <?php if (\count($RoomLiving) > 0) { ?>
                    <div class="row">

                        <div class="col-lg-12">
                            <table class="table table-bordered  "  id="table2">
                                <thead>
                                    <tr>
                                        <th>م</th>
                                        <th>نوع الغرفة</th>
                                        <th>عدد الاسرة   </th>
                                        <th style="padding: 0  !important ;">
                                            <table class="table  " style="margin: 0 !important ;">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 60%">  الاسم      </th>
                                                        <th style="width: 20%">النوع    </th>
                                                        <th style="width: 20%"> تاريخ الميلاد       </th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </th>
                                        <th id="delete_0" style="width: 10%">حذف التسكين   </th>
                                        <th id="delete_0" style="width: 10%">حذف الغرفة   </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $index = 0;

                                    foreach ($RoomLiving as $room_value) {
                                        $index++;
                                        ?>
                                        <tr id="tr_"<?= $room_value->operation_number; ?>>
                                            <td><?php echo $index; ?></td>
                                            <td><?php echo $room_value->title_ar; ?></td>
                                            <td><?php echo $room_value->no_of_bed; ?></td>
                                            <td style="padding: 0  !important ;">
                                                <?php
                                                foreach ($RoomLivingTravellers as $value) {
                                                    if ($value->operation_number == $room_value->operation_number) {
                                                        if ($value->gender == 0) {
                                                            $gender = "ذكر";
                                                        } else {
                                                            $gender = "انثى";
                                                        }
                                                        ?>
                                                        <table class="table  table-bordered "  style="margin: 0 !important ;">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="width: 60%"><?php echo $value->name; ?></td>
                                                                    <td style="width: 20%"><?php echo $gender; ?></td>
                                                                    <td style="width: 20%"><?php echo $value->birthdate; ?></td>

                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </td>
                                            <td id="delete_<?php echo $index; ?>">
                                                <button  class="btn btn-xs ls-brown-btn" title="حذف التسكين" onclick="delete_action_masa('<?= $room_value->title_ar; ?>', '<?= $room_value->operation_number; ?>')"  ><i class="fa fa-trash-o"></i></button>
                                            </td>

                                            <td id="delete_<?php echo $index; ?>">
                                                <button  class="btn btn-xs btn-danger" title="حذف الغرفة" onclick="delete_action_masa_room('<?= $room_value->title_ar; ?>', '<?= $room_value->operation_number; ?>')"  ><i class="fa fa-trash-o"></i></button>
                                            </td>
                                        </tr>

                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br>
                    <div class="clearfix"> </div>
                    <br/>
                <?php } ?>


            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?= $lang['reservation_closed_rooms_living']; ?>   للاستماره رقم  <?= $this->uri->segment(4) ?></h3>
                        </div>
                        <div class="panel-body">

                            <hr/>
                            <div class="col-lg-12">
                                <div class="col-lg-6" style="width:50%!important;">
                                    <select class="form-control" required="required" id="hotel_rooms_id" name="hotel_rooms_id">
                                        <option value=""> -- اختر الغرفة -- </option>
                                        <?php
                                            if (count($traveller_rooms_not_living) > 0) {
                                                foreach ($traveller_rooms_not_living as $value) {
                                                    ?>
                                                    <option value='<?= $value->hotel_rooms_id ?>' > نوع الغرفة  : <?= $value->title_ar . " "; ?>عدد الاسرة    :  <?= $value->no_of_bed; ?> </option>
                                                    <?php
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <input class="btn btn-primary" id="assign" value="تسكين" onclick="save_living();" readonly="readonly" />
                                    <input  id="reservation_id" value="<?= $reservation_id; ?>" style="display: none"/>
                                </div>

                            </div>
                            <div class="clearfix"></div>
                            <hr/>

                            <div class="col-lg-12">
                                <table class="table table-bordered table-striped table-bottomless">
                                    <thead>
                                        <tr>
                                            <th>م</th>
                                            <th>اختر</th>
                                            <th>الاسم</th>
                                            <th>النوع</th>
                                            <th>تاريخ الميلاد</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $i = 0;
                                            if (\count($traveller_not_living) > 0) {
                                                foreach ($traveller_not_living as $value) {
                                                    $i++;
                                                    if ($value->gender == 0) {
                                                        $gender = "ذكر";
                                                    } else {
                                                        $gender = "انثى";
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td><?= $i; ?></td>
                                                        <td>
                                                            <input class="icheck-blue select_travellers" style="height: 20px;width: 20px" name="traveller_id[]" type="checkbox"  value="<?= $value->id; ?>" >

                                                        </td>
                                                        <td><?= $value->name; ?></td>
                                                        <td><?= $gender; ?></td>
                                                        <td><?= $value->birthdate; ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
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
                                            function save_living() {

                                                var reservation_id = $("#reservation_id").val();
                                                var hotel_rooms_id = $("#hotel_rooms_id").val();
                                                if (hotel_rooms_id == "") {
                                                    $('.amaran').remove();
                                                    $.amaran({
                                                        content: {
                                                            message: '<b>فشل فى التسكين</b>',
                                                            size: '   من فضلك قم باختيار الغرفه اولا ',
                                                            file: ' ',
                                                            icon: 'fa fa-times'
                                                        },
                                                        theme: 'default error',
                                                        position: 'top right',
                                                        inEffect: 'slideLeft',
                                                        outEffect: 'slideTop',
                                                        closeButton: true,
                                                        delay: 7000
                                                    });
                                                } else {
                                                    var allTravellersVals = '';
                                                    $('.select_travellers').each(function () {
                                                        if ($(this).is(':checked')) {
                                                            allTravellersVals = allTravellersVals + $(this).val() + ',';
                                                        }
                                                    });
                                                    allTravellersVals = allTravellersVals.slice(0, -1);
                                                    console.log(allTravellersVals);

                                                    if (allTravellersVals == '') {
                                                        $('.amaran').remove();
                                                        $.amaran({
                                                            content: {
                                                                message: '<b>فشل فى التسكين</b>',
                                                                size: '   من فضلك قم باختيار المسافرين اولا ',
                                                                file: ' ',
                                                                icon: 'fa fa-times'
                                                            },
                                                            theme: 'default error',
                                                            position: 'top right',
                                                            inEffect: 'slideLeft',
                                                            outEffect: 'slideTop',
                                                            closeButton: true,
                                                            delay: 7000
                                                        });
                                                    } else {
                                                        $.ajax({
                                                            type: "post",
                                                            url: "<?= base_url("admin/reservation_closed_rooms_living/reservation_room_living") ?>",
                                                            data: {
                                                                reservation_id: reservation_id,
                                                                hotel_rooms_id: hotel_rooms_id,
                                                                allTravellersVals: allTravellersVals

                                                            },
                                                            success: function (data) {
                                                                console.log(data)
                                                                if (data == "1") {
                                                                    $.amaran({
                                                                        content: {
                                                                            message: '<b>تمت عملية التسكين بنجاح  </b>',
                                                                            size: ' ',
                                                                            file: '<b>   </b>',
                                                                            icon: 'glyphicon glyphicon-ok'
                                                                        },
                                                                        theme: 'default green',
                                                                        position: 'top right',
                                                                        inEffect: 'slideLeft',
                                                                        outEffect: 'slideTop',
                                                                        closeButton: true,
                                                                        delay: 7000
                                                                    });
                                                                    setTimeout(function () {
                                                                        window.location.reload();
                                                                    }, 4000);
                                                                } else {
                                                                    $('.amaran').remove();
                                                                    $.amaran({
                                                                        content: {
                                                                            message: '<b>فشل فى التسكين</b>',
                                                                            size: ' <b>' + data + '</b> ',
                                                                            file: ' ',
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

                                                            },
                                                            error: function (xhr, textStatus, errorThrown) {

                                                                bootbox.dialog({
                                                                    message: xhr.responseText,
                                                                    title: 'رسالة تنبيه',
                                                                    buttons: {
                                                                        danger: {
                                                                            label: lang.close,
                                                                            className: "red"
                                                                        }
                                                                    }
                                                                });
                                                            }
                                                        });
                                                    }


                                                }
                                            }


</script>


<script>

        function delete_action_masa(title, id) {
            $.confirm({
                title: '<span style="color:#333">هل انت متاكد من انك تريد مسح تسكين هذه الغرفة  </span>',
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
                url: "<?= base_url("admin/reservation_closed_rooms_living/DeleteLiving") ?>" + "/" + id,
                success: function (data) {
                    if (data == "yes" || data == "	yes") {
                        $('#tr_' + id).remove();
                        $.amaran({
                            content: {
                                message: '<b>تم الحذف</b>',
                                size: 'الغرفة   #' + title,
                                file: '<b>تم حذف        </b>',
                                icon: 'glyphicon glyphicon-ok'
                            },
                            theme: 'default green',
                            position: 'top right',
                            inEffect: 'slideLeft',
                            outEffect: 'slideTop',
                            closeButton: true,
                            delay: 7000
                        });

                        setTimeout(function () {
                            window.location.reload();
                        }, 4000);

                    } else if (data == "pemision_denied") {
                        $.amaran({
                            content: {
                                message: '<b> فشل فى  حذف الغرفة</b>',
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
                    } else {
                        $.amaran({
                            content: {
                                message: '<b> فشل فى  حذف الحجرة</b>',
                                size: title,
                                file: '<b>لا يمكن حذف هذا الغرفة لوجود عناصر متعلقة به</b>',
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

<script>

        function delete_action_masa_room(title, id) {
            $.confirm({
                title: '<span style="color:#333">هل انت متاكد من انك تريد مسح   هذه الغرفة  </span>',
                content: '<span style="color:#333">لديك 6 ثوانى للاختيار</span>',
                autoClose: 'cancel|6000',
                rtl: true,
                confirmButton: 'نعم متاكد',
                confirmButtonClass: 'btn-danger',
                cancelButton: 'الغاء',
                confirm: function () {
                    delete_item_masa_room(title, id);
                }

            });
        }

        function delete_item_masa_room(title, id) {
            $('.amaran').remove();
            $.ajax({
                type: "post",
                url: "<?= base_url("admin/reservation_closed_rooms_living/DeleteRoom") ?>" + "/" + id,
                success: function (data) {
                    console.log(data)
                    if (data == "yes" || data == "	yes") {
                        $('#tr_' + id).remove();
                        $.amaran({
                            content: {
                                message: '<b>تم الحذف</b>',
                                size: 'الغرفة   #' + title,
                                file: '<b>تم حذف        </b>',
                                icon: 'glyphicon glyphicon-ok'
                            },
                            theme: 'default green',
                            position: 'top right',
                            inEffect: 'slideLeft',
                            outEffect: 'slideTop',
                            closeButton: true,
                            delay: 7000
                        });

                        setTimeout(function () {
                            window.location.reload();
                        }, 3000);

                    } else if (data == "pemision_denied") {
                        $.amaran({
                            content: {
                                message: '<b> فشل فى  حذف الغرفة</b>',
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
                    } else {
                        $.amaran({
                            content: {
                                message: '<b> فشل فى  حذف الحجرة</b>',
                                size: title,
                                file: '<b>لا يمكن حذف هذا الغرفة لوجود عناصر متعلقة به</b>',
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