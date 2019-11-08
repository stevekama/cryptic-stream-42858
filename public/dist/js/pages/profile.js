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
                find_customer_by_id(data.customer_id);
            }
        });
    } 
    find_user_by_id();

    // get customer details
    function find_customer_by_id(customer_id){
        var action = "FETCH_CUSTOMER";
        $.ajax({
            url  : base_url+'api/customers/fetch_customers.php',
            type : "POST",
            data : {action:action, customer_id:customer_id}, 
            success: function(data){
                $('#customerFullNames').html(data.first_name+' '+data.other_names);
                $('#customerEmailAddress').html(data.email_address);
                $('#customerDOB').html(data.dob);
                $('#customerGender').html(data.gender_id);
                $('#customerPostalAddress').html(data.postal_address);
                $('#customerPhysicalAddress').html(data.physical_address);
                $('#customerCountry').html(data.country_id);
                $('#customerPhone').html(data.phone_number);
                $('#customerAltPhone').html(data.alt_phone_number);
            }
        });
        
    }
});