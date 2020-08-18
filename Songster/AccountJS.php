<?php header("Content-type: application/javascript"); ?>
$(document).ready(function() {
    <?php session_start(); ?>
    var U_ID = '<?php echo $_SESSION['sess_ID']?>';
    $('#Update').prop('disabled', true);
    $("input[type='text']").prop('disabled', true);

    
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

    
    $('#email_us').on('input', function() {
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

    
    $('#password2').on('input', function() {
        var input = $(this);
        var pass_val = input.val();
        var pass_regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        if (pass_val) {
            if (pass_regex.test(pass_val)) {
                $('#password2_error').html("");
                input.removeClass("invalid").addClass("valid");
                var password_hash = md5(pass_val); //Hashed Password
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

    
    $('#fullname').on('input', function() {
        var input = $(this);
        var user_val = input.val();
        if (user_val) {
            if (user_val.length >= 5 && user_val.length <= 30) {
                $('#username_error').html("");
                input.removeClass("invalid").addClass("valid");
            } else {
                $('#username_error').html("Username should be between 5 and 30 characters").addClass("error_show");
                input.removeClass("valid").addClass("invalid");
            }
        } else {
            input.removeClass("valid");
            input.removeClass("invalid");
            $('#username_error').html("").removeClass("error_show");
        }
    });

    $("#Edit").click(function() {
        $('#Update').prop('disabled', false);
        $("input[type='text']").prop('disabled', false);
        $('#Edit').prop('disabled', true);
    });
    $(document).on('click', '.navbar li', function() {
        $(".navbar li").removeClass("active");
        $(this).addClass("active");
    });

    $("#Logout").click(function() {
        location.href = "logout.php";
    });

    $("#Update").click(function(e) {
        e.preventDefault();
        $('#Update').prop('disabled', true);
        $("input[type='text']").prop('disabled', true);
        $('#Edit').prop('disabled', false);
        var username = $('#username').val();
        var email = $('#email_us').val();
        var phone = $('#Phone').val();
        var fname = $('#fullname').val();
        $.ajax({
            type: "POST",
            data: "Username=" + username + "&Email=" + email + "&Phone=" + phone + "&Fname=" + fname + "&UserID=" + U_ID,
            url: "User_update.php",
            success: function(response) {
                alert("Data updated succesfully")
            },
            error: function() {
                console.log("Error getting data");
            }
        });
    });

});