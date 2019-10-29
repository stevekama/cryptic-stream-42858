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
  
  <a href="index.php" class="text-center">I already have a membership</a>
<?php require_once('public/layouts/login/footer.php'); ?>