<?php require_once('models/initialization.php'); ?>
<?php require_once('public/layouts/login/header.php'); ?>
    <div class="register-box-body">
        <?php 
        // ceck if user id isset 
        if(isset($_GET['user_id'])){?>
            <p class="login-box-msg">New Password</p>
            <form action="<?php echo base_url(); ?>api/users/new_password.php" method="post">
                <div class="form-group has-feedback">
                    <input type="hidden" class="form-control" value="<?php echo htmlentities($_GET['user_id']); ?>" name="user_id">
                </div>

                <div class="form-group has-feedback">
                    <input type="hidden" class="form-control" name="action" value="CHANGE_USER_PASS"/>
                </div>

                <div class="form-group has-feedback">
                    <input type="password" id="new_pass" name="new_pass" class="form-control" placeholder="Enter the new password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input type="password" id="confirm_pass" name="confirm_pass" class="form-control" placeholder="Re-write the password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
        
                <div class="row">
                    <div class="col-xs-8">
                        &nbsp;
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" id="newPasswordSubmitBtn" class="btn btn-primary btn-block btn-flat">Enter</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            
        <?php }else{ ?>
        <p class="login-box-msg">New Password</p>
        <div class="alert alert-danger alert-dismissible">
            Please check on the  email entered and try again..
            <a href="forgot.php" class="btn btn-sm btn-info">Try Again</a>
        </div>
       <?php } ?>
    </div>
    <!-- /.register-box -->
    <!-- jQuery 3 -->
    <script src="<?php echo base_url(); ?>public/components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?php echo base_url(); ?>public/components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url(); ?>public/plugins/iCheck/icheck.min.js"></script>
</body>
</html>