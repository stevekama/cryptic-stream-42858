$(document).ready(function(){
    // get apps 
    function fetch_apps(){
        $.ajax({
            url: base_url+'api/app/fetch.php',
            type:'POST',
            dataType:'json',
            success:function(data){
                var create_div = ""; 
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
                $('#apps_data').append(create_div);
            }
        });
    }
    fetch_apps();

    function fetch_transactions(){
        $.ajax({
            url: base_url+'api/transactions/read.php',
            type:'POST',
            dataType:'json',
            success:function(data){
                var create_div = ""; 
                data.map(function(opt){
                    create_div += '<tr>';
                    create_div += '<td>'+opt.app+'</td>';
                    create_div += '<td>'+opt.transaction_id+'</td>';
                    create_div += '<td>'+opt.transaction_time+'</td>';
                    create_div += '<td>'+opt.product+'</td>';
                    create_div += '<td>'+opt.transaction_amount+'</td>';
                    create_div += '<td>'+opt.transaction_method+'</td>';
                    create_div += '<td>'+opt.transaction_status+'</td>';
                    create_div += '</tr>';
                });
                $('#loadTransactions').append(create_div);
            }
        });
    }
    fetch_transactions();

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
                    }
                    if(data.method == 'MPESA'){
                        $('#newAppModal').modal('hide');
                        $('#newAppForm')[0].reset();
                        $('#mpesaDetailsModal').modal('show');
                        $('#mpesaDetailsForm')[0].reset();
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
                    if(data.method == 'PAYPAL'){
                        fetch_apps();
                        $('#mpesaDetailsModal').modal('hide');
                        $('#mpesaDetailsForm')[0].reset();
                    }
                }
            }
        });

    });
    
    $(document).on('click', '.selectApp', function(){
        var app_id = $(this).attr('id');
        $.ajax({
            url:base_url+'api/app/fetch_single.php',
            type:'POST',
            data:{id:app_id},
            dataType: 'json',
            success:function(data){
                $('#appName').html(data.app_name);
                $('#appKey').html(data.app_key);
                $('#appSecret').html(data.app_secret);
                $('#appToken').html(data.app_token);
                $('#appDetailsModal').modal('show');
            }

        });
    });
});