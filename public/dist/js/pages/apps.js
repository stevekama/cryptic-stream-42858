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
                    $('#appsAlertMessage').html('<div class="alert alert-danger alert-dismissible">No applications found for te user.</div>');
                    return false;
                }else{ 
                    data.map(function(opt){
                        create_div += '<tr>';
                        create_div += '<td>'+opt.app_name+'</td>';
                        create_div += '<td>'+opt.app_method+'</td>';
                        create_div += '<td>'+opt.app_token+'</td>';
                        create_div += '<td>'+opt.response_url+'</td>';
                        create_div += '</tr>';
                    });  
                }
                $('#apps_data').append(create_div);
            }
        });
    }
    //fetch_apps();
});