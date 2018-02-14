    var Hotel_extra_services_grid;

    var Hotel_extra_services = function () {

        var init = function () {
            $.extend(lang, new_lang);
            //console.log(lang);
            handleRecords();
            handleSubmit();

        };
        var handleRecords = function () {

            Hotel_extra_services_grid = $('.dataTable').dataTable({
                //"processing": true,
                "serverSide": true,
                "ajax": {
                    "url": config.admin_url + "/hotel_extra_services/data",
                    "type": "POST"
                },
                "columns": [
//                    {"data": "user_input", orderable: false, "class": "text-center"},
                    {"data": "title_ar"},
                    {"data": "title_en"},
                    {"data": "active"},
                    {"data": "room_or_person"},
                    {"data": "options", orderable: false, "class": "text-center"}
                ],
                "order": [
                    [1, "desc"]
                ]

            });
        }
        var handleSubmit = function () {

            $('#addEditHotelExtraServicesForm').validate({
                rules: {
                    title_ar: {
                        required: true

                    },
                    title_en: {
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
            $('.submit-form').click(function () {
                if ($('#addEditHotelExtraServicesForm').validate().form()) {
                    $('#addEditHotelExtraServicesForm').submit();
                }
                return false;
            });
            $('#about_us_form input').keypress(function (e) {
                if (e.which == 13) {
                    if ($('#addEditHotelExtraServicesForm').validate().form()) {
                        $('#addEditHotelExtraServicesForm').submit();
                    }
                    return false;
                }
            });



            $('#addEditHotelExtraServicesForm').submit(function () {
                var id = $('#id').val();
                var action = config.admin_url + '/hotel_extra_services/add';
                if (id != 0) {
                    action = config.admin_url + '/hotel_extra_services/edit';
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
                            Hotel_extra_services_grid.api().ajax.reload();

                            if (id != 0) {
                                $('#addEditHotelExtraServices').modal('hide');
                            } else {
                                Hotel_extra_services.empty();
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
                    url: config.admin_url + '/hotel_extra_services/row',
                    data: {id: $(t).attr("data-id")},
                    success: function (data)
                    {
                        console.log(data);

                        Hotel_extra_services.empty();
                        App.setModalTitle('#addEditHotelExtraServices', 'تعديل');

                        for (i in data.message)
                        {
                            $('#' + i).val(data.message[i]);
                        }
                        $('#addEditHotelExtraServices').modal('show');
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
                                    url: config.admin_url + '/hotel_extra_services/delete',
                                    data: {id: $(t).attr("data-id")},
                                    success: function (data)
                                    {
                                        $.alert(data.message);
                                        Hotel_extra_services_grid.api().ajax.reload();


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
                Hotel_extra_services.empty();
                App.setModalTitle('#addEditHotelExtraServices', 'اضافة');
                $('#addEditHotelExtraServices').modal('show');
            },
            empty: function () {
                $('#hotel_extra_service_id').val(0);
                $('#room_or_person').find('option').eq(0).prop('selected', true);
                $('#active').find('option').eq(0).prop('selected', true);
                $('.has-error').removeClass('has-error');
                $('.has-success').removeClass('has-success');
                $('.help-block').html('');
                App.emptyForm();
            },
        };

    }();
    jQuery(document).ready(function () {
        Hotel_extra_services.init();
    });

