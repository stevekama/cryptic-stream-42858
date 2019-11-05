$(document).ready(function(){
    // get user details 
    function find_user_by_id(){
        var action = "FETCH_USER";
        $.ajax({
            url  : base_url+'api/users/users.php',
            type : "POST",
            data : {action:action}, 
            success: function(data){
                $('#profileImg').html('<img class="profile-user-img img-responsive img-circle" src="'+base_url+'public/dist/img/'+data.profile+'" alt="User profile picture">');
                $('.profile-username').html(data.username);
                $('#profileEmail').html(data.email);
            }
        });
    } 
    find_user_by_id();

    // get customer details
    
});