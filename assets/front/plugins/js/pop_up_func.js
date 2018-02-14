var show_popup_value = "";

$(document).ready(function() {

    $("#objectBox").mousemove(function(mouseEvent) {

        var obj = document.getElementById("objectBox");
        
        var obj_left = 0;
        var obj_top = 0;
        var xpos;
        var ypos;
        while (obj.offsetParent) {
            obj_left += obj.offsetLeft;
            obj_top += obj.offsetTop;
            obj = obj.offsetParent;
        }
        if (mouseEvent) {
            //FireFox
            xpos = mouseEvent.pageX;
            ypos = mouseEvent.pageY;
        } else {
            //IE
            xpos = window.event.x + document.body.scrollLeft - 2;
            ypos = window.event.y + document.body.scrollTop - 2;
        }
        xpos -= obj_left;
        ypos -= obj_top;
        if(ypos <= 50) {
          // show_confirm();
            var show_popup = localStorage.getItem("show_popup");
            if(show_popup == "undefined" || show_popup == null || show_popup == 0) {
                show_popup_function();
                localStorage.setItem("show_popup", "done");
            }
            
        }
    });


    var show_popup_function = function() {
        
        new $.popup({                
            title       : '',
            content         : '<div  id="newsletter"><h3>النشرة البريدية</h3><p>انضم الينا و استمتع بافضل عروض السفر و الرحلات</p><div id="message-newsletter_2"></div><form method="post" onsubmit="return visitors_form_submit()" id="visitors_form"><div class="form-group"><input name="phone" id="visitor_form_phone" type="text" value="" placeholder="رقم الهاتف" class="form-control"><div class="help-block"></div></div><br/><div class="form-group"><input name="email" id="visitor_form_email" type="text" value="" placeholder="البريد الالكترونى" class="form-control"><div id="help-msg"></div></div><p><input type="submit" value="اشترك الان" class="button submit-form" id="submit-newsletter_2"></p></form></div>', 
            html: true,
            autoclose   : false,
            closeOverlay:true,
            closeEsc: true,
            buttons     : false
            
        });
        
    };

    var show_confirm = function() {
        var cookie = confirm("Delete Cookie ?");
        if(cookie) {
            var show_popup = localStorage.getItem("show_popup");
            //alert(show_popup);
            localStorage.setItem("show_popup", 0);

        }
    };


   
    
});


 var visitors_form_submit = function() {


    var visitor_form_phone = $("#visitor_form_phone").val();
    var visitor_form_email = $("#visitor_form_email").val();
    if(visitor_form_phone == "" && visitor_form_email == "")  {
        $("#help-msg").html("من فضلك قم بإدخال بياناتك");
        return false;
    } else {


        var action = config.admin_url + "visitors/add";
        $.ajax({
            url: action,
            type: "POST",
            data: {
                "visitor_form_phone": visitor_form_phone,
                "visitor_form_email": visitor_form_email
            },  
            success: function(msg) {
                $("#help-msg").html("تم التسجيل بنجاح");
                
            }
        });
        return false;
    }

};
