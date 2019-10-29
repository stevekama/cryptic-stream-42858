<?php require_once('models/initialization.php'); ?>
<?php require_once('public/layouts/login/header.php'); ?>
  <p class="login-box-msg">Register a new account</p>
  <!-- Select customer type between corporates and individuals -->
  <form id="customerTypeForm" method="post">
    <div class="form-group has-feedback">
      <select name="cust_type_id" id="cust_type_id" class="form-control">
        <option disable selected>Choose type of registration</option>
        <option value="1">INDIVIDUAL</option>
        <option value="2">CO-OPORATE</option>
        <option value="3">SYSTEM</option>
      </select>
    </div>
    <div class="row">
      <div class="col-xs-7">
        &nbsp;
      </div>
      <!-- /.col -->
      <div class="col-xs-5">
        <button type="submit" id="customerTypeBtn" class="btn btn-primary btn-block btn-flat">Select</button>
      </div>
      <!-- /.col -->
    </div>
  </form>

  <!--individual form -->
  <form id="individualForm">
    <div class="form-group has-feedback">
      <div id="messageAlert"></div>
    </div>
    
    <div class="form-group has-feedback">
      <input type="text" name="first_name" class="form-control" placeholder="First Name">
      <span class="glyphicon glyphicon-user form-control-feedback"></span>
    </div>

    <div class="form-group has-feedback">
      <input type="text" name="other_names" class="form-control" placeholder="Other Names">
      <span class="glyphicon glyphicon-user form-control-feedback"></span>
    </div>

    <div class="form-group has-feedback">
      <select name="customer_identity_doc_type1" id="customer_identity_doc_type1" class="form-control">
        <option disable selected>Choose identification document</option>
        <option value="1">NATIONAL ID</option>
        <option value="2">PASSPORT</option>
        <option value="3">PIN CERTIFICATE</option>
      </select>
    </div>

    <div class="form-group has-feedback">
      <input type="email" name="email" class="form-control" placeholder="Email">
      <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    </div>

    <div class="form-group has-feedback">
      <input type="text" name="dob" id="dob" class="form-control" placeholder="Date of birth">
      <span class="glyphicon glyphicon-user form-control-feedback"></span>
    </div>

    <div class="form-group has-feedback">
      <select name="gender_id" id="gender_id" class="form-control">
        <option disable selected>Choose gender</option>
        <option value="1">MALE</option>
        <option value="2">FEMALE</option>
        <option value="3">OTHERS</option>
      </select>
    </div>

    <div class="form-group has-feedback">
      <input type="text" name="postal_address" id="postal_address" class="form-control" placeholder="Postal Address">
      <span class="glyphicon glyphicon-user form-control-feedback"></span>
    </div>

    <div class="form-group has-feedback">
      <input type="text" name="physical_address" id="physical_address" class="form-control" placeholder="Physical Address">
      <span class="glyphicon glyphicon-user form-control-feedback"></span>
    </div>

    <div class="form-group has-feedback">
      <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="Phone Number">
      <span class="glyphicon glyphicon-phone form-control-feedback"></span>
    </div>

    <div class="form-group has-feedback">
      <input type="text" name="alt_phone_number" id="alt_phone_number" class="form-control" placeholder="Alternative Phone Number">
      <span class="glyphicon glyphicon-phone form-control-feedback"></span>
    </div>

    <div class="row">
      <div class="col-xs-7">
        &nbsp;
      </div>
      <!-- /.col -->
      <div class="col-xs-5">
        <button type="submit" id="customerTypeBtn" class="btn btn-primary btn-block btn-flat">Select</button>
      </div>
      <!-- /.col -->
    </div>
  </form>
  
<?php require_once('public/layouts/login/footer.php'); ?>