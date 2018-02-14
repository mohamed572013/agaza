
    var Settings = function () {

        var init = function () {
            $.extend(lang, new_lang)
            handleSubmit();
        };

        var handleSubmit = function () {

            $('#settings_form').validate({
                rules: {
                    site_title_ar: {
                        required: true

                    },
                    site_title_en: {
                        required: true

                    },
                    site_phone: {
                        required: true

                    },
                    site_email: {
                        required: true

                    },
                    address_ar: {
                        required: true

                    },
                    address_en: {
                        required: true

                    },
                    site_desc_ar: {
                        required: true

                    },
                    site_desc_en: {
                        required: true

                    },
                    keywords_ar: {
                        required: true

                    },
                    keywords_en: {
                        required: true

                    },
                    site_close_message_ar: {
                        required: true

                    },
                    site_close_message_en: {
                        required: true

                    },
                },
                messages: lang.messages,
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
                if ($('#settings_form').validate().form()) {
                    $('#settings_form').submit();
                }
                return false;
            });
            $('#settings_form input').keypress(function (e) {
                if (e.which == 13) {
                    if ($('#settings_form').validate().form()) {
                        $('#settings_form').submit();
                    }
                    return false;
                }
            });



            $('#settings_form').submit(function () {
                var formData = new FormData($(this)[0]);
                action = config.base_url + '/admin/settings/edit';

                $.ajax({
                    url: action,
                    data: formData,
                    async: false,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {


                        if (data.type == 'success')
                        {
                            //console.log(data);
                            for (x in data.message)
                            {
                                if (x == 'site_contacts') {
                                    var site_contacts_json = data.message[x];
                                    var site_contacts = JSON.parse(site_contacts_json);
                                    //console.log(site_contacts);
                                    for (i in site_contacts)
                                    {
                                        $('#' + i).val(site_contacts[i]);

                                    }
                                } else {
                                    $('#' + x).val(data.message[x]);
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

        return {
            init: function () {
                init();
            }
        };

    }();
    jQuery(document).ready(function () {
        Settings.init();
    });
