$(document).ready(function(){
    function fetch_transactions(){
        $.ajax({
            url : base_url+'api/paypal_api/fetch.php',
            type:'POST',
            dataType:'json',
            success:function(data){
                var create_div = ""; 
                data.map(function(opt){
                    create_div += '<tr>';
                    create_div += '<td>'+opt.app_name+'</td>';
                    create_div += '<td>'+opt.transaction_id+'</td>';
                    create_div += '<td>'+opt.payment_amount+'</td>';
                    create_div += '<td>'+opt.payment_status+'</td>';
                    create_div += '<td>'+opt.transaction_date+'</td>';
                });
                $('#loadTransactions').append(create_div);
            }
        });
    }
    fetch_transactions();
});