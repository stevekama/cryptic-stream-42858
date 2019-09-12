$(document).ready(function(){
    // get apps 
    function fetch_apps(){
        $.ajax({
            url: base_url+'api/app/fetch.php',
            type:'POST',
            dataType:'json',
            success:function(data){
                var dataItems = "";
                $.each(data, function (index, itemData) {
                    dataItems += index + ": " + itemData + "\n";
                });
                console.log(dataItems);
            }
        });
    }
    fetch_apps();
});