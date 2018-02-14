    var haj_umrah_program_id = 0;
    var haj_umrah_program_flights_id;
    var Hotel_data_grid;
    var Program_cities_grid;
    var Program_extra_services_grid;
    var Program_advantages_grid;
    var Program_flights_grid;
    var Program_rooms_prices_grid;

    var Haj_umrah_program = function () {

        var init = function () {
            $.extend(lang, new_lang);
            $(".program-select-2").select2({
                dir: "rtl",
            });
            handleHajUmrahProgramCitiesSubmit();
            handleHajUmrahProgramFlightsSubmit();
            handleHajUmrahProgramRoomsPricesSubmit();
            handleHajUmrahProgramExtraServicesSubmit();
            handleHajUmrahProgramAdvantagesSubmit();
            handleChaletsOthersPricesSubmit();
            handleDatatables();
            handleChangeHotel();
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
        var getPlaces = function (place_id, selected_id, content) {
            $.ajax({
                type: "post",
                url: config.admin_url + '/haj_umrah_program/getPlaces',
                data: {
                    place_id: place_id,
                    selected_id: selected_id,
                },
                success: function (data) {
                    console.log(data)
                    $("#" + content).html(data);
                }
            });
        }
        var getHotels = function (region_id, selected_id, content) {
            $.ajax({
                type: "post",
                url: config.admin_url + '/haj_umrah_program/getHotels',
                data: {
                    region_id: region_id,
                    selected_id: selected_id,
                },
                success: function (data) {
                    console.log(data)
                    $("#" + content).html(data);
                }
            });
        }
        var handleChangeHotel = function () {
            $(document).on('change', '#haj_umrah_program_id', function () {
                haj_umrah_program_id = $(this).val();
                if ($('.table-box').hasClass('active')) {
                    var id = $('.table-box.active').attr('id');
                    if (id == 'program_cities_table') {
                        Program_cities_grid.ajax.url(config.admin_url + "/Haj_umrah_program_cities/data/" + haj_umrah_program_id).load();
                    }
                    if (id == 'program_flights_table') {
                        Program_flights_grid.ajax.url(config.admin_url + "/Haj_umrah_program_flights/data/" + haj_umrah_program_id).load();
                    }
                    if (id == 'program_rooms_prices_table') {
                        if (!$('#program_flights_table').hasClass('active')) {
                            $('.table-box').removeClass('active').addClass('disabled');
                            $('#program_flights_table').removeClass('disabled').addClass('active');
                            Program_flights_grid.ajax.url(config.admin_url + "/Haj_umrah_program_flights/data/" + haj_umrah_program_id).load();
                        }
                    }
                    if (id == 'program_extra_services_table') {
                        Program_extra_services_grid.ajax.url(config.admin_url + "/haj_umrah_program_extra_services/data/" + haj_umrah_program_id).load();
                    }
                    if (id == 'program_advantages_table') {
                        Program_advantages_grid.ajax.url(config.admin_url + "/haj_umrah_program_advantages/data/" + haj_umrah_program_id).load();
                    }

                }

            });
        }
        var handleDatatables = function () {
            $(document).on('click', '.program-data-box', function () {
                if (haj_umrah_program_id == 0) {
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
                                "url": config.admin_url + "/haj_umrah_program_cities/data/" + haj_umrah_program_id,
                                "type": "POST"
                            },
                            "columns": [
//                    {"data": "user_input", orderable: false, "class": "text-center"},
                                {"data": "city_id"},
                                {"data": "region_id"},
                                {"data": "hotel_id"},
                                {"data": "nights"},
                                {"data": "options", orderable: false, "class": "text-center"}
                            ],
                            "order": [
                                [1, "desc"]
                            ]

                        });
                    } else {
                        Program_cities_grid.ajax.url(config.admin_url + "/Haj_umrah_program_cities/data/" + haj_umrah_program_id).load();
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
                                "url": config.admin_url + "/Haj_umrah_program_flights/data/" + haj_umrah_program_id,
                                "type": "POST"
                            },
                            "columns": [
//                    {"data": "user_input", orderable: false, "class": "text-center"},
                                {"data": "travel_way"},
                                {"data": "flight_company_name"},
                                {"data": "name_from_city"},
                                {"data": "return_name_from_city"},
                                {"data": "room_prices"},
                                {"data": "options", orderable: false, "class": "text-center"}
                            ],
                            "order": [
                                [1, "desc"]
                            ]

                        });
                    } else {
                        Program_flights_grid.ajax.url(config.admin_url + "/Haj_umrah_program_flights/data/" + haj_umrah_program_id).load();
                    }
                }
                if (box_type == 'program_rooms_prices') {
                    haj_umrah_program_flights_id = $(this).data('id');
                    if (!$('#program_rooms_prices_table').hasClass('active')) {
                        $('.table-box').removeClass('active').addClass('disabled');
                        $('#program_rooms_prices_table').removeClass('disabled').addClass('active');

                    }

                    if (typeof Program_rooms_prices_grid === 'undefined') {


                        Program_rooms_prices_grid = $('#program_rooms_prices_table .dataTable').DataTable({
                            //"processing": true,
                            "serverSide": true,
                            "ajax": {
                                "url": config.admin_url + "/haj_umrah_program_rooms_prices/data/" + haj_umrah_program_flights_id,
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
                        Program_rooms_prices_grid.ajax.url(config.admin_url + "/haj_umrah_program_rooms_prices/data/" + haj_umrah_program_flights_id).load();
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
                                "url": config.admin_url + "/haj_umrah_program_extra_services/data/" + haj_umrah_program_id,
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
                        Program_extra_services_grid.ajax.url(config.admin_url + "/haj_umrah_program_extra_services/data/" + haj_umrah_program_id).load();
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
                                "url": config.admin_url + "/haj_umrah_program_advantages/data/" + haj_umrah_program_id,
                                "type": "POST"
                            },
                            "columns": [
//                    {"data": "user_input", orderable: false, "class": "text-center"},
                                {"data": "advantage_title_ar"},
                                {"data": "price"},
                                {"data": "options", orderable: false, "class": "text-center"}
                            ],
                            "order": [
                                [1, "desc"]
                            ]

                        });
                    } else {
                        Program_advantages_grid.ajax.url(config.admin_url + "/haj_umrah_program_advantages/data/" + haj_umrah_program_id).load();
                    }
                }
                return false;
            });
        }

        var handleHajUmrahProgramCitiesSubmit = function () {
            $('#addEditHajUmrahProgramCitiesForm').validate({
                rules: {
                    city_id: {
                        required: true

                    },
                    region_id: {
                        required: true

                    },
                    hotel_id: {
                        required: true

                    },
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
            $('#addEditHajUmrahProgramCities .submit-form').click(function () {
                if ($('#addEditHajUmrahProgramCitiesForm').validate().form()) {
                    $('#addEditHajUmrahProgramCitiesForm').submit();
                }
                return false;
            });
            $('#addEditHajUmrahProgramCitiesForm input').keypress(function (e) {
                if (e.which == 13) {
                    if ($('#addEditHajUmrahProgramCitiesForm').validate().form()) {
                        $('#addEditHajUmrahProgramCitiesForm').submit();
                    }
                    return false;
                }
            });



            $('#addEditHajUmrahProgramCitiesForm').submit(function () {
                var haj_umrah_program_cities_id = $('#haj_umrah_program_cities_id').val();
//                alert(hotels_rooms_id);
//                return false;
                var action = config.admin_url + '/Haj_umrah_program_cities/add';
                if (haj_umrah_program_cities_id != 0) {
                    action = config.admin_url + '/Haj_umrah_program_cities/edit';
                }
                var formData = new FormData($(this)[0]);
                formData.append('haj_umrah_program_id', haj_umrah_program_id);


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
                            if (haj_umrah_program_cities_id != 0) {
                                $('#addEditHajUmrahProgramCities').modal('hide');
                            } else {
                                Haj_umrah_program.cities_empty();
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

            $('#addEditHajUmrahProgramsFlightsForm').validate({
                rules: {
                    flight_reservation_id: {
                        required: true
                    },
                    child_price: {
                        required: true

                    },
                    infant_price: {
                        required: true

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
            $('#addEditHajUmrahProgramsFlights .submit-form').click(function () {
                if ($('#addEditHajUmrahProgramsFlightsForm').validate().form()) {
                    $('#addEditHajUmrahProgramsFlightsForm').submit();
                }
                return false;
            });
            $('#addEditHotelExtraServicesForm input').keypress(function (e) {
                if (e.which == 13) {
                    if ($('#addEditHajUmrahProgramsFlightsForm').validate().form()) {
                        $('#addEditHajUmrahProgramsFlightsForm').submit();
                    }
                    return false;
                }
            });



            $('#addEditHajUmrahProgramsFlightsForm').submit(function () {
                var going_date = $('#flight_reservation_id option:selected').data('going-date');
                var return_date = $('#flight_reservation_id option:selected').data('return-date');
                var haj_umrah_program_flights_id = $('#haj_umrah_program_flights_id').val();
                var action = config.admin_url + '/Haj_umrah_program_flights/add';
                if (haj_umrah_program_flights_id != 0) {
                    action = config.admin_url + '/Haj_umrah_program_flights/edit';
                }
                var formData = new FormData($(this)[0]);
                formData.append('haj_umrah_program_id', haj_umrah_program_id);
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
                            if (haj_umrah_program_flights_id != 0) {
                                $('#addEditHajUmrahProgramsFlights').modal('hide');
                            } else {
                                Haj_umrah_program.flights_empty();
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
                            }
                            if (data.error != 'undefined') {
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

            $('#addEditHajUmrahProgramsRoomsPricesForm').validate({
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
            $('#addEditHajUmrahProgramsRoomsPrices .submit-form').click(function () {
                if ($('#addEditHajUmrahProgramsRoomsPricesForm').validate().form()) {
                    $('#addEditHajUmrahProgramsRoomsPricesForm').submit();
                }
                return false;
            });
            $('#addEditHajUmrahProgramsRoomsPricesForm input').keypress(function (e) {
                if (e.which == 13) {
                    if ($('#addEditHajUmrahProgramsRoomsPricesForm').validate().form()) {
                        $('#addEditHajUmrahProgramsRoomsPricesForm').submit();
                    }
                    return false;
                }
            });



            $('#addEditHajUmrahProgramsRoomsPricesForm').submit(function () {
                var haj_umrah_program_rooms_prices_id = $('#haj_umrah_program_rooms_prices_id').val();
                var action = config.admin_url + '/haj_umrah_program_rooms_prices/add';
                if (haj_umrah_program_rooms_prices_id != 0) {
                    action = config.admin_url + '/haj_umrah_program_rooms_prices/edit';
                }
                var formData = new FormData($(this)[0]);
                formData.append('haj_umrah_program_flights_id', haj_umrah_program_flights_id);


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
                            if (haj_umrah_program_rooms_prices_id != 0) {
                                $('#addEditHajUmrahProgramsRoomsPrices').modal('hide');
                            } else {
                                Haj_umrah_program.rooms_prices_empty();
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

            $('#addEditHajUmrahProgramsExtraServicesForm').validate({
                rules: {
                    extra_services_id: {
                        required: true

                    },
                    price: {
                        required: true

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
            $('#addEditHajUmrahProgramsExtraServices .submit-form').click(function () {
                if ($('#addEditHajUmrahProgramsExtraServicesForm').validate().form()) {
                    $('#addEditHajUmrahProgramsExtraServicesForm').submit();
                }
                return false;
            });
            $('#addEditHajUmrahProgramsExtraServicesForm input').keypress(function (e) {
                if (e.which == 13) {
                    if ($('#addEditHajUmrahProgramsExtraServicesForm').validate().form()) {
                        $('#addEditHajUmrahProgramsExtraServicesForm').submit();
                    }
                    return false;
                }
            });



            $('#addEditHajUmrahProgramsExtraServicesForm').submit(function () {
                var haj_umrah_program_extra_services_id = $('#haj_umrah_program_extra_services_id').val();
                var action = config.admin_url + '/haj_umrah_program_extra_services/add';
                if (haj_umrah_program_extra_services_id != 0) {
                    action = config.admin_url + '/haj_umrah_program_extra_services/edit';
                }
                var formData = new FormData($(this)[0]);
                formData.append('haj_umrah_program_id', haj_umrah_program_id);


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
                            if (haj_umrah_program_extra_services_id != 0) {
                                $('#addEditHajUmrahProgramsExtraServices').modal('hide');
                            } else {
                                Haj_umrah_program.extra_services_empty();
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

                    },
                    price: {
                        required: true

                    },
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
            $('#addEditHajUmrahProgramsAdvantages .submit-form').click(function () {
                if ($('#addEditHajUmrahProgramsAdvantagesForm').validate().form()) {
                    $('#addEditHajUmrahProgramsAdvantagesForm').submit();
                }
                return false;
            });
            $('#addEditHajUmrahProgramsAdvantagesForm input').keypress(function (e) {
                if (e.which == 13) {
                    if ($('#addEditHajUmrahProgramsAdvantagesForm').validate().form()) {
                        $('#addEditHajUmrahProgramsAdvantagesForm').submit();
                    }
                    return false;
                }
            });



            $('#addEditHajUmrahProgramsAdvantagesForm').submit(function () {
                var haj_umrah_program_advantages_id = $('#haj_umrah_program_advantages_id').val();
                var action = config.admin_url + '/haj_umrah_program_advantages/add';
                if (haj_umrah_program_advantages_id != 0) {
                    action = config.admin_url + '/haj_umrah_program_advantages/edit';
                }
                var formData = new FormData($(this)[0]);
                formData.append('haj_umrah_program_id', haj_umrah_program_id);


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
                            if (haj_umrah_program_advantages_id != 0) {
                                $('#addEditHajUmrahProgramsAdvantages').modal('hide');
                            } else {
                                Haj_umrah_program.advantages_empty();
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
            $("#city_id").change(function () {
                var city_id = $("#city_id").val();
                //alert(city_id);
                $.ajax({
                    type: "post",
                    url: config.admin_url + '/haj_umrah_program_cities/GetCityRegions',
                    data: {city_id: city_id},
                    success: function (data) {
                        console.log(data)
                        $("#region_id").html(data);
                    }
                });
            });
            $("#region_id").change(function () {
                var region_id = $("#region_id").val();
                //alert(city_id);
                $.ajax({
                    type: "post",
                    url: config.admin_url + '/haj_umrah_program_cities/gatRegionHotels',
                    data: {region_id: region_id},
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
                    url: config.admin_url + '/haj_umrah_program/checkProgramNights',
                    data: {haj_umrah_program_id: haj_umrah_program_id},
                    async: false,
                    success: function (data) {
                        console.log(data);

                        if (data.type == 'success')
                        {
                            $('#country_id').find('option').eq(0).prop('selected', true);
                            $('#places_id').html('<option disabled="disabled" selected>اختر</option>');
                            $('#hotel_id').html('<option disabled="disabled" selected>اختر</option>');
                            Haj_umrah_program.cities_empty();
                            App.setModalTitle('#addEditHajUmrahProgramCities', 'اضافة');
                            $('#addEditHajUmrahProgramCities').modal('show');
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
                Haj_umrah_program.flights_empty();
                App.setModalTitle('#addEditHajUmrahProgramsFlights', 'اضافة');
                $('#addEditHajUmrahProgramsFlights').modal('show');
            },
            add_rooms_prices: function () {
                Haj_umrah_program.rooms_prices_empty();
                App.setModalTitle('#addEditHajUmrahProgramsRoomsPrices', 'اضافة');
                $('#addEditHajUmrahProgramsRoomsPrices').modal('show');
            },
            add_extra_services: function () {
                Haj_umrah_program.extra_services_empty();
                App.setModalTitle('#addEditHajUmrahProgramsExtraServices', 'اضافة');
                $('#addEditHajUmrahProgramsExtraServices').modal('show');
            },
            add_advantages: function () {
                Haj_umrah_program.advantages_empty();
                App.setModalTitle('#addEditHajUmrahProgramsAdvantages', 'اضافة');
                $('#addEditHajUmrahProgramsAdvantages').modal('show');
            },
            edit_cities: function (t) {



                App.editForm({
                    element: t,
                    url: config.admin_url + '/haj_umrah_program_cities/row',
                    data: {haj_umrah_program_cities_id: $(t).attr("data-id")},
                    success: function (data)
                    {
                        //console.log(data);

                        Haj_umrah_program.cities_empty();
                        App.setModalTitle('#addEditHajUmrahProgramCities', 'تعديل');
                        $('#city_id').val(data.message.city_id);
                        getPlaces(data.message.city_id, data.message.region_id, 'region_id');
                        getHotels(data.message.region_id, data.message.hotel_id, 'hotel_id');
                        $('#nights').val(data.message.nights);
                        $('#this_order').val(data.message.this_order);
                        $('#haj_umrah_program_cities_id').val(data.message.id);
                        $('#addEditHajUmrahProgramCities').modal('show');


                    }
                });

            },
            edit_flights: function (t) {
                App.editForm({
                    element: t,
                    url: config.admin_url + '/haj_umrah_program_flights/row',
                    data: {haj_umrah_program_flights_id: $(t).attr("data-id")},
                    success: function (data)
                    {
                        console.log(data);

                        Haj_umrah_program.flights_empty();
                        App.setModalTitle('#addEditHajUmrahProgramsFlights', 'تعديل');

                        $('#haj_umrah_program_flights_id').val(data.message.id);
                        $('#flight_reservation_id').val(data.message.flight_reservation_id);
                        $('#child_price').val(data.message.child_price);
                        $('#infant_price').val(data.message.infant_price);

                        $('#addEditHajUmrahProgramsFlights').modal('show');
                    }
                });

            },
            edit_rooms_prices: function (t) {
                App.editForm({
                    element: t,
                    url: config.admin_url + '/haj_umrah_program_rooms_prices/row',
                    data: {haj_umrah_program_rooms_prices_id: $(t).attr("data-id")},
                    success: function (data)
                    {
                        console.log(data);

                        Haj_umrah_program.rooms_prices_empty();
                        App.setModalTitle('#addEditHajUmrahProgramsRoomsPrices', 'تعديل');
                        $('#haj_umrah_program_rooms_prices_id').val(data.message.id);
                        $('#hotel_rooms_id').val(data.message.hotel_rooms_id);
                        $('#number_of_rooms').val(data.message.number_of_rooms);
                        $('#number_of_rooms_reserved').val(data.message.number_of_rooms_reserved);
                        $('#adult_price').val(data.message.price);

                        $('#addEditHajUmrahProgramsRoomsPrices').modal('show');
                    }
                });

            },
            edit_extra_services: function (t) {



                App.editForm({
                    element: t,
                    url: config.admin_url + '/haj_umrah_program_extra_services/row',
                    data: {haj_umrah_program_extra_services_id: $(t).attr("data-id")},
                    success: function (data)
                    {
                        console.log(data);

                        Haj_umrah_program.extra_services_empty();
                        App.setModalTitle('#addEditHajUmrahProgramsExtraServices', 'تعديل');

                        $('#haj_umrah_program_extra_services_id').val(data.message.id);
                        $('#extra_services_id').val(data.message.extra_services_id);
                        $('#price').val(data.message.price);
                        $('#addEditHajUmrahProgramsExtraServices').modal('show');
                    }
                });

            },
            edit_advantages: function (t) {



                App.editForm({
                    element: t,
                    url: config.admin_url + '/haj_umrah_program_advantages/row',
                    data: {haj_umrah_program_advantages_id: $(t).attr("data-id")},
                    success: function (data)
                    {
                        console.log(data);

                        Haj_umrah_program.advantages_empty();
                        App.setModalTitle('#addEditHajUmrahProgramsAdvantages', 'تعديل');

                        $('#haj_umrah_program_advantages_id').val(data.message.id);
                        $('#programs_advantage_id').val(data.message.programs_advantage_id);
                        alert(data.message.price);
                        $('#advantage_price').val(data.message.price);
                        $('#addEditHajUmrahProgramsAdvantages').modal('show');
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
                                    url: config.admin_url + '/haj_umrah_program_cities/delete',
                                    data: {haj_umrah_program_cities_id: $(t).attr("data-id")},
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
                                    url: config.admin_url + '/haj_umrah_program_flights/delete',
                                    data: {haj_umrah_programs_flights_id: $(t).attr("data-id")},
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
                                    url: config.admin_url + '/haj_umrah_program_rooms_prices/delete',
                                    data: {haj_umrah_program_rooms_prices_id: $(t).attr("data-id")},
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
                                    url: config.admin_url + '/haj_umrah_program_extra_services/delete',
                                    data: {haj_umrah_program_extra_services_id: $(t).attr("data-id")},
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
                                    url: config.admin_url + '/haj_umrah_program_advantages/delete',
                                    data: {haj_umrah_program_advantages_id: $(t).attr("data-id")},
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
                $('#haj_umrah_program_cities_id').val(0);
                $('#city_id').find('option').eq(0).prop('selected', true);
                $('#region_id').html('<option disabled selected>اختر</option>');
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
                $('#haj_umrah_program_extra_services_id').val(0);
                $('#extra_services_id').find('option').eq(0).prop('selected', true);
                $('.has-error').removeClass('has-error');
                $('.has-success').removeClass('has-success');
                $('.help-block').html('');
                App.emptyForm();
            },
            rooms_prices_empty: function () {
                $('#haj_umrah_program_rooms_prices_id').val(0);
                $('#hotel_rooms_id').find('option').eq(0).prop('selected', true);
                $('.has-error').removeClass('has-error');
                $('.has-success').removeClass('has-success');
                $('.help-block').html('');
                App.emptyForm();
            },
            advantages_empty: function () {
                $('#haj_umrah_program_advantages_id').val('0');
                $('#programs_advantage_id').find('option').eq(0).prop('selected', true);
                $('.has-error').removeClass('has-error');
                $('.has-success').removeClass('has-success');
                $('.help-block').html('');
                App.emptyForm();
            },
        };

    }();
    jQuery(document).ready(function () {
        Haj_umrah_program.init();
    });

