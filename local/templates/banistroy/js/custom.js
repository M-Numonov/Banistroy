function sendFormCallback() {
    if (!document.getElementById("feedback").checked === true){
        $(".checkbox__text").css({"color":"red"});
        return false;
    }
    $.getScript("https://www.google.com/recaptcha/api.js?render=6LfMQrkUAAAAALB0TkSYM8IuorqoFmbbSCOQMlp6", function(){
        $fio = $('input[name="fio"]').val();
        $phone = $('input[name="phone"]').val();
        $captcha = "";
        grecaptcha.ready(function () {
            grecaptcha.execute('6LfMQrkUAAAAALB0TkSYM8IuorqoFmbbSCOQMlp6', {action: 'create_comment'}).then(function (token) {
                console.log(token);
                $.getJSON('/ajax/forms.php', {type: "callback", fio: $fio, phone: $phone, captcha: token}, function (data) {
                    if (data.code === 0) {
                        $('#modal').modal('hide');
                        $('#modal2').modal('show');
                        setTimeout(function () {
                            $('#modal2').modal('hide');
                            $('input[name="phone"]').val("");
                            $('input[name="fio"]').val("");
                        }, 5000);
                        console.log(data.message);
                    } else {
                        $(".error_formv_title").html("Ошибка!");
                        $(".error_formv").html(data.message);
                    }
                });
            })
        });
    });
}

$(document).ready(function () {
    $(".phone_for_inputmask").inputmask("+7(###)###-##-##");  //static mask
});

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function checkCookie() {
    var user = getCookie("username");
    if (user != "") {
        alert("Welcome again " + user);
    } else {
        user = prompt("Please enter your name:", "");
        if (user != "" && user != null) {
            setCookie("username", user, 365);
        }
    }
}

$('.project-list__info__more_custom').on('mouseover', function(){
    var $that = $(this),
        nc = $that.prev('.project-list__info__in').length,
        block = nc ? $that.prev('.project-list__info__in') : $that.parent('.project-list__info__in');
    block.slideToggle(function(){
        $('.project-list__info__more_custom',block).add(block.next('.project-list__info__more_custom'))
            .text(block.is(':visible') ? 'скрыть' : 'более подробнее');
    });
});

$(document).ready(function(){
    $(document).on('click', '.dec-btn.btn-more', function(){
            var nav=$(this).attr("data-nav");
            var page=$(this).attr("data-page");
            var params=$(this).attr("data-params");
            var that=$(this);
            $("#result-ajax").fadeTo("slow", 0.3);
            $.getJSON(location.pathname+"?m-ajax=Y&PAGEN_"+nav+"="+page+params, function(data){
                $("#result-ajax").append(data.CONTENT);
                $("#result-ajax").fadeTo("slow", 1);
                $("#pagination-ajax").html("").html(data.PAGINATION);
                $("#pagination-bottom").html("").html(data.MORE);

            });
    });
});
$(document).ready(function(){
    $("#sku_form input[type=radio]").change(function() {
        $price_sum = 0;
        $old_price_sum = 0;
        $("#sku_form input[type=radio]:checked").each(function() {
           $price = $(this).data("price");
           $old_price = $(this).data("old-price");
            $price_sum = $price_sum + $price;
            $old_price_sum = $old_price_sum + $old_price;
        });
        $("#custom_price").text($price_sum);
        $("#custom_old_price").text($old_price_sum);
    });

});


