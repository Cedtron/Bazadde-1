$(document).ready(function () {
    // Hide the spinner initially
    var spinnerTimeout;

    function hideSpinner() {
        clearTimeout(spinnerTimeout);
        if ($('#loader').length > 0) {
            $('#loader').removeClass('show');
        }
    }


    

    $("#loading_spinner").addClass("d-none");

    $("#log").submit(function (event) {
        event.preventDefault();
    
        var user = $("#user").val();
        var pass = $("#password").val();
    
        if (user !== "" && pass !== "") {
            $("#loading_spinner").removeClass("d-none");
    
            $.ajax({
                type: 'post',
                url: 'aserver.php',
                data: {
                    admin: user,
                    password: pass,
                    dash: true // Add this parameter to match with PHP script
                },
                success: function (res) {
                    if (res.success) {
                        sessionStorage.setItem('email', res.email);
                        sessionStorage.setItem('role', res.role);
                        sessionStorage.setItem('ids', res.id);
                        window.location.href = "index.php";
                    } else {
                        $("#error").removeClass("d-none");
                        $("#loading_spinner").addClass("d-none");
                        $("#error").html(res.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                    $("#error").removeClass("d-none");
                    $("#loading_spinner").addClass("d-none");
                    $("#error").html("An error occurred. Please try again later.");
                }
            });
        } else {
            $("#error").html("Please Fill All The Details");
            console.log("Please Fill All The Details")
        }
    });
});