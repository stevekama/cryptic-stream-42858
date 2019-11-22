$(document).ready(function(){
    // user wallet
    function fetch_user_wallet(){
        var action = "FETCH_FOR_CUSTOMER";
        $.ajax({
            url: base_url+'api/customer_wallet/fetch.php',
            type:'POST',
            data:{action:action},
            dataType:'json',
            success:function(data){
                $('#customerWallet').html(data.amount);
                fetch_transactions();

            }
        });
    }
    fetch_user_wallet()

    // get tranactions
    function fetch_transactions(){
        $.ajax({
            url: base_url+'api/transactions/read.php',
            type:'POST',
            dataType:'json',
            success:function(data){
                if(data.message == 'empty'){
                    $('#errorMessageData').html('<div class="alert alert-danger alert-dismissible">No Transactions Found yet</div>');
                    return false;
                }else{
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
            }
        });
    }

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