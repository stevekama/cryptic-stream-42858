$(document).ready(function(){
    // get user details 
    function find_user_by_id(){
        var action = "FETCH_USER";
        $.ajax({
            url  : base_url+'api/users/users.php',
            type : "POST",
            data : {action:action}, 
            dataType:"json",
            success: function(data){
                // console.table(data);
                $('#profileImg').html('<img class="profile-user-img img-responsive img-circle" src="'+base_url+'public/dist/img/'+data.profile+'" alt="User profile picture">');
                $('.profile-username').html(data.username);
                $('#accountUserName').val(data.username);
                $('#profileEmail').html(data.email);
                find_customer_by_id(data.customer_id);
                find_customer_docs(data.customer_id);
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
            dataType: "json", 
            success: function(data){
                // console.table(data);
                $('#customerDocId').val(data.id);
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

    // get customer docs 
    function find_customer_docs(customer_id){
        var action = "FETCH_ALL_FOR_CUSTOMER";
        $.ajax({
            url  : base_url+'/api/customer_individual_docs/fetch.php',
            type : "POST",
            data : {action:action, customer_id:customer_id}, 
            success: function(data){
                var create_div = "";
                if(data.message == 'empty'){
                    $('#docsDataMessage').html('<div class="alert alert-danger alert-dismissible">No Customer Documents found...</div');
                    return false;
                }else{
                    data.map(function(opt){
                        create_div += '<tr>';
                        create_div += '<td>'+opt.customer_identity_doc_type_id+'</td>';
                        create_div += '<td>'+opt.identification_doc+'</td>';
                        create_div += '</tr>';
                    });
                    $('#loadDocs').append(create_div);

                }
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

    // add customer document
    var isSelectDocs = 0;
    function selectCustomerDocs(data, customerDocId){
      if(isSelectDocs == 0){
        isSelectDocs = 1;
        var select = document.getElementById(customerDocId);
        var defaultOption = document.createElement('option');
        defaultOption.appendChild(document.createTextNode('Choose document'));
        defaultOption.setAttribute('value', '');
        defaultOption.setAttribute('disabled', '');
        defaultOption.setAttribute('selected', '');
        select.appendChild(defaultOption);
        data.map(function(oneOpt){
            var option = document.createElement('option');
            option.appendChild(document.createTextNode(oneOpt.identification_doc_type));
            option.setAttribute('value', oneOpt.id);
            select.appendChild(option);
        });
      }else{
        isSelectDocs = 0;
      }
    }
    // fetch all customer identity docs
    // click new doc 
    $('#newDocBtn').click(function(){
        // find all documents
        var action = "FETCH_ALL";
        $.ajax({
            url  : base_url+'api/customer_doc/fetch.php',
            type : "POST",
            data : {action:action}, 
            dataType:"json",
            success: function(data){
                console.table(data);
            }
        });

    });

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

    // update password 
    $('#changePassForm').submit(function(event){
        event.preventDefault();
        var password = $('#currentPassword').val();
        var new_password = $('#newPassword').val();
        var confirm_pass = $('#confirmPassword').val();
        if(new_password === confirm_pass){
            var DataToSend = 'password='+password+'&new_password='+new_password+'&confirm_pass='+confirm_pass;
            $.ajax({
                url        : base_url+'api/users/change_pass.php',
                type       : "POST",
                data       : DataToSend, 
                beforeSend : function(){
                    $('#updatePassBtn').html('Updating...');
                },
                success: function(data){
                    $('#updatePassBtn').html('Submit');
                    if(data.message == 'success'){
                        find_user_by_id();
                        window.location.href = base_url+'public/users/index.php';
                    }
                    if(data.message == 'passwordDoNotMatch'){
                        $('#alertPassMessage').html('<div class="alert alert-danger alert-dismissible">The password entered do not match. Please check and try again..</div>');
                        return false;
                    }
                    if(data.message == 'wrongPass'){
                        $('#alertPassMessage').html('<div class="alert alert-danger alert-dismissible">The password entered do not match. Please check and try again..</div>');
                        //logout 
                        logout();
                        return false;
                    }
                }
            });
        }else{
            $('#alertPassMessage').html('<div class="alert alert-danger alert-dismissible">The password entered do not match. Please check and try again..</div>');
        }
    });

    // function loggout 
    function logout()
    {
        var action = "LOGOUT";
        $.ajax({
            url:base_url+'api/users/users.php',
            type:'POST',
            data:{action:action},
            dataType:"json",
            success:function(data){
                if(data.message == 'success'){
                    window.location.href = base_url+'index.php';
                }
            }
        });
    }

    /// profile modal 
    $('#editProfilePic').click(function(){
        $('#profileForm')[0].reset();
        $('#profileModal').modal('show');
    });

    // Submit user profile 
    $('#profileForm').submit(function(event){
        event.preventDefault();
        var user_profile = $('#userProfile').val();
        if(user_profile == ''){
            $('#alertMessageProfile').html('<div class="alert alert-danger alert-dismissible">Please Select a profile pic</div>');
            return false;
        }else{
            var extension = user_profile.split('.').pop().toLowerCase();
            if(jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1){
                $('#userProfile').val('');
                $('#alertMessageProfile').html('<div class="alert alert-danger alert-dismissible">The file selected is invalid. Please check and try again</div>');
                return false;
            }else{
                $.ajax({
                    url:base_url+"api/users/change_photo.php",
                    type:"POST",
                    data: new FormData(this),
                    dataType:"json",
                    contentType: false,       // The content type used when sending data to the server.
                    cache: false,             // To unable request pages to be cached
                    processData: false,
                    beforeSend: function () {
                        $("#profileBtn").val('Uploading..');
                    },
                    success:function(data){
                        $("#profileBtn").val('Save changes');
                        if(data.message == 'success'){
                            find_user_by_id();
                            $('#profileForm')[0].reset();
                            $('#profileModal').modal('hide');
                        }
                    }
                });
            }
        }
    });
});