$(document).ready(function(){
    $(document).on('click', 'a[id^="remove-"]', function(){
        var p_id  = $();
        $.ajax({ 
        method:'GET',
        url:"removemycart",
        data:{
            product_id:product,
        },
        success:function(response)
        {

        }
        });
    });
});