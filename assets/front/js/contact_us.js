
    var Contact_us = function () {

        var init = function () {
            //alert('here');
            handleSubmit();
        };

        var handleSubmit = function () {

            $('#contact_us_form').validate({
                rules: {
                    firstname: {
                        required: true

                    },
                    lastname: {
                        required: true

                    },
                    email: {
                        required: true,
                        email: true
                    },
                    mobile: {
                        required: true,
                        number: true
                    },
                    message: {
                        required: true

                    }
                },
                messages: {
                    firstname: {
                        required: 'ادخل الأسم الأول'

                    },
                    lastname: {
                        required: 'ادخل الأسم الأخير'

                    },
                    email: {
                        required: 'ادخل البريد الإلكترونى',
                        email: 'البريد الإلكترونى غير صحيح'
                    },
                    mobile: {
                        required: 'ادخل رقم الموبايل',
                        number: 'رقم الموبايل يجب ان يحتوى على أرقام فقط'
                    },
                    message: {
                        required: 'ادخل الرسالة'

                    }
                },
                highlight: function (element) { // hightlight error inputs #8fea93
                    $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
                    $(element).css({
                        'border-color': '#843534',
                        '-webkit-box-shadow': 'inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 6px #ce8483',
                        'box-shadow': 'inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 6px #ce8483'
                    });

                },
                unhighlight: function (element) {
                    $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
                    $(element).closest('.form-group').find('.help-block').html('');
                    $(element).css({
                        'border-color': '#2b542c',
                        '-webkit-box-shadow': 'inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 6px #67b168',
                        'box-shadow': 'inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 6px #67b168'
                    });
                },
                errorPlacement: function (error, element) {
                    $(element).closest('.form-group').find('.help-block').html($(error).html());
                }
            });
            $('.submit-form').click(function () {
                if ($('#contact_us_form').validate().form()) {
                    $('#contact_us_form').submit();
                }
                return false;
            });
            $('#about_us_form input').keypress(function (e) {
                if (e.which == 13) {
                    if ($('#contact_us_form').validate().form()) {
                        $('#contact_us_form').submit();
                    }
                    return false;
                }
            });



            $('#contact_us_form').submit(function () {
                var formData = new FormData($(this)[0]);
                action = config.base_url + 'contact_us/send';

                $.ajax({
                    url: action,
                    data: formData,
                    async: false,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        $('.loading_image_div').html('<img style="height: 50px; position: absolute; top: -77px; left: 80%; margin-left: -64px;" src="' + config.url + '3.gif"/>');
                        $('.loading_image_div').show();
                        $('.submit-form').val('جارى الأرسال');
                    },
                    success: function (data) {
                        console.log(data);

                        if (data.type == 'success')
                        {
                            //$('.loading_image_div').html('<img src="' + config.base_url + 'uploads/loader.gif"/>');
                            // $('.loading_image_div').show();
                            setTimeout(function () {
                                // $('.alert-message').html('تم الأرســـال  بنجــاح');
                                $('.loading_image_div').hide();
                                $('.submit-form').val('تم الأرسال');
                                //$('.alert-message').fadeIn(400);


                            }, 5000);

                        } else {
                            console.log(data)

                            for (i in data.errors)
                            {
                                $('[name="' + i + '"]')
                                        .css({
                                            'border-color': '#843534',
                                            '-webkit-box-shadow': 'inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 6px #ce8483',
                                            'box-shadow': 'inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 6px #ce8483'
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

        return {
            init: function () {
                init();
            }
        };

    }();
    jQuery(document).ready(function () {
        Contact_us.init();
    });
