    var Visa_create_grid;
    var errors = {};
    var success = false;
    var Visa_create = function () {

        var init = function () {
            //alert('heree');
            $.extend(lang, new_lang);
            //console.log(lang);
            handleRecords();
            handleSubmit();
            check(['visa_types', 'visa_jobs', 'visa_documents', 'visa_periods']);
        };
        var check = function (inputs_names) {

            for (var x = 0; x < inputs_names.length; x++) {
                test(inputs_names[x]);
            }
        }
        var checkBeforSubmit = function (inputs_names) {
            for (var x = 0; x < inputs_names.length; x++) {

                test2(inputs_names[x]);

            }
        }
        var test = function (name) {
            $("input[id^='" + name + "_']").on('change', function () {
                var count = 0;
                $("input[id^='" + name + "_']").each(function () {
                    if ($(this).is(':checked')) {
                        count++;
                    }
                });
                if (count == 0) {
                    errors[name] = 'يجب اختيار قيمة واحدة على الأقل';
                } else {
                    delete errors[name];
                    $('#' + name).find('.help-block').html('');
                }
                if (!$.isEmptyObject(errors)) {
                    for (var i in errors) {
                        $('#' + i).find('.help-block').html(errors[i]);
                    }
                    success = false;
                    return;
                }
                success = true;
            });
        }
        var test2 = function (name) {

            var count = 0;
            $("input[id^='" + name + "_']").each(function () {
                if ($(this).is(':checked')) {
                    count++;
                }
            });
            if (count == 0) {
                errors[name] = 'يجب اختيار قيمة واحدة على الأقل';
            } else {
                delete errors[name];
                $('#' + name).find('.help-block').html('');
            }
            if (!$.isEmptyObject(errors)) {
                for (var i in errors) {
                    $('#' + i).find('.help-block').html(errors[i]);
                }
                success = false;
                return;
            }
            success = true;

        }
        var handleRecords = function () {

            Visa_create_grid = $('.dataTable').dataTable({
                //"processing": true,
                "serverSide": true,
                "ajax": {
                    "url": config.admin_url + "/visa_create/data",
                    "type": "POST"
                },
                "columns": [
//                    {"data": "user_input", orderable: false, "class": "text-center"},
                    {"data": "country_title_ar"},
                    {"data": "type_title_ar"},
                    {"data": "job_title_ar"},
                    {"data": "period"},
                    {"data": "visa_created_at"},
                    {"data": "visa_active"},
                    {"data": "options", orderable: false, "class": "text-center"}
                ],
                "order": [
                    [4, "desc"]
                ]

            });
        }
        var handleSubmit = function () {

            $('#addEditVisaCreateForm').validate({
                rules: {
                    places_id: {
                        required: true

                    },
                    price: {
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
            $('#addEditVisaCreate .submit-form').click(function () {
                checkBeforSubmit(['visa_types', 'visa_jobs', 'visa_documents', 'visa_periods']);
                if ($('#addEditVisaCreateForm').validate().form()) {
                    if (success) {
                        $('#addEditVisaCreateForm').submit();
                    }


                }
                return false;
            });
            $('#addEditVisaCreateForm input').keypress(function (e) {
                if (e.which == 13) {
                    checkBeforSubmit(['visa_types', 'visa_jobs', 'visa_documents', 'visa_periods']);
                    if ($('#addEditVisaCreateForm').validate().form()) {
                        if (success) {
                            $('#addEditVisaCreateForm').submit();
                        }
                    }
                    return false;
                }
            });



            $('#addEditVisaCreateForm').submit(function () {
                var code = $('#code').val();
                var action = config.admin_url + '/visa_create/add';
                if (code != 0) {
                    action = config.admin_url + '/visa_create/edit';
                }
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
                            toastr.options = {
                                "debug": false,
                                "positionClass": "toast-bottom-left",
                                "onclick": null,
                                "fadeIn": 300,
                                "fadeOut": 1000,
                                "timeOut": 5000,
                                "extendedTimeOut": 1000
                            };
                            toastr.success(data.message, 'رسالة');
                            Visa_create_grid.api().ajax.reload();

                            if (code != 0) {
                                $('#addEditVisaCreate').modal('hide');
                            } else {
                                Visa_create.empty();
                            }

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
            },
            edit: function (t) {



                App.editForm({
                    element: t,
                    url: config.admin_url + '/visa_create/row',
                    data: {
                        code: $(t).attr("data-code"),
                        places_id: $(t).attr("data-places-id"),
                    },
                    success: function (data)
                    {
                        console.log(data);

                        Visa_create.empty();
                        App.setModalTitle('#addEditVisaCreate', 'تعديل');

                        for (i in data.data)
                        {
                            if (i == 'places_id') {
                                $('#' + i).val(data.data[i]);
                            } else if (i == 'code') {
                                $('#' + i).val(data.data[i]);
                            } else if (i == 'price') {
                                $('#' + i).val(data.data[i]);
                            } else if (i == 'active') {
                                $('#' + i).val(data.data[i]);
                            } else {
                                for (var x = 0; x < data.data[i].length; x++) {
                                    $("input[id^='" + i + "_']").each(function () {
                                        if ($(this).val() == data.data[i][x]) {
                                            $(this).prop('checked', true)
                                        }
                                    });
                                }
                            }

                        }
                        $('#addEditVisaCreate').modal('show');
                    }
                });

            },
            delete: function (t) {
                $.confirm({
                    title: lang.alert_message,
                    content: lang.confirm_message_title,
                    buttons: {
                        confirm: {
                            text: lang.yes,
                            action: function () {
                                App.deleteForm({
                                    element: t,
                                    url: config.admin_url + '/visa_create/delete',
                                    data: {code: $(t).attr("data-code")},
                                    success: function (data)
                                    {
                                        $.alert(data.message);
                                        Visa_create_grid.api().ajax.reload();


                                    }
                                });

                            }
                        },
                        cancel: {
                            text: lang.no,
                            action: function () {
                                $.alert(lang.deleting_cancelled);
                            }
                        }
                    }
                });
            },
            add: function () {
                Visa_create.empty();
                App.setModalTitle('#addEditVisaCreate', 'اضافة');
                $('#addEditVisaCreate').modal('show');
            },
            empty: function () {
                $('#id').val(0);
                $('#active').find('option').eq(0).prop('selected', true);
                $('#passport_status').find('option').eq(0).prop('selected', true);
                $('.has-error').removeClass('has-error');
                $('.has-success').removeClass('has-success');
                $('.help-block').html('');
                $("input[id^='visa_types_']").each(function () {
                    $(this).prop('checked', false);
                });
                $("input[id^='visa_jobs_']").each(function () {
                    $(this).prop('checked', false);
                });
                $("input[id^='visa_documents_']").each(function () {
                    $(this).prop('checked', false);
                });
                $("input[id^='visa_periods_']").each(function () {
                    $(this).prop('checked', false);
                });
                App.emptyForm();
            },
        };

    }();
    jQuery(document).ready(function () {
        Visa_create.init();
    });

