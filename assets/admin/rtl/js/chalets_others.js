    var Chalets_others_grid;
    var Chalets_others = function () {

        var init = function () {
            $.extend(lang, new_lang);
            handleRecords();
            handleSubmit();

        };
        var handleRecords = function () {

            Chalets_others_grid = $('.dataTable').dataTable({
                //"processing": true,
                "serverSide": true,
                "ajax": {
                    "url": config.admin_url + "/chalets_others/data",
                    "type": "POST"
                },
                "columns": [
//                    {"data": "user_input", orderable: false, "class": "text-center"},
                    {"data": "title_ar"},
                    {"data": "active"},
                    {"data": "options", orderable: false, "class": "text-center"}
                ],
                "order": [
                    [1, "desc"]
                ]

            });
        }
        var handleSubmit = function () {

            $('#addEditHotelChaletsOthersForm').validate({
                rules: {
                    title_ar: {
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
            $('.submit-form').click(function () {
                if ($('#addEditHotelChaletsOthersForm').validate().form()) {
                    $('#addEditHotelChaletsOthersForm').submit();
                }
                return false;
            });
            $('#addEditHotelChaletsOthersForm input').keypress(function (e) {
                if (e.which == 13) {
                    if ($('#addEditHotelChaletsOthersForm').validate().form()) {
                        $('#addEditHotelChaletsOthersForm').submit();
                    }
                    return false;
                }
            });



            $('#addEditHotelChaletsOthersForm').submit(function () {
                var chalets_others_id = $('#chalets_others_id').val();
                var action = config.admin_url + '/chalets_others/add';
                if (chalets_others_id != 0) {
                    action = config.admin_url + '/chalets_others/edit';
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
                            //alert(Chalets_others_grid);
                            Chalets_others_grid.api().ajax.reload();

                            if (chalets_others_id != 0) {
                                $('#addEditHotelChaletsOthers').modal('hide');
                            } else {
                                Chalets_others.empty();
                            }

                        } else {
                            console.log(data)
                            if (typeof data.errors !== 'undefined' && typeof data.errors === 'object') {
                                for (i in data.errors)
                                {
                                    $('[name="' + i + '"]')
                                            .closest('.form-group').addClass('has-error').removeClass("has-info");
                                    $('#' + i).parent().find(".help-block").html(data.errors[i])
                                }
                            }
                            if (typeof data.message !== 'undefined' && typeof data.message !== 'object') {
                                //alert('here2');
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
                    url: config.admin_url + '/chalets_others/row',
                    data: {chalets_others_id: $(t).attr("data-id")},
                    success: function (data)
                    {
                        console.log(data);

                        Chalets_others.empty();
                        App.setModalTitle('#addEditHotelChaletsOthers', 'تعديل');

                        for (i in data.message)
                        {

                            if (i == 'id') {
                                $('#chalets_others_id').val(data.message[i]);

                            } else {
                                $('#' + i).val(data.message[i]);
                            }

                        }
                        $('#addEditHotelChaletsOthers').modal('show');
                    }
                });

            },
            delete: function (t) {

                App.deleteForm({
                    element: t,
                    url: config.admin_url + '/chalets_others/delete',
                    data: {chalets_others_id: $(t).attr("data-id")},
                    success: function (data)
                    {

                        Chalets_others_grid.api().ajax.reload();


                    }
                });
            },
            add: function () {
                Chalets_others.empty();
                App.setModalTitle('#addEditHotelChaletsOthers', 'اضافة');
                $('#addEditHotelChaletsOthers').modal('show');
            },
            empty: function () {
                $('#chalets_others_id').val(0);
                $('#active').find('option').eq(0).prop('selected', true);
                $('.has-error').removeClass('has-error');
                $('.has-success').removeClass('has-success');
                $('.help-block').html('');
                App.emptyForm();
            },
        };

    }();
    jQuery(document).ready(function () {
        Chalets_others.init();
    });

    /*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */


