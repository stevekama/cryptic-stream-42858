<?php require_once('models/initialization.php'); ?>
<?php require_once('public/layouts/login/header.php'); ?>
  <p class="login-box-msg">Register a new membership</p>
  <!-- Select customer type between corporates and individuals -->
  <form id="customerTypeForm">
    <div class="form-group has-feedback">
      <select name="cust_type_id" id="cust_type_id" class="form-control">
        <option disable selected>Choose type of registration</option>
        <option value="1">INDIVIDUAL</option>
        <option value="2">CO-OPORATE</option>
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
  <form id="individualForm" method="post">
    <div class="form-group has-feedback">
      <div id="messageAlert"></div>
    </div>
    <!-- Have a form for customers and another for co-orporates -->
    <div class="form-group has-feedback">
      <input type="text" name="first_name" class="form-control" placeholder="First Name">
      <span class="glyphicon glyphicon-user form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
      <input type="text" name="other_names" class="form-control" placeholder="Other Names">
      <span class="glyphicon glyphicon-user form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
      <input type="text" name="phone" class="form-control" placeholder="Phone Number">
      <span class="glyphicon glyphicon-phone form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
      <input type="email" name="email" class="form-control" placeholder="Email">
      <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
      <input type="text" name="username" class="form-control" placeholder="Username">
      <span class="glyphicon glyphicon-user form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
      <input type="password" name="password" class="form-control" placeholder="Password">
      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
      <input type="password" name="confirm" class="form-control" placeholder="Retype password">
      <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
    </div>
    <div class="row">
      <div class="col-xs-7">
        &nbsp;
      </div>
      <!-- /.col -->
      <div class="col-xs-5">
        <button type="submit" id="registrationBtn" class="btn btn-primary btn-block btn-flat">Register</button>
      </div>
      <!-- /.col -->
    </div>
  </form>
  <a href="index.php" class="text-center">I already have a membership</a>
<?php require_once('public/layouts/login/footer.php'); ?>