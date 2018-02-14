    var program_id = 0;
    var programs_flights_id;
    var Hotel_data_grid;
    var Program_cities_grid;
    var Program_extra_services_grid;
    var Program_advantages_grid;
    var Program_flights_grid;
    var Program_rooms_prices_grid;

    var Program_data = function () {

        var init = function () {
            //alert('here');
            $.extend(lang, new_lang);
            $(".program-select-2").select2({
                dir: "rtl",
            });
            handleProgramCitiesSubmit();
            handleHajUmrahProgramFlightsSubmit();
            handleHajUmrahProgramRoomsPricesSubmit();
            handleHajUmrahProgramExtraServicesSubmit();
            handleHajUmrahProgramAdvantagesSubmit();
            handleChaletsOthersPricesSubmit();
            handleDatatables();
            handleChangePrograms();
            handleChangeCountriesOrCities();

        };
        var checkProgramNights = function (haj_umrah_program_id) {
            $.ajax({
                url: config.admin_url + '/haj_umrah_program/checkProgramNights',
                data: {haj_umrah_program_id: haj_umrah_program_id},
                async: false,
                success: function (data) {
                    console.log(data);

                    if (data.type == 'success')
                    {

                    } else {


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
        }
        var getCities = function (country_id, city_id, content) {
            $.ajax({
                type: "post",
                url: config.admin_url + '/program_data/getCities',
                data: {
                    country_id: country_id,
                    selected_id: city_id,
                },
                success: function (data) {
                    console.log(data)
                    $("#" + content).html(data);
                }
            });
        }
        var getHotels = function (city_id, selected_id, content) {
            $.ajax({
                type: "post",
                url: config.admin_url + '/program_data/getHotels',
                data: {
                    city_id: city_id,
                    selected_id: selected_id,
                },
                success: function (data) {
                    console.log(data)
                    $("#" + content).html(data);
                }
            });
        }
        var handleChangePrograms = function () {
            $(document).on('change', '#program_id', function () {
                program_id = $(this).val();
                //alert(program_id);
                if ($('.table-box').hasClass('active')) {
                    var id = $('.table-box.active').attr('id');
                    if (id == 'program_cities_table') {
                        Program_cities_grid.ajax.url(config.admin_url + "/program_cities/data/" + program_id).load();
                    }
                    if (id == 'program_flights_table') {
                        Program_flights_grid.ajax.url(config.admin_url + "/program_flights/data/" + program_id).load();
                    }
                    if (id == 'program_rooms_prices_table') {
                        if (!$('#program_flights_table').hasClass('active')) {
                            $('.table-box').removeClass('active').addClass('disabled');
                            $('#program_flights_table').removeClass('disabled').addClass('active');
                            Program_flights_grid.ajax.url(config.admin_url + "/program_flights/data/" + program_id).load();
                        }
                    }
                    if (id == 'program_extra_services_table') {
                        Program_extra_services_grid.ajax.url(config.admin_url + "/program_extra_services/data/" + program_id).load();
                    }
                    if (id == 'program_advantages_table') {
                        Program_advantages_grid.ajax.url(config.admin_url + "/program_advantages/data/" + program_id).load();
                    }

                }

            });
        }
        var handleDatatables = function () {
            $(document).on('click', '.program-data-box', function () {
                if (program_id == 0) {
                    bootbox.dialog({
                        message: '<p>من فضلك قم بإختيار برنامج معين</p>',
                        title: 'رسالة تنبيه',
                        buttons: {
                            danger: {
                                label: 'اغلاق',
                                className: "red"
                            }
                        }
                    });
                    return false;
                }
                var box_type = $(this).data('type');
                if (box_type == 'program_cities') {
                    if (!$('#program_cities_table').hasClass('active')) {
                        $('.table-box').removeClass('active').addClass('disabled');
                        $('#program_cities_table').removeClass('disabled').addClass('active');

                    }
                    //$('#rooms_table').addClass('active');
                    if (typeof Program_cities_grid === 'undefined') {

                        Program_cities_grid = $('#program_cities_table .dataTable').DataTable({
                            //"processing": true,
                            "serverSide": true,
                            "ajax": {
                                "url": config.admin_url + "/program_cities/data/" + program_id,
                                "type": "POST"
                            },
                            "columns": [
//                    {"data": "user_input", orderable: false, "class": "text-center"},
                                {"data": "city_title_ar"},
                                {"data": "hotel_nights"},
                                {"data": "options", orderable: false, "class": "text-center"}
                            ],
                            "order": [
                                [1, "desc"]
                            ]

                        });
                    } else {
                        Program_cities_grid.ajax.url(config.admin_url + "/program_cities/data/" + program_id).load();
                    }
                }
                if (box_type == 'program_flights') {
                    if (!$('#program_flights_table').hasClass('active')) {
                        $('.table-box').removeClass('active').addClass('disabled');
                        $('#program_flights_table').removeClass('disabled').addClass('active');

                    }

                    if (typeof Program_flights_grid === 'undefined') {


                        Program_flights_grid = $('#program_flights_table .dataTable').DataTable({
                            //"processing": true,
                            "serverSide": true,
                            "ajax": {
                                "url": config.admin_url + "/program_flights/data/" + program_id,
                                "type": "POST"
                            },
                            "columns": [
//                    {"data": "user_input", orderable: false, "class": "text-center"},
                                {"data": "going_date"},
                                {"data": "return_date"},
                                {"data": "room_prices"},
                                {"data": "options", orderable: false, "class": "text-center"}
                            ],
                            "order": [
                                [1, "desc"]
                            ]

                        });
                    } else {
                        Program_flights_grid.ajax.url(config.admin_url + "/program_flights/data/" + program_id).load();
                    }
                }
                if (box_type == 'program_rooms_prices') {
                    programs_flights_id = $(this).data('id');
                    if (!$('#program_rooms_prices_table').hasClass('active')) {
                        $('.table-box').removeClass('active').addClass('disabled');
                        $('#program_rooms_prices_table').removeClass('disabled').addClass('active');

                    }

                    if (typeof Program_rooms_prices_grid === 'undefined') {


                        Program_rooms_prices_grid = $('#program_rooms_prices_table .dataTable').DataTable({
                            //"processing": true,
                            "serverSide": true,
                            "ajax": {
                                "url": config.admin_url + "/program_rooms_prices/data/" + programs_flights_id,
                                "type": "POST"
                            },
                            "columns": [
//                    {"data": "user_input", orderable: false, "class": "text-center"},
                                {"data": "room_title_ar"},
                                {"data": "number_of_rooms"},
                                {"data": "number_of_rooms_reserved"},
                                {"data": "room_price"},
                                {"data": "options", orderable: false, "class": "text-center"}
                            ],
                            "order": [
                                [1, "desc"]
                            ]

                        });
                    } else {
                        Program_rooms_prices_grid.ajax.url(config.admin_url + "/program_rooms_prices/data/" + programs_flights_id).load();
                    }
                }
                if (box_type == 'program_extra_services') {
                    if (!$('#program_extra_services_table').hasClass('active')) {
                        $('.table-box').removeClass('active').addClass('disabled');
                        $('#program_extra_services_table').removeClass('disabled').addClass('active');

                    }

                    if (typeof Program_extra_services_grid === 'undefined') {


                        Program_extra_services_grid = $('#program_extra_services_table .dataTable').DataTable({
                            //"processing": true,
                            "serverSide": true,
                            "ajax": {
                                "url": config.admin_url + "/program_extra_services/data/" + program_id,
                                "type": "POST"
                            },
                            "columns": [
//                    {"data": "user_input", orderable: false, "class": "text-center"},
                                {"data": "extra_service_title_ar"},
                                {"data": "person_or_card"},
                                {"data": "price"},
                                {"data": "options", orderable: false, "class": "text-center"}
                            ],
                            "order": [
                                [1, "desc"]
                            ]

                        });
                    } else {
                        Program_extra_services_grid.ajax.url(config.admin_url + "/program_extra_services/data/" + program_id).load();
                    }
                }
                if (box_type == 'program_advantages') {
                    if (!$('#program_advantages_table').hasClass('active')) {
                        $('.table-box').removeClass('active').addClass('disabled');
                        $('#program_advantages_table').removeClass('disabled').addClass('active');

                    }

                    if (typeof Program_advantages_grid === 'undefined') {


                        Program_advantages_grid = $('#program_advantages_table .dataTable').DataTable({
                            //"processing": true,
                            "serverSide": true,
                            "ajax": {
                                "url": config.admin_url + "/program_advantages/data/" + program_id,
                                "type": "POST"
                            },
                            "columns": [
//                    {"data": "user_input", orderable: false, "class": "text-center"},
                                {"data": "advantage_title_ar"},
                                {"data": "options", orderable: false, "class": "text-center"}
                            ],
                            "order": [
                                [0, "desc"]
                            ]

                        });
                    } else {
                        Program_advantages_grid.ajax.url(config.admin_url + "/program_advantages/data/" + program_id).load();
                    }
                }
                return false;
            });
        }

        var handleProgramCitiesSubmit = function () {
            $('#addEditProgramCitiesForm').validate({
                rules: {
                    country_id: {
                        required: true

                    },
                    city_id: {
                        required: true

                    },
//                    hotel_id: {
//                        required: true
//
//                    },
                    nights: {
                        required: true

                    },
                },
                messages: lang.cities_messages,
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
            $('#addEditProgramCities .submit-form').click(function () {
                if ($('#addEditProgramCitiesForm').validate().form()) {
                    $('#addEditProgramCitiesForm').submit();
                }
                return false;
            });
            $('#addEditProgramCitiesForm input').keypress(function (e) {
                if (e.which == 13) {
                    if ($('#addEditProgramCitiesForm').validate().form()) {
                        $('#addEditProgramCitiesForm').submit();
                    }
                    return false;
                }
            });



            $('#addEditProgramCitiesForm').submit(function () {
                
                var program_cities_id = $('#program_cities_id').val();
//                alert(hotels_rooms_id);
//                return false;
                var action = config.admin_url + '/program_cities/add';
                if (program_cities_id != 0) {
                    action = config.admin_url + '/program_cities/edit';
                }
                var formData = new FormData($(this)[0]);
                formData.append('program_id', program_id);


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
                            Program_cities_grid.ajax.reload();
                            if (program_cities_id != 0) {
                                $('#addEditProgramCities').modal('hide');
                            } else {
                                Program_data.cities_empty();
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
        var handleHajUmrahProgramFlightsSubmit = function () {
            $('#addEditProgramsFlightsForm').validate({
                rules: {
                    flight_reservation_id: {
                        required: true
                    },
                    child_price: {
                        required: true,
                        number: true

                    },
                    infant_price: {
                        required: true,
                        number: true

                    },
                    f_currency_id: {
                        required: true,
                    },
                },
                messages: lang.flights_messages,
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
            $('#addEditProgramsFlights .submit-form').click(function () {
                if ($('#addEditProgramsFlightsForm').validate().form()) {
                    $('#addEditProgramsFlightsForm').submit();
                }
                return false;
            });
            $('#addEditProgramsFlightsForm input').keypress(function (e) {
                if (e.which == 13) {
                    if ($('#addEditProgramsFlightsForm').validate().form()) {
                        $('#addEditProgramsFlightsForm').submit();
                    }
                    return false;
                }
            });



            $('#addEditProgramsFlightsForm').submit(function () {
                var going_date = $('#flight_reservation_id option:selected').data('going-date');
                var return_date = $('#flight_reservation_id option:selected').data('return-date');
                var program_flights_id = $('#program_flights_id').val();
                var action = config.admin_url + '/program_flights/add';
                if (program_flights_id != 0) {
                    action = config.admin_url + '/program_flights/edit';
                }
                var formData = new FormData($(this)[0]);
                formData.append('program_id', program_id);
                formData.append('going_date', going_date);
                formData.append('return_date', return_date);


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
                            Program_flights_grid.ajax.reload();
                            if (program_flights_id != 0) {
                                $('#addEditProgramsFlights').modal('hide');
                            } else {
                                Program_data.flights_empty();
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
        var handleHajUmrahProgramRoomsPricesSubmit = function () {

            $('#addEditProgramsRoomsPricesForm').validate({
                rules: {
                    hotel_rooms_id: {
                        required: true

                    },
                    number_of_rooms: {
                        required: true

                    },
                    adult_price: {
                        required: true

                    },
                    r_currency_id: {
                        required: true,
                    },
                },
                messages: lang.rooms_prices_messages,
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
            $('#addEditProgramsRoomsPrices .submit-form').click(function () {
                if ($('#addEditProgramsRoomsPricesForm').validate().form()) {
                    $('#addEditProgramsRoomsPricesForm').submit();
                }
                return false;
            });
            $('#addEditProgramsRoomsPricesForm input').keypress(function (e) {
                if (e.which == 13) {
                    if ($('#addEditProgramsRoomsPricesForm').validate().form()) {
                        $('#addEditProgramsRoomsPricesForm').submit();
                    }
                    return false;
                }
            });



            $('#addEditProgramsRoomsPricesForm').submit(function () {
                var programs_rooms_prices_id = $('#programs_rooms_prices_id').val();
                var action = config.admin_url + '/program_rooms_prices/add';
                if (programs_rooms_prices_id != 0) {
                    action = config.admin_url + '/program_rooms_prices/edit';
                }
                var formData = new FormData($(this)[0]);
                formData.append('programs_flights_id', programs_flights_id);


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
                            Program_rooms_prices_grid.ajax.reload();
                            if (programs_rooms_prices_id != 0) {
                                $('#addEditProgramsRoomsPrices').modal('hide');
                            } else {
                                Program_data.rooms_prices_empty();
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
        var handleHajUmrahProgramExtraServicesSubmit = function () {

            $('#addEditProgramsExtraServicesForm').validate({
                rules: {
                    extra_services_id: {
                        required: true

                    },
                    price: {
                        required: true

                    },
                    s_currency_id: {
                        required: true,
                    },
                },
                messages: lang.extra_services_messages,
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
            $('#addEditProgramsExtraServices .submit-form').click(function () {
                if ($('#addEditProgramsExtraServicesForm').validate().form()) {
                    $('#addEditProgramsExtraServicesForm').submit();
                }
                return false;
            });
            $('#addEditProgramsExtraServicesForm input').keypress(function (e) {
                if (e.which == 13) {
                    if ($('#addEditProgramsExtraServicesForm').validate().form()) {
                        $('#addEditProgramsExtraServicesForm').submit();
                    }
                    return false;
                }
            });



            $('#addEditProgramsExtraServicesForm').submit(function () {
                var programs_extra_service_id = $('#programs_extra_service_id').val();
                var action = config.admin_url + '/program_extra_services/add';
                if (programs_extra_service_id != 0) {
                    action = config.admin_url + '/program_extra_services/edit';
                }
                var formData = new FormData($(this)[0]);
                formData.append('program_id', program_id);


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
                            Program_extra_services_grid.ajax.reload();
                            if (programs_extra_service_id != 0) {
                                $('#addEditProgramsExtraServices').modal('hide');
                            } else {
                                Program_data.extra_services_empty();
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
        var handleHajUmrahProgramAdvantagesSubmit = function () {

            $('#addEditHajUmrahProgramsAdvantagesForm').validate({
                rules: {
                    programs_advantage_id: {
                        required: true

                    }
                },
                messages: lang.advantages_messages,
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
            $('#addEditProgramsAdvantages .submit-form').click(function () {
                if ($('#addEditProgramsAdvantagesForm').validate().form()) {
                    $('#addEditProgramsAdvantagesForm').submit();
                }
                return false;
            });
            $('#addEditProgramsAdvantagesForm input').keypress(function (e) {
                if (e.which == 13) {
                    if ($('#addEditProgramsAdvantagesForm').validate().form()) {
                        $('#addEditProgramsAdvantagesForm').submit();
                    }
                    return false;
                }
            });



            $('#addEditProgramsAdvantagesForm').submit(function () {
                var programs_advantage_all_id = $('#programs_advantage_all_id').val();
                var action = config.admin_url + '/program_advantages/add';
                if (programs_advantage_all_id != 0) {
                    action = config.admin_url + '/program_advantages/edit';
                }
                var formData = new FormData($(this)[0]);
                formData.append('program_id', program_id);


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
                            Program_advantages_grid.ajax.reload();
                            if (programs_advantage_all_id != 0) {
                                $('#addEditProgramsAdvantages').modal('hide');
                            } else {
                                Program_data.advantages_empty();
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
        var handleChaletsOthersPricesSubmit = function () {

            $('#addEditHotelChaletsOthersPricesForm').validate({
                rules: {
                    coountry_id: {
                        required: true

                    },
                    chalets_others_id: {
                        required: true

                    },
                    froom_date: {
                        required: true

                    },
                    too_date: {
                        required: true

                    },
                    price: {
                        required: true

                    },
                    number_of_chalet: {
                        required: true

                    }
                },
                messages: lang.chalets_others_prices_messages,
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
            $('#addEditHotelChaletsOthersPrices .submit-form').click(function () {
                if ($('#addEditHotelChaletsOthersPricesForm').validate().form()) {
                    $('#addEditHotelChaletsOthersPricesForm').submit();
                }
                return false;
            });
            $('#addEditHotelChaletsOthersPricesForm input').keypress(function (e) {
                if (e.which == 13) {
                    if ($('#addEditHotelChaletsOthersPricesForm').validate().form()) {
                        $('#addEditHotelChaletsOthersPricesForm').submit();
                    }
                    return false;
                }
            });



            $('#addEditHotelChaletsOthersPricesForm').submit(function () {
                var hotels_chalets_others_prices_id = $('#hotels_chalets_others_prices_id').val();
                var action = config.admin_url + '/hotels_chalets_others_prices/add';
                if (hotels_chalets_others_prices_id != 0) {
                    action = config.admin_url + '/hotels_chalets_others_prices/edit';
                }
                var formData = new FormData($(this)[0]);
                formData.append('hotel_id', hotel_id);


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
                            Chalets_others_prices_grid.ajax.reload();
                            if (hotels_chalets_others_prices_id != 0) {
                                $('#addEditHotelChaletsOthersPrices').modal('hide');
                            } else {
                                Hotel_data.chalets_others_prices_empty();
                            }


                        } else {
                            console.log(data)
                            if (data.errors != 'undefined') {
                                for (i in data.errors)
                                {
                                    $('[name="' + i + '"]')
                                            .closest('.form-group').addClass('has-error').removeClass("has-info");
                                    $('#' + i).parent().find(".help-block").html(data.errors[i])
                                }
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
        var handleChangeCountriesOrCities = function () {
            $("#country_id").change(function () {
                var country_id = $(this).val();
                //alert(city_id);
                $.ajax({
                    type: "post",
                    url: config.admin_url + '/program_cities/getCountryCities',
                    data: {country_id: country_id},
                    success: function (data) {
                        console.log(data)
                        $("#city_id").html(data);
                    }
                });
            });
            $("#city_id").change(function () {
                var city_id = $("#city_id").val();
                //alert(city_id);
                $.ajax({
                    type: "post",
                    url: config.admin_url + '/program_cities/gatCityHotels',
                    data: {city_id: city_id},
                    success: function (data) {
                        console.log(data)
                        $("#hotel_id").html(data);
                    }
                });
            });

        }

        return {
            init: function () {
                init();
            },
            add_cities: function () {
                $.ajax({
                    url: config.admin_url + '/program_data/checkProgramNights',
                    data: {program_id: program_id},
                    async: false,
                    success: function (data) {
                        console.log(data);

                        if (data.type == 'success')
                        {
                            $('#country_id').find('option').eq(0).prop('selected', true);
                            $('#places_id').html('<option disabled="disabled" selected>اختر</option>');
                            $('#hotel_id').html('<option disabled="disabled" selected>اختر</option>');
                            Program_data.cities_empty();
                            App.setModalTitle('#addEditProgramCities', 'اضافة');
                            $('#addEditProgramCities').modal('show');
                        } else {
                            $.alert(data.message);

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


            },
            add_flights: function () {
                Program_data.flights_empty();
                App.setModalTitle('#addEditProgramsFlights', 'اضافة');
                $('#addEditProgramsFlights').modal('show');
            },
            add_rooms_prices: function () {
                Program_data.rooms_prices_empty();
                App.setModalTitle('#addEditProgramsRoomsPrices', 'اضافة');
                $('#addEditProgramsRoomsPrices').modal('show');
            },
            add_extra_services: function () {
                Program_data.extra_services_empty();
                App.setModalTitle('#addEditProgramsExtraServices', 'اضافة');
                $('#addEditProgramsExtraServices').modal('show');
            },
            add_advantages: function () {
                Program_data.advantages_empty();
                App.setModalTitle('#addEditProgramsAdvantages', 'اضافة');
                $('#addEditProgramsAdvantages').modal('show');
            },
            edit_cities: function (t) {



                App.editForm({
                    element: t,
                    url: config.admin_url + '/program_cities/row',
                    data: {program_cities_id: $(t).attr("data-id")},
                    success: function (data)
                    {
                        console.log(data);

                        Program_data.cities_empty();
                        App.setModalTitle('#addEditProgramCities', 'تعديل');
                        $('#city_id').val(data.message.city_id);
                        getCities(data.message.country_id, data.message.places_id, 'city_id');
                        getHotels(data.message.places_id, data.message.hotel_id, 'hotel_id');
                        $('#nights').val(data.message.nights);
                        $('#program_cities_id').val(data.message.id);
                        $('#country_id').val(data.message.country_id);
                        $('#addEditProgramCities').modal('show');


                    }
                });

            },
            edit_flights: function (t) {
                App.editForm({
                    element: t,
                    url: config.admin_url + '/program_flights/row',
                    data: {program_flight_id: $(t).attr("data-id")},
                    success: function (data)
                    {
                        console.log(data);

                        Program_data.flights_empty();
                        App.setModalTitle('#addEditProgramsFlights', 'تعديل');

                        $('#program_flights_id').val(data.message.id);
                        $('#flight_reservation_id').val(data.message.flight_reservation_id);
                        $('#child_price').val(data.message.child_price);
                        $('#infant_price').val(data.message.infant_price);
                        $('#f_currency_id').val(data.message.currency_id);

                        $('#addEditProgramsFlights').modal('show');
                    }
                });

            },
            edit_rooms_prices: function (t) {
                App.editForm({
                    element: t,
                    url: config.admin_url + '/program_rooms_prices/row',
                    data: {programs_rooms_prices_id: $(t).attr("data-id")},
                    success: function (data)
                    {
                        console.log(data);

                        Program_data.rooms_prices_empty();
                        App.setModalTitle('#addEditProgramsRoomsPrices', 'تعديل');
                        $('#programs_rooms_prices_id').val(data.message.id);
                        $('#hotel_rooms_id').val(data.message.hotel_rooms_id);
                        $('#number_of_rooms').val(data.message.number_of_rooms);
                        //$('#number_of_rooms_reserved').val(data.message.number_of_rooms_reserved);
                        $('#adult_price').val(data.message.price);
                        $('#r_currency_id').val(data.message.currency_id);
                        $('#addEditProgramsRoomsPrices').modal('show');
                    }
                });

            },
            edit_extra_services: function (t) {



                App.editForm({
                    element: t,
                    url: config.admin_url + '/program_extra_services/row',
                    data: {programs_extra_service_id: $(t).attr("data-id")},
                    success: function (data)
                    {
                        console.log(data);

                        Program_data.extra_services_empty();
                        App.setModalTitle('#addEditProgramsExtraServices', 'تعديل');

                        $('#programs_extra_service_id').val(data.message.id);
                        $('#extra_services_id').val(data.message.extra_service_id);
                        $('#price').val(data.message.price);
                        $('#s_currency_id').val(data.message.currency_id);
                        $('#addEditProgramsExtraServices').modal('show');
                    }
                });

            },
            edit_advantages: function (t) {



                App.editForm({
                    element: t,
                    url: config.admin_url + '/program_advantages/row',
                    data: {programs_advantage_all_id: $(t).attr("data-id")},
                    success: function (data)
                    {
                        console.log(data);

                        Program_data.advantages_empty();
                        App.setModalTitle('#addEditProgramsAdvantages', 'تعديل');

                        $('#programs_advantage_all_id').val(data.message.id);
                        $('#programs_advantage_id').val(data.message.programs_advantage_id);
                        $('#addEditProgramsAdvantages').modal('show');
                    }
                });

            },
            edit_chalets_others_prices: function (t) {

                App.editForm({
                    element: t,
                    url: config.admin_url + '/hotels_chalets_others_prices/row',
                    data: {hotels_chalets_others_prices_id: $(t).attr("data-id")},
                    success: function (data)
                    {
                        console.log(data);

                        Hotel_data.chalets_others_prices_empty();
                        App.setModalTitle('#addEditHotelChaletsOthersPrices', 'تعديل');

                        for (i in data.message)
                        {
                            if (i == 'chalets_others_id') {
                                $('#chalets_others_id').val(data.message[i]);
                            } else if (i == 'places_id') {
                                $('#coountry_id').val(data.message[i]);
                            } else if (i == 'id') {
                                $('#hotels_chalets_others_prices_id').val(data.message[i]);
                            } else if (i == 'from_date') {
                                $('#froom_date').val(data.message[i]);
                            } else if (i == 'to_date') {
                                $('#too_date').val(data.message[i]);
                            } else {
                                $('#' + i).val(data.message[i]);
                            }
                        }
                        $('#addEditHotelChaletsOthersPrices').modal('show');
                    }
                });

            },
            delete_cities: function (t) {
                $.confirm({
                    title: lang.alert_message,
                    content: lang.confirm_message_title,
                    buttons: {
                        confirm: {
                            text: lang.yes,
                            action: function () {
                                App.deleteForm({
                                    element: t,
                                    url: config.admin_url + '/program_cities/delete',
                                    data: {program_cities_id: $(t).attr("data-id")},
                                    success: function (data)
                                    {
                                        $.alert(data.message);
                                        Program_cities_grid.ajax.reload();


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
            delete_flights: function (t) {
                $.confirm({
                    title: lang.alert_message,
                    content: lang.confirm_message_title,
                    buttons: {
                        confirm: {
                            text: lang.yes,
                            action: function () {
                                App.deleteForm({
                                    element: t,
                                    url: config.admin_url + '/program_flights/delete',
                                    data: {program_flights_id: $(t).attr("data-id")},
                                    success: function (data)
                                    {
                                        $.alert(data.message);
                                        Program_flights_grid.ajax.reload();


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
            delete_rooms_prices: function (t) {
                $.confirm({
                    title: lang.alert_message,
                    content: lang.confirm_message_title,
                    buttons: {
                        confirm: {
                            text: lang.yes,
                            action: function () {
                                App.deleteForm({
                                    element: t,
                                    url: config.admin_url + '/program_rooms_prices/delete',
                                    data: {programs_rooms_prices_id: $(t).attr("data-id")},
                                    success: function (data)
                                    {
                                        $.alert(data.message);
                                        Program_rooms_prices_grid.ajax.reload();


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
            delete_extra_services: function (t) {

                $.confirm({
                    title: lang.alert_message,
                    content: lang.confirm_message_title,
                    buttons: {
                        confirm: {
                            text: lang.yes,
                            action: function () {
                                App.deleteForm({
                                    element: t,
                                    url: config.admin_url + '/program_extra_services/delete',
                                    data: {programs_extra_service_id: $(t).attr("data-id")},
                                    success: function (data)
                                    {
                                        $.alert(data.message);
                                        Program_extra_services_grid.ajax.reload();


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
            delete_advantages: function (t) {

                $.confirm({
                    title: lang.alert_message,
                    content: lang.confirm_message_title,
                    buttons: {
                        confirm: {
                            text: lang.yes,
                            action: function () {
                                App.deleteForm({
                                    element: t,
                                    url: config.admin_url + '/program_advantages/delete',
                                    data: {programs_advantage_all_id: $(t).attr("data-id")},
                                    success: function (data)
                                    {
                                        $.alert(data.message);
                                        Program_advantages_grid.ajax.reload();


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
            delete_chalets_others_prices: function (t) {

                App.deleteForm({
                    element: t,
                    url: config.admin_url + '/hotels_chalets_others_prices/delete',
                    data: {hotels_chalets_others_prices_id: $(t).attr("data-id")},
                    success: function (data)
                    {
                        Chalets_others_prices_grid.ajax.reload();


                    }
                });
            },
            cities_empty: function () {
                $('#program_cities_id').val(0);
                $('#country_id').find('option').eq(0).prop('selected', true);
                $('#city_id').html('<option disabled selected>اختر</option>');
                $('#hotel_id').html('<option disabled selected>اختر</option>');
                $('.has-error').removeClass('has-error');
                $('.has-success').removeClass('has-success');
                $('.help-block').html('');
                App.emptyForm();
            },
            flights_empty: function () {
                $('#haj_umrah_program_flights_id').val(0);
                $('#flight_reservation_id').find('option').eq(0).prop('selected', true);
                $('.has-error').removeClass('has-error');
                $('.has-success').removeClass('has-success');
                $('.help-block').html('');
                App.emptyForm();
            },
            extra_services_empty: function () {
                $('#programs_extra_service_id').val(0);
                $('#extra_services_id').find('option').eq(0).prop('selected', true);
                $('.has-error').removeClass('has-error');
                $('.has-success').removeClass('has-success');
                $('.help-block').html('');
                App.emptyForm();
            },
            rooms_prices_empty: function () {
                $('#programs_rooms_prices_id').val(0);
                $('#hotel_rooms_id').find('option').eq(0).prop('selected', true);
                $('.has-error').removeClass('has-error');
                $('.has-success').removeClass('has-success');
                $('.help-block').html('');
                App.emptyForm();
            },
            advantages_empty: function () {
                $('#programs_advantage_all_id').val('0');
                $('#programs_advantage_id').find('option').eq(0).prop('selected', true);
                $('.has-error').removeClass('has-error');
                $('.has-success').removeClass('has-success');
                $('.help-block').html('');
                App.emptyForm();
            },
        };

    }();
    jQuery(document).ready(function () {
        Program_data.init();
    });

