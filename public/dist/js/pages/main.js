$(document).ready(function(){
    // get apps 
    function fetch_apps(){
        $.ajax({
            url: base_url+'api/app/fetch.php',
            type:'POST',
            dataType:'json',
            success:function(data){
                $.map(data, function(val, key) {
                    alert("Value is :" + val);
                    alert("key is :" + key);
                });
                
            }
        });
    }
    fetch_apps();
});