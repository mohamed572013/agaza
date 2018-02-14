    var formData = new FormData();
    var booking_price = {};
    var Booking = function () {

        var init = function () {

            handleSubmit();
            handleAddMoreRoms();
            handleRemoveRoom();
            handleChangeLeftBar();
            handleChangeNumOfRooms(false);
            handleChangeServices();
            //handleChangeBirthdate(false);
        };
        var saveBooking = function (formData) {
            var save;
            //return save;
        }

        var getYearsCountBetweenTwoDates = function () {
            var oneDay = 24 * 60 * 60 * 1000;
            var date1 = new Date(2008, 01, 12);
            var date2 = new Date(2008, 01, 22);
            var diff = Math.round(Math.abs((date1.getTime() - date2.getTime()) / (oneDay)));
        }
        var calculateAge = function (birthday) {
            var now = new Date();
            var past = new Date(birthday);
            var nowYear = now.getFullYear();
            var pastYear = past.getFullYear();
            var age = nowYear - pastYear;
            return age;
        };
        var handleChangeNumOfRooms = function (before_next) {
            if (before_next) {

                var adult_num = $('#adult_num').val();
                var count = 0;
                $("select[id^='room_num']").each(function () {
                    var room_num = parseInt($(this).val());
                    var no_of_bed_in_room = parseInt($(this).data('no-of-bed'));
                    var total_no_of_bed_of_all_rooms = room_num * no_of_bed_in_room;
                    count += total_no_of_bed_of_all_rooms;
                });
                //alert(adult_num);
                //alert(count);
                if (count <= adult_num && count != 0) {
                    return true;
                } else {
                    return false;
                }

            } else {
                $('.room_num').on('change', function () {
                    var adult_num = $('#adult_num').val();
                    var count = 0;
                    $("select[id^='room_num']").each(function () {
                        var room_num = parseInt($(this).val());
                        var room_name_in_english = $(this).data('type-room'); //return two
                        var room_price = parseInt($('#' + room_name_in_english + '_price').val());
                        var room_id = $(this).attr('id');
                        var room_cost = room_num * room_price;
                        booking_price[room_id] = room_cost;
                        var no_of_bed_in_room = parseInt($(this).data('no-of-bed'));
                        var total_no_of_bed_of_all_rooms = room_num * no_of_bed_in_room;
                        count += total_no_of_bed_of_all_rooms;
                    });
                    //alert(adult_num);
                    //alert(count);
                    if (count <= adult_num && count != 0) {
                        $('.alert-message').html('');
                        $('.alert-message').fadeOut(1000);
                        var price = 0;
                        for (var i in booking_price) {
                            price += booking_price[i];
                        }
                        console.log(price);
                        $('#booking-price').html(price);
                    } else {
                        $('.alert-message').html('<span class="alert-danger">لابد ان يكون عدد البالغين مساوى لعدد الأسرة أو أقل منها</span>');
                        $('.alert-message').fadeIn(1000);
                    }
                }
                );
            }

        }

        var handleChangeServices = function () {
            $("input[id^='extra_service_for_person_num']").on('change keyup', function () {
                var extra_service_for_person_num = $(this).val();
                var extra_service_for_person_id = $(this).attr('id');
                var i = extra_service_for_person_id.lastIndexOf('_');
                var n = parseInt(extra_service_for_person_id.substr(i + 1));
                var option_selected = $('#extra_service_for_person_' + n).find('option:selected');
                var option_price = parseInt(option_selected.data('service-price'));
                var service_cost = extra_service_for_person_num * option_price;
                console.log(booking_price);
                booking_price[extra_service_for_person_id] = service_cost;
                var price = 0;
                for (var i in booking_price) {
                    price += booking_price[i];
                }
                $('#booking-price').html(price);
            });
            $("select[id^='extra_service_for_person']").on('change', function () {
                var option_selected = $(this).find('option:selected');
                var option_price = parseInt(option_selected.data('service-price'));
                var extra_service_for_person_id = $(this).attr('id');
                var i = extra_service_for_person_id.lastIndexOf('_');
                var n = parseInt(extra_service_for_person_id.substr(i + 1));
                $('#extra_service_for_person_num_' + n).prop('readonly', false);
            });
            $("input[id^='extra_services_for_cards']").on('change', function () {
                if ($(this).is(':checked')) {
                    var service_price = $(this).data('service-price');
                    var service_id = $(this).attr('id');
                    booking_price[service_id] = service_price;
                    var price = 0;
                    for (var i in booking_price) {
                        price += booking_price[i];
                    }
                    $('#booking-price').html(price);
                } else {
                    var service_price = 0;
                    var service_id = $(this).attr('id');
                    booking_price[service_id] = service_price;
                    var price = 0;
                    for (var i in booking_price) {
                        price += booking_price[i];
                    }
                    $('#booking-price').html(price);
                }
            });
        }
//        var handleChangeBirthdate = function (before_next) {
////            $(".birthdate-input").each(function (index) {
////                alert($(document).find('.birthdate-input:eq(' + index + ')').val());
////            });
//            if (before_next) {
//                $(".birthdate-input:eq('1')").each(function () {
//                    var indexo = 1;
//                    var birthdate_selected = $(document).find('.birthdate-input:eq(' + indexo + ')').val();
//                    var birthdate_type = $(document).find('.birthdate-input:eq(' + indexo + ')').data('birthdate-type');
//                    var age = calculateAge(birthdate_selected);
//                    return age;
//                    if (birthdate_type == 'birthdate_adult') {
//                        if (age > 10) {
//                            var obj = {type: 'success', message: ''};
//                            return obj;
//                        } else {
//                            var html_message = '<p class="alert-danger text-right">سن البالغ يجب أن يكون أكبر من  عشرة سنين  فمن فضلك قم اختيار تاريخ ميلاد صحصيح</p>';
//                            var obj = {type: 'error', message: html_message};
//                            return obj;
//                        }
//                    }
////                    if (birthdate_type == 'birthdate_childs') {
////                        if (age >= 2 && age < 10) {
////                            var obj = {type: 'success', message: ''};
////                            return obj;
////                        } else {
////                            alert('here2');
////                            var html_message = '<p class="alert-danger text-right">سن الطفل  يجب أن يكون أكبر من  سنتين وأقل من عشرة سنين  فمن فضلك قم اختيار تاريخ ميلاد صحصيح</p>';
////                            var obj = {type: 'error', message: html_message};
////                            console.log(obj);
////                            return obj;
////                        }
////                    }
////                    if (birthdate_type == 'birthdate_infant') {
////                        if (age < 2) {
////                            var obj = {type: 'success', message: ''};
////                            return obj;
////                        } else {
////                            alert('here3');
////                            var html_message = '<p class="alert-danger text-right">سن الرضيع  يجب أن يكون أكبر من  سنتين  فمن فضلك قم اختيار تاريخ ميلاد صحصيح</p>';
////                            var obj = {type: 'error', message: html_message};
////                            console.log(obj);
////                            return obj;
////                        }
////                    }
//                });
//
//
//            } else {
//                $(document).on('change', '.birthdate-input', function () {
//                    var birthdate_selected = $(this).val();
//                    var birthdate_type = $(this).data('birthdate-type');
//                    var age = calculateAge(birthdate_selected);
//                    if (birthdate_type == 'birthdate_adult') {
//                        if (age > 10) {
//                            //don't do anything
//                        } else {
//                            bootbox.dialog({
//                                message: '<p class="alert-danger text-right">سن البالغ يجب أن يكون أكبر من  عشرة سنين  فمن فضلك قم اختيار تاريخ ميلاد صحصيح</p>',
//                                title: '<h4 class="text-right">رسالة تنبيه</h4>',
//                                buttons: {
//                                    danger: {
//                                        label: lang.close,
//                                        className: "red"
//                                    }
//                                }
//                            });
//                        }
//                    }
//                    if (birthdate_type == 'birthdate_childs') {
//                        if (age >= 2 && age < 10) {
//                            //don't do anything
//                        } else {
//                            bootbox.dialog({
//                                message: '<p class="alert-danger text-right">سن الطفل  يجب أن يكون أكبر من  سنتين وأقل من عشرة سنين  فمن فضلك قم اختيار تاريخ ميلاد صحصيح</p>',
//                                title: '<h4 class="text-right">رسالة تنبيه</h4>',
//                                buttons: {
//                                    danger: {
//                                        label: lang.close,
//                                        className: "red"
//                                    }
//                                }
//                            });
//                        }
//                    }
//                    if (birthdate_type == 'birthdate_infant') {
//                        if (age < 2) {
//                            //don't do anything
//                        } else {
//                            bootbox.dialog({
//                                message: '<p class="alert-danger text-right">سن الرضيع  يجب أن يكون أكبر من  سنتين  فمن فضلك قم اختيار تاريخ ميلاد صحصيح</p>',
//                                title: '<h4 class="text-right">رسالة تنبيه</h4>',
//                                buttons: {
//                                    danger: {
//                                        label: lang.close,
//                                        className: "red"
//                                    }
//                                }
//                            });
//                        }
//                    }
//
//
//                });
//            }
//
//        }
        var handlingFormForTravellersInfo = function (adult_num, child_num, infant_num, num) {
            var title;
            var div_content_id;
            var birthdate_name;
            var birthdate_id;
            var birthdate_type;
            if (adult_num && !child_num && !infant_num) {
                title = 'بيانات البالغين';
                div_content_id = 'traveller-info-box-adult';
                birthdate_name = 'birthdate_adult[]';
                birthdate_id = 'birthdate_adult';
                birthdate_type = 'birthdate_adult';
            }
            if (child_num && !adult_num && !infant_num) {
                title = 'بيانات الأطفال';
                div_content_id = 'traveller-info-box-childs';
                birthdate_name = 'birthdate_childs[]';
                birthdate_id = 'birthdate_childs';
                birthdate_type = 'birthdate_childs';
            }
            if (infant_num && !adult_num && !child_num) {
                title = 'بيانات الرضع';
                div_content_id = 'traveller-info-box-infant';
                birthdate_name = 'birthdate_infant[]';
                birthdate_id = 'birthdate_infant';
                birthdate_type = 'birthdate_infant';
            }

            var html = '<fieldset>' +
                    '<legend>' + title + '</legend>' +
                    '<div class= "traveller-info-box" >';
            var flag = birthdate_id + '_';
            for (var x = 1; x <= num; x++) {
                var birthdate_id_final = flag + x;
                html += '<div class="row" >' +
                        '<div class="col-xs-12 col-sm-4" >' +
                        '<div class="form-group form-block type-2 clearfix">' +
                        '<div class="control-label form-label color-dark-2"> الاسم: </div>' +
                        '<div class="input-style-1 b-50 brd-0 type-2 color-3">' +
                        '<input class="form-control" type="text" placeholder="الاسم " name="name[]">' +
                        '</div>' +
                        '<div class="help-block"></div>' +
                        '</div>' +
                        '</div>' +
                        '<div class="col-xs-12 col-sm-4" >' +
                        '<div class="form-group form-block type-2 clearfix" >' +
                        '<div class="control-label form-label color-dark-2" > النوع </div>' +
                        '<div class="input-style-1 b-50 brd-0 type-2 color-3" >' +
                        '<select class="form-control amr color-3"  name="gender[]">' +
                        '<option selected disabled> اختر </option>' +
                        '<option value="ذكر" > ذكر </option>' +
                        '<option value="أنثى" > انثى </option>' +
                        '</select>' +
                        '</div>' +
                        '<div class="help-block"></div>' +
                        '</div>' +
                        '</div>' +
                        '<div class="col-xs-12 col-sm-4">' +
                        '<div class="form-group form-block type-2 clearfix">' +
                        '<div class="control-label form-label color-dark-2"> تاريخ الميلاد </div>' +
                        '<div class="input-style-1 b-50 brd-0 type-2 color-3">' +
                        '<img src="img/calendar_icon_grey.png" alt = "">' +
                        '<input class="form-control birthdate-input ' + birthdate_type + '" type="date" placeholder="تاريخ الميلاد" data-birthdate-type="' + birthdate_type + '"  name="' + birthdate_name + '" id="' + birthdate_id_final + '">' +
                        '</div>' +
                        '<div class="help-block"></div>' +
                        '</div>' +
                        '</div>' +
                        '</div>';
            }
            html += '</div>' +
                    '</fieldset>';
            $('#' + div_content_id).html(html);
        }
        var handleChangeLeftBar = function () {
            $('#adult_num').on('change keyup', function () {
                var adult_num = $(this).val();
                //this action for extra_service_for_person_num field max number
                $("input[name^='extra_service_for_person_num']").each(function () {
                    $(this).attr('max', adult_num);
                });
                $('#adult_num_span').html(adult_num);
                handlingFormForTravellersInfo(true, false, false, adult_num);
            });
            $('#childs_num').on('change keyup', function () {
                var childs_num = $(this).val();
                $('#childs_num_span').html(childs_num);
                handlingFormForTravellersInfo(false, true, false, childs_num);
            });
            $('#infant_num').on('change keyup', function () {
                var infant_num = $(this).val();
                $('#infant_num_span').html(infant_num);
                handlingFormForTravellersInfo(false, false, true, infant_num);
            });
            $('.room_num').on('change', function () {
                var html = '';
                $("select[id^='room_num']").each(function () {
                    var room_num = parseInt($(this).val());
                    if (room_num != 0) {
                        var room_type = $(this).data('room-type-ar');
                        html += '<div class="row" style="margin-bottom:20px;">' +
                                '<div class="col-md-6">' +
                                '<h6 class="pull-right"> <span class="booktit"> النوع: </span></h6>' +
                                '<h6 class="pull-right">' + room_type + '</h6>' +
                                '</div>' +
                                '<div class = "col-md-6">' +
                                '<h6 class="pull-right"> <span class="booktit"> العدد : </span></h6>' +
                                '<h6 class="pull-right"> ' + room_num + ' غرف </h6>' +
                                '</div>' +
                                '</div>';
                    }


                });
                $('.room-reserved-box').html(html);
            });
            $("select[name^='extra_service_for_person_ids']").each(function () {
                $(this).on('change', function () {
                    //alert($(this).attr('id'));
                    var extra_service_for_person_count = $('#extra_service_for_person_count').val();
                    var current_select_change_id = '#' + $(this).attr('id'); //return id of select tag
                    var option_selected = $(this).val(); //return id of service selected
                    //alert(extra_service_for_person_count);
                    for (var x = 1; x <= extra_service_for_person_count; x++) {
                        //alert('here');
                        var select_id = '#extra_service_for_person_' + x;
                        var options_class = '.option_' + option_selected;
                        if (select_id == current_select_change_id) {
                            //alert('here2222');
                            continue;
                        }
                        $("option[class^='option_']").prop('disabled', false);
                        $(select_id + ' ' + options_class).prop('disabled', 'disabled');
                    }
                });
            });
            $("input[id^='extra_services_for_cards']").on('change', function () {
                var html = '';
                //alert($("input[id^='extra_services_for_cards']:checked").length);
                if ($("input[id^='extra_services_for_cards']:checked").length > 0) {
                    $("input[id^='extra_services_for_cards']:checked").each(function () {
                        var service_title = $(this).data('service-title');
                        var service_price = $(this).data('service-price');
                        //var service_id = $(this).attr('id');
                        html += '<div class="col-md-12">' +
                                '<h6 class="pull-right"> <span class="booktit"> اسم الخدمة: </span></h6>' +
                                '<h6 class="pull-right"> ' + service_title + '</h6>' +
                                '</div>';
                    });
                } else {
                    html += '<div class="col-md-12">' +
                            '<h6 class="pull-right"> <span class="booktit"> اسم الخدمة: </span></h6>' +
                            '<h6 class="pull-right">  </h6>' +
                            '</div>';
                }

                $('#extra-services-cards-box-left-bar').html(html);

            });

            $("input[id^='extra_service_for_person_num']").on('change keyup', function () {
                var html = '';

                var extra_service_for_person_num = $(this).val();
                var extra_service_for_person_id = $(this).attr('id');
                //alert(extra_service_for_person_id);
                $('.' + extra_service_for_person_id).css('display', 'none');
                if (extra_service_for_person_num > 0) {
                    var extra_service_for_person_num = $(this).val();

                    var i = extra_service_for_person_id.lastIndexOf('_');
                    var n = parseInt(extra_service_for_person_id.substr(i + 1));
                    var option_selected = $('#extra_service_for_person_' + n).find('option:selected');
                    var service_title = option_selected.data('service-title');
                    var service_price = option_selected.data('service-price');
                    html += '<div class="col-md-12 ' + extra_service_for_person_id + '">' +
                            '<h6 class="pull-right"><span class="booktit">اسم الخدمة:</span></h6>' +
                            '<h6 class="pull-right">' + service_title + '</h6>' +
                            '</div>' +
                            '<div class="col-md-12 ' + extra_service_for_person_id + '">' +
                            '<h6 class="pull-right"><span class="booktit">عدد الافراد:</span></h6>' +
                            '<h6 class="pull-right">' + extra_service_for_person_num + '</h6>' +
                            '</div>';
                    $('#extra-services-persons-box-left-bar').append(html);
                } else {
                    $('.' + extra_service_for_person_id).hide();
                }


            });

//            $(document).on('change keyup', '.birthdate-input', function () {
//                var birthdate_selected = $(this).val();
//                var birthdate_id = $(this).attr('id');
//                var birthdate_type = $(this).data('birthdate-type');
//                var age = calculateAge(birthdate_selected);
//                if (birthdate_type == 'birthdate_adult') {
//                    if (age > 10) {
//                        //don't do anything
//                    } else {
//                        bootbox.dialog({
//                            message: '<p class="alert-danger text-right">سن البالغ يجب أن يكون أكبر من  عشرة سنين  فمن فضلك قم اختيار تاريخ ميلاد صحصيح</p>',
//                            title: '<h4 class="text-right">رسالة تنبيه</h4>',
//                            buttons: {
//                                danger: {
//                                    label: lang.close,
//                                    className: "red"
//                                }
//                            }
//                        });
//                        alert('here');
////                        $('#' + birthdate_id).closest('.form-block').removeClass('has-success').addClass('has-error');
////                        $('#' + birthdate_id).closest('.form-block').find('.help-block').html('سن البالغ يجب أن يكون أكبر من  عشرة سنين  فمن فضلك قم اختيار تاريخ ميلاد صحصيسسسسسسسح');
//                    }
//                }
//                if (birthdate_type == 'birthdate_childs') {
//                    if (age >= 2 && age < 10) {
//                        //don't do anything
//                    } else {
//                        bootbox.dialog({
//                            message: '<p class="alert-danger text-right">سن الطفل  يجب أن يكون أكبر من  سنتين وأقل من عشرة سنين  فمن فضلك قم اختيار تاريخ ميلاد صحصيح</p>',
//                            title: '<h4 class="text-right">رسالة تنبيه</h4>',
//                            buttons: {
//                                danger: {
//                                    label: lang.close,
//                                    className: "red"
//                                }
//                            }
//                        });
//                    }
//                }
//                if (birthdate_type == 'birthdate_infant') {
//                    if (age < 2) {
//                        //don't do anything
//                    } else {
//                        bootbox.dialog({
//                            message: '<p class="alert-danger text-right">سن الرضيع  يجب أن يكون أكبر من  سنتين  فمن فضلك قم اختيار تاريخ ميلاد صحصيح</p>',
//                            title: '<h4 class="text-right">رسالة تنبيه</h4>',
//                            buttons: {
//                                danger: {
//                                    label: lang.close,
//                                    className: "red"
//                                }
//                            }
//                        });
//                    }
//                }
//
//
//            });
        }
        var handleAddMoreRoms = function () {
            $('.add-more-rooms').on('click', function () {
                var html = '<div class="row room-row">' +
                        '<div class = "col-xs-12 col-sm-5" >' +
                        '<div class = "form-group form-block type-2 clearfix" >' +
                        '<div class = "control-label form-label color-dark-2" > نوع الغرفة </div>' +
                        ' <div class = "input-style-1 b-50 brd-0 type-2 color-3" >' +
                        '<select name = "destination" class = "form-control amr color-3" data - placeholder = "" name = "room_type[]" id = "room_type" >' +
                        '<option value = "" > ثنائى </option>' +
                        '<option value = "0" > ثلاثى </option>' +
                        '</select>' +
                        '</div>' +
                        '<div class = "help-block" > </div>' +
                        '</div>' +
                        '</div>' +
                        '<div class = "col-xs-12 col-sm-5" >' +
                        '<div class = "form-group form-block type-2 clearfix" >' +
                        '<div class = "control-label form-label color-dark-2" > عدد الغرف </div>' +
                        '<div class = "input-style-1 b-50 brd-0 type-2 color-3" >' +
                        '<input class = "form-control" type = "number" placeholder = "عدد الغرف" name = "room_num[]" id = "room_num" >' +
                        '</div>' +
                        '<div class = "help-block" > </div>' +
                        '</div>' +
                        '</div>' +
                        '<div class = "col-xs-12 col-sm-2" >' +
                        '<a href = "" class="btn btn-danger remove-room" > - </a>' +
                        '</div>' +
                        '</div>';
                $('.rooms-box').append(html);
                return false;
            });
        }
        var handleRemoveRoom = function () {
            $(document).on('click', '.remove-room', function () {
                $(this).closest('.room-row').remove();
                return false;
            });
        }
        var handleSubmit = function () {
            $('#form-client').validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input

                rules: {
                    username: {
                        required: true
                    },
                    phone: {
                        required: true
                    },
                    email: {
                        required: true
                    },
                    address: {
                        required: true
                    },
                    birthdate: {
                        required: true
                    },
                },
                messages: lang.form_client,
                highlight: function (element) {
                    $(element).closest('.form-block').removeClass('has-success').addClass('has-error');
                },
                unhighlight: function (element) {
                    $(element).closest('.form-block').removeClass('has-error').addClass('has-success');
                    $(element).closest('.form-block').find('.help-block').html('');
                },
                errorPlacement: function (error, element) {
                    $(element).closest('.form-block').find('.help-block').html($(error).html());
                }
            });
            $('#form-travellersnum').validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input

                rules: {
                    adult_num: {
                        required: true
                    }
                },
                messages: lang.form_travellers,
                highlight: function (element) {
                    $(element).closest('.form-block').removeClass('has-success').addClass('has-error');
                },
                unhighlight: function (element) {
                    $(element).closest('.form-block').removeClass('has-error').addClass('has-success');
                    $(element).closest('.form-block').find('.help-block').html('');
                },
                errorPlacement: function (error, element) {
                    $(element).closest('.form-block').find('.help-block').html($(error).html());
                }
            });
            $('#form-rooms').validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input

                rules: {
                    room_num: {
                        required: true
                    }
                },
                messages: lang.form_travellers,
                highlight: function (element) {
                    $(element).closest('.form-block').removeClass('has-success').addClass('has-error');
                },
                unhighlight: function (element) {
                    $(element).closest('.form-block').removeClass('has-error').addClass('has-success');
                    $(element).closest('.form-block').find('.help-block').html('');
                },
                errorPlacement: function (error, element) {
                    $(element).closest('.form-block').find('.help-block').html($(error).html());
                }
            });
//            $('#form-services').validate({
//                errorElement: 'span', //default input error message container
//                errorClass: 'help-block help-block-error', // default input error message class
//                focusInvalid: false, // do not focus the last invalid input
//
//                rules: {
//                    adult_num: {
//                        required: true
//                    }
//                },
//                messages: lang.form_travellers,
//                highlight: function (element) {
//                    $(element).closest('.form-block').removeClass('has-success').addClass('has-error');
//                },
//                unhighlight: function (element) {
//                    $(element).closest('.form-block').removeClass('has-error').addClass('has-success');
//                    $(element).closest('.form-block').find('.help-block').html('');
//                },
//                errorPlacement: function (error, element) {
//                    $(element).closest('.form-block').find('.help-block').html($(error).html());
//                }
//            });
            $('#form-travellersinfo').validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input

                rules: {
                    adult_num: {
                        required: true
                    }
                },
                messages: lang.form_travellers,
                highlight: function (element) {
                    $(element).closest('.form-block').removeClass('has-success').addClass('has-error');
                },
                unhighlight: function (element) {
                    $(element).closest('.form-block').removeClass('has-error').addClass('has-success');
                    $(element).closest('.form-block').find('.help-block').html('');
                },
                errorPlacement: function (error, element) {
                    $(element).closest('.form-block').find('.help-block').html($(error).html());
                }
            });
            $('#booking-form input').keypress(function (e) {
                if (e.which == 13) {
                    $('#booking-form').submit(); //form validation success, call ajax form submit
                    return false;
                }
            });
            $(".next-step").click(function (e) {
                var form_type = $(this).data('form-type');
                // alert(form_type);
                if ($('#' + form_type).validate().form() == false) {
                    return false;
                } else {

                    /*checks before got next tab*/
                    if (form_type == 'form-rooms') {
                        var check = handleChangeNumOfRooms(true);
                        if (!check) {
                            $('.alert-message').html('<span class="alert-danger">لابد ان يكون عدد البالغين مساوى لعدد الأسرة أو أقل منها</span>');
                            $('.alert-message').fadeIn(1000);
                            return false;
                        }
                    }
                    /*end*/

                    /*store date of every tab in only on varible*/
                    var data = $('#' + form_type).serializeArray()
                    console.log(data);
                    for (var x = 0; x < data.length; x++) {
                        var elem = data[x];
//                        if (formData.has(elem.name)) {
//                            alert(formData.get(elem.name));
//                            formData.delete(elem.name);
//                        }

                        formData.append(elem.name, elem.value);
                        //console.log(elem);
                        console.log(formData);
                    }
                    /*end*/

                    /*save data in formdata variable to database*/
                    var save_success = true;
                    if (form_type == 'form-travellersinfo') { //كدا يعنى انا فى أخر تاب
                        var action = config.base_url + 'programs/checkBirthdates';
                        var Data = new FormData($('#form-travellersinfo')[0]);
                        $.ajax({
                            url: action,
                            data: Data,
                            async: false,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function (data) {

                                console.log(data);
                                if (data.type == 'success') {
                                    var price = 0;
                                    for (var i in booking_price) {
                                        price += booking_price[i];
                                    }
                                    formData.append('booking_price', price);
                                    var action = config.base_url + 'programs/test';
                                    $.ajax({
                                        url: action,
                                        data: formData,
                                        async: false,
                                        cache: false,
                                        contentType: false,
                                        processData: false,
                                        success: function (data) {

                                            console.log(data);
                                            if (data.type == 'success') {
                                                $('.success-message').html('<p class="alert alert-success">' + data.message + '</p>');
                                            } else {
                                                for (var x = 0; x < data.errors.length; x++) {
                                                    $('.error-message').html('<li class="list-group-item list-group-item-danger">' + data.errors[x] + '</li>');
                                                    $('.error-message').fadeIn(1000);
                                                }
                                                save_success = false;
                                            }

                                        },
                                        error: function (xhr, textStatus, errorThrown) {
                                            $('.loading').addClass('hide');
                                            bootbox.dialog({
                                                message: xhr.responseText,
                                                title: lang.messages_error,
                                                buttons: {
                                                    danger: {
                                                        label: lang.close,
                                                        className: "red"
                                                    }
                                                }
                                            });
                                        },
                                        dataType: "json",
                                        type: "POST"
                                    });
                                } else {
                                    for (var i in data.errors) {
                                        $('#' + i).closest('.form-block').removeClass('has-success').addClass('has-error');
                                        $('#' + i).closest('.form-block').find('.help-block').html(data.errors[i]);
                                    }
                                    save_success = false;
                                }

                            },
                            error: function (xhr, textStatus, errorThrown) {
                                $('.loading').addClass('hide');
                                bootbox.dialog({
                                    message: xhr.responseText,
                                    title: lang.messages_error,
                                    buttons: {
                                        danger: {
                                            label: lang.close,
                                            className: "red"
                                        }
                                    }
                                });
                            },
                            dataType: "json",
                            type: "POST"
                        });
                    }
                    /*end*/

                    if (save_success) {
                        var $active = $('.wizard .nav-tabs li.active');
                        $active.next().removeClass('disabled');
                        nextTab($active);
                    } else {
                        return false;
                    }

                }


            });
            $(".prev-step").click(function (e) {

                var $active = $('.wizard .nav-tabs li.active');
                prevTab($active);
            });
            var nextTab = function (elem) {
                $(elem).next().find('a[data-toggle="tab"]').click();
            }
            var prevTab = function (elem) {
                $(elem).prev().find('a[data-toggle="tab"]').click();
            }

//            $('#booking-form').submit(function () {
//
//                var action = config.admin_url + 'services/add';
//                if ($('#service_id').val() != 0)
//                {
//                    action = config.admin_url + 'services/edit';
//                }
//
//                var formData = new FormData($(this)[0]);
//
//
//
//                $.ajax({
//                    url: action,
//                    data: formData,
//                    async: false,
//                    cache: false,
//                    contentType: false,
//                    processData: false,
//                    success: function (data) {
//
//                        $('.loading').addClass('hide');
//
//                        $('.has-error').removeClass('has-error');
//                        $('.help-block').html("");
//
//                        if (data.type == 'success')
//                        {
//                            //if( data.data.admin_avatar != "" )
//                            //{
//                            //    $('#admin_avatar').html("<a target='_blank' href='"+config.user_files + "/admins/" + data.data.admin_avatar+"'>" +
//                            //        "<img style='width: 50px; height: 50px' src='"+config.user_files + "/admins/" + data.data.admin_avatar+"' />" +
//                            //        "</a>")
//                            //}
//                            //category_grid.ajax.reload();
//                            //  $('#admin_avatar').val(data.data.admin_avatar);
//
//
//                            service_grid.fnClearTable(0);
//                            service_grid.fnDraw();
//
//                            $('#addEditService').modal('hide');
//
//                        } else {
//                            for (i in data.errors)
//                            {
//                                $('[name="' + i + '"]')
//                                        .closest('.form-group').addClass('has-error').removeClass("has-info");
//                                $('#' + i).parent().find(".help-block").html(data.errors[i])
//                            }
//                        }
//                    },
//                    error: function (xhr, textStatus, errorThrown) {
//                        $('.loading').addClass('hide');
//                        bootbox.dialog({
//                            message: xhr.responseText,
//                            title: lang.messages_error,
//                            buttons: {
//                                danger: {
//                                    label: lang.close,
//                                    className: "red"
//                                }
//                            }
//                        });
//                    },
//                    dataType: "json",
//                    type: "POST"
//                });
//
//                return false;
//            });

        }

        return {
            init: function () {
                init();
            }
        };
    }();
    $(document).ready(function () {
        Booking.init();
        check_next_prev_active_after_loading_page(false);
        function check_next_prev_active_after_loading_page(t) {

            if ($('.pagy > a.page.active').length > 0) {
                var element;
                if (t) {
                    element = t;
                } else {
                    element = $('.pagy > a.page.active');
                }
                var current_href = element.attr('href');
                var i = current_href.lastIndexOf('-');
                var current_page_number = parseInt(current_href.substr(i + 1));
                var pages = parseInt($('.total_pages').html());
                if (current_page_number == 1) {
                    $('.pagy .prev').hide();
                } else {
                    $('.pagy .prev').show();
                }
                if (current_page_number >= pages) {
                    $('.pagy .next').hide();
                } else {
                    $('.pagy .next').show();
                }
            }

        }

        function check_prev_next_active_when_clicked(type) {


            var current_href = $('.pagy > a.page.active').attr('href');
            var i = current_href.lastIndexOf('-');
            var pages = parseInt($('.total_pages').html());
            if (type == 'next') {
                var current_page_number = parseInt(current_href.substr(i + 1)) + 1;
            } else {
                var current_page_number = parseInt(current_href.substr(i + 1)) - 1;
            }
            if (current_page_number >= pages) {
                $('.pagy .next').hide();
            } else {
                $('.pagy .next').show();
            }
            if (current_page_number == 1) {
                $('.pagy .prev').hide();
            } else {
                $('.pagy .prev').show();
            }


        }
        /*handle how many of links i want to show*/

        if ($('.pagy > a.page.active').length > 0) {
            var current_href = $('.pagy > a.page.active').attr('href');
            var i = current_href.lastIndexOf('-');
            var current_page_number = parseInt(current_href.substr(i + 1));
            $(".pagy  > a.page:gt('" + (current_page_number) + "')").hide();
        }


        /*end*/

        /*handle links clicked*/
        $('.pagy > a.page').on('click', function () {
            check_next_prev_active_after_loading_page($(this));
            //console.log('ahmsssed');
            History.pushState(null, null, $(this).attr("href"));
            $(this).addClass('active').siblings('a').removeClass('active');
            var totalPagesVisisble = $('.pagy > a.page:visible').length;
            $(".pagy > a.page").show();
            $(".pagy > a.page:gt('" + (totalPagesVisisble + 1) + "')").hide();
            var url = $(this).attr('href');
            $.ajax
                    ({
                        type: "get",
                        url: url,
                        success: function (data)
                        {
                            console.log(data);
                            $(".programs-content").html(data);
                        },
                        xhr: function () {
                            var xhr = new window.XMLHttpRequest();
                            xhr.addEventListener("progress", function (evt) {
                                if (evt.lengthComputable) {
                                    var t = evt.loaded / evt.total;
                                }

                            }, false);
                            return xhr;
                        }
                    });
            return false;
        });
        /*handle next clicked*/
        $('.pagy .next').on('click', function () {
            check_prev_next_active_when_clicked('next');
            /*handle how many of links i want to show when i click next*/
            var totalPagesVisisble = $('.pagy > a.page:visible').length;
            $(".pagy > a.page").show();
            $(".pagy > a.page:gt('" + (totalPagesVisisble + 1) + "')").hide();
            /**/
            var href = $('.pagy > a.page.active').attr('href');
            var i = href.lastIndexOf('-');
            var next_page_number = parseInt(href.substr(i + 1)) + 1;
            var pages = parseInt($('.total_pages').html());
            //alert(parseInt(href.substr(i + 1)));
            if (next_page_number > pages) {
                return false;
            } else {

                if (i != -1) {
                    var next_page_url = href.substr(0, i) + "-" + next_page_number;
                }
                History.pushState(null, null, next_page_url);
                $.ajax
                        ({
                            type: "get",
                            url: next_page_url,
                            success: function (data)
                            {
                                console.log(data);
                                $(".programs-content").html(data);
                            },
                            xhr: function () {
                                var xhr = new window.XMLHttpRequest();
                                xhr.addEventListener("progress", function (evt) {
                                    if (evt.lengthComputable) {
                                        var t = evt.loaded / evt.total;
                                    }

                                }, false);
                                return xhr;
                            }
                        });
                $('.pagy > a.page.active').removeClass('active').next().addClass('active');
            }

            return false;
        });
        /*handle prev clicked*/
        $('.pagy .prev').on('click', function () {
            check_prev_next_active_when_clicked('prev');
            /*handle how many of links i want to show when i click prev*/
            var totalPagesVisisble = $('.pagy > a.page:visible').length;
            $(".pagy > a.page").show();
            $(".pagy > a.page:gt('" + (totalPagesVisisble - 1) + "')").hide();
            /*end*/
            var href = $('.pagy > a.page.active').attr('href');
            var i = href.lastIndexOf('-');
            var prev_page_number = parseInt(href.substr(i + 1)) - 1;
            if (prev_page_number >= 1) {

                if (i != -1) {
                    var prev_page_url = href.substr(0, i) + "-" + prev_page_number;
                }
                History.pushState(null, null, prev_page_url);
                $.ajax
                        ({
                            type: "get",
                            url: prev_page_url,
                            success: function (data)
                            {
                                console.log(data);
                                $(".programs-content").html(data);
                            },
                            xhr: function () {
                                var xhr = new window.XMLHttpRequest();
                                xhr.addEventListener("progress", function (evt) {
                                    if (evt.lengthComputable) {
                                        var t = evt.loaded / evt.total;
                                    }

                                }, false);
                                return xhr;
                            }
                        });
                $('.pagy > a.page.active').removeClass('active').prev().addClass('active');
                //$(this).href() //get current href in prev btn href

            } else {
                return false;
            }

            return false;
        });
        $('#program_flight').on('change', function () {
            var program_flight_id = $('#program_flight').val();
            if (program_flight_id == null) {

                $('#program_flight').css('border-color', '#ae4f4d');
                $('#program_flight').closest('.form-group').find('.help-block').html('<span class="alert-danger">لابد من اختيار تاريخ</span>');
                return false;
            } else {
                $('#program_flight').css('border-color', 'rgba(255, 255, 255, 0.5)');
                $('#program_flight').closest('.form-group').find('.help-block').html('');
            }
        });
        $('.btn_search_in_program_details').on('click', function () {
            var program_flight_id = $('#program_flight').val();
            if (program_flight_id == null) {

                $('#program_flight').css('border-color', '#ae4f4d');
                $('#program_flight').closest('.form-group').find('.help-block').html('<span class="alert-danger">لابد من اختيار تاريخ الرحلة</span>');
                return false;
            } else {
                $('#program_flight').css('border-color', 'rgba(255, 255, 255, 0.5)');
                $('#program_flight').closest('.form-group').find('.help-block').html('');
            }
            var program_id = $('#program_id').val();
            var action = config.base_url + '/programs/getProgramFlight';
            $.ajax({
                url: action,
                data: {
                    program_flight_id: program_flight_id,
                    program_id: program_id
                },
                async: false,
                success: function (data) {
                    console.log(data);
                    $('#program_flight_info').html(data);
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
                dataType: "text",
                type: "POST"
            });
            return false;
        });
        $('.booking-btn').on('click', function () {
            var action = config.base_url + '/home/checkLoginForAjax';
            $.ajax({
                url: action,
                async: false,
                data: {
                    program_id: $('#program_id').val()
                },
                success: function (data) {
                    console.log(data);
                    //return false;
                    if (data.type == 'success') {
                        var program_title = $('#program_title').val();
                        var program_id = $('#program_id').val();
                        var program_flight_id = $('#program_flight').val();
                        var new_program_title = program_title.replace(" ", "_");
                        var program_name_in_url = new_program_title + '-' + program_flight_id + '-' + program_id;
                        if (program_flight_id == null) {
                            bootbox.dialog({
                                message: '<p class="alert-danger text-right">لابد من اختيار تاريخ رحلة لهذا البرنامج</p>',
                                title: '<h4 class="text-right">رسالة تنبيه</h4>',
                                buttons: {
                                    danger: {
                                        label: 'اغلاق',
                                        className: "red",
                                        callback: function () {
                                            var details_box_offset_top = $('#details-box').offset().top;
                                            $("html, body").animate({scrollTop: details_box_offset_top}, 1000);
                                            //alert(t.top);
                                            $('#booking-prices-section').trigger('click');
                                        }
                                    }
                                }
                            });
                        } else {
                            var url = config.base_url + 'programs/booking/' + program_name_in_url;
                            //var url = data.data.company_url + 'programs/booking/' + program_name_in_url;
                            window.location.href = url;
                        }
                    } else {
                        bootbox.dialog({
                            message: '<p class="alert-danger text-right">' + data.message + '</p>',
                            title: '<h4 class="text-right">رسالة تنبيه</h4>',
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
                dataType: "JSON",
                type: "POST"
            });
            return false;
        });
    });