    var Users = function () {

        var handleChangeAddToRadio = function () {
            $('.addToTypeRadio').on('change', function () {
                var type = $(this).val();
                if (type == 'other') {
                    $('.branches-box').slideDown(500, function () {

                        $('.departments-box').slideDown(500);
                    });
//                    if ($('#user_type').val() == 'super admin') {
//                        $('.branches-box').slideDown(500);
//                    }
//                    if ($('#user_type').val() == 'owner') {
//                        $('.branches-box').slideDown(500, function () {
//
//                            $('.departments-box').slideDown(500);
//                        });
//                    }

                    var branches_id = $('#branches_id option:selected').val();
                    //alert(branches_id);
                    var action = config.base_url + 'Ajax/gatBranchesDepartments';
                    $.ajax({
                        type: "post",
                        url: action,
                        data: {branches_id: branches_id},
                        success: function (data) {
                            console.log(data);
                            $("#departments_id").html(data);
                        }
                    });
                }
                if (type == 'me') {
                    $('#branches_id').find('option').eq(0).prop('selected', true).trigger('change');
                    var branches_id = $("#current_user_company_id").val();
                    var action = config.base_url + 'Ajax/gatBranchesDepartments';
                    $.ajax({
                        type: "post",
                        url: action,
                        data: {branches_id: branches_id},
                        success: function (data) {
                            //console.log(data);
                            $("#departments_id").html(data);
                        }
                    });
                    $('.branches-box').slideUp(500, function () {

                        $('.departments-box').slideDown(500);
                    });
//                    if ($('#user_type').val() == 'super admin') {
//                        $('.branches-box').slideUp(500);
//                    }
//                    if ($('#user_type').val() == 'owner') {
//                        $('.branches-box').slideUp(500, function () {
//
//                            $('.departments-box').slideDown(500);
//                        });
//                    }

                }
            });
        }


        return{
            init: function () {
                handleChangeAddToRadio();
            }

        };
    }();
    $(document).ready(function () {
        Users.init();
    });