    var Hotels_grid;
    var Haj_umrah_hotels_images_grid;

    var Clients = function () {

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
                    "url": config.admin_url + "/clients/data",
                    "type": "POST"
                },
                "columns": [
//                    {"data": "user_input", orderable: false, "class": "text-center"},
                    {"data": "title_ar"},
                    //{"data": "city_title_ar"},
                    {"data": "main_image"},
                    {"data": "is_active"},
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
            $('#addEditClientsForm').validate({
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
            $('#addEditClients .submit-form').click(function () {
                if ($('#addEditClientsForm').validate().form()) {
                    $('#addEditClientsForm').submit();
                }
                return false;
            });
            $('#addEditEtiquetteForm input').keypress(function (e) {
                if (e.which == 13) {
                    if ($('#addEditClientsForm').validate().form()) {
                        $('#addEditClientsForm').submit();
                    }
                    return false;
                }
            });



            $('#addEditClientsForm').submit(function () {

                var client_id = $('#client_id').val();
                
                var action = config.admin_url + '/clients/add';
                if (client_id != 0) {
                    action = config.admin_url + '/clients/edit';
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
                            if (client_id != 0) {
                                $('#addEditClients').modal('hide');
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
                    url: config.admin_url + '/clients/row',
                    data: {client_id: $(t).attr("data-id")},
                    success: function (data)
                    {
                        $('#addEditClients').modal('show');
                        console.log(data);

                        Clients.hotels_empty();
                        App.setModalTitle('#addEditClients', 'تعديل');

                        for (i in data.message)
                        {
                            if (i == 'id') {
                                $('#client_id').val(data.message[i]);                            
                            } else if (i == 'image') {
                                $('.image_uploaded').html('<img style="height:80px;width:150px;" id="image_upload_preview" src="' + config.base_url + 'uploads/clients/' + data.message[i] + '" alt="your image" />');

                            } else if (i == 'tags') {
                                $('#' + i).val(data.message[i]);

                            } else {
                                //console.log(data.message[i]);
                                $('#' + i).val(data.message[i]);
                            }

                        }
                        $('#addEditClients').modal('show');
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
                                    url: config.admin_url + '/clients/delete',
                                    data: {client_id: $(t).attr("data-id")},
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
            add_clients: function () {
                Clients.hotels_empty();
                App.setModalTitle('#addEditClients', 'اضافة');
                $('#addEditClients').modal('show');
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
                $('#client_id').val(0)
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
        Clients.init();
    });

