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
                $('#accountUserName').val(data.username);
                $('#profileEmail').html(data.email);
                find_customer_by_id(data.customer_id);
            }
        });
    } 
    find_user_by_id();

    
    // gender gender by id 
    function find_gender_by_id(gender_id){
        var action = "FECH_GENDER";
        $.ajax({
            url  : base_url+'api/customer_gender/fetch.php',
            type : "POST",
            data : {action:action, gender_id:gender_id}, 
            success: function(data){
                $('#customerGender').html(data.gender);
            }
        });
    }

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
                find_gender_by_id(data.gender_id);
                $('#customerPostalAddress').html(data.postal_address);
                $('#customerPhysicalAddress').html(data.physical_address);
                find_country_by_id(data.country_id);
                $('#customerPhone').html(data.phone_number);
                $('#customerAltPhone').html(data.alt_phone_number);
            }
        }); 
    }

    // find country by id 
    function find_country_by_id(country_id){
        var action = "FETCH_COUNTRY";
        $.ajax({
            url  : base_url+'api/countries/fetch.php',
            type : "POST",
            data : {action:action, country_id:country_id}, 
            success: function(data){
                $('#customerCountry').html(data.country);
            }
        });
    }

    // update username 
    $('#usernameForm').submit(function(event){
        event.preventDefault();
        var action = "UPDATE_USERNAME";
        var username = $('#accountUserName').val();
        var DataToSend = 'action='+action+'&username='+username;
        $.ajax({
            url        : base_url+'api/users/update.php',
            type       : "POST",
            data       : DataToSend, 
            beforeSend : function(){
                $('#updateUsernameBtn').html('Updating...');
            },
            success: function(data){
                $('#updateUsernameBtn').html('Update');
                if(data.message == 'success'){
                    find_user_by_id();
                    window.location.href = base_url+'public/users/index.php';
                }else{
                    $('#alertMessage').html('<div class="alert alert-danger alert-dismissible">There was a problem in updating username</div>');
                }
            }
        });

    });
});