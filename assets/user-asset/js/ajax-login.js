$(document).ready(function() {                 
    $("#login_form").submit(function(e){
        e.preventDefault();
        $.ajax({
        url:'../../../homes/php/user-login.php',
        type:'POST',
        data: {
            username:$("#us_name").val(), 
            password:$("#u_pswd").val()
            },
        success: function(resp) {
            if(resp == "invalid") {
            $("#errorMsg").html("Invalid username and password!");  
            } else {
            // window.location.href= resp;
            console.log("Logged In");
            $('#signup_form')[0].reset();
            $('#signup').modal('hide');
            }
        }
        });
    });
});