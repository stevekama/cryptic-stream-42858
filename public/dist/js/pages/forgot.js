$(document).ready(function(){
    // display the forgot pass form and hide other forms
    $('#forgotPassForm').fadeIn(800).show();
    $('#checkCodeForm').fadeOut(900).hide();
    $('#newPasswordForm').fadeOut(900).hide();

    // submit forgot pass
    $('#forgotPassForm').submit(function(event){
        var form_data = $(this).serialize();
        $.ajax({
            url: base_url + "api/users/forgot.php",
            type: 'POST',
            data: form_data,
            dataType: 'json',
            beforeSend:function(){
                $('#forgotPassSubmitBtn').html('Loading...');
            },
            success:function(data){
                if(data.message == 'success'){
                    $('#forgotPassForm').fadeOut(900).hide();
                    $('#checkCodeForm').fadeIn(800).show();
                    $('#newPasswordForm').fadeOut(900).hide();
                }
            }

        }); 
    });

    // submit the code
});