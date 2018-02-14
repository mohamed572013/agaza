
    var Advertismnent = function () {

        var init = function () {
            $.extend(lang, new_lang)
            handleSubmit();
        };

        var handleSubmit = function () {

            $('#advertismnent_form').validate({
                rules: {
                    title_ar: {
                        required: true

                    },
                    title_en: {
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
                if ($('#advertismnent_form').validate().form()) {
                    $('#advertismnent_form').submit();
                }
                return false;
            });
            $('#advertismnent_form input').keypress(function (e) {
                if (e.which == 13) {
                    if ($('#advertismnent_form').validate().form()) {
                        $('#advertismnent_form').submit();
                    }
                    return false;
                }
            });



            $('#advertismnent_form').submit(function () {
                var formData = new FormData($(this)[0]);
                action = config.base_url + '/admin/advertismnent/edit';

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
                                    $('.advertismnent_image').attr('src', config.base_url + 'uploads/advertismnent/' + data.message[x]);
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
        Advertismnent.init();
    });
