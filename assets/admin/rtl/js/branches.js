    var Branches = function () {

        var handleChangeAddToRadio = function () {
            $('.addToTypeRadio').on('change', function () {
                var type = $(this).val();
                if (type == 'other') {
                    $('.branches-box').slideDown(500);
                }
                if (type == 'me') {
                    var branches_id = $("#current_user_company_id").val();
                    var action = config.base_url + 'Ajax/gatBranchesDepartments';
                    $.ajax({
                        type: "post",
                        url: action,
                        data: {branches_id: branches_id},
                        success: function (data) {
                            $("#departments_id").html(data);

                        }
                    });
                    $('.branches-box').slideUp(500);
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
        Branches.init();
    });