    var hotel_id = 0;
    var Hotel_data_grid;
    var Hotels_rooms_grid;
    var Hotels_extra_services_grid;
    var Hotels_rooms_prices_grid;
    var Chalets_others_prices_grid;

    var Hotel_data = function () {

        var init = function () {
            $.extend(lang, new_lang);
            $(".hotel-select-2").select2({
                dir: "rtl",
            });
            handleHotelRoomsSubmit();
            handleExtraServicesSubmit();
            handleRoomsPricesSubmit();
            handleChaletsOthersPricesSubmit();
            handleDatatables();
            handleChangeHotel();

        };
        var getOthersRoomsForMax = function (hotel_id, hotels_rooms_id) {
            $.ajax({
                url: config.admin_url + '/hotel_data/getOthersRoomsForMax',
                async: false,
                data: {
                    hotel_id: hotel_id,
                    hotels_rooms_id: hotels_rooms_id
                },
                success: function (data) {
                    console.log(data);

                    if (data.type == 'success')
                    {
//                        var html = '<option disabled="disabled" selected>اختر</option>';
//                        var id;
//                        var title_ar;
//                        for (var x = 0; x < data.data.length; x++) {
//                            for (var i in data.data[x]) {
//                                if (i == 'id') {
//                                    id = data.data[x][i];
//                                }
//                                if (i == 'title_ar') {
//                                    title_ar = data.data[x][i];
//                                }
//                            }
//                            html += '<option value="' + id + '">' + title_ar + '</option>';
//                        }
//                        $('#extra_service_id').html(html);
//                        App.setModalTitle('#addEditHotelExtraServices', 'اضافة');
//                        $('#addEditHotelExtraServices').modal('show');
                    } else {
                        bootbox.dialog({
                            message: '<p>كل الخدمات المتاحة تمت اضافتها</p>',
                            title: 'رسالة تنبيه',
                            buttons: {
                                danger: {
                                    label: 'اغلاق',
                                    className: "red"
                                }
                            }
                        });
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
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
        var handleChangeHotel = function () {
            $(document).on('change', '#hotel_id', function () {
                hotel_id = $(this).val();
                if ($('.table-box').hasClass('active')) {
                    var id = $('.table-box.active').attr('id');
                    if (id == 'rooms_table') {
                        Hotels_rooms_grid.ajax.url(config.admin_url + "/hotels_rooms/data/" + hotel_id).load();
                    }
                    if (id == 'extra_services_table') {
                        Hotels_extra_services_grid.ajax.url(config.admin_url + "/hotels_extra_services/data/" + hotel_id).load();
                    }
                    if (id == 'rooms_prices_table') {
                        Hotels_rooms_prices_grid.ajax.url(config.admin_url + "/hotels_rooms_prices/data/" + hotel_id).load();
                    }
                    if (id == 'chalets_others_prices_table') {
                        Chalets_others_prices_grid.ajax.url(config.admin_url + "/hotels_chalets_others_prices/data/" + hotel_id).load();
                    }

                }

            });
        }
        var handleDatatables = function () {
            $(document).on('click', '.hotel-data-box', function () {
                if (hotel_id == 0) {
                    bootbox.dialog({
                        message: '<p>من فضلك قم بإختيار فندق معين</p>',
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
                if (box_type == 'rooms') {
                    if (!$('#rooms_table').hasClass('active')) {
                        $('.table-box').removeClass('active').addClass('disabled');
                        $('#rooms_table').removeClass('disabled').addClass('active');

                    }
                    //$('#rooms_table').addClass('active');
                    if (typeof Hotels_rooms_grid === 'undefined') {


                        Hotels_rooms_grid = $('#rooms_table .dataTable').DataTable({
                            //"processing": true,
                            "serverSide": true,
                            "ajax": {
                                "url": config.admin_url + "/hotels_rooms/data/" + hotel_id,
                                "type": "POST"
                            },
                            "columns": [
//                    {"data": "user_input", orderable: false, "class": "text-center"},
                                {"data": "title_ar"},
                                {"data": "number_of_child_extra"},
                                {"data": "number_of_infant_extra"},
                                {"data": "options", orderable: false, "class": "text-center"}
                            ],
                            "order": [
                                [1, "desc"]
                            ]

                        });
                    } else {
                        Hotels_rooms_grid.ajax.url(config.admin_url + "/hotels_rooms/data/" + hotel_id).load();
                    }
                }
                if (box_type == 'extra_services') {
                    if (!$('#extra_services_table').hasClass('active')) {
                        $('.table-box').removeClass('active').addClass('disabled');
                        $('#extra_services_table').removeClass('disabled').addClass('active');

                    }

                    if (typeof Hotels_extra_services_grid === 'undefined') {


                        Hotels_extra_services_grid = $('#extra_services_table .dataTable').DataTable({
                            //"processing": true,
                            "serverSide": true,
                            "ajax": {
                                "url": config.admin_url + "/hotels_extra_services/data/" + hotel_id,
                                "type": "POST"
                            },
                            "columns": [
//                    {"data": "user_input", orderable: false, "class": "text-center"},
                                {"data": "title_ar"},
                                {"data": "price_for_adult"},
                                {"data": "price_for_child"},
                                {"data": "options", orderable: false, "class": "text-center"}
                            ],
                            "order": [
                                [1, "desc"]
                            ]

                        });
                    } else {
                        Hotels_extra_services_grid.ajax.url(config.admin_url + "/hotels_extra_services/data/" + hotel_id).load();
                    }
                }
                if (box_type == 'rooms_prices') {
                    if (!$('#rooms_prices_table').hasClass('active')) {
                        $('.table-box').removeClass('active').addClass('disabled');
                        $('#rooms_prices_table').removeClass('disabled').addClass('active');

                    }

                    if (typeof Hotels_rooms_prices_grid === 'undefined') {


                        Hotels_rooms_prices_grid = $('#rooms_prices_table .dataTable').DataTable({
                            //"processing": true,
                            "serverSide": true,
                            "ajax": {
                                "url": config.admin_url + "/hotels_rooms_prices/data/" + hotel_id,
                                "type": "POST"
                            },
                            "columns": [
//                    {"data": "user_input", orderable: false, "class": "text-center"},
                                {"data": "place_title_ar"},
                                {"data": "hotel_title_ar"},
                                {"data": "from_date"},
                                {"data": "to_date"},
                                {"data": "adult_price"},
                                //{"data": "child_price"},
                                {"data": "number_of_room"},
                                {"data": "number_of_room_reserved"},
                                {"data": "options", orderable: false, "class": "text-center"}
                            ],
                            "order": [
                                [1, "desc"]
                            ]

                        });
                    } else {
                        Hotels_rooms_prices_grid.ajax.url(config.admin_url + "/hotels_rooms_prices/data/" + hotel_id).load();
                    }
                }
                if (box_type == 'chalets_others_prices') {
                    if (!$('#chalets_others_prices_table').hasClass('active')) {
                        $('.table-box').removeClass('active').addClass('disabled');
                        $('#chalets_others_prices_table').removeClass('disabled').addClass('active');

                    }

                    if (typeof Chalets_others_prices_grid === 'undefined') {


                        Chalets_others_prices_grid = $('#chalets_others_prices_table .dataTable').DataTable({
                            //"processing": true,
                            "serverSide": true,
                            "ajax": {
                                "url": config.admin_url + "/hotels_chalets_others_prices/data/" + hotel_id,
                                "type": "POST"
                            },
                            "columns": [
//                    {"data": "user_input", orderable: false, "class": "text-center"},
                                {"data": "place_title_ar"},
                                {"data": "chalet_title_ar"},
                                {"data": "from_date"},
                                {"data": "to_date"},
                                {"data": "price"},
                                {"data": "number_of_chalet"},
                                {"data": "number_of_chalet_reserved"},
                                {"data": "options", orderable: false, "class": "text-center"}
                            ],
                            "order": [
                                [1, "desc"]
                            ]

                        });
                    } else {
                        Chalets_others_prices_grid.ajax.url(config.admin_url + "/hotels_chalets_others_prices/data/" + hotel_id).load();
                    }
                }
                return false;
            });
        }

        var handleHotelRoomsSubmit = function () {

            $('#addEditHotelRoomsForm').validate({
                rules: {
                    room_id: {
                        required: true

                    },
                    number_of_child_extra: {
                        required: true

                    },
                    number_of_infant_extra: {
                        required: true

                    },
                },
                messages: lang.hotel_rooms_messages,
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
            $('#addEditHotelRooms .submit-form').click(function () {
                if ($('#addEditHotelRoomsForm').validate().form()) {
                    $('#addEditHotelRoomsForm').submit();
                }
                return false;
            });
            $('#addEditHotelRoomsForm input').keypress(function (e) {
                if (e.which == 13) {
                    if ($('#addEditHotelRoomsForm').validate().form()) {
                        $('#addEditHotelRoomsForm').submit();
                    }
                    return false;
                }
            });



            $('#addEditHotelRoomsForm').submit(function () {
                var hotels_rooms_id = $('#hotels_rooms_id').val();
//                alert(hotels_rooms_id);
//                return false;
                var action = config.admin_url + '/hotels_rooms/add';
                if (hotels_rooms_id != 0) {
                    action = config.admin_url + '/hotels_rooms/edit';
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
                            Hotels_rooms_grid.ajax.reload();

                            $('#addEditHotelRooms').modal('hide');

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
        var handleExtraServicesSubmit = function () {

            $('#addEditHotelExtraServicesForm').validate({
                rules: {
                    extra_service_id: {
                        required: true

                    },
                    price_for_adult: {
                        required: true

                    },
                    price_for_child: {
                        required: true

                    },
                    s_currency_id: {
                        required: true
                    },
                },
                messages: lang.hotel_extra_services_messages,
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
            $('#addEditHotelExtraServices .submit-form').click(function () {
                if ($('#addEditHotelExtraServicesForm').validate().form()) {
                    $('#addEditHotelExtraServicesForm').submit();
                }
                return false;
            });
            $('#addEditHotelExtraServicesForm input').keypress(function (e) {
                if (e.which == 13) {
                    if ($('#addEditHotelExtraServicesForm').validate().form()) {
                        $('#addEditHotelExtraServicesForm').submit();
                    }
                    return false;
                }
            });



            $('#addEditHotelExtraServicesForm').submit(function () {
                var hotels_extra_services_id = $('#hotels_extra_services_id').val();
//                alert(hotels_rooms_id);
//                return false;
                var action = config.admin_url + '/hotels_extra_services/add';
                if (hotels_extra_services_id != 0) {
                    action = config.admin_url + '/hotels_extra_services/edit';
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
                            Hotels_extra_services_grid.ajax.reload();

                            $('#addEditHotelExtraServices').modal('hide');

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
        var handleRoomsPricesSubmit = function () {

            $('#addEditHotelRoomsPricesForm').validate({
                rules: {
                    country_id: {
                        required: true

                    },
                    rooom_id: {
                        required: true

                    },
                    from_date: {
                        required: true,
                    },
                    to_date: {
                        required: true

                    },
                    adult_price: {
                        required: true

                    },
                   
                    number_of_room: {
                        required: true

                    },
                    r_currency_id: {
                        required: true
                    },
                },
                messages: lang.hotel_rooms_prices_messages,
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
            $('#addEditHotelRoomsPrices .submit-form').click(function () {
                if ($('#addEditHotelRoomsPricesForm').validate().form()) {
                    $('#addEditHotelRoomsPricesForm').submit();
                }
                return false;
            });
            $('#addEditHotelRoomsPricesForm input').keypress(function (e) {
                if (e.which == 13) {
                    if ($('#addEditHotelRoomsPricesForm').validate().form()) {
                        $('#addEditHotelRoomsPricesForm').submit();
                    }
                    return false;
                }
            });



            $('#addEditHotelRoomsPricesForm').submit(function () {
                var hotels_rooms_prices_id = $('#hotels_rooms_prices_id').val();
                var action = config.admin_url + '/hotels_rooms_prices/add';
                if (hotels_rooms_prices_id != 0) {
                    action = config.admin_url + '/hotels_rooms_prices/edit';
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
                            Hotels_rooms_prices_grid.ajax.reload();
                            if (hotels_rooms_prices_id != 0) {
                                $('#addEditHotelRoomsPrices').modal('hide');
                            } else {
                                Hotel_data.rooms_prices_empty();
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
            add_rooms: function () {
                Hotel_data.rooms_empty();
                App.setModalTitle('#addEditHotelRooms', 'اضافة');
                $('#addEditHotelRooms').modal('show');
            },
            add_rooms2: function () {
                Hotel_data.rooms_empty();
                $.ajax({
                    url: config.admin_url + '/hotel_data/availableRooms',
                    async: false,
                    data: {hotel_id: hotel_id},
                    success: function (data) {
                        console.log(data);

                        if (data.type == 'success')
                        {
                            var html = '<option disabled="disabled" selected>اختر</option>';
                            var id;
                            var title_ar;
                            for (var x = 0; x < data.data.length; x++) {
                                for (var i in data.data[x]) {
                                    if (i == 'id') {
                                        id = data.data[x][i];
                                    }
                                    if (i == 'title_ar') {
                                        title_ar = data.data[x][i];
                                    }
                                }
                                html += '<option value="' + id + '">' + title_ar + '</option>';
                            }
                            $('#room_id').html(html);
                            App.setModalTitle('#addEditHotelRooms', 'اضافة');
                            $('#addEditHotelRooms').modal('show');
                        } else {
                            bootbox.dialog({
                                message: '<p>كل الغرف المتاحة تمت اضافتها</p>',
                                title: 'رسالة تنبيه',
                                buttons: {
                                    danger: {
                                        label: 'اغلاق',
                                        className: "red"
                                    }
                                }
                            });
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
            add_extra_services: function () {
                Hotel_data.extra_services_empty();
                App.setModalTitle('#addEditHotelExtraServices', 'اضافة');
                $('#addEditHotelExtraServices').modal('show');


            },
            add_extra_services2: function () {
                Hotel_data.extra_services_empty();
                $.ajax({
                    url: config.admin_url + '/hotel_data/availableExtraServices',
                    async: false,
                    data: {hotel_id: hotel_id},
                    success: function (data) {
                        console.log(data);

                        if (data.type == 'success')
                        {
                            var html = '<option disabled="disabled" selected>اختر</option>';
                            var id;
                            var title_ar;
                            for (var x = 0; x < data.data.length; x++) {
                                for (var i in data.data[x]) {
                                    if (i == 'id') {
                                        id = data.data[x][i];
                                    }
                                    if (i == 'title_ar') {
                                        title_ar = data.data[x][i];
                                    }
                                }
                                html += '<option value="' + id + '">' + title_ar + '</option>';
                            }
                            $('#extra_service_id').html(html);
                            App.setModalTitle('#addEditHotelExtraServices', 'اضافة');
                            $('#addEditHotelExtraServices').modal('show');
                        } else {
                            bootbox.dialog({
                                message: '<p>كل الخدمات المتاحة تمت اضافتها</p>',
                                title: 'رسالة تنبيه',
                                buttons: {
                                    danger: {
                                        label: 'اغلاق',
                                        className: "red"
                                    }
                                }
                            });
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
            add_rooms_prices: function () {
                Hotel_data.rooms_prices_empty();
                App.setModalTitle('#addEditHotelRoomsPrices', 'اضافة');
                $('#addEditHotelRoomsPrices').modal('show');
            },
            add_chalets_others_prices: function () {
                Hotel_data.chalets_others_prices_empty();
                App.setModalTitle('#addEditHotelChaletsOthersPrices', 'اضافة');
                $('#addEditHotelChaletsOthersPrices').modal('show');
            },
            edit_rooms: function (t) {


                App.editForm({
                    element: t,
                    url: config.admin_url + '/hotels_rooms/row',
                    data: {hotels_rooms_id: $(t).attr("data-id")},
                    success: function (data)
                    {

                        console.log(data);

                        Hotel_data.rooms_empty();
                        App.setModalTitle('#addEditHotelRooms', 'تعديل');

                        for (i in data.message)
                        {
                            if (i == 'hotel_rooms_id') {
                                $('#room_id').val(data.message[i]);
                            } else if (i == 'id') {
                                $('#hotels_rooms_id').val(data.message[i]);

                            } else {
                                $('#' + i).val(data.message[i]);
                            }
                        }
                        $('#addEditHotelRooms').modal('show');
                    }
                });

            },
            edit_extra_services: function (t) {



                App.editForm({
                    element: t,
                    url: config.admin_url + '/hotels_extra_services/row',
                    data: {hotels_extra_services_id: $(t).attr("data-id")},
                    success: function (data)
                    {
                        console.log(data);

                        Hotel_data.extra_services_empty();
                        App.setModalTitle('#addEditHotelExtraServices', 'تعديل');

                        for (i in data.message)
                        {
                            if (i == 'hotel_services_id') {
                                $('#extra_service_id').val(data.message[i]);
                            } else if (i == 'id') {
                                $('#hotels_extra_services_id').val(data.message[i]);

                            } else {
                                $('#' + i).val(data.message[i]);
                            }
                        }
                        $('#addEditHotelExtraServices').modal('show');
                    }
                });

            },
            edit_rooms_prices: function (t) {



                App.editForm({
                    element: t,
                    url: config.admin_url + '/hotels_rooms_prices/row',
                    data: {hotels_rooms_prices_id: $(t).attr("data-id")},
                    success: function (data)
                    {
                        console.log(data);

                        Hotel_data.rooms_prices_empty();
                        App.setModalTitle('#addEditHotelRoomsPrices', 'تعديل');

                        for (i in data.message)
                        {
                            if (i == 'hotel_rooms_id') {
                                $('#rooom_id').val(data.message[i]);
                            } else if (i == 'places_id') {
                                $('#country_id').val(data.message[i]);
                            } else if (i == 'id') {
                                $('#hotels_rooms_prices_id').val(data.message[i]);
                            } else {
                                $('#' + i).val(data.message[i]);
                            }
                        }
                        $('#addEditHotelRoomsPrices').modal('show');
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
            delete_rooms: function (t) {
                $.confirm({
                    title: lang.alert_message,
                    content: lang.confirm_message_title,
                    buttons: {
                        confirm: {
                            text: lang.yes,
                            action: function () {
                                App.deleteForm({
                                    element: t,
                                    url: config.admin_url + '/hotels_rooms/delete',
                                    data: {hotels_rooms_id: $(t).attr("data-id")},
                                    success: function (data)
                                    {
                                        $.alert(data.message);
                                        Hotels_rooms_grid.ajax.reload();


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
                                    url: config.admin_url + '/hotels_extra_services/delete',
                                    data: {hotels_extra_services_id: $(t).attr("data-id")},
                                    success: function (data)
                                    {
                                        $.alert(data.message);
                                        Hotels_extra_services_grid.ajax.reload();


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
                                    url: config.admin_url + '/hotels_rooms_prices/delete',
                                    data: {hotels_rooms_prices_id: $(t).attr("data-id")},
                                    success: function (data)
                                    {
                                        $.alert(data.message);
                                        Hotels_rooms_prices_grid.ajax.reload();


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

                $.confirm({
                    title: lang.alert_message,
                    content: lang.confirm_message_title,
                    buttons: {
                        confirm: {
                            text: lang.yes,
                            action: function () {


                                App.deleteForm({
                                    element: t,
                                    url: config.admin_url + '/hotels_chalets_others_prices/delete',
                                    data: {hotels_chalets_others_prices_id: $(t).attr("data-id")},
                                    success: function (data)
                                    {
                                        $.alert(data.message);
                                        Chalets_others_prices_grid.ajax.reload();


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
            rooms_empty: function () {
                $('#hotels_rooms_id').val(0);
                $('#room_id').find('option').eq(0).prop('selected', true);
                $('.has-error').removeClass('has-error');
                $('.has-success').removeClass('has-success');
                $('.help-block').html('');
                App.emptyForm();
            },
            extra_services_empty: function () {

                $('#hotels_extra_services_id').val(0);
                $('#extra_service_id').find('option').eq(0).prop('selected', true);
                $('.has-error').removeClass('has-error');
                $('.has-success').removeClass('has-success');
                $('.help-block').html('');
                App.emptyForm();
            },
            rooms_prices_empty: function () {
                $('#hotels_rooms_prices_id').val(0);
                $('#country_id').find('option').eq(0).prop('selected', true);
                $('#rooom_id').find('option').eq(0).prop('selected', true);
                $('.has-error').removeClass('has-error');
                $('.has-success').removeClass('has-success');
                $('.help-block').html('');
                App.emptyForm();
            },
            chalets_others_prices_empty: function () {
                $('#hotels_chalets_others_prices_id').val(0);
                $('#coountry_id').find('option').eq(0).prop('selected', true);
                $('#chalets_others_id').find('option').eq(0).prop('selected', true);
                $('.has-error').removeClass('has-error');
                $('.has-success').removeClass('has-success');
                $('.help-block').html('');
                App.emptyForm();
            },
        };

    }();
    jQuery(document).ready(function () {
        Hotel_data.init();
    });

