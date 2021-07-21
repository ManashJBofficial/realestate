
    function delClick(e)
    {
        
        var delid= e;
        $.ajax({
            url: "/realestate/myadmin/actions/deleteFavouriteApt.php",
            method: "POST",  
            data:
            {
                id:delid
            },        
            success: function(response) {
                $('.'+delid).remove();
                
                if(response=='Deleted')
                {
                    $('#delete-success-toast').toast('show');
                }                
            },
            error: function(response) {
                console.log(response);
            }
        });
    
    }

