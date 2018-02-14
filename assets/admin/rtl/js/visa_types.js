    var Visa_types_grid;

    var Visa_types = function () {

        var init = function () {
            //alert('heree');
            $.extend(lang, new_lang);
            //console.log(lang);
            handleRecords();
            handleSubmit();

        };
        var handleRecords = function () {

            Visa_types_grid = $('.dataTable').dataTable({
                //"processing": true,
                "serverSide": true,
                "ajax": {
                    "url": config.admin_url + "/visa_types/data",
                    "type": "POST"
                },
                "columns": [
//                    {"data": "user_input", orderable: false, "class": "text-center"},
                    {"data": "title_ar"},
                    {"data": "active"},
                    {"data": "options", orderable: false, "class": "text-center"}
                ],
                "order": [
                    [1, "desc"]
                ]

            });
        }
        var handleSubmit = function () {

            $('#addEditVisaTypesForm').validate({
                rules: {
                    title_ar: {
                        required: true

                    },
                    room_or_person: {
                        required: true
                    }
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
            $('#addEditVisaTypes .submit-form').click(function () {
                if ($('#addEditVisaTypesForm').validate().form()) {
                    $('#addEditVisaTypesForm').submit();
                }
                return false;
            });
            $('#addEditVisaTypesForm input').keypress(function (e) {
                if (e.which == 13) {
                    if ($('#addEditVisaTypesForm').validate().form()) {
                        $('#addEditVisaTypesForm').submit();
                    }
                    return false;
                }
            });



            $('#addEditVisaTypesForm').submit(function () {
                var id = $('#id').val();
                var action = config.admin_url + '/visa_types/add';
                if (id != 0) {
                    action = config.admin_url + '/visa_types/edit';
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
                            Visa_types_grid.api().ajax.reload();

                            if (id != 0) {
                                $('#addEditVisaTypes').modal('hide');
                            } else {
                                Visa_types.empty();
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
                    url: config.admin_url + '/visa_types/row',
                    data: {id: $(t).attr("data-id")},
                    success: function (data)
                    {
                        console.log(data);

                        Visa_types.empty();
                        App.setModalTitle('#addEditVisaTypes', 'تعديل');

                        for (i in data.message)
                        {


                            $('#' + i).val(data.message[i]);
                        }
                        $('#addEditVisaTypes').modal('show');
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
                                    url: config.admin_url + '/visa_types/delete',
                                    data: {id: $(t).attr("data-id")},
                                    success: function (data)
                                    {
                                        $.alert(data.message);
                                        Visa_types_grid.api().ajax.reload();


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
                Visa_types.empty();
                App.setModalTitle('#addEditVisaTypes', 'اضافة');
                $('#addEditVisaTypes').modal('show');
            },
            empty: function () {
                $('#id').val(0);
                $('#active').find('option').eq(0).prop('selected', true);
                $('.has-error').removeClass('has-error');
                $('.has-success').removeClass('has-success');
                $('.help-block').html('');
                App.emptyForm();
            },
        };

    }();
    jQuery(document).ready(function () {
        Visa_types.init();
    });

