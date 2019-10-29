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
    }
  });
}
find_customer_type();

/// submit customer type form 
$('#customerTypeForm').submit(function(event){
  event.preventDefault();
  var customer_type_id = $('#cust_type_id').val();
  $('#type_id').val(customer_type_id);
  $('#customerTypeForm').fadeOut(900).hide();
  $('#individualForm').fadeIn(800).show();
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