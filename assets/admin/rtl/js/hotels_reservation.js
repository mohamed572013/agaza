    var Hotels_reservation_grid;
    var Hotels_reservation = function () {

        var init = function () {
            //alert('here');
            handleRecords();
            handleSubmit();
        };

        var handleSubmit = function () {

            $('#about_us_form').validate({
                rules: {
                    title_ar: {
                        required: true

                    },
                    desc_ar: {
                        required: true

                    }
                },
                //messages: lang.messages,
                highlight: function (element) { // hightlight error inputs
                    $(element).closest('.form-group').removeClass('has-success').addClass('has-error');

                },
                unhighlight: function (element) {
                    $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
                    $(element).closest('.form-group').find('.help-block').html('');

                },
                errorPlacement: function (error, element) {
                    $(element).closest('.form-group').find('.help-block').html($(error).html());
                }
            });
            $('.submit-form').click(function () {
                if ($('#about_us_form').validate().form()) {
                    $('#about_us_form').submit();
                }
                return false;
            });
            $('#about_us_form input').keypress(function (e) {
                if (e.which == 13) {
                    if ($('#about_us_form').validate().form()) {
                        $('#about_us_form').submit();
                    }
                    return false;
                }
            });



            $('#about_us_form').submit(function () {
                var formData = new FormData($(this)[0]);
                action = config.base_url + '/admin/about_us/edit';

                $.ajax({
                    url: action,
                    data: formData,
                    async: false,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        console.log(data);

                        if (data.type == 'success')
                        {
                            for (x in data.message)
                            {
                                if (x == 'desc_ar' || x == 'title_ar') {
                                    $('#' + x).val(data.message[x]);
                                }
                                if (x == 'image') {
                                    $('.about_us_image').attr('src', config.base_url + 'uploads/about_us/' + data.message[x]);
                                }
                            }
                            toastr.options = {
                                "debug": false,
                                "positionClass": "toast-bottom-left",
                                "onclick": null,
                                "fadeIn": 300,
                                "fadeOut": 1000,
                                "timeOut": 5000,
                                "extendedTimeOut": 1000
                            };
                            toastr.success('تم التعديل بنجاح', 'رسالة');

                        } else {
                            console.log(data)
                            if (typeof data.errors === 'object') {
                                for (i in data.errors)
                                {
                                    $('[name="' + i + '"]')
                                            .closest('.form-group').addClass('has-error').removeClass("has-info");
                                    $('#' + i).parent().find(".help-block").html(data.errors[i])
                                }
                            }
                            if (typeof data.message !== 'undefined') {
                                $.confirm({
                                    title: lang.error,
                                    content: data.message,
                                    type: 'red',
                                    typeAnimated: true,
                                    buttons: {
                                        tryAgain: {
                                            text: lang.try_again,
                                            btnClass: 'btn-red',
                                            action: function () {
                                            }
                                        }
                                    }
                                });
                            }
                        }
                    },
                    error: function (xhr, textStatus, errorThrown) {
                        $('.loading').addClass('hide');
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
                    dataType: "json",
                    type: "POST"
                });

                return false;

            })




        }
        var handleRecords = function () {
            //alert('d');
            Hotels_reservation_grid = $('.dataTable').dataTable({
                //"processing": true,
                "serverSide": true,
                "ajax": {
                    "url": config.admin_url + "/hotels_reservation/data",
                    "type": "POST"
                },
                "columns": [
//                    {"data": "user_input", orderable: false, "class": "text-center"},
                    {"data": "serial"},
                    // {"data": "reservation_id"},
                    //{"data": "our_code"},
                    {"data": "hotel_title_ar"},
                    {"data": "child_company_ar"},
                    {"data": "arrive_date"},
                    {"data": "departing_date"},
                    {"data": "options", orderable: false, "class": "text-center"}
                ],
                "order": [
                    [1, "desc"]
                ]

            });
        }
        var print_div = function (html)
        {
            var mywindow = window.open('', 'طباعة الإستمارة', 'height=600,width=800');
            mywindow.document.body.innerHTML = html;

        }

        return {
            init: function () {
                init();
            },
            print_reservation: function (ele) {
                var action = config.admin_url + '/hotels_reservation/print_reservation';
                $.ajax({
                    url: action,
                    data: {
                        reservation_id: $(ele).data('id'),
                    },
                    async: false,
                    success: function (data) {
                        print_div(data);
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
                    dataType: "text",
                    type: "POST"
                });
                return false;
            }
        };

    }();
    jQuery(document).ready(function () {
        Hotels_reservation.init();
    });
