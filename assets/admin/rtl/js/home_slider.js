    var Home_slider_grid;
    var Home_slider = function () {

        var init = function () {
            $.extend(lang, new_lang);
            handleHomeSliderTable();
            handleSubmit();
            readImage();


        };
        var readImage = function (input) {
            $("#home_slider_image").change(function () {
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
        var handleHomeSliderTable = function () {
            Home_slider_grid = $('.dataTable').dataTable({
                //"processing": true,
                "serverSide": true,
                "ajax": {
                    "url": config.admin_url + "/home_slider/data",
                    "type": "POST",
                },
                "columns": [
//                  {"data": "user_input", orderable: false, "class": "text-center"},
                    {"data": "first_title_en"},
                    {"data": "second_title_en"},
                    {"data": "image"},
                    {"data": "active"},
                    {"data": "options", orderable: false, }
                ],
                "order": [
                    [1, "desc"]
                ]

            });
        }
        var handleSubmit = function () {
            $('#addEditHomeSliderForm').validate({
                rules: {
                    this_order: {
                        required: true,
                    },
                    first_title_ar: {
                        required: true,
                    },
                    first_title_en: {
                        required: true,
                    },
                    second_title_ar: {
                        required: true,
                    },
                    second_title_en: {
                        required: true,
                    },
                    url: {
                        required: true,
                    },
                },
                messages: lang.messages,
                highlight: function (element) { // hightlight error inputs
                    $(element).closest('.form-group').removeClass('has-success').addClass('has-error');

                },
                unhighlight: function (element) {
                    $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
                    $(element).closest('.form-group').find('.help-block').html('').css('opacity', 0);

                },
                errorPlacement: function (error, element) {
                    $(element).closest('.form-group').find('.help-block').html($(error).html()).css('opacity', 1);
                }
            });
            $('#addEditHomeSlider .submit-form').click(function () {
                if ($('#addEditHomeSliderForm').validate().form()) {
                    $('#addEditHomeSliderForm').submit();
                }
                return false;
            });
            $('#addEditHomeSliderForm input').keypress(function (e) {
                if (e.which == 13) {
                    if ($('#addEditHomeSliderForm').validate().form()) {
                        $('#addEditHomeSliderForm').submit();
                    }
                    return false;
                }
            });



            $('#addEditHomeSliderForm').submit(function () {
                var id = $('#id').val();
                var action = config.admin_url + '/home_slider/add';
                if (id != 0) {
                    action = config.admin_url + '/home_slider/edit';
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
                            Home_slider_grid.api().ajax.reload();
                            if (id != 0) {
                                $('#addEditHomeSlider').modal('hide');
                            } else {
                                Home_slider.empty();
                            }

                        } else {
                            console.log(data)
                            if (typeof data.errors === 'object') {
                                for (i in data.errors)
                                {
                                    $('[name="' + i + '"]')
                                            .closest('.form-group').addClass('has-error');
                                    $('#' + i).parent().find(".help-block").html(data.errors[i]).css('opacity', 1)
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
                    url: config.admin_url + '/home_slider/row',
                    data: {id: $(t).attr("data-id")},
                    success: function (data)
                    {
                        console.log(data);

                        Home_slider.empty();
                        App.setModalTitle('#addEditHomeSlider', lang.edit_category);

                        for (i in data.message)
                        {
                            if (i == 'image') {
                                $('.image_uploaded').html('<img style="height:80px;width:150px;" id="image_upload_preview" src="' + config.base_url + 'uploads/home_slider/' + data.message[i] + '" alt="your image" />');
                            } else {
                                $('#' + i).val(data.message[i]);
                            }

                        }
                        $('#addEditHomeSlider').modal('show');
                    }
                });

            },
            delete: function (t) {
                App.deleteForm({
                    element: t,
                    url: config.admin_url + '/home_slider/delete',
                    data: {id: $(t).attr("data-id")},
                    success: function (data)
                    {
                        $.alert(data.message);
                        Home_slider_grid.api().ajax.reload();


                    }
                });

            },
            add: function () {
                Home_slider.empty();
                App.setModalTitle('#addEditHomeSlider', lang.add_category);
                $('#addEditHomeSlider').modal('show');
            },
            empty: function () {
                $('#id').val(0)
                $('#active').find('option').eq(0).prop('selected', true);
                $('.image_uploaded').html('<img src="' + config.base_url + 'no-image.jpg" width="150" height="80" />');
                $('.has-error').removeClass('has-error');
                $('.has-success').removeClass('has-success');
                $('.help-block').html('');
                App.emptyForm();
            }
        };

    }();
    jQuery(document).ready(function () {
        Home_slider.init();
    });




