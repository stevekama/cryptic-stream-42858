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
                    create_div += '<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>';
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
                    create_div += '<td>'+opt.transaction_currency+'</td>';
                    create_div += '<td>'+opt.transaction_method+'</td>';
                    create_div += '<td>'+opt.transaction_status+'</td>';
                    create_div += '</tr>';
                });
                $('#loadTransactions').append(create_div);
            }
        });
    }
    fetch_transactions();
});