
    var cities_ids = {};
    var hotels_ids = {};
    var prices = {};
    var stars = {};
    var sort = {};
    var Haj_umrah_programs = function () {

        var init = function () {
            //alert(con.min_price);
            handleChangeFilterByCity();
            handleChangeFilterByHotel();
            handleShowAndHideFiltersByCity();
            handleShowAndHideFiltersByHotel();
            handleShowMorePrograms();
            handleChangeFilterByPrice();
            handleChangeFilterByStars();
            handleFilterAscDesc();
        }
        var handleShowAndHideFiltersByCity = function () {
            $('#city_name').on('keyup', function () {
                cities_ids = {};
                var city_name = $(this).val();
                $.ajax({
                    url: config.base_url + "programs/getCitiesLike",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        city_name: city_name,
                    },
                    success: function (data)
                    {
                        console.log(data);
                        if (data.type == 'success') {
                            var html = '';
                            var count = 1;
                            for (var x = 0; x < data.data.length; x++) {
                                var input_id = 'city_id_' + count;
                                for (var i in data.data[x]) {
                                    if (i == 'title_ar') {
                                        html += '<li  style="display: block;">' +
                                                '<label>' +
                                                '<input type="checkbox" class="city_id" id="' + input_id + '" value="' + data.data[x].id + '">' +
                                                data.data[x].title_ar +
                                                ' </label>' +
                                                ' </li>';
                                    }

                                }
                                count++;
                            }
                            $('#panel-cities .ul-box').html(html);

                        } else {
                            $('#panel-cities .ul-box').html('');

                        }


                    },
                    error: function (xhr, textStatus, errorThrown) {
                        //$('.loading').addClass('hide');
                        bootbox.dialog({
                            message: xhr.responseText,
                            title: 'sssss',
                            buttons: {
                                danger: {
                                    label: 'esss',
                                    className: "red"
                                }
                            }
                        });
                    },
                });
            });
        }
        var handleShowAndHideFiltersByHotel = function () {
            $('#hotel_name').on('keyup', function () {
                hotels_ids = {};
                var hotel_name = $(this).val();
                $.ajax({
                    url: config.base_url + "programs/getHotelsLike",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        hotel_name: hotel_name,
                    },
                    success: function (data)
                    {
                        console.log(data);
                        if (data.type == 'success') {
                            var html = '';
                            var count = 1;
                            for (var x = 0; x < data.data.length; x++) {
                                var input_id = 'hotel_id_' + count;
                                for (var i in data.data[x]) {
                                    if (i == 'title_ar') {
                                        html += '<li  style="display: block;">' +
                                                '<label>' +
                                                '<input type="checkbox" class="hotel_id" id="' + input_id + '" value="' + data.data[x].id + '">' +
                                                data.data[x].title_ar +
                                                ' </label>' +
                                                ' </li>';
                                    }

                                }
                                count++;
                            }
                            $('#panel-hotels .ul-box').html(html);

                        } else {
                            $('#panel-hotels .ul-box').html('');

                        }


                    },
                    error: function (xhr, textStatus, errorThrown) {
                        //$('.loading').addClass('hide');
                        bootbox.dialog({
                            message: xhr.responseText,
                            title: 'sssss',
                            buttons: {
                                danger: {
                                    label: 'esss',
                                    className: "red"
                                }
                            }
                        });
                    },
                });
            });
        }
        var handleChangeFilterByCity = function () {
            $(document).on('change', '.city_id', function () {
                var input_id = $(this).attr('id');
                var input_value = $(this).val();
                if ($(this).is(':checked')) {
                    cities_ids[input_id] = input_value;
                } else {
                    delete cities_ids[input_id];
                }
                console.log(cities_ids);
                handleFilter();
            });
        }
        var handleChangeFilterByHotel = function () {
            $(document).on('change', '.hotel_id', function () {
                var input_id = $(this).attr('id');
                var input_value = $(this).val();
                if ($(this).is(':checked')) {
                    hotels_ids[input_id] = input_value;
                } else {
                    delete hotels_ids[input_id];
                }
                console.log(hotels_ids);
                handleFilter();
            });
        }

        var handleFilter = function () {
            var data_1 = $.extend({}, cities_ids, hotels_ids);
            var data_2 = $.extend({}, data_1, prices);
            var data_3 = $.extend({}, data_2, stars);
            var data = $.extend({}, data_3, sort);
            //console.log(JSON.stringify(ids));
            //return false;
            $.ajax({
                url: config.base_url + "programs/filter",
                type: 'POST',
                dataType: 'text',
                data: $.param(data),
                success: function (data)
                {
                    $('.pagy').hide();
                    $('.loading-div').show();
                    setTimeout(function () {
                        $(".programs-content").html(data);
                        $('.loading-div').hide();
                    }, 3000);


                },
                error: function (xhr, textStatus, errorThrown) {
                    //$('.loading').addClass('hide');
                    bootbox.dialog({
                        message: xhr.responseText,
                        title: 'sssss',
                        buttons: {
                            danger: {
                                label: 'esss',
                                className: "red"
                            }
                        }
                    });
                },
            });
        }

        var handleShowMorePrograms = function () {
            $(document).on('click', '.show-more-programs', function () {
                var all_programs_count = $(this).attr('data-all-programs-count');
                //alert(all_programs_count);
                var current_length = $(this).attr('data-current-length');
                var action = config.base_url + 'programs/morePrograms';
                var data_1 = $.extend({}, cities_ids, hotels_ids);
                var data_2 = $.extend({}, data_1, prices);
                var data_3 = $.extend({}, data_2, stars);
                var data_4 = $.extend({}, data_3, sort);
                var data = $.extend({}, data_4, {current_length: current_length});
                $.ajax({
                    url: action,
                    data: $.param(data),
                    async: false,
                    beforeSend: function () {
                        $('.show-more-programs').html('<img src="' + config.base_url + 'uploads/loading.gif" style="width:20px;height:25px;">');
                    },
                    success: function (data) {
                        if (all_programs_count == current_length) {
                            //$('.show-more-programs').hide();
                        } else {
                            $('.loading-div').show();
                            setTimeout(function () {
                                var show_more_box_html = $('#show-more-box').html();
                                $(document).find('#show-more-box').remove();
                                $('.programs-content').append(data);
                                $('.programs-content').append('<div id="show-more-box">' + show_more_box_html + '</div>');
                                var new_length = $(document).find('.list-item-entry').length;
                                $('.show-more-programs').attr('data-current-length', new_length);
                                if (all_programs_count == new_length) {
                                    //alert('here');
                                    $('.show-more-programs').hide();
                                }
                                $('.loading-div').hide();
                            }, 3000);

                        }
                        $('.show-more-programs').html('المزيد');


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

        var handleChangeFilterByPrice = function () {
            $("#slider-range").slider({
                range: true,
                min: price.min,
                max: price.max,
                values: [price.min, price.max],
                slide: function (event, ui) {
                    $("#price_start").val("Egp" + ui.values[ 0 ]);
                    $("#price_end").val("Egp" + ui.values[ 1 ]);
                },
                change: function () {
                    //alert('sss');
                    var price_start = $("#price_start").val();
                    var price_end = $("#price_end").val();
                    prices['price_start'] = price_start;
                    prices['price_end'] = price_end;

                    console.log(prices);
                    handleFilter();
                }
            });
            $("#price_start").val("Egp" + $("#slider-range").slider("values", 0));
            $("#price_end").val("Egp" + $("#slider-range").slider("values", 1));
        }
        var handleChangeFilterByStars = function () {
            $("input[id^='star_']").each(function () {
                $(this).on('change', function () {
                    var input_id = $(this).attr('id');
                    var input_value = $(this).val();
                    if ($(this).is(':checked')) {
                        stars[input_id] = input_value;
                    } else {
                        delete stars[input_id];
                    }
                    console.log(stars);
                    handleFilter();
                });
            });
        }
        var handleFilterAscDesc = function () {
            $('.sort').on('click', function () {
                var sort_type = $(this).data('sort-type');
                var sort_value = $(this).data('sort-value');
                var new_limit = $(document).find('.list-item-entry').length;
                sort['sort_type'] = sort_type;
                sort['sort_value'] = sort_value;
                sort['new_limit'] = new_limit;

                console.log(sort);
                handleFilter();
                return false;
            });
        }
        var propChecked = function (elem) {
            $("." + elem).each(function () {
                $(this).prop('checked', false);
            });
        }
        return {
            init: function () {
                init();
            }
        }

    }();
    jQuery(document).ready(function () {
        Haj_umrah_programs.init();
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
    });


