var Program_categories_grid;
var parent_id = 0;

var Program_categories = function () {

    var init = function () {
        $.extend(lang, new_lang);
        handleMainCategoriesTable();
        handleSubCategoriesTable();
        handleSubmit();


    };


    var handleSubCategoriesTable = function () {
        $(document).on('click', '.sub_btn', function () {
            parent_id = $(this).data('id');
            if (typeof Program_categories_grid === 'undefined') {


                Program_categories_grid = $('#countries_table .dataTable').dataTable({
                    "serverSide": true,
                    "ajax": {
                        "url": config.admin_url + "/program_categories/data/?parent_id=" + parent_id,
                        "type": "POST",
                    },
                    "columns": [
//                    {"data": "user_input", orderable: false, "class": "text-center"},
                        {"data": "title_ar"},
                        {"data": "title_en"},
                        {"data": "sub"},
                        {"data": "active"},
                        {"data": "options", orderable: false, "class": "text-center"}
                    ],
                    "order": [
                        [1, "desc"]
                    ]

                });
            } else {
                Program_categories_grid.api().ajax.url(config.admin_url + "/program_categories/data/?parent_id=" + parent_id).load();
            }



            return false;
        });
    }
    var handleMainCategoriesTable = function () {
        Program_categories_grid = $('.dataTable').dataTable({
            //"processing": true,
            "serverSide": true,
            "ajax": {
                "url": config.admin_url + "/program_categories/data/?parent_id=" + parent_id,
                "type": "POST",
            },
            "columns": [
//                    {"data": "user_input", orderable: false, "class": "text-center"},
                {"data": "title_ar"},
                {"data": "title_en"},
                {"data": "sub"},
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
        $('#addEditProgramCategoriesForm').validate({
            rules: {
                title_ar: {
                    required: true,
                    onlyArabic: true

                },
                title_en: {
                    required: true,
                    onlyEnglish: true

                },
                active: {
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
        $('#addEditProgramCategories .submit-form').click(function () {
            if ($('#addEditProgramCategoriesForm').validate().form()) {
                $('#addEditProgramCategoriesForm').submit();
            }
            return false;
        });
        $('#addEditProgramCategoriesForm input').keypress(function (e) {
            if (e.which == 13) {
                if ($('#addEditProgramCategoriesForm').validate().form()) {
                    $('#addEditProgramCategoriesForm').submit();
                }
                return false;
            }
        });



        $('#addEditProgramCategoriesForm').submit(function () {
            var id = $('#id').val();
            var action = config.admin_url + '/program_categories/add';
            if (id != 0) {
                action = config.admin_url + '/program_categories/edit';
            }
            var formData = new FormData($(this)[0]);
            formData.append('parent_id', parent_id);
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
                        Program_categories_grid.api().ajax.reload();
                        if (id != 0) {
                            $('#addEditProgramCategories').modal('hide');
                        } else {
                            Program_categories.empty();
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
        edit: function (t) {



            App.editForm({
                element: t,
                url: config.admin_url + '/program_categories/row',
                data: {id: $(t).attr("data-id")},
                success: function (data)
                {
                    console.log(data);

                    Program_categories.empty();
                    App.setModalTitle('#addEditProgramCategories', 'تعديل');

                    for (i in data.message)
                    {

                        if (i == 'image') {
                            $('.image_uploaded').html('<img style="height:80px;width:150px;" id="image_upload_preview" src="' + config.base_url + 'uploads/places/' + data.message[i] + '" alt="your image" />');

                        } else {
                            $('#' + i).val(data.message[i]);
                        }

                    }
                    $('#addEditProgramCategories').modal('show');
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
                                url: config.admin_url + '/program_categories/delete',
                                data: {id: $(t).attr("data-id"), parent: $(t).attr("data-parent")},
                                success: function (data)
                                {
                                    $.alert(data.message);
                                    Program_categories_grid.api().ajax.reload();


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
            Program_categories.empty();
            App.setModalTitle('#addEditProgramCategories', 'اضافة');
            $('#addEditProgramCategories').modal('show');
        },
        empty: function () {
            $('#id').val(0)
            $('select').find('option').eq(0).prop('selected', true);
            $('.has-error').removeClass('has-error');
            $('.has-success').removeClass('has-success');
            $('.help-block').html('');
            App.emptyForm();
        }
    };

}();
jQuery(document).ready(function () {
    Program_categories.init();
});

