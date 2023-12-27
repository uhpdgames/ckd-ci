
(function ($) {
    "use strict";


     /*==================================================================
    [ Focus input ]*/
    $('.input100').each(function(){
        $(this).on('blur', function(){
            if($(this).val().trim() != "") {
                $(this).addClass('has-val');
            }
            else {
                $(this).removeClass('has-val');
            }
        })    
    })
  
  
    /*==================================================================
    [ Validate ]*/
    var input = $('.validate-input .input100');

    $('.validate-form').on('submit',function(){
        var check = true;

        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                showValidate(input[i]);
                check=false;
            }
        }

        return check;
    });


    $('.validate-form .input100').each(function(){
        $(this).focus(function(){
           hideValidate(this);
        });
    });

    function validate (input) {
        if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
            if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                return false;
            }
        }
        else {
            if($(input).val().trim() == ''){
                return false;
            }
        }
    }

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }


    function setCookie(name, value, days) {
        var expires = "";
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "") + expires + "; path=/";
    }

    function getCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }

    function eraseCookie(name) {
        document.cookie = name + '=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
    }


    $(document).ready(function () {


        $("#username, #password").keypress(function (event) {
            if (event.keyCode == 13 || event.which == 13) login();
        })

        $(".show-password").click(function () {
            if ($("#password").val()) {
                if ($(this).hasClass("active")) {
                    $(this).removeClass("active");
                    $("#password").attr("type", "password");
                } else {
                    $(this).addClass("active");
                    $("#password").attr("type", "text");
                }
                $(this).find("span").toggleClass("fas fa-eye fas fa-eye-slash");
            }
        })
    })
})(jQuery);

function login() {
    var username = $("#username").val();
    var password = $("#password").val();

    if ($(".alert-login").hasClass("alert-danger") || $(".alert-login").hasClass("alert-success")) {
        $(".alert-login").removeClass("alert-danger alert-success");
        $(".alert-login").addClass("d-none");
        $(".alert-login").html("");
    }
    if ($(".show-password").hasClass("active")) {
        $(".show-password").removeClass("active");
        $("#password").attr("type", "password");
        $(".show-password").find("span").toggleClass("fas fa-eye fas fa-eye-slash");
    }
    $(".show-password").addClass("disabled");
    $(".btn-login .sk-chase").removeClass("d-none");
    $(".btn-login span").addClass("d-none");
    $(".btn-login").attr("disabled", true);
    $("#username").attr("disabled", true);
    $("#password").attr("disabled", true);

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: config_base +"/meeting/ajax_login.php",
        async: false,
        data: {username: username, password: password},
        success: function (result) {
            if (result.success) {
                setCookie('task_by_uid', result.success, 7);
                setCookie('task_by_name', result.name, 7);
                $(".error-log").text(" ");
                window.location.reload();

                //window.location = "<?php echo $config_base?>/meeting";
            } else if (result.error) {
                $(".alert-login").removeClass("d-none");
                $(".show-password").removeClass("disabled");
                $(".btn-login .sk-chase").addClass("d-none");
                $(".btn-login span").removeClass("d-none");
                $(".btn-login").attr("disabled", false);
                $("#username").attr("disabled", false);
                $("#password").attr("disabled", false);
                $(".alert-login").removeClass("alert-success");
                $(".alert-login").addClass("alert-danger");
                // $(".error-log").html(result.error);
                $(".error-log").text(result.error);
            }
        },
        error:function (){

        }
    });
}
