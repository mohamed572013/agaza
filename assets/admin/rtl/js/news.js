    var News_grid;

    var News = function () {

        var init = function () {
            $.extend(lang, new_lang);
            handleRecords();            
            handleSubmit();
            readImage();

        };


        var readImage = function () {
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
    
        var handleRecords = function () {
            News_grid = $('#news_table .dataTable').dataTable({
                //"processing": true,
                "serverSide": true,
                "ajax": {
                    "url": config.admin_url + "/news/data",
                    "type": "POST"
                },
                "columns": [
                    {"data": "title_ar"},
                    {"data": "main_image"},
                    {"data": "active"},
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
            $('#addEditNewsForm').validate({
                rules: {
                    title_ar: {
                        required: true,
                        //onlyArabic: true

                    },
                    
                    the_order: {
                        required: true,
                        number: true

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
            $('#addEditNews .submit-form').click(function () {
                if ($('#addEditNewsForm').validate().form()) {
                    $('#addEditNewsForm').submit();
                }
                return false;
            });
            $('#addEditNewsForm input').keypress(function (e) {
                if (e.which == 13) {
                    if ($('#addEditNewsForm').validate().form()) {
                        $('#addEditNewsForm').submit();
                    }
                    return false;
                }
            });



            $('#addEditNewsForm').submit(function () {

                var news_id = $('#news_id').val();
                
                var action = config.admin_url + '/news/add';
                if (news_id != 0) {
                    action = config.admin_url + '/news/edit';
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
                            News_grid.api().ajax.reload();
                            if (client_id != 0) {
                                $('#addEditClients').modal('hide');
                            } else {
                                News.news_empty();
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


        return {
            init: function () {
                init();
            },
            edit_news: function (t) {



                App.editForm({
                    element: t,
                    url: config.admin_url + '/news/row',
                    data: {news_id: $(t).attr("data-id")},
                    success: function (data)
                    {
                        $('#addEditNews').modal('show');
                        console.log(data);

                        News.news_empty();
                        App.setModalTitle('#addEditNews', 'تعديل');

                        for (i in data.message)
                        {
                            if (i == 'id') {
                                $('#news_id').val(data.message[i]);                            
                            } else if (i == 'image') {
                                $('.image_uploaded').html('<img style="height:80px;width:150px;" id="image_upload_preview" src="' + config.base_url + 'uploads/news/' + data.message[i] + '" alt="your image" />');

                            } else if (i == 'tags') {
                                $('#' + i).val(data.message[i]);

                            } else {
                                //console.log(data.message[i]);
                                $('#' + i).val(data.message[i]);
                            }

                        }
                        $('#addEditNews').modal('show');
                    }
                });

            },
            delete_news: function (t) {
                $.confirm({
                    title: lang.alert_message,
                    content: lang.confirm_message_title,
                    buttons: {
                        confirm: {
                            text: lang.yes,
                            action: function () {
                                App.deleteForm({
                                    element: t,
                                    url: config.admin_url + '/news/delete',
                                    data: {news_id: $(t).attr("data-id")},
                                    success: function (data)
                                    {
                                        $.alert(data.message);
                                        News_grid.api().ajax.reload();


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
            add_mews: function () {
                News.news_empty();
                App.setModalTitle('#addEditNews', 'اضافة');
                $('.image_uploaded').html('<img style="height:80px;width:150px;" id="image_upload_preview" src="' + config.base_url + 'no-image.jpg" alt="your image" />');
                $('#addEditNews').modal('show');
            },
            
            news_empty: function () {
                $('#news_id').val(0)
                $('#image').val('');
                $('select').find('option').eq(0).prop('selected', true);
                $('.has-error').removeClass('has-error');
                $('.has-success').removeClass('has-success');
                App.emptyForm();
            },
            
        };

    }();
    jQuery(document).ready(function () {
        News.init();
    });

