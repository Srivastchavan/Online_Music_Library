$(document).ready(function() {
    $('#email').on('input', function() {
        var input = $(this);
        var email_val = input.val();
        var email_regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (email_val) {
            if (email_regex.test(email_val)) {
                $('#email_error').html("");
                input.removeClass("invalid");
            } else {
                $('#email_error').html("Email address entered is not valid").addClass("error_show");
                input.removeClass("valid").addClass("invalid");
            }
        } else {
            input.removeClass("valid");
            input.removeClass("invalid");
            $('#email_error').html("").removeClass("error_show");
        }
    });
    $('#password').on('input', function() {
        var input = $(this);
        input.removeClass("invalid");
    });
    $("#box_signin").hide();
    $("#box_pricing").hide();
    $("#login_option").click(function() {
        $("#second").removeClass('active');
        $("#third").removeClass('active');
        $("#first").addClass('active');
        $("#box_login").show();
        $("#box_signin").hide();
        $("#box_pricing").hide();
    });
});