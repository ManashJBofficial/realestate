$(document).ready(function() {
    let limit = 3;
    let start = 0;
    let action = 'inactive';
    function load_data(limit, start)
    {
    $.ajax({
        type: "POST",
        data:{limit:limit, start:start},
        cache:false,
        url: "/realestate/myadmin/actions/loadData.php",             
        success: function(data){                    
            $('#load_data').append(data);
            if(data == '')
            {
            $('#load_data_message').html("<div class='text-center'><button type='button' class='btn btn-dark btn-rounded' disabled>You're all caught up</button></div>");
            action = 'active';
            }
            else
            {
            $('#load_data_message').html("<div class='text-center'><button type='button' class='btn btn-warning btn-rounded' disabled>Please Wait....</button></div>");
            action = "inactive";
            }
        }
        
    });
    }
    
    if(action == 'inactive')
    {
    action = 'active';
    load_data(limit, start);
    }
    $(window).scroll(function(){
        if($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive')
        {
        action = 'active';
        start = start + limit;
        setTimeout(function(){
        load_data(limit, start);
        }, 1000);
        }
    });
});
