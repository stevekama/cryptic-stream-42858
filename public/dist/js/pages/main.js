$(document).ready(function(){
    // get apps 
    function fetch_apps(){
        $.ajax({
            url: base_url+'api/app/fetch.php',
            type:'POST',
            dataType:'json',
            success:function(data){
                var app_data = [];
                for (var i = 0; i < data.length; i++) {
                    for (var key in data[i]) {
                        if (app_data.indexOf(key) === -1) {
                            app_data.push(key);
                        }
                    }
                }
                console.log(app_data);
            }
        });
    }
    fetch_apps();
});