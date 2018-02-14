
var cities_ids = {};
var programs_ids = {};
var prices = {};
var stars = {};
var sort = {};

var Programs = function () {

    var init = function () {
        handleShowMorePrograms();
        check_program();
        get_cities_like();
        check_city();
        get_programs_like();
    }
   



    var get_cities_like = function() {
        $("#city-input").on("keyup", function() {
            var searched_value = $(this).val();
            
            var action = config.base_url + "programs/getCitiesLike";
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
                     //   html += "<li><label for='city_"+msg.data[i].id+"'>"+msg.data[i].title_ar+"</label><input id='city_"+msg.data[i].id+"' data-id='"+msg.data[i].id+"' data-title = '"+msg.data[i].title_ar+"' class='city-checkbox js-switch' onchange='getData()' type='checkbox' ></li>";                        
                    }
                    
                    $("#city-block").html(html);
                }
            });
        });
    };



    var get_programs_like = function() {
        $("#program-input").on("keyup", function() {
            var searched_value = $(this).val();
            
            var action = config.base_url + "programs/getProgramsLike";
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
                        html += '<label for="program_'+msg.data[i].id+'">';
                        html += '<input class="program-checkbox" onchange="check_program()" value="'+msg.data[i].id+'" type="checkbox" value="" id="program_'+msg.data[i].id+'" data-id="'+msg.data[i].id+'" data-title = "'+msg.data[i].title_ar+'">';
                        html += '<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>';
                        html += msg.data[i].title_ar;
                        html += '</label></div></li>';
                     //   html += "<li><label for='city_"+msg.data[i].id+"'>"+msg.data[i].title_ar+"</label><input id='city_"+msg.data[i].id+"' data-id='"+msg.data[i].id+"' data-title = '"+msg.data[i].title_ar+"' class='city-checkbox js-switch' onchange='getData()' type='checkbox' ></li>";                        
                    }
                    
                    $("#program-block").html(html);
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
                    var input_value = $(this).val();
                    var input_id = $(this).attr('id');
                    cities_ids[input_id] = input_value;
                } else {
                    var city_id = $(this).data("id");
                    var city_title = $(this).data("title");
                    var input_value = $(this).val();
                    var input_id = $(this).attr('id');
                    delete cities_ids[input_id];
                }
            });
            handleFilterByCity();
        });        
    };





    var handleFilterByCity = function () {

        var data_1 = $.extend({}, cities_ids, programs_ids);
        var data_2 = $.extend({}, data_1, prices);
        var data_3 = $.extend({}, data_2, stars);
        var data = $.extend({}, data_3, sort);
        //console.log(data);
        //console.log(JSON.stringify(ids));
        //return false;
        $.ajax({
            url: config.base_url + "programs/getProgramsByCity",
            type: 'POST',
            dataType: 'text',
            data: $.param(data),
            success: function (data)
            {
                console.log(data);
                $(".programs-content").html(data);
                var count = $("#programs_count").val();
                var current_length = $(".program-item").length;                 
                    if(count == current_length) {
                        $("#show-more-programs").remove();
                    } else {
                        $("#show-more-programs").show();
                    }
                //console.log();

            },
            error: function (xhr, textStatus, errorThrown) {
                //$('.loading').addClass('hide');
                bootbox.dialog({
                    message: xhr.responseText,
                    title: lang.messages_error,
                    buttons: {
                        danger: {
                            label: lang.close,
                            className: "red"
                        }
                    }
                });
            },
        });
    }



     var check_program = function() {
        $(".program-checkbox").on("change", function() {
            $(".program-checkbox").each(function() {
                if($(this).is(":checked")) {
                    //console.log(cities.length)                    ;
                    var program_id = $(this).data("id");
                    var program_title = $(this).data("title");
                    var input_value = $(this).val();
                    var input_id = $(this).attr('id');
                    programs_ids[input_id] = input_value;
                } else {
                    var program_id = $(this).data("id");
                    var program_title = $(this).data("title");
                    var input_value = $(this).val();
                    var input_id = $(this).attr('id');
                    delete programs_ids[input_id];
                }
            });
            handleFilterByProgram();
        });        
    };





    var handleFilterByProgram = function () {

        var data_1 = $.extend({}, cities_ids, programs_ids);
        var data_2 = $.extend({}, data_1, prices);
        var data_3 = $.extend({}, data_2, stars);
        var data = $.extend({}, data_3, sort);
        //console.log(data);
        //console.log(JSON.stringify(ids));
        //return false;
        $.ajax({
            url: config.base_url + "programs/getProgramsByProgram",
            type: 'POST',
            dataType: 'text',
            data: {
                "programs": programs_ids
            },
            success: function (data)
            {
                console.log(data);
                $(".programs-content").html(data);
                
                        $("#show-more-programs").remove();
                   
                //console.log();

            },
            error: function (xhr, textStatus, errorThrown) {
                //$('.loading').addClass('hide');
                bootbox.dialog({
                    message: xhr.responseText,
                    title: lang.messages_error,
                    buttons: {
                        danger: {
                            label: lang.close,
                            className: "red"
                        }
                    }
                });
            },
        });
    }




    var handleShowMorePrograms = function () {
        $(document).on('click', '#show-more-programs', function () {
            var all_programs_count = $("#programs_count").val();
            var current_length = $(".program-item").length;
            //alert(all_programs_count);
            var action = config.base_url + 'programs/index';
            var data_1 = $.extend({}, cities_ids, programs_ids);
            var data_2 = $.extend({}, data_1, prices);
            var data_3 = $.extend({}, data_2, stars);
            var data_4 = $.extend({}, data_3, sort);
            var data = $.extend({}, data_4, {current_length: current_length});
            $("#show-more-programs").text(" جارى التحميل ").addClass("fa fa-spinner");
            setTimeout(function() {
                $("#show-more-programs").text("عرض المزيد من البرامج");
            $.ajax({
                url: action,
                data: $.param(data),
                async: false,
                beforeSend: function () {
                    
                    //$('#show-more-programs').html('<img src="' + config.base_url + 'uploads/loading.gif" style="width:20px;height:25px;">');
                },
                success: function (data) {
                    $(".programs-content").append(data);   
                    var current_length = $(".program-item").length;                 
                    if(all_programs_count == current_length) {
                        $("#show-more-programs").remove();
                    } else {
                        $("#show-more-programs").show();
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    bootbox.dialog({
                        message: xhr.responseText,
                        title: lang.messages_error,
                        buttons: {
                            danger: {
                                label: lang.close,
                                className: "red"
                            }
                        }
                    });
                },
                dataType: "text",
                type: "POST"
            });
             } , 1500);
            return false;
        });
    }




    return {
        init: function () {
            init();
        }
    }

}();
jQuery(document).ready(function () {
    Programs.init();
 

var check_city = function() {
        
            $(".city-checkbox").each(function() {
                if($(this).is(":checked")) {
                    //console.log(cities.length)                    ;
                    var city_id = $(this).data("id");
                    var city_title = $(this).data("title");
                    var input_value = $(this).val();
                    var input_id = $(this).attr('id');
                    cities_ids[input_id] = input_value;
                } else {
                    var city_id = $(this).data("id");
                    var city_title = $(this).data("title");
                    var input_value = $(this).val();
                    var input_id = $(this).attr('id');
                    delete cities_ids[input_id];
                }
            });
            handleFilterByCity();
             
    };





    var handleFilterByCity = function () {

        var data_1 = $.extend({}, cities_ids, programs_ids);
        var data_2 = $.extend({}, data_1, prices);
        var data_3 = $.extend({}, data_2, stars);
        var data = $.extend({}, data_3, sort);
        //console.log(data);
        //console.log(JSON.stringify(ids));
        //return false;
        $.ajax({
            url: config.base_url + "programs/getProgramsByCity",
            type: 'POST',
            dataType: 'text',
            data: $.param(data),
            success: function (data)
            {
                $(".programs-content").html(data);

            },
            error: function (xhr, textStatus, errorThrown) {
                //$('.loading').addClass('hide');
                bootbox.dialog({
                    message: xhr.responseText,
                    title: lang.messages_error,
                    buttons: {
                        danger: {
                            label: lang.close,
                            className: "red"
                        }
                    }
                });
            },
        });
    }



var check_program = function() {
      
            $(".program-checkbox").each(function() {
                if($(this).is(":checked")) {
                    //console.log(cities.length)                    ;
                    var program_id = $(this).data("id");
                    var program_title = $(this).data("title");
                    var input_value = $(this).val();
                    var input_id = $(this).attr('id');
                    programs_ids[input_id] = input_value;
                } else {
                    var program_id = $(this).data("id");
                    var program_title = $(this).data("title");
                    var input_value = $(this).val();
                    var input_id = $(this).attr('id');
                    delete programs_ids[input_id];
                }
            });
            handleFilterByProgram();
     
    };





    var handleFilterByProgram = function () {

        var data_1 = $.extend({}, cities_ids, programs_ids);
        var data_2 = $.extend({}, data_1, prices);
        var data_3 = $.extend({}, data_2, stars);
        var data = $.extend({}, data_3, sort);
        //console.log(data);
        //console.log(JSON.stringify(ids));
        //return false;
        $.ajax({
            url: config.base_url + "programs/getProgramsByProgram",
            type: 'POST',
            dataType: 'text',
            data: $.param(data),
            success: function (data)
            {
                console.log(data);
                $(".programs-content").html(data);
                var count = $("#programs_count").val();
                var current_length = $(".program-item").length;                 
                    if(count == current_length) {
                        $("#show-more-programs").remove();
                    } else {
                        $("#show-more-programs").show();
                    }
                //console.log();

            },
            error: function (xhr, textStatus, errorThrown) {
                //$('.loading').addClass('hide');
                bootbox.dialog({
                    message: xhr.responseText,
                    title: lang.messages_error,
                    buttons: {
                        danger: {
                            label: lang.close,
                            className: "red"
                        }
                    }
                });
            },
        });
    }


     var check_program = function() {
       
            $(".program-checkbox").each(function() {
                if($(this).is(":checked")) {
                    //console.log(cities.length)                    ;
                    var program_id = $(this).data("id");
                    var program_title = $(this).data("title");
                    var input_value = $(this).val();
                    var input_id = $(this).attr('id');
                    programs_ids[input_id] = input_value;
                } else {
                    var program_id = $(this).data("id");
                    var program_title = $(this).data("title");
                    var input_value = $(this).val();
                    var input_id = $(this).attr('id');
                    delete programs_ids[input_id];
                }
            });
            handleFilterByProgram();
        
    };





    var handleFilterByProgram = function () {

        var data_1 = $.extend({}, cities_ids, programs_ids);
        var data_2 = $.extend({}, data_1, prices);
        var data_3 = $.extend({}, data_2, stars);
        var data = $.extend({}, data_3, sort);
        //console.log(data);
        //console.log(JSON.stringify(ids));
        //return false;
        $.ajax({
            url: config.base_url + "programs/getProgramsByProgram",
            type: 'POST',
            dataType: 'text',
            data: {
                "programs": programs_ids
            },
            success: function (data)
            {
                console.log(data);
                $(".programs-content").html(data);
                
                        $("#show-more-programs").remove();
                   
                //console.log();

            },
            error: function (xhr, textStatus, errorThrown) {
                //$('.loading').addClass('hide');
                bootbox.dialog({
                    message: xhr.responseText,
                    title: lang.messages_error,
                    buttons: {
                        danger: {
                            label: lang.close,
                            className: "red"
                        }
                    }
                });
            },
        });
    };
});