    var Companies_grid;
    var Branches_grid;
    var Employees_grid;
    var company_id;
    var branch_id;

    var Companies = function () {

        var init = function () {
            $.extend(lang, new_lang);
            $.extend(config, new_config);
            //handleRecords();
            handleSubmit();
            handleBranchesSubmit();
            handleEmployeesSubmit();
            handleDatatables();


        };
        var handleDatatables = function () {
            $(document).on('click', '.data-box', function () {
                var box_type = $(this).data('type');
                if (box_type == 'companies') {
                    if (!$('#companies_table').hasClass('active')) {
                        $('.table-box').removeClass('active').addClass('disabled');
                        $('#companies_table').removeClass('disabled').addClass('active');

                    }

                    if (typeof Companies_grid === 'undefined') {


                        Companies_grid = $('#companies_table .dataTable').dataTable({
                            "serverSide": true,
                            "ajax": {
                                "url": config.admin_url + "/branches/data",
                                "type": "POST",
                            },
                            "columns": [
//                    {"data": "user_input", orderable: false, "class": "text-center"},
                                {"data": "code"},
                                {"data": "title_ar"},
                                {"data": "title_en"},
                                {"data": "departments"},
                                {"data": "active"},
                                {"data": "options", orderable: false, "class": "text-center"}
                            ],
                            "order": [
                                [1, "desc"]
                            ]

                        });
                    } else {
                        Companies_grid.api().ajax.url(config.admin_url + "/branches/data").load();
                    }
                }
                if (box_type == 'branches') {
                    company_id = $(this).data('id');
                    if (!$('#branches_table').hasClass('active')) {
                        $('.table-box').removeClass('active').addClass('disabled');
                        $('#branches_table').removeClass('disabled').addClass('active');

                    }

                    if (typeof Branches_grid === 'undefined') {


                        Branches_grid = $('#branches_table .dataTable').DataTable({
                            //"processing": true,
                            "serverSide": true,
                            "ajax": {
                                "url": config.admin_url + "/departments/data/?company_id=" + company_id,
                                "type": "POST"
                            },
                            "columns": [
//                    {"data": "user_input", orderable: false, "class": "text-center"},
                                {"data": "title_ar"},
                                {"data": "title_en"},
                                {"data": "employees"},
                                {"data": "active"},
                                {"data": "options", orderable: false, "class": "text-center"}
                            ],
                            "order": [
                                [1, "desc"]
                            ]

                        });
                    } else {
                        Branches_grid.ajax.url(config.admin_url + "/departments/data/?company_id=" + company_id).load();
                    }
                }
                if (box_type == 'employees') {
                    company_id = $(this).data('branches-id');
                    branch_id = $(this).data('departments-id');
                    if (!$('#employees_table').hasClass('active')) {
                        $('.table-box').removeClass('active').addClass('disabled');
                        $('#employees_table').removeClass('disabled').addClass('active');

                    }

                    if (typeof Employees_grid === 'undefined') {


                        Employees_grid = $('#employees_table .dataTable').DataTable({
                            //"processing": true,
                            "serverSide": true,
                            "ajax": {
                                "url": config.admin_url + "/employees/data/?company_id=" + company_id + "&branch_id=" + branch_id,
                                "type": "POST"
                            },
                            "columns": [
//                    {"data": "user_input", orderable: false, "class": "text-center"},
                                {"data": "title_ar"},
                                {"data": "title_en"},
                                {"data": "email"},
                                {"data": "active"},
                                {"data": "options", orderable: false, "class": "text-center"}
                            ],
                            "order": [
                                [1, "desc"]
                            ]

                        });
                    } else {
                        Employees_grid.ajax.url(config.admin_url + "/employees/data/?company_id=" + company_id + "&branch_id=" + branch_id).load();
                    }
                }


                return false;
            });
        }


        var handleRecords = function () {
            Companies_grid = $('#companies_table .dataTable').dataTable({
                //"processing": true,
                "serverSide": true,
                "ajax": {
                    "url": config.admin_url + "/branches/data",
                    "type": "POST",
                },
                "columns": [
//                    {"data": "user_input", orderable: false, "class": "text-center"},
                    {"data": "code"},
                    {"data": "title_ar"},
                    {"data": "title_en"},
                    {"data": "departments"},
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
            $('#addEditCompaniesForm').validate({
                rules: {
                    code: {
                        required: true,
                    },
                    title_ar: {
                        required: true,
                        onlyArabic: true

                    },
                    title_en: {
                        required: true,
                        onlyEnglish: true

                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    phone: {
                        required: true,
                        number: true,
                    },
                    address: {
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
            if (config.user_type == 'owner') {
                $("#site_url").rules("add", {
                    required: true,
                    messages: {
                        required: "هذا الحقل مطلوب",
                    }
                });
            }
            if (config.user_type == 'super admin') {
                $("input[name='pay_ways_id']").rules("add", {
                    required: true,
                    messages: {
                        required: "هذا الحقل مطلوب"
                    }
                });
                $("#pay_way_value").rules("add", {
                    required: true,
                    messages: {
                        required: "هذا الحقل مطلوب"
                    }
                });
                $("input[name='discount_types_id']").rules("add", {
                    required: true,
                    messages: {
                        required: "هذا الحقل مطلوب"
                    }
                });
                $("#discount_value").rules("add", {
                    required: true,
                    messages: {
                        required: "هذا الحقل مطلوب"
                    }
                });
            }
            $('#addEditCompanies .submit-form').click(function () {
                if ($('#addEditCompaniesForm').validate().form()) {
                    $('#addEditCompaniesForm').submit();
                }
                return false;
            });
            $('#addEditCompaniesForm input').keypress(function (e) {
                if (e.which == 13) {
                    if ($('#addEditCompaniesForm').validate().form()) {
                        $('#addEditCompaniesForm').submit();
                    }
                    return false;
                }
            });



            $('#addEditCompaniesForm').submit(function () {
                var id = $('#id').val();
                var action = config.admin_url + '/branches/add';
                if (id != 0) {
                    action = config.admin_url + '/branches/edit';
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
                            Companies_grid.api().ajax.reload();
                            if (id != 0) {
                                $('#addEditCompanies').modal('hide');
                            } else {
                                Companies.empty();
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
        var handleBranchesSubmit = function () {
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
            $('#addEditBranchesForm').validate({
                rules: {
                    title_ar: {
                        required: true,
                        onlyArabic: true

                    },
                    title_en: {
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
            $('#addEditBranches .submit-form').click(function () {
                if ($('#addEditBranchesForm').validate().form()) {
                    $('#addEditBranchesForm').submit();
                }
                return false;
            });
            $('#addEditBranchesForm input').keypress(function (e) {
                if (e.which == 13) {
                    if ($('#addEditBranchesForm').validate().form()) {
                        $('#addEditBranchesForm').submit();
                    }
                    return false;
                }
            });



            $('#addEditBranchesForm').submit(function () {
                var departments_id = $('#departments_id').val();
                var action = config.admin_url + '/departments/add';
                if (departments_id != 0) {
                    action = config.admin_url + '/departments/edit';
                }
                var formData = new FormData($(this)[0]);
                formData.append('id', departments_id);
                formData.append('branches_id', company_id);
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
                            Branches_grid.ajax.reload();
                            if (departments_id != 0) {
                                $('#addEditBranches').modal('hide');
                            } else {
                                Companies.empty();
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
        var handleEmployeesSubmit = function () {
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
            $('#addEditEmployeesForm').validate({
                rules: {
                    e_title_ar: {
                        required: true,
                        onlyArabic: true
                    },
                    e_title_en: {
                        required: true,
                        onlyEnglish: true
                    },
                    gender: {
                        required: true,
                    },
                    job_title: {
                        required: true,
                    },
                    e_email: {
                        required: true,
                        email: true,
                    },
                    password: {
                        required: true,
                    },
                    start_working_date: {
                        required: true,
                    },
                    e_address: {
                        required: true,
                    },
                    emergency_phone_1: {
                        required: true,
                        number: true,
                    },
                    emergency_name_1: {
                        required: true,
                    },
                    emergency_phone_2: {
                        required: true,
                        number: true,
                    },
                    emergency_name_2: {
                        required: true,
                    },
                },
                messages: lang.employees_messages,
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

            $('#addEditEmployees .submit-form').click(function () {
                var employees_id = $('#employees_id').val();
                if (employees_id != 0) {
                    $("#password").rules("remove", "required");
                }
                if ($('#addEditEmployeesForm').validate().form()) {
                    $('#addEditEmployeesForm').submit();
                }
                return false;
            });
            $('#addEditEmployeesForm input').keypress(function (e) {
                if (e.which == 13) {
                    var employees_id = $('#employees_id').val();
                    if (employees_id != 0) {
                        $("#password").rules("remove", "required");
                    }
                    if ($('#addEditEmployeesForm').validate().form()) {
                        $('#addEditEmployeesForm').submit();
                    }
                    return false;
                }
            });



            $('#addEditEmployeesForm').submit(function () {
                var employees_id = $('#employees_id').val();
                var action = config.admin_url + '/employees/add';
                if (employees_id != 0) {
                    action = config.admin_url + '/employees/edit';
                }
                var formData = new FormData($(this)[0]);
                formData.append('id', employees_id);
                formData.append('branches_id', company_id);
                formData.append('departments_id', branch_id);
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
                            Employees_grid.ajax.reload();
                            if (employees_id != 0) {
                                $('#addEditEmployees').modal('hide');
                            } else {
                                Companies.empty();
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
                    url: config.admin_url + '/branches/row',
                    data: {id: $(t).attr("data-id")},
                    success: function (data)
                    {
                        console.log(data);

                        Companies.empty();
                        App.setModalTitle('#addEditCompanies', 'تعديل');

                        for (i in data.message)
                        {
                            if (i == 'pay_ways_id') {
                                $('#pay_ways_' + data.message[i]).prop('checked', true);
                            } else if (i == 'discount_types_id') {
                                $('#discount_types_' + data.message[i]).prop('checked', true);
                            } else {
                                $('#' + i).val(data.message[i]);
                            }
                        }
                        $('#addEditCompanies').modal('show');
                    }
                });

            },
            edit_branches: function (t) {



                App.editForm({
                    element: t,
                    url: config.admin_url + '/departments/row',
                    data: {id: $(t).attr("data-id")},
                    success: function (data)
                    {
                        console.log(data);

                        Companies.empty();
                        App.setModalTitle('#addEditBranches', 'تعديل');

                        for (i in data.message)
                        {
                            if (i == 'id') {

                                $('#departments_id').val(data.message[i]);

                            } else {
                                $('#d_' + i).val(data.message[i]);
                            }
                        }
                        $('#addEditBranches').modal('show');
                    }
                });

            },
            edit_employees: function (t) {



                App.editForm({
                    element: t,
                    url: config.admin_url + '/employees/row',
                    data: {id: $(t).attr("data-id")},
                    success: function (data)
                    {
                        console.log(data);

                        Companies.empty();
                        App.setModalTitle('#addEditEmployees', 'تعديل');

                        for (i in data.message)
                        {
                            if (i == 'id') {

                                $('#employees_id').val(data.message[i]);

                            } else if (i == 'address' || i == 'email' || i == 'active' || i == 'title_ar' || i == 'title_en') {
                                $('#e_' + i).val(data.message[i]);

                            } else if (i == 'password') {

                            } else {
                                $('#' + i).val(data.message[i]);
                            }
                        }
                        $('#addEditEmployees').modal('show');
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
                                    url: config.admin_url + '/branches/delete',
                                    data: {id: $(t).attr("data-id")},
                                    success: function (data)
                                    {
                                        $.alert(data.message);
                                        Companies_grid.api().ajax.reload();


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
            delete_branches: function (t) {
                $.confirm({
                    title: lang.alert_message,
                    content: lang.confirm_message_title,
                    buttons: {
                        confirm: {
                            text: lang.yes,
                            action: function () {
                                App.deleteForm({
                                    element: t,
                                    url: config.admin_url + '/departments/delete',
                                    data: {id: $(t).attr("data-id")},
                                    success: function (data)
                                    {
                                        $.alert(data.message);
                                        Branches_grid.api().ajax.reload();


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
            delete_employees: function (t) {
                $.confirm({
                    title: lang.alert_message,
                    content: lang.confirm_message_title,
                    buttons: {
                        confirm: {
                            text: lang.yes,
                            action: function () {
                                App.deleteForm({
                                    element: t,
                                    url: config.admin_url + '/employees/delete',
                                    data: {id: $(t).attr("data-id")},
                                    success: function (data)
                                    {
                                        $.alert(data.message);
                                        Employees_grid.api().ajax.reload();


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
                Companies.empty();
                $('#id').val(0);
                $('#active').find('option').eq(0).prop('selected', true);
                App.setModalTitle('#addEditCompanies', 'اضافة');
                $('#addEditCompanies').modal('show');
            },
            add_branches: function () {
                Companies.empty();
                $('#departments_id').val(0);
                $('#d_active').find('option').eq(0).prop('selected', true);
                App.setModalTitle('#addEditBranches', 'اضافة');
                $('#addEditBranches').modal('show');
            },
            add_employees: function () {
                Companies.empty();
                $('#employees_id').val(0);
                $('#e_active').find('option').eq(0).prop('selected', true);
                $('#gender').find('option').eq(0).prop('selected', true);
                App.setModalTitle('#addEditEmployees', 'اضافة');
                $('#addEditEmployees').modal('show');
            },
            empty: function () {

                $('.has-error').removeClass('has-error');
                $('.has-success').removeClass('has-success');
                $('.help-block').html('');
                App.emptyForm();
            }
        };

    }();
    jQuery(document).ready(function () {
        Companies.init();
    });

