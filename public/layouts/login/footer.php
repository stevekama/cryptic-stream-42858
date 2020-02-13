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

    // date format 
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd'
    });


  </script>
</body>
</html>