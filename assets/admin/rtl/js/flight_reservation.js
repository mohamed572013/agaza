
    var Program_type;
    var Programs_grid;
    var Flight_reservation_grid;
    var programTypeFormData;
    var Flight_reservation = function () {

        var init = function () {
            $.extend(lang, new_lang);
            handleRecords();
            handleSubmit();
            handleDetermineProgramType();
            //handleWhichProgramTypeSectionIsRequired();
        };
        var handleWhichFlightTypeSectionIsRequired = function (type) {
            if (type == 2) {
                $('#collective-box-period').slideUp(500, function () {
                    $('#individual-box-period').slideDown(500);
                });
                $("#flight_company_name").rules("remove", "required");
                $("#travel_way_id").rules("remove", "required");
                $("#passenger_num").rules("remove", "required");
                $("#going_date").rules("remove", "required");
                $("#return_date").rules("remove", "required");
                $("#individual_going_from_place").rules("add", {
                    required: true,
                    messages: {
                        required: 'هذا الحقل مطلوب',
                    }
                });
                $("#individual_going_to_place").rules("add", {
                    required: true,
                    messages: {
                        required: 'هذا الحقل مطلوب',
                    }
                });

            } else {
                $('#individual-box-period').slideUp(500, function () {
                    $('#collective-box-period').slideDown(500);
                });
                $("#individual_going_from_place").rules("remove", "required");
                $("#individual_going_to_place").rules("remove", "required");
                $("#flight_company_name").rules("add", {
                    required: true,
                    messages: {
                        required: 'هذا الحقل مطلوب',
                    }
                });
                $("#travel_way_id").rules("add", {
                    required: true,
                    messages: {
                        required: 'هذا الحقل مطلوب',
                    }
                });
                $("#passenger_num").rules("add", {
                    required: true,
                    messages: {
                        required: 'هذا الحقل مطلوب',
                    }
                });
                $("#going_date").rules("add", {
                    required: true,
                    messages: {
                        required: 'هذا الحقل مطلوب',
                    }
                });
                $("#return_date").rules("add", {
                    required: true,
                    messages: {
                        required: 'هذا الحقل مطلوب',
                    }
                });
            }
        }
        var handleDetermineProgramType = function () {
            $('input[name="flight_type"]').on('change', function () {
                //Flight_reservation.empty();
                var program_type = $(this).data('type');
                if (program_type == 'individual') {
                    $('#collective-box-period').slideUp(500, function () {
                        $('#individual-box-period').slideDown(500);
                    });
                    $("#flight_company_name").rules("remove", "required");
                    $("#travel_way_id").rules("remove", "required");
                    $("#passenger_num").rules("remove", "required");
                    $("#going_date").rules("remove", "required");
                    $("#return_date").rules("remove", "required");
                    $("#individual_going_from_place").rules("add", {
                        required: true,
                        messages: {
                            required: 'هذا الحقل مطلوب',
                        }
                    });
                    $("#individual_going_to_place").rules("add", {
                        required: true,
                        messages: {
                            required: 'هذا الحقل مطلوب',
                        }
                    });

                } else {
                    $('#individual-box-period').slideUp(500, function () {
                        $('#collective-box-period').slideDown(500);
                    });
                    $("#individual_going_from_place").rules("remove", "required");
                    $("#individual_going_to_place").rules("remove", "required");
                    $("#flight_company_name").rules("add", {
                        required: true,
                        messages: {
                            required: 'هذا الحقل مطلوب',
                        }
                    });
                    $("#travel_way_id").rules("add", {
                        required: true,
                        messages: {
                            required: 'هذا الحقل مطلوب',
                        }
                    });
                    $("#passenger_num").rules("add", {
                        required: true,
                        messages: {
                            required: 'هذا الحقل مطلوب',
                        }
                    });
                    $("#going_date").rules("add", {
                        required: true,
                        messages: {
                            required: 'هذا الحقل مطلوب',
                        }
                    });
                    $("#return_date").rules("add", {
                        required: true,
                        messages: {
                            required: 'هذا الحقل مطلوب',
                        }
                    });
                }

            });

        }

        var handleRecords = function () {
            Flight_reservation_grid = $('.dataTable').dataTable({
                //"processing": true,
                "serverSide": true,
                "ajax": {
                    "url": config.admin_url + "/flight_reservation/data",
                    "type": "POST"
                },
                "columns": [
//                    {"data": "user_input", orderable: false, "class": "text-center"},
                    {"data": "going_date"},
                    {"data": "return_date"},
                    {"data": "flight_type"},
                    {"data": "options", orderable: false, "class": "text-center"}
                ],
                "order": [
                    [1, "desc"]
                ]

            });
        }
        var handleSubmit = function () {
            $('#addEditflightReservationForm').validate({
                rules: {
                },
                messages: lang.collective_messages,
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
            $('#addEditflightReservation .submit-form').click(function () {
                //alert('here');
                //return false;
                if ($('#addEditflightReservationForm').validate().form()) {
                    $('#addEditflightReservationForm').submit();
                }
                return false;
            });
            $('#addEditflightReservationForm input').keypress(function (e) {
                if (e.which == 13) {
                    if ($('#addEditflightReservationForm').validate().form()) {
                        $('#addEditflightReservationForm').submit();
                    }
                    return false;
                }
            });



            $('#addEditflightReservationForm').submit(function () {
                var id = $('#id').val();
                var action = config.admin_url + '/flight_reservation/add';
                if (id != 0) {
                    action = config.admin_url + '/flight_reservation/edit';
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
                            Flight_reservation_grid.api().ajax.reload();
                            if (id != 0) {
                                $('#addEditflightReservation').modal('hide');
                            } else {
                                Flight_reservation.empty();
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
                    url: config.admin_url + '/flight_reservation/row',
                    data: {id: $(t).attr("data-id")},
                    success: function (data)
                    {
                        console.log(data);

                        Flight_reservation.empty();
                        App.setModalTitle('#addEditflightReservation', 'تعديل');
                        if (data.message.flight_type == 1) {
                            $('#flight_type_collective').prop('checked', true);
                            $('#flight_type_individual').prop('checked', false);
                            $('#individual-box-period').hide();
                            $('#collective-box-period').show();
                            for (i in data.message)
                            {

                                $('#' + i).val(data.message[i]);

                            }
                        } else {
                            $('#flight_type_collective').prop('checked', false);
                            $('#flight_type_individual').prop('checked', true);
                            $('#collective-box-period').hide();
                            $('#individual-box-period').show();
                            for (i in data.message)
                            {
                                if (i == 'id') {
                                    $('#' + i).val(data.message[i]);
                                } else {
                                    $('#individual_' + i).val(data.message[i]);
                                }


                            }
                        }
                        //handleWhichFlightTypeSectionIsRequired(data.message.flight_type);
                        $('#addEditflightReservation').modal('show');
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
                                    url: config.admin_url + '/flight_reservation/delete',
                                    data: {id: $(t).attr("data-id")},
                                    success: function (data)
                                    {
                                        $.alert(data.message);
                                        Flight_reservation_grid.api().ajax.reload();


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
                $('#flight_type_collective').prop('checked', false);
                $('#individual-box-period').hide();
                $('#collective-box-period').hide();
                Flight_reservation.empty();
                App.setModalTitle('#addEditflightReservation', 'اضافة');
                $('#addEditflightReservation').modal('show');
            },
            empty: function () {
                $('#id').val(0)
                $('#active').find('option').eq(0).prop('selected', true);
                $('select').find('option').eq(0).prop('selected', true);
                $('.has-error').removeClass('has-error');
                $('.has-success').removeClass('has-success');
                $('.help-block').html('');
                App.emptyForm();
            }
        };

    }();
    jQuery(document).ready(function () {
        Flight_reservation.init();
    });

