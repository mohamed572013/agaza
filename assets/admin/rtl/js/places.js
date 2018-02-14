    var Places_grid;
    var place_id = 0;

    var Places = function () {

        var init = function () {
            $.extend(lang, new_lang);
            handleRecords();
            handleCitiesTable();
            handleSubmit();

            readImage();

        };
        var readImage = function () {
            $("#place_image").change(function () {
                //alert($(this)[0].files.length);
                for (var i = 0; i < $(this)[0].files.length; i++) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('.image_uploaded').html('<img style="height:80px;width:150px;" id="image_upload_preview" src="' + e.target.result + '" alt="your image" />');
                    }

                    reader.readAsDataURL($(this)[0].files[i]);
                }

                //readURL(this);
            });



        }

        var handleCitiesTable = function () {
            $(document).on('click', '.places_btn', function () {
                place_id = $(this).data('id');
                if (typeof Places_grid === 'undefined') {


                    Places_grid = $('#countries_table .dataTable').dataTable({
                        "serverSide": true,
                        "ajax": {
                            "url": config.admin_url + "/places/data/?place_id=" + place_id,
                            "type": "POST",
                        },
                        "columns": [
//                    {"data": "user_input", orderable: false, "class": "text-center"},
                            {"data": "title_ar"},
                            {"data": "image"},
                            {"data": "cities"},
                            {"data": "options", orderable: false, "class": "text-center"}
                        ],
                        "order": [
                            [1, "desc"]
                        ]

                    });
                } else {
                    Places_grid.api().ajax.url(config.admin_url + "/places/data/?place_id=" + place_id).load();
                }



                return false;
            });
        }
        var handleRecords = function () {
            Places_grid = $('#countries_table .dataTable').dataTable({
                //"processing": true,
                "serverSide": true,
                "ajax": {
                    "url": config.admin_url + "/places/data/?place_id=" + place_id,
                    "type": "POST",
                },
                "columns": [
//                    {"data": "user_input", orderable: false, "class": "text-center"},
                    {"data": "title_ar"},
                    {"data": "image"},
                    {"data": "cities"},
                    {"data": "options", orderable: false, "class": "text-center"}
                ],
                "order": [
                    [1, "desc"]
                ]

            });
        }
        var handleSubmit = function () {
            jQuery.validator.addMethod("onlyArabic", function (value) {
                var arabic = /[\u0600-\u06FF0-9,-.]/;
                var space = /\s/;
                var count = 0;
                for (var i = 0; i < value.length; i++) {
                    if (space.test(value.charAt(i)) == false) {
                        if (arabic.test(value.charAt(i))) {

                        } else {
                            count++;
                        }
                    }


                }

                if (count > 0) {
                    return false;
                } else {
                    return true;
                }
            }, "ادخل الحروف بالغة العربية");
            jQuery.validator.addMethod("onlyEnglish", function (value) {
                var endlish = /[A-Za-z0-9,-.]/;
                var space = /\s/;
                var count = 0;
                for (var i = 0; i < value.length; i++) {
                    if (space.test(value.charAt(i)) == false) {
                        if (endlish.test(value.charAt(i))) {

                        } else {
                            count++;
                        }
                    }
                }

                if (count > 0) {
                    return false;
                } else {
                    return true;
                }
            }, "ادخل الحروف بالغة الإنجليزية");
            $('#addEditPlacesForm').validate({
                rules: {
                    title_ar: {
                        required: true,
                        onlyArabic: true

                    },
                    title_en: {
                        required: true,
                        onlyEnglish: true

                    },
                    this_order: {
                        required: true,
                        number: true

                    },
                    body_ar: {
                        required: true,
                        onlyArabic: true

                    },
                    body_en: {
                        required: true,
                        onlyEnglish: true

                    },
                    desc_ar: {
                        required: true,
                        onlyArabic: true

                    },
                    desc_en: {
                        required: true,
                        onlyEnglish: true

                    },
                    keywords_ar: {
                        required: true,
                        onlyArabic: true

                    },
                    keywords_en: {
                        required: true,
                        onlyEnglish: true

                    },
                },
                messages: lang.messages,
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
            $('#addEditPlaces .submit-form').click(function () {
                if ($('#addEditPlacesForm').validate().form()) {
                    $('#addEditPlacesForm').submit();
                }
                return false;
            });
            $('#addEditPlacesForm input').keypress(function (e) {
                if (e.which == 13) {
                    if ($('#addEditPlacesForm').validate().form()) {
                        $('#addEditPlacesForm').submit();
                    }
                    return false;
                }
            });



            $('#addEditPlacesForm').submit(function () {
                var id = $('#id').val();
                var action = config.admin_url + '/places/add';
                if (id != 0) {
                    action = config.admin_url + '/places/edit';
                }
                var formData = new FormData($(this)[0]);
                formData.append('place_id', place_id);
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
                            Places_grid.api().ajax.reload();
                            if (id != 0) {
                                $('#addEditPlaces').modal('hide');
                            } else {
                                Places.empty();
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
        var handleImagesFormSubmit = function () {

            var action = config.admin_url + '/hotels/add_images';
            $('#addEditHotelsImages .submit-form').click(function () {
                var hotel_id = $('#hotel_id').val();
                var inputFile = $('#hotel_images');
                var formData = new FormData($("#addEditHotelsImagesForm")[0]);
                var fileToUpload = inputFile[0].files;
                for (var x = 0; x < fileToUpload.length; x++) {
                    formData.append('file[]', fileToUpload[x]);
                }
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
                            $('#addEditHotelsImages').modal('hide');
//                            handleListImagesOnServer(hotel_id);
//                            Haj_umrah_hotels.hotels_empty();
//                            $("#files-not-uploaded").html('');

                        } else {
                            console.log(data)
                            if (typeof data.errors === 'object') {

                                var items = [];
                                $.each(data.errors, function (i, element) {
                                    items.push('<li class="list-group-item">' + i + ' : ' + element + '</li>');
                                });
                                console.log(items);
                                $("#files-not-uploaded").html('').html(items.join(''));

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
            });
        }
        var handleListImagesOnServer = function (hotel_id) {
            var action = config.admin_url + '/hotels/listFiles';
            $.ajax({
                url: action,
                data: {hotel_id: hotel_id},
                async: false,
                success: function (data) {
                    console.log(data);

                    if (data.type == 'success')
                    {
                        var items = [];
                        for (var x = 0; x < data.data.length; x++) {

                            items.push('<div style="position:relative;float:right;padding: 5px 5px;"><img style="height:80px;width:80px;" src="' + config.base_url + 'uploads/maka_madina_hotels_slider/' + data.data[x].image + '"/><div style="position: absolute; top: -3px; left: 4px; width: 15px; height: 15px; text-align: center; line-height: 15px; background: #ab0101; border-radius: 50px;"><a href="" class="hotel_image" data-id="' + data.data[x].id + '" data-hotel-id="' + data.data[x].maka_madina_hotels_id + '" data-image="' + data.data[x].image + '" style="color:#fff;">x</a></div></div>');


                        }
                        $("#hotel-images-box").html('').html(items.join(''));

                    } else {
                        $("#hotel-images-box").html('');
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
        var remove_image = function () {
            $(document).on('click', '.hotel_image', function () {
                var image_id = $(this).data('id');
                var hotel_id = $(this).data('hotel-id');
                var image = $(this).data('image');
                var action = config.admin_url + '/hotels/remove_image';
                $.ajax({
                    url: action,
                    data: {
                        image_id: image_id,
                        hotel_id: hotel_id,
                        image: image
                    },
                    async: false,
                    success: function (data) {
                        console.log(data);

                        if (data.type == 'success')
                        {


                            $('#addEditHotelsImages .submit-form').prop('disabled', true);
                            $('#addEditHotelsImages .submit-form').html('جارى الحذف...');
                            setTimeout(function () {
                                handleListImagesOnServer(hotel_id);
                                $('#addEditHotelsImages .submit-form').prop('disabled', false);
                                $('#addEditHotelsImages .submit-form').html('حفظ');
                            }, 3000);

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
            });

        }
        var handleListImagesOnServer2 = function (hotel_id) {
            var items = [];
            var action = config.admin_url + '/haj_umrah_hotels/listFiles/' + hotel_id;
            $.getJSON(action, function (result) {
                $.each(result, function (i, element) {
                    items.push('<div style="position:relative;float:right;padding: 5px 5px;"><img style="height:80px;width:80px;" src="' + config.base_url + 'uploads/haj_umrah_hotels/' + element + '"/><div style="position: absolute; top: -3px; left: 4px; width: 15px; height: 15px; text-align: center; line-height: 15px; background: #ab0101; border-radius: 50px;"><a href="" style="color:#fff;">x</a></div></div>');
                });
                console.log(items);
                $("#hotel-images-box").html('').html(items.join(''));
            });
        }

        return {
            init: function () {
                init();
            },
            edit: function (t) {



                App.editForm({
                    element: t,
                    url: config.admin_url + '/places/row',
                    data: {id: $(t).attr("data-id")},
                    success: function (data)
                    {
                        console.log(data);

                        Places.empty();
                        App.setModalTitle('#addEditPlaces', 'تعديل');

                        for (i in data.message)
                        {

                            if (i == 'image') {
                                $('.image_uploaded').html('<img style="height:80px;width:150px;" id="image_upload_preview" src="' + config.base_url + 'uploads/places/' + data.message[i] + '" alt="your image" />');

                            } else {
                                $('#' + i).val(data.message[i]);
                            }

                        }
                        $('#addEditPlaces').modal('show');
                    }
                });

            },
            delete: function (t) {
                $.confirm({
                    title: lang.alert_message,
                    content: lang.confirm_message_title,
                    buttons: {
                        confirm: {
                            text: lang.yes,
                            action: function () {
                                App.deleteForm({
                                    element: t,
                                    url: config.admin_url + '/places/delete',
                                    data: {id: $(t).attr("data-id")},
                                    success: function (data)
                                    {
                                        $.alert(data.message);
                                        Places_grid.api().ajax.reload();


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
            add: function () {
                Places.empty();
                App.setModalTitle('#addEditPlaces', 'اضافة');
                $('#addEditPlaces').modal('show');
            },
            empty: function () {
                $('#id').val(0)
                $('#place_image').val('');
                $('.image_uploaded').html('<img src="' + config.base_url + 'no-image.jpg" width="150" height="80" />');
                $('select').find('option').eq(0).prop('selected', true);
                $('.has-error').removeClass('has-error');
                $('.has-success').removeClass('has-success');
                $('.help-block').html('');
                App.emptyForm();
            }
        };

    }();
    jQuery(document).ready(function () {
        Places.init();
    });

