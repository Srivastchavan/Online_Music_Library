$(document).ready(function() {
    //Username Validation
    $('#username').on('input', function() {
        var input = $(this);
        var user_val = input.val();
        if (user_val) {
            if (user_val.length >= 5 && user_val.length <= 20) {
                $('#username_error').html("");
                input.removeClass("invalid").addClass("valid");
            } else {
                $('#username_error').html("Username should be between 5 and 20 characters").addClass("error_show");
                input.removeClass("valid").addClass("invalid");
            }
        } else {
            input.removeClass("valid");
            input.removeClass("invalid");
            $('#username_error').html("").removeClass("error_show");
        }
    });

    //Email Validation
    $('#email2').on('input', function() {
        var input = $(this);
        var email_val = input.val();
        var email_regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (email_val) {
            if (email_regex.test(email_val)) {
                $('#email2_error').html("");
                input.removeClass("invalid").addClass("valid");
            } else {
                $('#email2_error').html("Email address entered is not valid").addClass("error_show");
                input.removeClass("valid").addClass("invalid");
            }
        } else {
            input.removeClass("valid");
            input.removeClass("invalid");
            $('#email2_error').html("").removeClass("error_show");
        }
    });

    //Password Validation
    $('#password2').on('input', function() {
        var input = $(this);
        var pass_val = input.val();
        var pass_regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        if (pass_val) {
            if (pass_regex.test(pass_val)) {
                $('#password2_error').html("");
                input.removeClass("invalid").addClass("valid");
                //var password_hash = md5(pass_val);  //Hashed Password
            } else {
                $('#password2_error').html("Password must contain:" +
                    "<ul>" +
                    "<li>Minimum 8 characters</li>" +
                    "<li>Atleast one Uppercase letter,one Lowercase letter" +
                    "<li>A special character from @$!%*</li>" +
                    "</ul>").addClass("error_show");
                input.removeClass("valid").addClass("invalid");
            }
        } else {
            input.removeClass("valid");
            input.removeClass("invalid")
            $('#password2_error').html("").removeClass("error_show");
        }
    });

    //After submit validation
    $("#button2").click(function() {
        if (!$('#username').val()) {
            $('#username_error').html("Username field must not be empty").addClass("error_show");
            $('#username').addClass("invalid");
        }
        if (!$('#email2').val()) {
            $('#email2_error').html("Email field must not be empty").addClass("error_show");
            $('#email2').addClass("invalid");
        }
        if (!$('#password2').val()) {
            $('#password2_error').html("Please enter a password").addClass("error_show");
            $('#password2').addClass("invalid");
        }
    })
    $("#signin_option").click(function() {
        $("#first").removeClass('active');
        $("#third").removeClass('active');
        $("#second").addClass('active');
        $("#second").addClass('active');
        $("#box_signin").show();
        $("#box_login").hide();

    });


    $("#signupForm").on("submit", function(event) {
        event.preventDefault();
        $.ajax({
            type: "POST",
            data: $(this).serialize(),
            url: "signup.php",
            success: function(response) {
                $('#password2_error').html(response).removeClass("error_show");
                $("#box_signin").hide();
                $("#box_login").show();
            },
            error: function() {
                console.log("Error getting data");
            }
        });
        return false;
    });
});