    </div>
    <!-- /.form-box -->
</div>
<!-- /.register-box -->
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
<script>
// registration form 
// function to display drop down customer type 
var isSelectType = 0;
function selectCustomerType(data, typeId){
  if(isSelectType == 0){
    isSelectType = 1;
    var select = document.getElementById(typeId);
    var defaultOption = document.createElement('option');
    defaultOption.appendChild(document.createTextNode('Choose type of registration'));
    defaultOption.setAttribute('value', '');
    defaultOption.setAttribute('disabled', '');
    defaultOption.setAttribute('selected', '');
    select.appendChild(defaultOption);
    data.map(function(oneOpt){
        var option = document.createElement('option');
        option.appendChild(document.createTextNode(oneOpt.cust_type));
        option.setAttribute('value', oneOpt.id);
        select.appendChild(option);
    });
  }
}

function find_customer_type(){
  var action = "FETCH_ALL";
  $.ajax({
    url : base_url+'api/customer_type/fetch.php',
    type: 'POST',
    data:{action:action},
    dataType: 'json',
    success:function(data){
      selectCustomerType(data, 'cust_type_id');
      $('#customerTypeForm').fadeIn(800).show();
      $('#individualForm').fadeOut(900).hide();
      $('#userAccountForm').fadeOut(900).hide();
    }
  });
}
find_customer_type();

// function to select gender
var isSelectGender = 0;
function selectCustomerGender(data, genderId){
  if(isSelectGender == 0){
    isSelectGender = 1;
    var select = document.getElementById(genderId);
    var defaultOption = document.createElement('option');
    defaultOption.appendChild(document.createTextNode('Choose customer gender'));
    defaultOption.setAttribute('value', '');
    defaultOption.setAttribute('disabled', '');
    defaultOption.setAttribute('selected', '');
    select.appendChild(defaultOption);
    data.map(function(oneOpt){
        var option = document.createElement('option');
        option.appendChild(document.createTextNode(oneOpt.gender));
        option.setAttribute('value', oneOpt.id);
        select.appendChild(option);
    });
  }else{
    isSelectGender = 0;
  }
}

function find_customer_gender(){
  var action = "FETCH_ALL";
  $.ajax({
    url : base_url+'api/customer_gender/fetch.php',
    type: 'POST',
    data:{action:action},
    dataType: 'json',
    success:function(data){
      selectCustomerGender(data, 'gender_id');
    }
  });
}

// function to select gender
var isSelectCountry = 0;
function selectCustomerCountry(data, countryId){
  if(isSelectCountry == 0){
    isSelectCountry = 1;
    var select = document.getElementById(countryId);
    var defaultOption = document.createElement('option');
    defaultOption.appendChild(document.createTextNode('Choose customer country'));
    defaultOption.setAttribute('value', '');
    defaultOption.setAttribute('disabled', '');
    defaultOption.setAttribute('selected', '');
    select.appendChild(defaultOption);
    data.map(function(oneOpt){
        var option = document.createElement('option');
        option.appendChild(document.createTextNode(oneOpt.country));
        option.setAttribute('value', oneOpt.id);
        select.appendChild(option);
    });
  }else{
    isSelectCountry = 0;
  }
}

function find_customer_country(country_id){
  var action = "FETCH_ALL";
  $.ajax({
    url : base_url+'api/countries/fetch.php',
    type: 'POST',
    data:{action:action},
    dataType: 'json',
    success:function(data){
      selectCustomerCountry(data, country_id);
    }
  });
}

$('.datepicker').datepicker({
    format: 'yyyy-mm-dd'
});
/// submit customer type form 
$('#customerTypeForm').submit(function(event){
  event.preventDefault();
  var customer_type_id = $('#cust_type_id').val();
  $('#customerTypeForm').fadeOut(900).hide();
  $('#userAccountForm').fadeOut(900).hide();
  if(customer_type_id == 1){
    $('#individual_type_id').val(customer_type_id);
    find_customer_gender();
    find_customer_country('individual_country_id');
    $('#individualForm').fadeIn(800).show();
  }
  if(customer_type_id == 2){
    $('#organization_type_id').val(customer_type_id);
    find_customer_country('organization_country_id');
    $('#organizationForm').fadeIn(800).show();
  }
});

/// submit individual form 
$('#individualForm').submit(function(event){
  event.preventDefault();
  var form_data = $(this).serialize();
  $.ajax({
    url : base_url+'api/customers/new_customer.php',
    type: 'POST',
    data:form_data,
    dataType: 'json',
    beforeSend:function(){
      $('#individualFormBtn').html('Loading...');
    },
    success:function(data){
      $('#individualFormBtn').html('Save');
      if(data.message == 'success'){
        $('#customer_id').val(data.customer_id);
        $('#individualForm').fadeIn(900).hide();
        $('#userAccountForm').fadeIn(800).show();
        $('#customerTypeForm').fadeOut(900).hide();
      }
      if(data.message == 'duplicatedEmail'){
        $('#individualFormMessageAlert').html('<div class="alert alert-danger alert-dismissible">Email Entererd Exist. Please Check and Try again...</div>');
        return false;
      }
    }
  });
});

// submit organization form
$('#organizationForm').submit(function(event){
  event.preventDefault();
  var form_data = $(this).serialize();
  $.ajax({
    url : base_url+'api/customers/new_customer.php',
    type: 'POST',
    data:form_data,
    dataType: 'json',
    beforeSend:function(){
      $('#organizationFormBtn').html('Loading...');
    },
    success:function(data){
      $('#organizationFormBtn').html('Save');
      if(data.message == 'success'){
        $('#customer_id').val(data.customer_id);
        $('#individualForm').fadeIn(900).hide();
        $('#userAccountForm').fadeIn(800).show();
        $('#customerTypeForm').fadeOut(900).hide();
      }
      if(data.message == 'duplicatedEmail'){
        $('#individualFormMessageAlert').html('<div class="alert alert-danger alert-dismissible">Email Entererd Exist. Please Check and Try again...</div>');
        return false;
      }
    }
  });
});


$('#userAccountForm').submit(function(event){
  event.preventDefault();
  var form_data = $(this).serialize();
  $.ajax({
    url : base_url+'api/users/insert.php',
    type: 'POST',
    data:form_data,
    dataType: 'json',
    beforeSend:function(){
      $('#userAccountBtn').html('Loading...');
    },
    success:function(data){
      $('#userAccountBtn').html('Sign up');
      if(data.message == 'success'){
        window.location.href = base_url+'index.php';  
      }
      
      if(data.message == 'failed'){
        $('#signupAccountFormMessageAlert').html('<div class="alert alert-danger alert-dismissible">Failed To Register user. Please Try again..</div>');
        return false;
      }

      if(data.message == 'errorPass'){
        $('#signupAccountFormMessageAlert').html('<div class="alert alert-danger alert-dismissible">Failed To Register user. The password entered do not match. Please check and try again...</div>');
        return false;
      }
    }
  });
});
//Login form
</script>
</body>
</html>