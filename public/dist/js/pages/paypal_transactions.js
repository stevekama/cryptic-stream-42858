$(document).ready(function(){
    function fetch_transactions(){
        $.ajax({
            url : base_url+'api/paypal_api/fetch.php',
            type:'POST',
            dataType:'json',
            success:function(data){
                var create_div = "";
                if(data.message == 'empty'){
                    $('#alertMessage').html('<div class="alert alert-danger alert-dismissible">No Paypal Transactions found...</div>');
                    return false;
                }else{
                    data.map(function(opt){
                        create_div += '<tr>';
                        create_div += '<td>'+opt.app_name+'</td>';
                        create_div += '<td>'+opt.transaction_id+'</td>';
                        create_div += '<td>'+opt.payment_amount+'</td>';
                        create_div += '<td>'+opt.payment_status+'</td>';
                        create_div += '<td>'+opt.transaction_date+'</td>';
                        create_div += '</tr>';
                    });
                    $('#paypalTransactionsData').append(create_div);
                }
            }
        });
    }
    fetch_transactions();
    
});