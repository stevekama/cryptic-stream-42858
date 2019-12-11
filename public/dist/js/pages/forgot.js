$(document).ready(function(){

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
                    $('#forgotPassErrorMessage').html('<div class="alert alert-success alert-dismissible">An Email has been successfully sent to you. Check your email to continue...</div>');
                    $('#email').val('');
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
                    $('#currentUserId').val(data.id);
                    $('#forgotPassForm').fadeOut(900).hide();
                    $('#checkCodeForm').fadeOut(900).hide();
                    $('#newPasswordForm').fadeIn(800).show();    
                }                
            }
        }); 
    });

    // submit new password
    $('#newPasswordForm').submit(function(event){
        event.preventDefault();
        var form_data = $(this).serialize();
        $.ajax({
            url: base_url + "api/users/new_password.php",
            type: 'POST',
            data: form_data,
            dataType: 'json',
            beforeSend:function(){
                $('#newPasswordSubmitBtn').html('Loading...');
            },
            success:function(data){
                $('#newPasswordSubmitBtn').html('Enter');
                if(data.message == 'success'){
                    // send notification email and redirect
                    var to = data.user.email;
                    var to_username = data.user.username;
                    var subject = "Welcome To Iko Pay";
                    var message = '<p>You have successfully changed your password.</p><p>You can now log in to your account..</p>';
                    if(send_mail(to, to_username, subject, message)){
                        window.location.href = base_url+'index.php';
                    }
                }
            }
        }); 
    });

    function send_mail(to, to_username, subject, message){
        var dataToSend = 'to='+to+'&to_username='+to_username+'&subject='+subject+'&message='+message;
        $.ajax({
            url: base_url + "api/users/mail.php",
            type: 'POST',
            data: dataToSend,
            dataType: 'json',
            success:function(data){
                if(data.message == 'success'){
                    return true;
                }else{
                    return false;    
                }                
            }
        }); 
    }
});