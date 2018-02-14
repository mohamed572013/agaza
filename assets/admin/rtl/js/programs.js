
    var Program_type;
    var Programs_grid;
    var Programs_images_grid;
    var programTypeFormData;
    var Programs = function () {

        var init = function () {
            $.extend(lang, new_lang);
            handleRecords();
            handleShowInSlider();
            handleSubmit();
            handleImagesFormSubmit();
            readImage();
            remove_image();
            handleChangeMainCategories();
        };
        var handleChangeMainCategories = function () {
            $("#parent_category_id").change(function () {
                var parent_category_id = $(this).val();
                //alert(country_id);
                $.ajax({
                    type: "post",
                    url: config.admin_url + '/programs/getSubCategories',
                    data: {parent_category_id: parent_category_id},
                    success: function (data) {
                        //console.log(data)
                        $("#category_id").html(data);
                    }
                });
            });

        }
        var getSubCategories = function (parent_category_id, selected_id, content) {
            $.ajax({
                type: "post",
                url: config.admin_url + '/programs/getSubCategoriesForEdit',
                data: {
                    parent_category_id: parent_category_id,
                    selected_id: selected_id,
                },
                success: function (data) {
                    console.log(data)
                    $("#" + content).html(data);
                }
            });
        }

        var readImage = function (input) {
            $("#prog_main_image").change(function () {
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
            $("#prog_slider_image").change(function () {
                //alert($(this)[0].files.length);
                for (var i = 0; i < $(this)[0].files.length; i++) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('.slider_image_uploaded').html('<img style="height:80px;width:150px;" id="slider_image_upload_preview" src="' + e.target.result + '" alt="your image" />');
                    }

                    reader.readAsDataURL($(this)[0].files[i]);
                }

                //readURL(this);
            });


        }
        var handleRecords = function () {
            Programs_grid = $('#programs_table .dataTable').dataTable({
                //"processing": true,
                "serverSide": true,
                "ajax": {
                    "url": config.admin_url + "/programs/data",
                    "type": "POST"
                },
                "columns": [
//                    {"data": "user_input", orderable: false, "class": "text-center"},
                    {"data": "title_ar"},
                    {"data": "image"},
                    {"data": "images"},
                    {"data": "branche_title"},
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
            $('#addEditProgramsForm').validate({
                rules: {
                    agaza_title_ar: {
                        required: true,
                        //onlyArabic: true

                    },
                    agaza_title_en: {
                        required: true,
                        //onlyEnglish: true

                    },
                    maka_nights: {
                        required: true

                    },
                    programs_levels: {
                        required: true

                    },
                    agaza_this_order: {
                        required: true,
                        number: true

                    },
                    price_start_from: {
                        required: true,
                        number: true

                    },
                    currency_id: {
                        required: true,
                    },
                    parent_category_id: {
                        required: true,
                    },
//                    category_id: {
//                        required: true,
//                    },
                    agaza_program_include_ar: {
                        required: true,
                        //onlyArabic: true

                    },
                    agaza_program_include_en: {
                        required: true,
                        //onlyEnglish: true

                    },
                    agaza_desc_ar: {
                        required: true,
                        //onlyArabic: true

                    },
                    agaza_desc_en: {
                        required: true,
                        //onlyEnglish: true

                    },
                    agaza_keywords_ar: {
                        required: true,
                        //onlyArabic: true

                    },
                    agaza_keywords_en: {
                        required: true,
                        //onlyEnglish: true

                    },
                    branches_id: {
                        required: true
                    }
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
            $('#addEditPrograms .submit-form').click(function () {
                if ($('#addEditProgramsForm').validate().form()) {
                    $('#addEditProgramsForm').submit();
                }
                return false;
            });
            $('#addEditProgramsForm input').keypress(function (e) {
                if (e.which == 13) {
                    if ($('#addEditProgramsForm').validate().form()) {
                        $('#addEditProgramsForm').submit();
                    }
                    return false;
                }
            });



            $('#addEditProgramsForm').submit(function () {
                var id = $('#id').val();
                var action = config.admin_url + '/programs/add';
                if (id != 0) {
                    action = config.admin_url + '/programs/edit';
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
                            Programs_grid.api().ajax.reload();
                            if (id != 0) {
                                $('#addEditPrograms').modal('hide');
                            } else {
                                Programs.programs_empty();
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

            var action = config.admin_url + '/programs/add_images';
            $('#addEditProgramsImages .submit-form').click(function () {
                var program_id = $('#program_id').val();
                var inputFile = $('#program_images');
                var formData = new FormData($("#addEditProgramsImagesForm")[0]);
                var fileToUpload = inputFile[0].files;
                //return false;
                for (var x = 0; x < fileToUpload.length; x++) {
                    formData.append('file[]', fileToUpload[x]);
                }
                formData.append('program_id', program_id);


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
                            $('#addEditProgramsImages').modal('hide');
                            //handleListImagesOnServer(program_id);   make error
                            //Programs.programs_empty();
                            //$("#files-not-uploaded").html('');

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
            var action = config.admin_url + '/programs/listFiles';
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

                            items.push('<div style="position:relative;float:right;padding: 5px 5px;"><img style="height:80px;width:80px;" src="' + config.base_url + 'uploads/programs_slider/' + data.data[x].image + '"/><div style="position: absolute; top: -3px; left: 4px; width: 15px; height: 15px; text-align: center; line-height: 15px; background: #ab0101; border-radius: 50px;"><a href="" class="program_image" data-id="' + data.data[x].id + '" data-program-id="' + data.data[x].programs_id + '" data-image="' + data.data[x].image + '" style="color:#fff;">x</a></div></div>');
                        }
                        $("#programs-images-box").html('').html(items.join(''));

                    } else {
                        $("#programs-images-box").html('');
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
            $(document).on('click', '.program_image', function () {
                var image_id = $(this).data('id');
                var program_id = $(this).data('program-id');
                var image = $(this).data('image');
                var action = config.admin_url + '/programs/remove_image';
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
                            $('#addEditProgramsImages .submit-form').prop('disabled', true);
                            $('#addEditProgramsImages .submit-form').html('جارى الحذف...');
                            setTimeout(function () {
                                handleListImagesOnServer(program_id);
                                $('#addEditProgramsImages .submit-form').prop('disabled', false);
                                $('#addEditProgramsImages .submit-form').html('حفظ');
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
        var handleShowInSlider = function () {
            $('#show_in_slider').on('change', function () {
                var show_in_slider = $(this).val();
                if (show_in_slider == 1) {
                    $('#slider-image-upload-box').slideDown(500);
                    $("#prog_slider_image").rules("add", {
                        required: true,
                        messages: {
                            required: "لا يوجد ملف للرفع",
                        }
                    });
                } else {
                    $("#prog_slider_image").rules("remove", "required");
                    $("#prog_slider_image").closest('.form-group').removeClass('has-error');
                    $("#prog_slider_image").closest('.form-group').find('.help-block').html('');
                    $('#slider-image-upload-box').slideUp(500);
                }
            });
        }

        return {
            init: function () {
                init();
            },
            edit_programs: function (t) {



                App.editForm({
                    element: t,
                    url: config.admin_url + '/programs/row',
                    data: {id: $(t).attr("data-id")},
                    success: function (data)
                    {
                        console.log(data);
                        Programs.programs_empty();
                        App.setModalTitle('#addEditPrograms', 'تعديل');

                        for (i in data.message)
                        {
                            if (i == 'image') {
                                $('.image_uploaded').html('<img style="height:80px;width:150px;" id="image_upload_preview" src="' + data.message.agazabook_url + '/uploads/programs/' + data.message[i] + '" alt="your image" />');
                            } else if (i == 'parent_category_id') {
                                $('#' + i).val(data.message[i]);
                                getSubCategories(data.message[i], data.message.category_id, 'category_id');

                            } else if (i == 'show_in_slider' && data.message[i] == 0) {
                                //alert('here');
                                $('#' + i).val(data.message[i]);

                            } else if (i == 'company_id') {
                                //alert('here');
                                $('#branches_id').val(data.message[i]);

                            } else if (i == 'show_in_slider' && data.message[i] == 1) {
                                $('#' + i).val(data.message[i]);
                                $('#slider-image-upload-box').slideDown(500);
                                $('.slider_image_uploaded').html('<img style="height:80px;width:150px;" id="image_upload_preview" src="' + data.message.agazabook_url + '/uploads/programs_slider/' + data.message['slider_image'] + '" alt="your image" />');

                            } else {
                                $('#' + i).val(data.message[i]);
                            }

                        }
                        $('#addEditPrograms').modal('show');
                    }
                });

            },
            delete_programs: function (t) {
                $.confirm({
                    title: lang.alert_message,
                    content: lang.confirm_message_title,
                    buttons: {
                        confirm: {
                            text: lang.yes,
                            action: function () {
                                App.deleteForm({
                                    element: t,
                                    url: config.admin_url + '/programs/delete',
                                    data: {id: $(t).attr("data-id")},
                                    success: function (data)
                                    {
                                        $.alert(data.message);
                                        Programs_grid.api().ajax.reload();


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
           
            add_programs: function () {

                Programs.programs_empty();
                App.setModalTitle('#addEditPrograms', 'اضافة');
                $('#addEditPrograms').modal('show');
            },
            add_images: function (element) {
                $('#program_id').val($(element).data('id'));
                $("#program-images-box").html('');
                $("#program_images").val('');
                handleListImagesOnServer($(element).data('id'));
                App.setModalTitle('#addEditProgramsImages', 'اضافة');
                $('#addEditProgramsImages').modal('show');
            },
            programs_empty: function () {
                $('#id').val(0)
                $('#prog_main_image').val('');
                $('#prog_slider_image').val('');
                $('.image_uploaded').html('<img src="' + config.base_url + 'no-image.jpg" width="150" height="80" />');
                $('.slider_image_uploaded').html('<img src="' + config.base_url + 'no-image.jpg" width="150" height="80" />');
                $('#show_in_slider').find('option').eq(0).prop('selected', true);
                $('#show_in_agazabook').find('option').eq(0).prop('selected', true);
                $('#parent_category_id').find('option').eq(0).prop('selected', true);
                $('#category_id').html('<option selected disabled>اختر</option>');
                $('#slider-image-upload-box').slideUp(500);
                $('#active').find('option').eq(0).prop('selected', true);
                $('#special_offer').find('option').eq(0).prop('selected', true);
                $('.has-error').removeClass('has-error');
                $('.has-success').removeClass('has-success');
                $('.help-block').html('');
                App.emptyForm();
            },
            programs_images_empty: function () {
                $("#hotel-images-box").html('');
                $("#hotel_images").val('');
            },
        };

    }();
    jQuery(document).ready(function () {
        Programs.init();
    });

