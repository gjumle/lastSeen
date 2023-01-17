$(document).ready(function() {
    $(".registration-form form input").on("focusout", function() {
        if($(this).val() === "") {
            $(this).next(".error-message").html("This field is required").css("display", "block");
        } else {
            $(this).next(".error-message").html("").css("display", "none");
        }
    });

    $(".registration-form form").on("submit", function(e){
        e.preventDefault(); // prevent form from submitting

        var isValid = true;
        $(".registration-form form input").each(function() {
            if($(this).val() === "") {
                isValid = false;
                $(this).next(".error-message").html("This field is required").css("display", "block");
            }
        });

        if(isValid) {
            // create an object to hold the form data
            var data = {
                "username": $("#username").val(),
                "password": $("#password").val(),
                "email": $("#email").val(),
                "city": $("#city").val()
            };

            // send the request using jQuery's ajax method
            $.ajax({
                type: "POST",
                url: "your-server-script-url.php",
                data: data,
                success: function(response) {
                    if(response.status === "success") {
                        alert("Registration successful!");
                    } else {
                        alert("Registration failed: " + response.message);
                    }
                }
            });
        }
    });
});

$(document).ready(function() {
    $('.login-form form input').on('focusout', function() {
        if($(this).val() === '') {
            $(this).next('.error-message').html('This field is required').css('display', 'block');
        } else {
            $(this).next('.error-message').html('').css('display', 'none');
        }
    });

    $('.login-form form').on('submit', function(e) {
        e.preventDefault();

        var isValid = true;
        $('.login-form form input').each(function() {
            if($(this).val() === '') {
                isValid = false;
                $(this).next('.error-message').html('This field is required').css('display', 'block');
            }
        });

        if(isValid) {
            var data = {
                'username': $('#username').val(),
                'password': $('#password').val()
            };

            $.ajax({
                type: 'POST',
                url: 'your-server-script-url.php',
                data: data,
                success: function(response) {
                    if(response.status === 'success') {
                        alert('Login successful!');
                    } else {
                        alert('Login failed: ' + response.message);
                    }
                }
            });
        }
    });
});

