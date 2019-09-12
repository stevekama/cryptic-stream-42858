$(document).ready(function(){
    // get apps 
    function fetch_apps(){
        $.ajax({
            url: base_url+'api/app/fetch.php',
            type:'POST',
            dataType:'json',
            success:function(data){
                var app_data = [];
                for(var key in data){
                    if(data.hasOwnProperty(key)){
                        var item = data[key];
                        app_data.push({
                            ItemName: item.data.app_name
                        });
                    }
                }
                console.log(app_data);
            }
        });
    }
    fetch_apps();
});