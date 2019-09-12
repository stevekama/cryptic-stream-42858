$(document).ready(function(){
    // get apps 
    function fetch_apps(){
        $.ajax({
            url: base_url+'api/app/fetch.php',
            type:'POST',
            dataType:'json',
            success:function(data){
                $.each(data, function( key, value ) {
                    alert( key + ": " + value );
                });
            }
        });
    }
    fetch_apps();
});