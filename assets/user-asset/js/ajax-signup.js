
$(document).ready(function() {
    
    $("#submit").on("click", function(e) {

        var isvalidate = $("#signup_form")[0].checkValidity();
        if (isvalidate) {
        e.preventDefault();
        var f_name = $('#f_name').val();
        var l_name = $('#l_name').val();
        var u_name = $('#u_name').val();
        var pswd = $('#pswd').val();
        var e_id = $('#e_id').val();
        var ph_no = $('#ph_no').val();

            $.ajax({
                url: "../../../realestate/homes/php/user-signup.php",
                method: "POST",
                data: {

                    "f_name": f_name,
                    "l_name": l_name,
                    "u_name": u_name,
                    "pswd": pswd,
                    "e_id": e_id,
                    "ph_no": ph_no
                },
                success: function(response) {
                    $('#signup_form')[0].reset();
                    $('#signup').modal('hide');
                    $('#signup-success-toast').toast('show');
                    
                },
                error: function(response) {
                    alert("Sign up Error !");
                }
            });
        }
    });
    
});
