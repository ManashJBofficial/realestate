$(document).ready(function () {
    $("#s_submit").on("click",function (e) {
        var isvalidate = $("#single_contact_form")[0].checkValidity();
        if (isvalidate) {
            e.preventDefault();
            var formData = {
                csrf_token: $("#csrf_tokens").val(),
                apt_name: $("#apt_name").val(),
                s_name: $("#s_name").val(),
                s_email: $("#s_email").val(),
                s_mobile: $("#s_mobile").val(),
                s_desc: $("#s_desc").val()
            };
            var dataurl = '/realestate/myadmin/actions/contactApt.php';
            $.ajax({
                url: dataurl,
                method: "POST",
                data: formData,
                beforeSend: function(xhr){
                    $('#s_submit').html('SENDING...');
                },
                success: function(response) {             
                    $('#single_contact_form')[0].reset();
                    $('#single_prop_contact').modal('hide');
                    $('#s_submit').html('Send Message');
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
                    alert('Something Went Wrong !')
                }
            });
        }
    });
});