
$(document).ready(function() {
    $("#saveApartment").on("click", function(e) {
        e.preventDefault();
        
            $.ajax({
                url: "/realestate/myadmin/actions/saveApt.php",
                method: "POST",  
                success: function(response) {
                    // $('#fav-toast').toast('show');
                    $("#saveApartment").html('<i class="fas fa-heart"></i>'+response);
                    if(response=='Saved') 
                    {
                        $('#save-success-toast').toast('show');
                    }
                    else if(response=='Save'){
                        $('#delete-success-toast').toast('show');
                    }
                    else if(response=='Login to Save'){
                    $('#login').modal('show');
                    }

                },
                error: function(response) {
                    alert(response);
                }
            });
        
    });
    
});
