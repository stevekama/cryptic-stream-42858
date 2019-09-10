$(document).ready(function(){
    $('#paypalForm').submit(function(e){
        e.preventDefault();
        var form_data = $(this).serialize();
        $.ajax({
            url:base_url+'api/paypal_api/checkout.php',
            type:"POST",
            data:form_data,
            dataType:'json',
            success:function(data){
                console.log(data);
            }     
        });
    });
});