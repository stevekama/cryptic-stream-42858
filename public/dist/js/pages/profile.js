$(document).ready(function(){
    // get user details 
    function find_user_by_id(){
        var action = "FETCH_USER";
        $.ajax({
            url  : base_url+'api/users/users.php',
            type : "POST",
            data : {action:action}, 
            success: function(data){
                $('.profile-username').html(data.username);
                $('#profileEmail').html(data.email);
            }
        });
    } 
    find_user_by_id();
    
    // get customer details
    
});