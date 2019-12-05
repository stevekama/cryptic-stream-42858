$(document).ready(function(){
    // display the forgot pass form and hide other forms
    $('#forgotPassForm').fadeIn(800).show();
    $('#checkCodeForm').fadeOut(900).hide();
    $('#newPasswordForm').fadeOut(900).hide();

    // submit forgot pass
    $('#forgotPassForm').submit(function(event){
        event.preventDefault();
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
                $('#forgotPassSubmitBtn').html('Enter');
                if(data.message == 'success'){
                    $('#forgotPassForm').fadeOut(900).hide();
                    $('#checkCodeForm').fadeIn(800).show();
                    $('#newPasswordForm').fadeOut(900).hide();
                }
                if(data.message == 'emailDoesnotExist'){
                    $('#forgotPassErrorMessage').html('<div class="alert alert-danger alert-dismissible">The email entered doesnot exists. Please check and try again...</div>');
                    return false;
                }
            }

        }); 
    });

    // submit the code
    $('#checkCodeForm').submit(function(event){
        event.preventDefault();
        var form_data = $(this).serialize();
        $.ajax({
            url: base_url + "api/users/new_password.php",
            type: 'POST',
            data: form_data,
            dataType: 'json',
            beforeSend:function(){
                $('#checkCodeSubmitBtn').html('Loading...');
            },
            success:function(data){
                $('#checkCodeSubmitBtn').html('Enter');
                if(data.message == 'wrongToken'){
                    $('#checkCodeErrorMessage').html('<div class="alert alert-danger alert-dismissible">The code entered is wrong. Please check and try again...</div>');
                    return false;
                }else{
                    $('#currentUserId').value(data.id);
                    $('#forgotPassForm').fadeOut(900).hide();
                    $('#checkCodeForm').fadeOut(900).hide();
                    $('#newPasswordForm').fadeIn(800).show();    
                }                
            }
        }); 
    });

    // submit new password
});