var Etiquette = function() {


    var init = function() {
        show_more_etiquette();
        check_one_brand();
    }

    var show_more_etiquette = function() {
        $("#show-more-et").on("click", function() {            
            //$(this).remove();
            var etiquette_count = $("#etiquette-count").val();
            var page_count = $(".list-item").length;
            var action = config.base_url + "etiquette/index";
            $(this).text(" جارى التحميل ").addClass("fa fa-spinner");
            setTimeout(function() {
                $("#show-more-et").text("اكتشف المزيد");
                $.ajax({
                    url: action,
                    data: {
                        "page_count": page_count
                    },
                    type: "POST",
                    success: function(msg) {
                        $(".active-etiquette").append(msg);
                        var page_count = $(".list-item").length;
                        if(etiquette_count == page_count) {
                            $("#show-more-et").remove();
                        } else {
                            $("#show-more-et").show();
                        }
                    }
                });
            } , 1500);
        });
    };

    
    

    return {
        init: function() {
            init();
        }
    }


}();

jQuery(document).ready(function() {
    Etiquette.init();
});