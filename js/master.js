$(document).ready(function() {
    $(".registration-form form").on("submit", function(e){
        e.preventDefault(); // prevent form from submitting
        var username = $("#username").val();
        var password = $("#password").val();
        var email = $("#email").val();
        var city = $("#city").val();

        if(username === "") {
            $("#username").next(".error-message").html("Please enter a username").css("display", "block");
        } else if(password === "") {
            $("#password").next(".error-message").html("Please enter a password").css("display", "block");
        } else if(email === "") {
            $("#email").next(".error-message").html("Please enter an email").css("display", "block");
        } else if(city === "") {
            $("#city").next(".error-message").html("Please enter a city").css("display", "block");
        } else {
            var data = {
                "username": username,
                "password": password,
                "email": email,
                "city": city
            };

            $.ajax({
                type: "POST",
                url: "index.php?register",
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
