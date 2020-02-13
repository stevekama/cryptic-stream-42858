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

    /// load customer types from table
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
    // display customer type
    function find_customer_type(){
      var action = "FETCH_ALL";
      $.ajax({
        url : base_url+'api/customer_type/fetch.php',
        type: 'POST',
        data:{action:action},
        dataType: 'json',
        success:function(data){
          selectCustomerType(data, 'cust_type_id');
        }
      });
    }
    find_customer_type();

    // bring in gender 
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

    // load gender
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
    find_customer_gender();

    // bring in country
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

    function find_customer_country(){
      var action = "FETCH_ALL";
      $.ajax({
        url : base_url+'api/countries/fetch.php',
        type: 'POST',
        data:{action:action},
        dataType: 'json',
        success:function(data){
          selectCustomerCountry(data, 'country_id');
        }
      });
    }
    find_customer_country();

    // date format 
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd'
    });
    
    // bring in customer form 
    $('#customerForm').fadeIn(800).show();
    $('#userAccountForm').fadeOut(900).hide();

    /// submit cistomers
    $('#customerForm').submit(function(event){
      event.preventDefault();
      var form_data = $(this).serialize();
      $.ajax({
        url : base_url+'api/customers/new_customer.php',
        type: 'POST',
        data:form_data,
        dataType: 'json',
        beforeSend:function(){
          $('#customerFormBtn').html('Loading...');
        },
        success:function(data){
          $('#customerFormBtn').html('Save');
          if(data.message == 'success'){
            $('#customer_id').val(data.customer_id);
            $('#customerForm').fadeIn(900).hide();
            $('#userAccountForm').fadeIn(800).show();
          }
          if(data.message == 'duplicatedEmail'){
            $('#customerFormMessageAlert').html('<div class="alert alert-danger alert-dismissible">Email Entererd Exist. Please Check and Try again...</div>');
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
          if(data.message == 'success'){
            window.location.href = data.url;  
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


  </script>
</body>
</html>