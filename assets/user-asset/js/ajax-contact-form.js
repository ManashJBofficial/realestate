$(document).ready(function () {
    $("#c_submit").on("click",function (e) {
        var isvalidate = $("#contact_form")[0].checkValidity();
        if (isvalidate) {
            e.preventDefault();
            var formData = {
                csrf_token: $("#csrf_token").val(),
                c_name: $("#c_name").val(),
                c_mobile: $("#c_mobile").val(),
                c_email: $("#c_email").val(),
                c_subject: $("#c_subject").val(),
                c_msg: $("#c_msg").val()
            };
            var dataurl = '/realestate/myadmin/actions/contact.php';
            $.ajax({
                url: dataurl,
                method: "POST",
                data: formData,
                beforeSend: function(xhr){
                    $('#c_submit').html('SENDING...');
                },
                success: function(response) {             
                    $('#contact_form')[0].reset();
                    $('#contactmodal').modal('hide');
                    $('#c_submit').html('Send Message');
                    
                    if(response=='ok')
                    {
                        $('#msg-sent-success-toast').toast('show');
                    }
                    else if(response=='csrf_mismatch'){
                        $('#msg-csrf-failed-toast').toast('show');
                    }
                    else{
                        $('#msg-sent-failed-toast').toast('show');
                        
                    }
                },
                error: function(response) {
                    alert('Something Went Wrong !');
                    $('#c_submit').html('Send Message');
                }
            });
        }
    });
});