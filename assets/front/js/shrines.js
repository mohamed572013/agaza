
    var Shrines = function () {

        var init = function () {
            handleGetShrinesByCity();
            handleShowMore();
        }
        var handleShowMore = function () {
            $(document).on('click', '.show-more', function () {
                var city_id = $(this).data('city-id');
                var shrines_count = $(this).data('shrines-count');
                var current_shrines = $('.shrine').length;  //before click show more

                $.ajax({
                    url: config.base_url + "shrines/ShrinesByCity",
                    type: 'POST',
                    dataType: 'json',
                    beforeSend: function () {

                    },
                    data: {
                        city_id: city_id,
                        shrines_count: shrines_count,
                        offset: current_shrines,
                    },
                    success: function (data)
                    {
                        console.log(data);
                        if (data.type == 'success') {
                            var html = '';
                            for (var x = 0; x < data.data.shrines.length; x++) {

                                var title = data.data.shrines[x].shrine_title_ar;
                                var shrine_id = data.data.shrines[x].shrine_id;
                                var city_title_ar = data.data.shrines[x].city_title_ar;
                                var shrine_image = data.data.shrines[x].shrine_image;
                                var title_in_url = title.replace(' ', '-');
                                html += '<div class="shrine col-sm-4 pull-left wow fadeIn" data-wow-delay="0.1s">' +
                                        '<div class="img_wrapper">' +
                                        '<div class="img_container">' +
                                        '<a href="' + config.base_url + 'shrines/details/' + title_in_url + '-' + shrine_id + '">' +
                                        '<img src="' + config.url + 'uploads/maka_madina_shrines/' + shrine_image + '" width="800" height="533" class="img-responsive" alt="">' +
                                        '<div class="short_info_grid">' +
                                        '<h3>' + title + '</h3>' +
                                        '<em>' + city_title_ar + '</em>' +
                                        '<p></p>' +
                                        '</div>' +
                                        '</a>' +
                                        '</div>' +
                                        '</div>' +
                                        '</div>';



                            }
                            $('#shrines-content').append(html);
                            var current_shrines = $('.shrine').length; //after click show more
                            if (data.data.shrines_count > current_shrines) {
                                var btn = '<div class="clearfix">' +
                                        '</div><a class="btn btn-default show-more" data-city-id="' + city_id + '" data-shrines-count="' + data.data.shrines_count + '">المزيد</a>';
                                $('#show-more-btn-box').html(btn);
                            } else {
                                $('#show-more-btn-box').html('');
                            }

                        } else {
                            $('#shrines-content').html(data.message);

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
                return false;
            });
        }
        var handleGetShrinesByCity = function () {
            $('#shrinesSearchFrom .submit-form').on('click', function () {
                var city_id = $('#city_id').val();
                //alert(city_id);
                if (city_id === null) {
                    alert('here');

                } else {
                    $.ajax({
                        url: config.base_url + "shrines/ShrinesByCity",
                        type: 'POST',
                        dataType: 'json',
                        beforeSend: function () {
                            //alert('here');
                            $('#shrinesSearchFrom .submit-form').val('جارى البحث ....');
                        },
                        data: {
                            city_id: city_id,
                        },
                        success: function (data)
                        {
                            console.log(data);
                            $('#shrinesSearchFrom .submit-form').val('ابحث');
                            if (data.type == 'success') {
                                var html = '';
                                for (var x = 0; x < data.data.shrines.length; x++) {

                                    var title = data.data.shrines[x].shrine_title_ar;
                                    var shrine_id = data.data.shrines[x].shrine_id;
                                    var city_title_ar = data.data.shrines[x].city_title_ar;
                                    var shrine_image = data.data.shrines[x].shrine_image;
                                    var title_in_url = title.replace(' ', '-');
                                    html += '<div class="shrine col-sm-4 pull-left wow fadeIn" data-wow-delay="0.1s">' +
                                            '<div class="img_wrapper">' +
                                            '<div class="img_container">' +
                                            '<a href="' + config.base_url + 'shrines/details/' + title_in_url + '-' + shrine_id + '">' +
                                            '<img src="' + config.url + 'uploads/maka_madina_shrines/' + shrine_image + '" width="800" height="533" class="img-responsive" alt="">' +
                                            '<div class="short_info_grid">' +
                                            '<h3>' + title + '</h3>' +
                                            '<em>' + city_title_ar + '</em>' +
                                            '<p></p>' +
                                            '</div>' +
                                            '</a>' +
                                            '</div>' +
                                            '</div>' +
                                            '</div>';



                                }


                                $('#shrines-content').html(html);
                                if (data.data.shrines_count > data.data.shrines.length) {
                                    var btn = '<div class="clearfix">' +
                                            '</div><a class="btn btn-default show-more" data-city-id="' + city_id + '" data-shrines-count="' + data.data.shrines_count + '">المزيد</a>';
                                    $('#show-more-btn-box').html(btn);
                                }

                            } else {
                                $('#shrines-content').html(data.message);

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
                }
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
        Shrines.init();


    });


