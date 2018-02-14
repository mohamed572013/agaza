
    var Destinations = function () {

        var init = function () {
            //alert('here');
            handleGetHotelsOnScroll();
            handleGetShrinesOnScroll();
            handleInOutEgyptForCities();
            handleGetProgramsOnScroll();
        }

        var handleGetHotelsOnScroll = function () {
            var all_hotels_count = $('#all_hotels_count').val();
            var current_length = $(document).find('.hotel_item_container').length;
            if (all_hotels_count <= current_length) {
                $('#hotels_container').css({
                    'overflow': 'hidden'
                });
            }
            $('#hotels_container').on('scroll', function () {
                var hotels_items_length = $(document).find('.hotel_item_container').length;
                //alert(hotels_items_length);
                var container_height = $(this).innerHeight();//146
                var container_scroll_height = $(this)[0].scrollHeight; //256
                var container_scroll_top = $(this).scrollTop(); //58
                var city = $('#city_id').val();

                if (container_scroll_top == container_scroll_height - container_height) {  //يبئا هوا كدا فى أخر الكونتينر
                    var action = config.base_url + 'ajax/moreHotels';
                    $.ajax({
                        url: action,
                        data: {current_length: hotels_items_length, city: city},
                        async: false,
                        beforeSend: function () {

                        },
                        success: function (data) {
                            if (all_hotels_count == hotels_items_length) {

                            } else {
                                $('#hotels_container .list-item-entry').append(data);

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
                        dataType: "text",
                        type: "POST"
                    });
                }
            });
        }
        var handleGetShrinesOnScroll = function () {
            var all_shrines_count = $('#all_shrines_count').val();
            var current_length = $(document).find('.shrine_item_container').length;
            if (all_shrines_count <= current_length) {
                $('#shrines_container').css({
                    'overflow': 'hidden'
                });
            }
            $('#shrines_container').on('scroll', function () {
                var shrines_items_length = $(document).find('.shrine_item_container').length;
                //alert(shrines_items_length);
                var container_height = $(this).innerHeight();//146
                var container_scroll_height = $(this)[0].scrollHeight; //256
                var container_scroll_top = $(this).scrollTop(); //58
                var city = $('#city_id').val();
                if (container_scroll_top == container_scroll_height - container_height) {  //يبئا هوا كدا فى أخر الكونتينر
                    var action = config.base_url + 'ajax/moreShrines';
                    $.ajax({
                        url: action,
                        data: {current_length: shrines_items_length, city: city},
                        async: false,
                        beforeSend: function () {

                        },
                        success: function (data) {
                            if (all_shrines_count == shrines_items_length) {

                            } else {
                                $('#shrines_container .row').append(data);

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
                        dataType: "text",
                        type: "POST"
                    });
                }
            });
        }
        var handleGetProgramsOnScroll = function () {
            var all_programs_count = $('#all_programs_count').val();
            var current_length = $(document).find('.program_item_container').length;
            if (all_programs_count <= current_length) {
                $('#programs_container').css({
                    'overflow': 'hidden'
                });
            }
            $('#programs_container').on('scroll', function () {
                var programs_items_length = $(document).find('.program_item_container').length;
                //alert(shrines_items_length);
                var container_height = $(this).innerHeight();//146
                var container_scroll_height = $(this)[0].scrollHeight; //256
                var container_scroll_top = $(this).scrollTop(); //58
                var city = $('#city_id').val();
                if (container_scroll_top == container_scroll_height - container_height) {  //يبئا هوا كدا فى أخر الكونتينر
                    var action = config.base_url + 'ajax/morePrograms';
                    $.ajax({
                        url: action,
                        data: {current_length: programs_items_length, city: city},
                        async: false,
                        beforeSend: function () {

                        },
                        success: function (data) {
                            if (all_programs_count == programs_items_length) {

                            } else {
                                $('#programs_container .programs-content').append(data);

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
                        dataType: "text",
                        type: "POST"
                    });
                }
            });
        }
        var handleInOutEgyptForCities = function () {
            $('.in_out_egypt').on('change', function () {
                var action = config.base_url + 'ajax/getCitiesInOutEgypt';
                var in_out_egypt = $(this).val();
                $.ajax({
                    url: action,
                    data: {in_out_egypt: in_out_egypt},
                    async: false,
                    beforeSend: function () {

                    },
                    success: function (data) {
                        $('.loading-div').show();
                        setTimeout(function () {
                            $('#destinations').html(data);
                            $('.loading-div').hide();
                        }, 3000);




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
            });
        }
        return {
            init: function () {
                init();
            }
        }

    }();
    jQuery(document).ready(function () {
        Destinations.init();
    });


