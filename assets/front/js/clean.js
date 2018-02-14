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
                    save_booking();
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