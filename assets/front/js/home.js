
    var Home = function () {


        var init = function () {

            hanldeSubscribe();
        }
        var hanldeSubscribe = function () {
            $('#subscribeForm').validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                    }
                },
                messages: {
                    email: {
                        required: 'ادخل البريد الإلكترونى',
                        email: 'البريد الإلكترونى غير صحيح'
                    }
                },
                highlight: function (element) {
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
            $('#subscribeForm .submit-form').click(function () {
                if ($('#subscribeForm').validate().form()) {
                    $('#subscribeForm').submit();
                }
                return false;
            });
            $('#subscribeForm input').keypress(function (e) {
                if (e.which == 13) {
                    if ($('#subscribeForm').validate().form()) {
                        $('#subscribeForm').submit();
                    }
                    return false;
                }
            });



            $('#subscribeForm').submit(function () {
                var id = $('#id').val();
                var action = config.base_url + '/home/subscribe';
                var formData = new FormData($(this)[0]);


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
                            $('.alert_custom').css({
                                'background-color': '#00a2ff'
                            });
                            $('#alert_message').html('تم اشتراكك معنا');
                            $('.alert_custom').fadeIn(500).delay(2000).fadeOut(500);

                        } else {
                            console.log(data)
                            if (typeof data.errors === 'object') {
                                for (i in data.errors)
                                {
                                    $('[name="' + i + '"]')
                                            .closest('.form-group').addClass('has-error').removeClass("has-info");
                                    $('#' + i).parent().find(".help-block").html(data.errors[i])
                                }
                            } else {
                                $('.alert_custom').css({
                                    'background-color': '#c04848'
                                });
                                $('#alert_message').html('لقد تم اشتراكك من قبل');
                                $('.alert_custom').fadeIn(500).delay(2000).fadeOut(500);
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
        var getObjectLength = function (obj) {
            var count = 0;
            var i;

            for (i in obj) {
                if (obj.hasOwnProperty(i)) {
                    count++;
                }
            }
            return count;
        }


        return {
            init: function () {
                init();
            }
        }

    }();

    jQuery(document).ready(function () {
        Home.init();
    });


