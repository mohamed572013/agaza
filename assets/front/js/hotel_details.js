    $(document).ready(function () {
        //alert('here');


        $('.booking-btn').on('click', function () {
            var url = $(this).attr('href');
            var action = config.base_url + '/home/checkLoginForAjax';
            $.ajax({
                url: action,
                async: false,
                success: function (data) {
                    console.log(data);
                    //return false;
                    if (data.type == 'success') {


                        window.location.href = url;
                    } else {
                        bootbox.dialog({
                            message: '<p class="alert-danger text-right">' + data.message + '</p><br><a href="' + config.base_url + 'login" class="btn btn-info">  ! سجل الأن<a>',
                            title: '<h4 class="text-right">رسالة تنبيه</h4>',
                            buttons: {
                                danger: {
                                    label: 'اغلاق',
                                    className: "red"
                                }
                            }
                        });
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    bootbox.dialog({
                        message: xhr.responseText,
                        title: 'رسالة تنبيه',
                        buttons: {
                            danger: {
                                label: 'اغلاق',
                                className: "red"
                            }
                        }
                    });
                },
                dataType: "JSON",
                type: "POST"
            });
            return false;
        });
    });    /*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */


