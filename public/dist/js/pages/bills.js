$(document).ready(function(){

    // load merchants
    var loadMerchants = $('#loadMerchants').DataTable({
        "processing":true,
        "serverSide":true,
        "order":[],
        "ajax":{
            url: base_url+"api/organizations/fetch.php",
            type:"POST",
        },
        "columnDefs":[
            {
                "targets":[0, 4],
                "orderable":false,
            },  
        ],
        "autoWidth":false
    });

    // make payments
    $(document).on('click', '.pay', function(){
        var action = "FETCH_USER_BY_ID";
        var user_id = $(this).attr('id');
        $.ajax({
            url:base_url+'/api/organizations/organizations.php',
            type:"POST",
            data:{action:action, user_id:user_id},
            dataType:"json",
            success:function(data){
                if(data.message == "errorUser"){
                    return false;
                }else{
                    $('#paymentUserId').val(data.user.id);
                    $('#makePaymentModal').modal('show');
                }
            }
        });
    });

    // submit payments
    

    // bring in utilities
    var loadUtilities = $('#loadUtilities').DataTable({
        "processing":true,
        "serverSide":true,
        "order":[],
        "ajax":{
            url: base_url+"api/utilities/fetch.php",
            type:"POST",
        },
        "columnDefs":[
            {
                "targets":[1],
                "orderable":false,
            },  
        ],
        "autoWidth":false
    });
});