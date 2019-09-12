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
                var create_div = '';
                for (var i = 0; i < data.length; i++) {
                    create_div += '<div class="col-lg-3 col-xs-6">';
                    create_div += '<div class="small-box bg-green">';
                    create_div += '<div class="inner">';
                    create_div += '<h3>&nbsp;</h3>';
                    create_div += '<p>Transactions</p>';
                    create_div += '</div>';
                    create_div += '<div class="icon">';
                    create_div += '<i class="ion ion-bag"></i>';
                    create_div += '</div>';
                    create_div += '<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>';
                    create_div += '</div>';
                    create_div += '</div>';
                }

                $('#apps_data').append(create_div);
        
            }
        });
    }
    fetch_apps();
});