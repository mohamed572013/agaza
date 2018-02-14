    var Haj_umrah_programs_grid;

    var Haj_umrah_programs = function () {

        var init = function () {
            $.extend(lang, new_lang);
            handleRecords();
            handleSubmit();
            handleShowInSlider();
            readUrlForImages();
            handleImagesFormSubmit();
            remove_image();

        };
        var readUrlForImages = function () {
            $("input[type='file']").each(function () {

                $(this).on('change', function () {
                    var image_id = $(this).data('image');
                    for (var i = 0; i < $(this)[0].files.length; i++) {
                        var reader = new FileReader();

                        reader.onload = function (e) {
                            $('#' + image_id).attr('src', e.target.result);
                        }

                        reader.readAsDataURL($(this)[0].files[i]);
                    }

                    //readURL(this);
                });
            });

        }
        var handleImagesFormSubmit = function () {

            var action = config.admin_url + '/haj_umrah_programs/add_images';
            $('#addEditHajUmrahProgramsImages .submit-form').click(function () {
                var program_id = $('#program_id').val();
                var inputFile = $('#program_images');
                var formData = new FormData($("#addEditHajUmrahProgramsImagesForm")[0]);
                var fileToUpload = inputFile[0].files;
                //return false;
                for (var x = 0; x < fileToUpload.length; x++) {
                    formData.append('file[]', fileToUpload[x]);
                }



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
                            handleListImagesOnServer(program_id);
                            //Haj_umrah_programs.hotels_empty();
                            $("#files-not-uploaded").html('');

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
        var handleListImagesOnServer = function (program_id) {
            var action = config.admin_url + '/haj_umrah_programs/listFiles';
            $.ajax({
                url: action,
                data: {program_id: program_id},
                async: false,
                success: function (data) {
                    console.log(data);

                    if (data.type == 'success')
                    {
                        var items = [];
                        for (var x = 0; x < data.data.length; x++) {

                            items.push('<div style="position:relative;float:right;padding: 5px 5px;"><img style="height:80px;width:80px;" src="' + config.base_url + 'uploads/haj_umrah_programs_slider/' + data.data[x].image + '"/><div style="position: absolute; top: -3px; left: 4px; width: 15px; height: 15px; text-align: center; line-height: 15px; background: #ab0101; border-radius: 50px;"><a href="" class="haj_umrah_hotel_image" data-id="' + data.data[x].id + '" data-program-id="' + data.data[x].haj_umrah_programs_id + '" data-image="' + data.data[x].image + '" style="color:#fff;">x</a></div></div>');


                        }
                        $("#program-images-box").html('').html(items.join(''));

                    } else {
                        $("#program-images-box").html('');
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
            $(document).on('click', '.haj_umrah_hotel_image', function () {
                var image_id = $(this).data('id');
                var program_id = $(this).data('program-id');
                var image = $(this).data('image');
                var action = config.admin_url + '/haj_umrah_programs/remove_image';
                $.ajax({
                    url: action,
                    data: {
                        image_id: image_id,
                        program_id: program_id,
                        image: image
                    },
                    async: false,
                    success: function (data) {
                        console.log(data);

                        if (data.type == 'success')
                        {
                            handleListImagesOnServer(program_id);

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
        var handleShowInSlider = function () {
            $('#show_in_slider').on('change', function () {
                var show_in_slider = $(this).val();
                if (show_in_slider == 1) {
                    $('#slider-image-upload-box').show(500);
//                    $("#slider_image").rules("add", {
//                        required: true,
//                        messages: {
//                            required: "من فضلك ادخل الصورة",
//                        }
//                    });
                } else {
                    $('#slider-image-upload-box').removeClass('has-error');
                    $('#slider-image-upload-box').find('.help-block').html('');
                    //$("#slider_image").rules("remove", "required");
                    $('#slider-image-upload-box').hide(500);

                }
            });
        }
        var handleRecords = function () {
            Haj_umrah_programs_grid = $('.dataTable').dataTable({
                //"processing": true,
                "serverSide": true,
                "ajax": {
                    "url": config.admin_url + "/haj_umrah_programs/data",
                    "type": "POST"
                },
                "columns": [
//                    {"data": "user_input", orderable: false, "class": "text-center"},
                    {"data": "title_ar"},
                    {"data": "price_start_from"},
                    {"data": "images"},
                    {"data": "options", orderable: false, "class": "text-center"}
                ],
                "order": [
                    [1, "desc"]
                ]

            });
        }
        var handleSubmit = function () {

            $('#addEditHajUmrahProgramsForm').validate({
                rules: {
                    active: {
                        required: true

                    },
                    no_of_nights: {
                        required: true

                    },
                    program_view_in_home: {
                        required: true

                    },
                    special_offer: {
                        required: true

                    },
                    programs_levels: {
                        required: true

                    },
                    title_ar: {
                        required: true

                    },
                    price_start_from: {
                        required: true

                    },
                    this_order: {
                        required: true

                    },
                    program_include: {
                        required: true

                    },
                    program_not_include: {
                        required: true

                    },
                    desc_ar: {
                        required: true

                    },
                    keywords_ar: {
                        required: true

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
            $('.submit-form').click(function () {
                if ($('#addEditHajUmrahProgramsForm').validate().form()) {
                    $('#addEditHajUmrahProgramsForm').submit();
                }
                return false;
            });
            $('#addEditHajUmrahProgramsForm input').keypress(function (e) {
                if (e.which == 13) {
                    if ($('#addEditHajUmrahProgramsForm').validate().form()) {
                        $('#addEditHajUmrahProgramsForm').submit();
                    }
                    return false;
                }
            });



            $('#addEditHajUmrahProgramsForm').submit(function () {
                var haj_umrah_program_id = $('#haj_umrah_program_id').val();
                var action = config.admin_url + '/haj_umrah_programs/add';
                if (haj_umrah_program_id != 0) {
                    action = config.admin_url + '/haj_umrah_programs/edit';
                }
                var formData = new FormData($(this)[0]);


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
                            Haj_umrah_programs_grid.api().ajax.reload();
                            if (haj_umrah_program_id != 0) {
                                $('#addEditHajUmrahPrograms').modal('hide');
                            } else {
                                Haj_umrah_programs.empty();
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

        return {
            init: function () {
                init();
            },
            edit: function (t) {



                App.editForm({
                    element: t,
                    url: config.admin_url + '/haj_umrah_programs/row',
                    data: {haj_umrah_program_id: $(t).attr("data-id")},
                    success: function (data)
                    {
                        console.log(data);

                        Haj_umrah_programs.empty();
                        App.setModalTitle('#addEditHajUmrahPrograms', 'تعديل');

                        for (i in data.message)
                        {
                            if (i == 'id') {
                                $('#haj_umrah_program_id').val(data.message[i]);
                            } else if (i == 'image') {
                                $('#program-image-view').attr('src', config.base_url + 'uploads/haj_umrah_programs/' + data.message[i]);
                            } else if (i == 'slider_image') {
                                $('#slider-image-view').attr('src', config.base_url + 'uploads/haj_umrah_programs_slider/' + data.message[i]);
                            } else if (i == 'show_in_slider') {
                                if (data.message[i] == 1) {
                                    $('#' + i).val(data.message[i]);
                                    $('#slider-image-upload-box').show();
                                } else {
                                    $('#slider-image-upload-box').hide();
                                }
                            } else {
                                $('#' + i).val(data.message[i]);
                            }

                        }
                        $('#addEditHajUmrahPrograms').modal('show');
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
                                    url: config.admin_url + '/haj_umrah_programs/delete',
                                    data: {haj_umrah_program_id: $(t).attr("data-id")},
                                    success: function (data)
                                    {
                                        $.alert(data.message);
                                        Haj_umrah_programs_grid.api().ajax.reload();


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
                Haj_umrah_programs.empty();
                App.setModalTitle('#addEditHajUmrahPrograms', 'اضافة');
                $('#addEditHajUmrahPrograms').modal('show');
            },
            add_images: function (element) {
                $('#program_id').val($(element).data('id'));
                $("#program-images-box").html('');
                $("#program_images").val('');
                handleListImagesOnServer($(element).data('id'));
                App.setModalTitle('#addEditHajUmrahProgramsImages', 'اضافة');
                $('#addEditHajUmrahProgramsImages').modal('show');
            },
            empty: function () {
                $('#haj_umrah_program_id').val(0);
                $('#program_image').val('');
                $('#slider_image').val('');
                $('.im').attr('src', config.base_url + 'no-image.jpg');
                $('select').find('option').eq(0).prop('selected', true);
                $('.has-error').removeClass('has-error');
                $('.has-success').removeClass('has-success');
                App.emptyForm();
            },
        };

    }();
    jQuery(document).ready(function () {
        Haj_umrah_programs.init();
    });

