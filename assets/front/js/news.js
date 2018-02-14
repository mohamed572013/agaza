var News = function() {


    var init = function() {
        show_more_news();
    }

    var show_more_news = function() {
        $("#show-more-news").click(function() {
            var action = config.base_url + "news/index";
            var news_count = $("#count").val();
            var current_count = $(".news-item").length;
            $.ajax({
                url: action,
                type: "POST",
                data: {
                    offset: current_count
                },
                beforeSend: function() {
                    $("#loader-container").show();
                    $("#show-more-news").html("جارى تحمل المزيد من الأخبار ... ");
                },
                success: function(msg) {
                    setTimeout(function() {
                        $(".newss").append(msg);
                        var current_count = $(".news-item").length;
                        if(news_count == current_count) {
                            $("#show-more-news").hide();
                        }
                    }, 3000);
                },
                error: function() {
                    $("#show-more-news").html("حدث خطأ ... ");
                }, 
                complete: function() {
                    setTimeout(function() {
                        $("#loader-container").hide();
                        $("#show-more-news").html("اكتشف المزيد من الأخبار ");
                    }, 3000);
                }
            });
        });
    };

    
    

    return {
        init: function() {
            init();
        }
    }


}();

jQuery(document).ready(function() {
    News.init();
});