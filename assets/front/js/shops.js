var shops = {};
var cities = {};
var tags = {};
var Shops = function() {


	var init = function() {
		show_more_shops();
		get_cities_like();
		get_shops_like();
        get_shops_by_tag();
        check_city();
        check_shop();
	};


	var show_more_shops = function() {
		$("#show-more-shops").click(function() {
			var shops_count = $("#shops-count").val();
            var page_count = $(".single-shop").length;
            
            var action = config.base_url + "shops/index";
            $(this).text(" جارى التحميل ").addClass("fa fa-spinner");
            setTimeout(function() {
                $("#show-more-shops").text("اكتشف المزيد");
                $.ajax({
                    url: action,
                    data: {
                        "page_count": page_count
                    },
                    type: "POST",
                    success: function(msg) {
                        $(".active-shops").append(msg);
                        var page_count = $(".single-shop").length;
                        if(shops_count == page_count) {
                            $("#show-more-shops").remove();
                        } else {
                            $("#show-more-shops").show();
                        }
                    }
                });
            } , 1500);
		});
	};


	var get_cities_like = function() {
		$("#city-input").on("keyup", function() {
			var city_title = $(this).val();
			var action = config.base_url + "shops/getCitiesLike";
            $.ajax({
                url: action,
                data: {
                    "searched_value": city_title
                },
                type: "POST",
                success: function(msg) {
                    console.log(msg);
                    var html = "";

                    for(i in msg.data) {
                        html += '<li><div class="checkbox">';
                        html += '<label for="city_'+msg.data[i].id+'">';
                        html += '<input class="city-checkbox" onchange="check_city()" value="'+msg.data[i].id+'" type="checkbox" value="" id="restaurant_'+msg.data[i].id+'" data-id="'+msg.data[i].id+'" data-title = "'+msg.data[i].title_ar+'">';
                        html += '<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>';
                        html += msg.data[i].title_ar;
                        html += '</label></div></li>';
                   //     html += '<li><label for="city_'+ msg.data[i].id +'">'+ msg.data[i].title_ar +'</label><input type="checkbox" id="city_'+ msg.data[i].id +'" data-id="'+ msg.data[i].id +'" data-title = "'+ msg.data[i].title_ar +'"  class="city-checkbox">';
                      //  html += '<span class="switchery switchery-small" style="box-shadow: rgb(223, 223, 223) 0px 0px 0px 0px inset; border-color: rgb(223, 223, 223); background-color: rgb(255, 255, 255); transition: border 0.4s, box-shadow 0.4s;"><small style="left: 0px; transition: background-color 0.4s, left 0.2s;"></small></span>';
                     //   html += '</li>';
                    }
                    
                    $("#city-block").html(html);
                }
            });
		});
	};

    



	var get_shops_like = function() {
        $("#shop-input").on("keyup", function() {
            var searched_value = $(this).val();
            var action = config.base_url + "shops/getShopLike";
            $.ajax({
                url: action,
                data: {
                    "searched_value": searched_value
                },
                type: "POST",
                success: function(msg) {
                    console.log(msg);
                    var html = "";

                    for(i in msg.data) {
                        html += '<li><div class="checkbox">';
                        html += '<label for="shop_'+msg.data[i].id+'">';
                        html += '<input class="shop-checkbox" onchange="check_shop()" value="'+msg.data[i].id+'" type="checkbox" value="" id="shop_'+msg.data[i].id+'" data-id="'+msg.data[i].id+'" data-title = "'+msg.data[i].title_ar+'">';
                        html += '<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>';
                        html += msg.data[i].title_ar;
                        html += '</label></div></li>';
                       // html += '<li><label for="shop_'+ msg.data[i].id +'">'+ msg.data[i].title_ar +'</label><input type="checkbox" id="shop_'+ msg.data[i].id +'" data-id="'+ msg.data[i].id +'" data-title = "'+ msg.data[i].title_ar +'" class="shop-checkbox" >';
                        //html += '<span class="switchery switchery-small" style="box-shadow: rgb(223, 223, 223) 0px 0px 0px 0px inset; border-color: rgb(223, 223, 223); background-color: rgb(255, 255, 255); transition: border 0.4s, box-shadow 0.4s;"><small style="left: 0px; transition: background-color 0.4s, left 0.2s;"></small></span>';
                        //html += '</li>';
                    }
                    
                    $("#shop-block").html(html);
                }
            });
        });
    };





    var get_shops_by_tag = function() {
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
        var action = config.base_url + "shops/getShopsByTags";      
        var restaurants_count = $("#shops-count").val();
        var page_count = $(".single-shop").length;  
        $.ajax({
            url: action,
            data: {
                "searched_value": tags
            },
            type: "POST",
            success: function(msg) {
                $(".active-shops").html(msg);
                var page_count = $(".single-shop").length;
                if(restaurants_count == page_count) {
                    $("#show-more-shops").remove();
                } else {
                    $("#show-more-shops").show();
                }
            }
        });
    };




    var check_city = function() {
        $(".city-checkbox").on("change", function() {
          //  alert("rrrr");
            $(".city-checkbox").each(function() {
                if($(this).is(":checked")) {
                    //console.log(cities.length)                    ;
                    var city_id = $(this).data("id");
                    var city_title = $(this).data("title");
                    cities[city_id] = city_title;
                } else {
                    var city_id = $(this).data("id");
                    var city_title = $(this).data("title");
                    delete cities[city_id];
                }
            });
            apply_filter();
        });
    };


    var apply_filter = function() {
        apply_shops_sidebar();
        var action = config.base_url + "shops/getShopsByCity";      
        var shops_count = $("#shops-count").val();
        var page_count = $(".single-shop").length;  
        $.ajax({
            url: action,
            data: {
                "searched_value": cities
            },
            type: "POST",
            success: function(msg) {
                $(".active-shops").html(msg);
                var page_count = $(".single-shop").length;
                if(shops_count == page_count) {
                    $("#show-more-shops").remove();
                } else {
                    $("#show-more-shops").show();
                }
            }
        });
    };


    var apply_shops_sidebar = function() {
       // alert("ssss");
        var action = config.base_url + "shops/getShopsByCitySidebar";  
        
        $.ajax({
            url: action,
            data: {
                "searched_value": cities
            },
            type: "POST",
            success: function(msg) {
                console.log(msg);
                var html = "";
                for(i in msg.data) {
                     html += '<li><div class="checkbox">';
                        html += '<label for="shop_'+msg.data[i].id+'">';
                        html += '<input class="shop-checkbox" onchange="check_shop()" value="'+msg.data[i].id+'" type="checkbox" value="" id="shop_'+msg.data[i].id+'" data-id="'+msg.data[i].id+'" data-title = "'+msg.data[i].title_ar+'">';
                        html += '<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>';
                        html += msg.data[i].title_ar;
                        html += '</label></div></li>';
                    //html += "<li><label>"+ msg.data[i].title_ar +"</label><input type='checkbox' class='shop-checkbox'></li>";    
                }
                 
                $("#shop-block").html(html);   
            }
        });
    };


    var check_shop = function() {
        $(".shop-checkbox").on("change", function() {
      //      alert("fffff");
            $(".shop-checkbox").each(function() {
                if($(this).is(":checked")) {
                    //console.log(cities.length)                    ;
                    var shop_id = $(this).data("id");
                    var shop_title = $(this).data("title");
                    shops[shop_id] = shop_title;
                } else {
                    var shop_id = $(this).data("id");
                    var shop_title = $(this).data("title");
                    delete shops[shop_id];
                }
            });
            apply_filter_by_shop();
        });
    };


    var apply_filter_by_shop = function() {
        var action = config.base_url + "shops/getShopsByTitle";      
        var shops_count = $("#shops-count").val();
        var page_count = $(".single-shop").length;  
        $.ajax({
            url: action,
            data: {
                "searched_value": shops
            },
            type: "POST",
            success: function(msg) {
                $(".active-shops").html(msg);
                var page_count = $(".single-shops").length;
                if(shops_count == page_count) {
                    $("#show-more-shops").remove();
                } else {
                    $("#show-more-shops").show();
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

$(document).ready(function() {
	Shops.init();





});

var check_city = function() {
     
            $(".city-checkbox").each(function() {
                if($(this).is(":checked")) {
                    //console.log(cities.length)                    ;
                    var city_id = $(this).data("id");
                    var city_title = $(this).data("title");
                    cities[city_id] = city_title;
                } else {
                    var city_id = $(this).data("id");
                    var city_title = $(this).data("title");
                    delete cities[city_id];
                }
            });
            apply_filter();
      
    };


    var apply_filter = function() {
        //apply_shops_sidebar();
        var action = config.base_url + "shops/getShopsByCity";      
        var shops_count = $("#shops-count").val();
        var page_count = $(".single-shop").length;  
        $.ajax({
            url: action,
            data: {
                "searched_value": cities
            },
            type: "POST",
            success: function(msg) {
                $(".active-shops").html(msg);
                var page_count = $(".single-shop").length;
                if(shops_count == page_count) {
                    $("#show-more-shops").remove();
                } else {
                    $("#show-more-shops").show();
                }
            }
        });
    };


    var apply_shops_sidebar = function() {
       // alert("ssss");
        var action = config.base_url + "shops/getShopsByCitySidebar";  
        
        $.ajax({
            url: action,
            data: {
                "searched_value": cities
            },
            type: "POST",
            success: function(msg) {
                console.log(msg);
                var html = "";
                for(i in msg.data) {
                    html += '<li><div class="checkbox">';
                        html += '<label for="shop_'+msg.data[i].id+'">';
                        html += '<input class="shop-checkbox" onchange="check_shop()" value="'+msg.data[i].id+'" type="checkbox" value="" id="shop_'+msg.data[i].id+'" data-id="'+msg.data[i].id+'" data-title = "'+msg.data[i].title_ar+'">';
                        html += '<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>';
                        html += msg.data[i].title_ar;
                        html += '</label></div></li>';
                   // html += "<li><label>"+ msg.data[i].title_ar +"</label><input type='checkbox' class='shop-checkbox'></li>";    
                }
                 
                $("#shop-block").html(html);   
            }
        });
    };


    var check_shop = function() {
        
            $(".shop-checkbox").each(function() {
                if($(this).is(":checked")) {
                    //console.log(cities.length)                    ;
                    var shop_id = $(this).data("id");
                    var shop_title = $(this).data("title");
                    shops[shop_id] = shop_title;
                } else {
                    var shop_id = $(this).data("id");
                    var shop_title = $(this).data("title");
                    delete shops[shop_id];
                }
            });
            apply_filter_by_shop();
       
    };


    var apply_filter_by_shop = function() {
        var action = config.base_url + "shops/getShopsByTitle";      
        var shops_count = $("#shops-count").val();
        var page_count = $(".single-shop").length;  
        $.ajax({
            url: action,
            data: {
                "searched_value": shops
            },
            type: "POST",
            success: function(msg) {
                $(".active-shops").html(msg);
                var page_count = $(".single-shops").length;
                if(shops_count == page_count) {
                    $("#show-more-shops").remove();
                } else {
                    $("#show-more-shops").show();
                }
            }
        });
    };
