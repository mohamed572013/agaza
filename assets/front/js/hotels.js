
    var cities_ids = {};
    var hotels_ids = {};
    var prices = {};
    var stars = {};
    var sort = {};
    var advantages_ids = {};
    var Hotels = function () {

        var init = function () {
            show_more_hotels();

        }

        var show_more_hotels = function () {
            $(document).on('click', '.show-more-hotels', function () {
//                alert('here');
//                return false;
                //$('.show-more-hotels').html('<img src="' + config.base_url + 'uploads/loader.gif" style="width:20px;height:25px;">');
                var all_hotels_count = $(this).attr('data-all-hotels-count');
                var current_length = $(this).attr('data-current-length');
                var city = $(this).attr('data-city-id');
                var action = config.base_url + 'hotels/index';
                var data_1 = $.extend({}, cities_ids, hotels_ids);
                var data_2 = $.extend({}, data_1, prices);
                var data_3 = $.extend({}, data_2, stars);
                var data_4 = $.extend({}, data_3, sort);
                var data_5 = $.extend({}, data_4, advantages_ids);
                var data = $.extend({}, data_5, {current_length: current_length, city: city});
                $.ajax({
                    url: action,
                    data: $.param(data),
                    async: false,
                    beforeSend: function () {
                        $('.show-more-hotels').html('<img height="40px" width="40px" src="' + config.url + '3.gif" />');

                    },
                    success: function (data) {
                        if (all_hotels_count == current_length) {

                        } else {
                            setTimeout(function () {
                                $('.show-more-hotels').remove();
                                $('.list-content').append(data);
                                var new_length = $(document).find('.list-item-entry').length;
                                $('.show-more-hotels').attr('data-current-length', new_length);
                                if (all_hotels_count == new_length) {
                                    $('.show-more-hotels').remove();
                                }
                                $('.loading-div').hide();
                            }, 3000);

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
                return false;
            });
        }


        return {
            init: function () {
                init();
            }
        }

    }();
    jQuery(document).ready(function () {
        Hotels.init();
    });


