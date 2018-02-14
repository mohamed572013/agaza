var brands = {};
var tags = {};
var Transports = function() {


    var init = function() {
        show_more_transports();
        get_transports_by_tag();
    }

    var show_more_transports = function() {
        $("#show-more-transports").click(function() {

            var shops_count = $("#transports-count").val();
           // alert(shops_count);
            var page_count = $(".single-transport").length;
            //alert(page_count);
            var action = config.base_url + "transports/index";
            $(this).text(" جارى التحميل ").addClass("fa fa-spinner");
            setTimeout(function() {
                $("#show-more-transports").text("اكتشف المزيد");
                $.ajax({
                    url: action,
                    data: {
                        "page_count": page_count
                    },
                    type: "POST",
                    success: function(msg) {
                        $(".active-transports").append(msg);
                        var page_count = $(".single-transport").length;
                        if(shops_count == page_count) {
                            $("#show-more-transports").remove();
                        } else {
                            $("#show-more-transports").show();
                        }
                    }
                });
            } , 1500);
        });
    };







    var get_transports_by_tag = function() {
        $(".tags-items").on("click", function() {
            
            var tag_id = $(this).data("id");
            var tag_title = $(this).data("title");              

            if (typeof tags[tag_id] == "undefined" || tags[tag_id] == null) {
                tags[tag_id] = tag_title;   
                $(this).addClass("tags_active");
                //$(this).css("color", "green");
            } else {
                delete tags[tag_id];
                $(this).removeClass("tags_active");
                //$(this).css("color", "red");
            }

            apply_tags_filter();
        });
    };


    var apply_tags_filter = function() {
        //alert("dddd");
        var action = config.base_url + "transports/getTransportsByTags";      
        var transports_count = $("#transports-count").val();
        var page_count = $(".single-transport").length;  
        $.ajax({
            url: action,
            data: {
                "searched_value": tags
            },
            type: "POST",
            success: function(msg) {
                $(".active-transports").html(msg);
                var page_count = $(".single-transport").length;
                if(transports_count == page_count) {
                    $("#show-more-transports").remove();
                } else {
                    $("#show-more-transports").show();
                }
            }
        });
    };





    

    return {
        init: function() {
            init();
        }
    }


}();

jQuery(document).ready(function() {
    Transports.init();
});