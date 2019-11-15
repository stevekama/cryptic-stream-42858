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
    fetch_apps();

    // new app.
    $('#newAppBtn').click(function(){
        $('#newAppModal').modal('show');
        $('#newAppForm')[0].reset();
    });

     // submit app
     $('#newAppForm').submit(function(event){
        event.preventDefault();
        var form_data = $(this).serialize();
        $.ajax({
            url:base_url+'api/app/register_app.php',
            type: 'POST',
            data:form_data,
            dataType:'json',
            cache:false,
            success:function(data){
                if(data.message == 'success'){
                    if(data.method == 'PAYPAL'){
                        fetch_apps();
                        $('#newAppModal').modal('hide');
                        $('#newAppForm')[0].reset();
                        window.location.href = base_url+'public/index.php';
                    }
                    if(data.method == 'MPESA'){
                        $('#newAppModal').modal('hide');
                        $('#newAppForm')[0].reset();
                        $('#shortcode').val('');
                        $('#lipanampesacode').val('');
                        $('#lipanampesapasskey').val('');
                        $('#mpesaAppToken').val(data.token);
                        $('#mpesaDetailsModal').modal('show');
                    }
                }
            }
        });
    });

    // submit mpesa details 
    $('#mpesaDetailsForm').submit(function(event){
        event.preventDefault();
        var form_data = $(this).serialize();
        $.ajax({
            url:base_url+'api/m_api/register_url.php',
            type: 'POST',
            data:form_data,
            dataType:'json',
            cache:false,
            success:function(data){
                if(data.message == 'success'){
                    fetch_apps();
                    $('#mpesaDetailsModal').modal('hide');
                    $('#mpesaDetailsForm')[0].reset();
                    window.location.href = base_url+'public/index.php';
                }
            }
        });

    });
    

});