$(document).ready(function(){
    // Get apps 
      // get apps 
      function fetch_apps(){
        $.ajax({
            url: base_url+'api/app/fetch.php',
            type:'POST',
            dataType:'json',
            success:function(data){
                var create_div = "";
                if(data.message == 'empty'){
                    create_div += '<div class="col-lg-3 col-xs-6">';
                    create_div += '<div class="small-box bg-red">';
                    create_div += '<div class="inner">';
                    create_div += '<h3>&nbsp;</h3>';
                    create_div += '<p>No Apps</p>';
                    create_div += '</div>';
                    create_div += '<div class="icon">';
                    create_div += '<i class="ion ion-bag"></i>';
                    create_div += '</div>';
                    create_div += '<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>';
                    create_div += '</div>';
                    create_div += '</div>';
                }else{ 
                    data.map(function(opt){
                        create_div += '<div class="col-lg-3 col-xs-6">';
                        create_div += '<div class="small-box bg-green">';
                        create_div += '<div class="inner">';
                        create_div += '<h3>&nbsp;</h3>';
                        create_div += '<p>'+opt.app_name+'</p>';
                        create_div += '</div>';
                        create_div += '<div class="icon">';
                        create_div += '<i class="ion ion-bag"></i>';
                        create_div += '</div>';
                        create_div += '<a href="#" id="'+opt.id+'" class="small-box-footer selectApp">More info <i class="fa fa-arrow-circle-right"></i></a>';
                        create_div += '</div>';
                        create_div += '</div>';
                    });  
                }
                $('#apps_data').append(create_div);
            }
        });
    }
    //fetch_apps();
});