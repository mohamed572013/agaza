var restaurants = {};
var cities = {};
var tags = {};
var Restaurants = function() {


    var init = function() {
        show_more_restaurants();        
        get_cities_like();
        get_restaurants_like();
        check_city();
        check_restaurant();
        get_restaurants_by_tag();
    }

    var show_more_restaurants = function() {
        $("#show-more-res").on("click", function() {            
            //$(this).remove();
            var restaurants_count = $("#restaurants-count").val();
            var page_count = $(".single-restaurant").length;
            
            var action = config.base_url + "restaurants/index";
            $(this).text(" جارى التحميل ").addClass("fa fa-spinner");
            setTimeout(function() {
                $("#show-more-res").text("اكتشف المزيد");
                $.ajax({
                    url: action,
                    data: {
                        "page_count": page_count
                    },
                    type: "POST",
                    success: function(msg) {
                        $(".active-restaurants").append(msg);
                        var page_count = $(".single-restaurant").length;
                        if(restaurants_count == page_count) {
                            $("#show-more-res").remove();
                        } else {
                            $("#show-more-res").show();
                        }
                    }
                });
            } , 1500);
        });
    };


    var get_cities_like = function() {
        $("#city-input").on("keyup", function() {
            var searched_value = $(this).val();
            
            var action = config.base_url + "restaurants/getCitiesLike";
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
                        html += '<label for="city_'+msg.data[i].id+'">';
                        html += '<input class="city-checkbox" onchange="check_city()" value="'+msg.data[i].id+'" type="checkbox" value="" id="city_'+msg.data[i].id+'" data-id="'+msg.data[i].id+'" data-title = "'+msg.data[i].title_ar+'">';
                        html += '<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>';
                        html += msg.data[i].title_ar;
                        html += '</label></div></li>';
                        //html += "<li><label for='city_"+msg.data[i].id+"'>"+msg.data[i].title_ar+"</label><input id='city_"+msg.data[i].id+"' data-id='"+msg.data[i].id+"' data-title = '"+msg.data[i].title_ar+"' class='city-checkbox js-switch' onchange='getData()' type='checkbox' ></li>";                        
                    }
                    
                    $("#city-block").html(html);
                }
            });
        });
    };

    


    var get_restaurants_like = function() {
        $("#res-input").on("keyup", function() {
            var searched_value = $(this).val();
            var action = config.base_url + "restaurants/getRestaurantLike";
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
                        html += '<label for="restaurant_'+msg.data[i].id+'">';
                        html += '<input class="restaurant-checkbox" onchange="check_restaurant()" value="'+msg.data[i].id+'" type="checkbox" value="" id="restaurant_'+msg.data[i].id+'" data-id="'+msg.data[i].id+'" data-title = "'+msg.data[i].title_ar+'">';
                        html += '<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>';
                        html += msg.data[i].title_ar;
                        html += '</label></div></li>';
                        //html += "<li><label for='restaurant_"+msg.data[i].id+"'>"+msg.data[i].title_ar+"</label><input id='restaurant_"+msg.data[i].id+"' data-id='"+msg.data[i].id+"' data-title = '"+msg.data[i].title_ar+"' class='restaurant-checkbox restaurants-switch' onchange='getDataa()' type='checkbox' ></li>";                        
                    }
                    
                    $("#res-block").html(html);
                }
            });
        });
    };


    var check_city = function() {
        $(".city-checkbox").on("change", function() {
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
        //restaurants_restore_switch();
    };





    var apply_filter = function() {
        apply_restaurants_sidebar();
        var action = config.base_url + "restaurants/getRestaurantsByCity";      
        var restaurants_count = $("#restaurants-count").val();
        var page_count = $(".single-restaurant").length;  
        $.ajax({
            url: action,
            data: {
                "searched_value": cities
            },
            type: "POST",
            success: function(msg) {
                $(".active-restaurants").html(msg);
                var page_count = $(".single-restaurant").length;
                if(restaurants_count == page_count) {
                    $("#show-more-res").remove();
                } else {
                    $("#show-more-res").show();
                }
            }
        });
    };


    var apply_restaurants_sidebar = function() {
        var action = config.base_url + "restaurants/getRestaurantsByCitySidebar";  
        
        $.ajax({
            url: action,
            data: {
                "searched_value": cities
            },
            type: "POST",
            success: function(msg) {
                var html = "";
                for(i in msg.data) {
                     html += '<li><div class="checkbox">';
                        html += '<label for="restaurant_'+msg.data[i].id+'">';
                        html += '<input class="restaurant-checkbox" onchange="check_restaurant()" value="'+msg.data[i].id+'" type="checkbox" value="" id="restaurant_'+msg.data[i].id+'" data-id="'+msg.data[i].id+'" data-title = "'+msg.data[i].title_ar+'">';
                        html += '<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>';
                        html += msg.data[i].title_ar;
                        html += '</label></div></li>';
                    //html += "<li><label for='restaurant_"+msg.data[i].id+"'>"+msg.data[i].title_ar+"</label><input id='restaurant_"+msg.data[i].id+"' data-id='"+msg.data[i].id+"' data-title = '"+msg.data[i].title_ar+"' class='restaurant-checkbox restaurants-switch' onchange='getDataa()' type='checkbox' ></li>";                        
                }
                 
                $("#res-block").html(html);   

            }
        });
     //   restaurants_restore_switch();
    };


    var check_restaurant = function() {
        $(".restaurant-checkbox").on("change", function() {
            $(".restaurant-checkbox").each(function() {
                if($(this).is(":checked")) {
                    //console.log(cities.length)                    ;
                    var restaurant_id = $(this).data("id");
                    var restaurant_title = $(this).data("title");
                    restaurants[restaurant_id] = restaurant_title;
                } else {
                    var restaurant_id = $(this).data("id");
                    var restaurant_title = $(this).data("title");
                    delete restaurants[restaurant_id];
                }
            });
            apply_filter_by_restaurant();
        });
    };


    var apply_filter_by_restaurant = function() {
        var action = config.base_url + "restaurants/getRestaurantsByTitle";      
        var restaurants_count = $("#restaurants-count").val();
        var page_count = $(".single-restaurant").length;  
        $.ajax({
            url: action,
            data: {
                "searched_value": restaurants
            },
            type: "POST",
            success: function(msg) {
                $(".active-restaurants").html(msg);
                var page_count = $(".single-restaurant").length;
               // if(restaurants_count == page_count) {
                    $("#show-more-res").remove();
              //  } else {
               //    $("#show-more-res").show();
              //  }
            }
        });
    };


    var get_restaurants_by_tag = function() {
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
        var action = config.base_url + "restaurants/getRestaurantsByTags";      
        var restaurants_count = $("#restaurants-count").val();
        var page_count = $(".single-restaurant").length;  
        $.ajax({
            url: action,
            data: {
                "searched_value": tags
            },
            type: "POST",
            success: function(msg) {
                $(".active-restaurants").html(msg);
                var page_count = $(".single-restaurant").length;
                if(restaurants_count == page_count) {
                    $("#show-more-res").remove();
                } else {
                    $("#show-more-res").show();
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
    Restaurants.init();
});



  var check_city = function() {
     //   $(".city-checkbox").on("change", function() {
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
      //  });
        //restaurants_restore_switch();
    };





    var apply_filter = function() {
        apply_restaurants_sidebar();
        var action = config.base_url + "restaurants/getRestaurantsByCity";      
        var restaurants_count = $("#restaurants-count").val();
        var page_count = $(".single-restaurant").length;  
        $.ajax({
            url: action,
            data: {
                "searched_value": cities
            },
            type: "POST",
            success: function(msg) {
                $(".active-restaurants").html(msg);
                var page_count = $(".single-restaurant").length;
                if(restaurants_count == page_count) {
                    $("#show-more-res").remove();
                } else {
                    $("#show-more-res").show();
                }
            }
        });
    };
var check_restaurant = function() {
     //   $(".restaurant-checkbox").on("change", function() {
            $(".restaurant-checkbox").each(function() {
                if($(this).is(":checked")) {
                    //console.log(cities.length)                    ;
                    var restaurant_id = $(this).data("id");
                    var restaurant_title = $(this).data("title");
                    restaurants[restaurant_id] = restaurant_title;
                } else {
                    var restaurant_id = $(this).data("id");
                    var restaurant_title = $(this).data("title");
                    delete restaurants[restaurant_id];
                }
            });
            apply_filter_by_restaurant();
     //   });
    };


    var apply_filter_by_restaurant = function() {
        var action = config.base_url + "restaurants/getRestaurantsByTitle";      
        var restaurants_count = $("#restaurants-count").val();
        var page_count = $(".single-restaurant").length;  
        $.ajax({
            url: action,
            data: {
                "searched_value": restaurants
            },
            type: "POST",
            success: function(msg) {
                $(".active-restaurants").html(msg);
                var page_count = $(".single-restaurant").length;
         //       if(restaurants_count == page_count) {
                    $("#show-more-res").remove();
           //     } else {
         //           $("#show-more-res").show();
          //      }
            }
        });
    };


 var apply_restaurants_sidebar = function() {
        var action = config.base_url + "restaurants/getRestaurantsByCitySidebar";  
        
        $.ajax({
            url: action,
            data: {
                "searched_value": cities
            },
            type: "POST",
            success: function(msg) {
                var html = "";
                for(i in msg.data) {
                     html += '<li><div class="checkbox">';
                        html += '<label for="restaurant_'+msg.data[i].id+'">';
                        html += '<input class="restaurant-checkbox" onchange="check_restaurant()" value="'+msg.data[i].id+'" type="checkbox" value="" id="restaurant_'+msg.data[i].id+'" data-id="'+msg.data[i].id+'" data-title = "'+msg.data[i].title_ar+'">';
                        html += '<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>';
                        html += msg.data[i].title_ar;
                        html += '</label></div></li>';
                    //html += "<li><label for='restaurant_"+msg.data[i].id+"'>"+msg.data[i].title_ar+"</label><input id='restaurant_"+msg.data[i].id+"' data-id='"+msg.data[i].id+"' data-title = '"+msg.data[i].title_ar+"' class='restaurant-checkbox restaurants-switch' onchange='getDataa()' type='checkbox' ></li>";                        
                }
                 
                $("#res-block").html(html);   

            }
        });
     //   restaurants_restore_switch();
    };