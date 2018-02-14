

    var Login = function () {

        var init = function () {
            //alert('here');
            handle_login();


        }
        var handle_login = function () {
            $("#login-form").validate({
                rules: {
                    email: {
                        required: true
                    },
                    password: {
                        required: true
                    }
                },
                messages: {
                    email: {
                        required: 'أدخل البريد الإلكترونى'
                    },
                    password: {
                        required: 'أدخل كلمة السر'
                    }
                },
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
                if ($('#login-form').validate().form()) {
                    $('#login-form').submit();
                }
                return false;
            });
            $('#login-form').submit(function () {
                $.ajax({
                    url: config.base_url + "login/check",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        email: $('#email').val(),
                        password: $('#password').val(),
                        ajax: true
                    },
                    success: function (data)
                    {
                        console.log(data);
                        if (data.type == 'success') {

                            //window.location.href = config.base_url;
                            window.history.go(-1);
                        } else {

                            if (data.message != undefined) {
                                $('#alert-message').html(data.message).fadeIn(400).delay(4000).fadeOut(1000);
                            } else {
                                for (i in data.errors)
                                {
                                    if (i != '') {
                                        $('[name="' + i + '"]')
                                                .closest('.form-group').addClass('has-error').removeClass("has-info");
                                        $('#' + i).parent().find(".help-block").html(data.errors[i]);
                                    }
                                }
                            }
                        }


                    },
                    error: function (xhr, textStatus, errorThrown) {
                        //$('.loading').addClass('hide');
                        bootbox.dialog({
                            message: xhr.responseText,
                            title: 'sssss',
                            buttons: {
                                danger: {
                                    label: 'esss',
                                    className: "red"
                                }
                            }
                        });
                    },
                });

                return false;
            });

        }

        return {
            init: function () {
                init();
            }
        }

    }();

    jQuery(document).ready(function () {
        Login.init();
    });


