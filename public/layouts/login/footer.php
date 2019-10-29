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
//registration form 
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

// functions to select customer doc type 
var isSelectDoc = 0;
function selectCustomerDoc(data, docId){
  if(isSelectDoc == 0){
    isSelectDoc = 1;
    var select = document.getElementById(docId);
    var defaultOption = document.createElement('option');
    defaultOption.appendChild(document.createTextNode('Choose identification document'));
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
    isSelectDoc = 0;
  }
}

function find_customer_doc(){
  var action = "FETCH_ALL";
  $.ajax({
    url : base_url+'api/customer_docs/fetch.php',
    type: 'POST',
    data:{action:action},
    dataType: 'json',
    success:function(data){
      selectCustomerDoc(data, 'customer_identity_doc_type1');
    }
  });
}

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


/// submit customer type form 
$('#customerTypeForm').submit(function(event){
  event.preventDefault();
  var customer_type_id = $('#cust_type_id').val();
  $('#type_id').val(customer_type_id);
  $('#customerTypeForm').fadeOut(900).hide();
  find_customer_doc();
  find_customer_gender();
  $('#individualForm').fadeIn(800).show();
  $('#userAccountForm').fadeOut(900).hide();
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
    }
  });
});


$('#registerForm').submit(function(event){
  event.preventDefault();
  var form_data = $(this).serialize();
  $.ajax({
    url : base_url+'api/users/insert.php',
    type: 'POST',
    data:form_data,
    dataType: 'json',
    beforeSend:function(){
      $('#registrationBtn').html('Loading...');
    },
    success:function(data){
      if(data.message == 'success'){
        window.location.href = base_url+'index.php';  
      }

      if(data.message == 'emailError'){
        $('#messageAlert').html('<div class="alert alert-danger alert-dismissible">Email Entererd Exist. Please Check and Try again...</div>');
        return false;
      }

      if(data.message == 'failed'){
        $('#messageAlert').html('<div class="alert alert-danger alert-dismissible">Failed To Register user. Please Try again..</div>');
        return false;
      }

      if(data.message == 'errorPass'){
        $('#messageAlert').html('<div class="alert alert-danger alert-dismissible">Failed To Register user. The password entered do not match. Please check and try again...</div>');
        return false;
      }
    }
  });
});
</script>
</body>
</html>