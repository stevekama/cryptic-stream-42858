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
    
  </script>
</body>
</html>