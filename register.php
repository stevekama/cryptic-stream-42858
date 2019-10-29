<?php require_once('models/initialization.php'); ?>
<?php require_once('public/layouts/login/header.php'); ?>
  <p class="login-box-msg">Register a new account</p>
  <!-- Select customer type between corporates and individuals -->
  <form id="customerTypeForm" method="post">
    <div class="form-group has-feedback">
      <select id="cust_type_id" class="form-control">
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

    <a href="index.php" class="text-center">I already have a membership</a>
  </form>

  <!--individual form -->
  <form id="individualForm" method="post">
    <div class="form-group has-feedback">
      <div id="individualFormMessageAlert"></div>
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
      <input type="hidden" name="cust_type_id" id="type_id" class="form-control">
    </div>

    <div class="form-group has-feedback">
      <select name="customer_identity_doc_type1" id="customer_identity_doc_type1" class="form-control">
      </select>
    </div>

    <div class="form-group has-feedback">
      <input type="text" name="identification_doc1" class="form-control" placeholder="Identification number">
      <span class="glyphicon glyphicon-file form-control-feedback"></span>
    </div>

    <div class="form-group has-feedback">
      <input type="email" name="email_address" class="form-control" placeholder="Email">
      <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    </div>

    <div class="form-group has-feedback">
      <input type="text" name="dob" id="dob" class="form-control" placeholder="Date of birth">
      <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
    </div>

    <div class="form-group has-feedback">
      <select name="gender_id" id="gender_id" class="form-control">
      </select>
    </div>

    <div class="form-group has-feedback">
      <input type="text" name="postal_address" id="postal_address" class="form-control" placeholder="Postal Address">
      <span class="glyphicon glyphicon-folder-close form-control-feedback"></span>
    </div>

    <div class="form-group has-feedback">
      <input type="text" name="physical_address" id="physical_address" class="form-control" placeholder="Physical Address">
      <span class="glyphicon glyphicon-briefcase form-control-feedback"></span>
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
        <button type="submit" id="individualFormBtn" class="btn btn-primary btn-block btn-flat">Save</button>
      </div>
      <!-- /.col -->
    </div>
  </form>

  <!--sign up account form -->
  <form id="userAccountForm" method="post">
    <div class="form-group has-feedback">
      <div id="signupAccountFormMessageAlert"></div>
    </div>

    <div class="form-group has-feedback">
      <input type="text" name="customer_id" id="customer_id" class="form-control">
    </div>

    <div class="form-group has-feedback">
      <input type="text" name="username" id="username" class="form-control" placeholder="Username">
      <span class="glyphicon glyphicon-user form-control-feedback"></span>
    </div>

    <div class="form-group has-feedback">
      <input type="password" name="password" id="password" class="form-control" placeholder="Password">
      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>

    <div class="form-group has-feedback">
      <input type="password" name="confirm" id="confirm" class="form-control" placeholder="Retype password">
      <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
    </div>

    <div class="row">
      <div class="col-xs-7">
        &nbsp;
      </div>
      <!-- /.col -->
      <div class="col-xs-5">
        <button type="submit" id="userAccountBtn" class="btn btn-primary btn-block btn-flat">Sign up</button>
      </div>
      <!-- /.col -->
    </div>
  </form>
<?php require_once('public/layouts/login/footer.php'); ?>