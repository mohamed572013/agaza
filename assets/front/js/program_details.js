var is_logged = false;  //for check if user is logged before booking
var program_details = function () {

    var init = function () {
        handleBooking();
        handleChangeFlightDate();

    }

    var handleBooking = function () {
        $('.booking-btn').on('click', function () {
//alert("hhh");
            var action = config.base_url + '/home/checkLoginForAjax';

            if ($('#program_flight').val() == 0) {
                $('#redirect-alert-message').html(lang.error_choose_program).addClass('alert-danger').fadeIn(500).delay(3000).fadeOut(2000);
            } else {

                $.ajax({
                    url: action,
                    async: false,
                    data: {
                        program_id: $('#program_id').val()
                    },
                    //alert('fgfg');
                    success: function (data) {
                        console.log(data);
                        //return false;
                        if (data.type == 'success') {
                            var program_title = $('#program_title').val();
                            var program_id = $('#program_id').val();
                            var program_flight_id = $('#program_flight').val();
                            var new_program_title = program_title.replace(" ", "-");
                            var program_name_in_url = new_program_title + '-' + program_flight_id + '-' + program_id;
                            var url = config.base_url + 'programs/booking/' + program_name_in_url;
                            window.location.href = url;
                        } else {
                            $('#login-link').trigger('click');
                        }
                    },
                    error: function (xhr, textStatus, errorThrown) {
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
                    dataType: "JSON",
                    type: "POST"
                });
            }
            return false;
        });

    }

    function edit_timer() {
        alert("here");
    }

    var handleChangeFlightDate = function () {
        $('#program_flight').on('change', function () {
            var program_flight_id = $('#program_flight').val();
            var program_id = $('#program_id').val();
            //alert(program_flight_id);
            if (program_flight_id == null) {

                $('#program_flight').css('border-color', '#ae4f4d');
                $('#program_flight').closest('.form-group').find('.help-block').html('<span class="alert-danger">لابد من اختيار تاريخ</span>');
                return false;
            } else {
                $('#program_flight').css('border-color', 'rgba(255, 255, 255, 0.5)');
                $('#program_flight').closest('.form-group').find('.help-block').html('');
            }

            var action = config.base_url + '/programs/getProgramFlightInfo';
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
                        title: lang.messages_error,
                        buttons: {
                            danger: {
                                label: lang.close,
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
    }


    return {
        init: function () {
            init();
        },
        goToPricesAndBookingSection: function () {
            var details_box_offset_top = $('.tab-content2').offset().top;
            $("html, body").animate({scrollTop: details_box_offset_top}, 1000, function () {
                $('#prices-tab').trigger('click');

            });
        },
    }

}();

jQuery(document).ready(function () {
    program_details.init();
});



