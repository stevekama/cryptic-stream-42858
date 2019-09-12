$(document).ready(function(){
    // get apps 
    function fetch_apps(){
        $.ajax({
            url: base_url+'api/app/fetch.php',
            type:'POST',
            dataType:'json',
            success:function(data){
                $.getJSON(data, function(json_data){
                    var app_data = '';
                    $.each(json_data, function(key, value){
                        app_data += '<div class="col-lg-3 col-xs-6">';
                        app_data += '<div class="small-box bg-green">';
                        app_data += '<div class="inner">';
                        app_data += '<h3>&nbsp;</h3>';
                        app_data += '<p>Transactions</p>';
                        app_data += '</div>';
                        app_data += '<div class="icon">';
                        app_data += '<i class="ion ion-bag"></i>';
                        app_data += '</div>';
                        app_data += '<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>';
                        app_data += '</div>';
                        app_data += '</div>';
                    });
                    $('#apps_data').append(app_data);
                });
            }
        });
    }
    fetch_apps();
});