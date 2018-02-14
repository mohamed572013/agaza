    var Shrines_grid;

    var Shrines = function () {

        var init = function () {
            //alert('here');
            $.extend(lang, new_lang);
            //console.log(lang);
            handleRecords();
            handleSubmit();
            handleCountriesChange();
            readImage();
            handleImagesFormSubmit();
            remove_image();

        };
        var readImage = function (input) {
            $("#image").change(function () {
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
        var handleCountriesChange = function () {
            $("#country_id").change(function () {
                var country_id = $("#country_id").val();
                $.ajax({
                    type: "post",
                    url: config.admin_url + "/maka_madina_shrines/gatCountryCities",
                    data: {country_id: country_id},
                    success: function (data) {
                        $("#places_id").html(data);
                    }
                });
            });
        }
        var handleRecords = function () {
            //alert('here2');
            Shrines_grid = $('.dataTable').dataTable({
                //"processing": true,
                "serverSide": true,
                "ajax": {
                    "url": config.admin_url + "/maka_madina_shrines/data",
                    "type": "POST"
                },
                "columns": [
//                    {"data": "user_input", orderable: false, "class": "text-center"},
                    {"data": "shrine_title_ar"},
                    {"data": "city_title_ar"},
                    {"data": "shrine_image"},
                    {"data": "images"},
                    {"data": "options", orderable: false, "class": "text-center"}
                ],
                "order": [
                    [1, "desc"]
                ]

            });
        }
        var getPlaces = function (place_id, selected_id, content) {
            $.ajax({
                type: "post",
                url: config.admin_url + '/maka_madina_shrines/getPlaces',
                data: {
                    place_id: place_id,
                    selected_id: selected_id,
                },
                success: function (data) {
                    console.log(data)
                    $("#" + content).html(data);
                }
            });
        }
        var handleImagesFormSubmit = function () {

            var action = config.admin_url + '/maka_madina_shrines/add_images';
            $('#addEditShrinesImages .submit-form').click(function () {
                var shrine_id = $('#shrine_id').val();
                var inputFile = $('#shrine_images');
                var formData = new FormData($("#addEditShrinesImagesForm")[0]);
                var fileToUpload = inputFile[0].files;
                //return false;
                for (var x = 0; x < fileToUpload.length; x++) {
                    formData.append('file[]', fileToUpload[x]);
                }
                formData.append('shrine_id', shrine_id);


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
                            $('#addEditShrinesImages').modal('hide');
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
        var handleListImagesOnServer = function (shrine_id) {
            var action = config.admin_url + '/Maka_madina_shrines/listFiles';
            $.ajax({
                url: action,
                data: {shrine_id: shrine_id},
                async: false,
                success: function (data) {
                    console.log(data);

                    if (data.type == 'success')
                    {
                        var items = [];
                        for (var x = 0; x < data.data.length; x++) {

                            items.push('<div style="position:relative;float:right;padding: 5px 5px;"><img style="height:80px;width:80px;" src="' + config.base_url + 'uploads/shrines_slider/' + data.data[x].image + '"/><div style="position: absolute; top: -3px; left: 4px; width: 15px; height: 15px; text-align: center; line-height: 15px; background: #ab0101; border-radius: 50px;"><a href="" class="shrine_image" data-id="' + data.data[x].id + '" data-shrine-id="' + data.data[x].shrine_id + '" data-image="' + data.data[x].image + '" style="color:#fff;">x</a></div></div>');
                        }
                        $("#shrines-images-box").html('').html(items.join(''));

                    } else {
                        $("#shrines-images-box").html('');
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
            $(document).on('click', '.shrine_image', function () {
                var image_id = $(this).data('id');
                var shrine_id = $(this).data('shrine-id');
                var image = $(this).data('image');
                var action = config.admin_url + '/maka_madina_shrines/remove_image';
                $.ajax({
                    url: action,
                    data: {
                        image_id: image_id,
                        shrine_id: shrine_id,
                        image: image
                    },
                    async: false,
                    success: function (data) {
                        console.log(data);

                        if (data.type == 'success')
                        {
                            $('#addEditShrinesImages .submit-form').prop('disabled', true);
                            $('#addEditShrinesImages .submit-form').html('جارى الحذف...');
                            setTimeout(function () {
                                handleListImagesOnServer(shrine_id);
                                $('#addEditShrinesImages .submit-form').prop('disabled', false);
                                $('#addEditShrinesImages .submit-form').html('حفظ');
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
        var handleSubmit = function () {
            
            $('#addEditShrinesForm').validate({
                rules: {
                    this_order: {
                        required: true,
                        number: true,
                    },
                    country_id: {
                        required: true

                    },
                    places_id: {
                        required: true

                    },
                    title_ar: {
                        required: true,
                     

                    },
                    title_en: {
                        required: true,
                       

                    },
                    body_ar: {
                        required: true,
                      

                    },
                    body_en: {
                        required: true,
                      

                    },
                    desc_ar: {
                        required: true,
                       

                    },
                    desc_en: {
                        required: true,
                       

                    },
                    keywords_ar: {
                        required: true,
                     

                    },
                    keywords_en: {
                        required: true,
                   

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
                if ($('#addEditShrinesForm').validate().form()) {
                    $('#addEditShrinesForm').submit();
                }
                return false;
            });
            $('#addEditShrinesForm input').keypress(function (e) {
                if (e.which == 13) {
                    if ($('#addEditShrinesForm').validate().form()) {
                        $('#addEditShrinesForm').submit();
                    }
                    return false;
                }
            });



            $('#addEditShrinesForm').submit(function () {
                var id = $('#id').val();
                var action = config.admin_url + '/maka_madina_shrines/add';
                if (id != 0) {
                    action = config.admin_url + '/maka_madina_shrines/edit';
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
                            Shrines_grid.api().ajax.reload();

                            if (id != 0) {
                                $('#addEditShrines').modal('hide');
                            } else {
                                Shrines.empty();
                            }

                        } else {
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

        return {
            init: function () {
                init();
            },
            edit: function (t) {



                App.editForm({
                    element: t,
                    url: config.admin_url + '/maka_madina_shrines/row',
                    data: {id: $(t).attr("data-id")},
                    success: function (data)
                    {
                        console.log(data);
                        Shrines.empty();
                        App.setModalTitle('#addEditShrines', 'تعديل');

                        for (i in data.message)
                        {

                            if (i == 'country_id') {
                                $('#' + i).val(data.message[i]);
                                getPlaces(data.message[i], data.message.places_id, 'places_id');
                            } else if (i == 'image') {
                                $('.image_uploaded').html('<img style="height:80px;width:150px;" id="image_upload_preview" src="' + config.base_url + 'uploads/maka_madina_shrines/' + data.message[i] + '" alt="your image" />');

                            } else {
                                $('#' + i).val(data.message[i]);
                            }

                        }
                        $('#addEditShrines').modal('show');
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
                                    url: config.admin_url + '/maka_madina_shrines/delete',
                                    data: {id: $(t).attr("data-id")},
                                    success: function (data)
                                    {
                                        $.alert(data.message);
                                        Shrines_grid.api().ajax.reload();


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
                Shrines.empty();
                App.setModalTitle('#addEditShrines', 'اضافة');
                $('#addEditShrines').modal('show');
            },
            add_images: function (element) {
                $('#shrine_id').val($(element).data('id'));
                $("#shrines-images-box").html('');
                $("#shrine_images").val('');
                handleListImagesOnServer($(element).data('id'));
                App.setModalTitle('#addEditShrinesImages', 'اضافة');
                $('#addEditShrinesImages').modal('show');
            },
            empty: function () {
                $('#id').val(0);
                $('#active').find('option').eq(0).prop('selected', true);
                $('#country_id').find('option').eq(0).prop('selected', true);
                $('#places_id').html('<option selected disabled>اختر</option>');
                $('.has-error').removeClass('has-error');
                $('.has-success').removeClass('has-success');
                App.emptyForm();
            },
        };

    }();
    jQuery(document).ready(function () {
        Shrines.init();
    });

