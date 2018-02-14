    var Hotels_grid;
    var Haj_umrah_hotels_images_grid;

    var Etiquette = function () {

        var init = function () {
            $.extend(lang, new_lang);
            handleRecords();
            //handleDatatables();
            handleSubmit();
            //handleListImagesOnServer();
            handleImagesFormSubmit();
            remove_image();
            handleChangeCountriesOrCities();
            readImage();

        };
    
        var handleRecords = function () {
            Hotels_grid = $('#hotels_table .dataTable').dataTable({
                //"processing": true,
                "serverSide": true,
                "ajax": {
                    "url": config.admin_url + "/etiquette/data",
                    "type": "POST"
                },
                "columns": [
//                    {"data": "user_input", orderable: false, "class": "text-center"},
                    {"data": "title_ar"},
                    //{"data": "city_title_ar"},
                    {"data": "main_image"},
                    {"data": "created"},
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
            $('#addEditEtiquetteForm').validate({
                rules: {
                    title_ar: {
                        required: true,
                        //onlyArabic: true

                    },
                    
                    the_order: {
                        required: true,
                        number: true

                    },
                   
                    content_ar: {
                        required: true,
                        //onlyArabic: true

                    },
                    tags: {
                        required: true,
                        //onlyEnglish: true

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
            $('#addEditEtiquette .submit-form').click(function () {
                if ($('#addEditEtiquetteForm').validate().form()) {
                    $('#addEditEtiquetteForm').submit();
                }
                return false;
            });
            $('#addEditEtiquetteForm input').keypress(function (e) {
                if (e.which == 13) {
                    if ($('#addEditEtiquetteForm').validate().form()) {
                        $('#addEditEtiquetteForm').submit();
                    }
                    return false;
                }
            });



            $('#addEditEtiquetteForm').submit(function () {

                var etiquette_id = $('#etiquette_id').val();
                
                var action = config.admin_url + '/etiquette/add';
                if (etiquette_id != 0) {
                    action = config.admin_url + '/etiquette/edit';
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
                            Hotels_grid.api().ajax.reload();
                            if (etiquette_id != 0) {
                                $('#addEditEtiquette').modal('hide');
                            } else {
                                Etiquette.hotels_empty();
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
            edit_hotels: function (t) {



                App.editForm({
                    element: t,
                    url: config.admin_url + '/etiquette/row',
                    data: {etiquette_id: $(t).attr("data-id")},
                    success: function (data)
                    {
                        $('#addEditEtiquette').modal('show');
                        console.log(data);

                        Etiquette.hotels_empty();
                        App.setModalTitle('#addEditEtiquette', 'تعديل');

                        for (i in data.message)
                        {
                            if (i == 'id') {
                                $('#etiquette_id').val(data.message[i]);                            
                            } else if (i == 'image') {
                                $('.image_uploaded').html('<img style="height:80px;width:150px;" id="image_upload_preview" src="' + config.base_url + 'uploads/etiquette/' + data.message[i] + '" alt="your image" />');

                            } else if (i == 'tags') {
                                $('#' + i).val(data.message[i]);

                            } else {
                                //console.log(data.message[i]);
                                $('#' + i).val(data.message[i]);
                            }

                        }
                        $('#addEditEtiquette').modal('show');
                    }
                });

            },
            delete_hotels: function (t) {
                $.confirm({
                    title: lang.alert_message,
                    content: lang.confirm_message_title,
                    buttons: {
                        confirm: {
                            text: lang.yes,
                            action: function () {
                                App.deleteForm({
                                    element: t,
                                    url: config.admin_url + '/Etiquette/delete',
                                    data: {etiquette_id: $(t).attr("data-id")},
                                    success: function (data)
                                    {
                                        $.alert(data.message);
                                        Hotels_grid.api().ajax.reload();


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
            add_etiquette: function () {
                Etiquette.hotels_empty();
                App.setModalTitle('#addEditEtiquette', 'اضافة');
                $('#addEditEtiquette').modal('show');
            },
            add_images: function (element) {
                $('#shop_id').val($(element).data('id'));
                $("#shop-images-box").html('');
                $("#shop_images").val('');
                handleListImagesOnServer($(element).data('id'));
                App.setModalTitle('#addEditShopsImages', 'اضافة');
                $('#addEditShopsImages').modal('show');
            },
            hotels_empty: function () {
                $('#Etiquette_id').val(0)
                $('#image').val('');
                $('select').find('option').eq(0).prop('selected', true);
                $('.has-error').removeClass('has-error');
                $('.has-success').removeClass('has-success');
                App.emptyForm();
            },
            hotel_images_empty: function () {
                $("#shop-images-box").html('');
                $("#shop_images").val('');
            },
        };

    }();
    jQuery(document).ready(function () {
        Etiquette.init();
    });

