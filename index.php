<?php require_once('models/initialization.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Iko Systems | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!--Scripts -->
    <!-- jQuery 3 -->
    <script src="<?php echo base_url(); ?>public/components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?php echo base_url(); ?>public/components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url(); ?>public/plugins/iCheck/icheck.min.js"></script>
    <!--base URL -->
    <script src="<?php echo base_url(); ?>public/dist/js/base_url.js"></script>
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="index.php"><b>IKO </b>Systems</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <form id="loginForm" method="post">
                <div class="form-group has-feedback">
                    <div id="messageAlert"></div>
                </div>

                <div class="form-group has-feedback">
                    <input type="email" name="email" id="loginEmail" class="form-control" placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" id="loginPass" class="form-control" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-7">
                        &nbsp;
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-5">
                        <button type="submit" name="login" id="loginBtn" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <a href="forgot.php">I forgot my password</a><br>
            <a href="register.php?project_id=2" class="text-center">Register a new membership</a>
        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->

    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' /* optional */
            });
        });
    </script>
    <!--Login Script-->
    <script>
        $(document).ready(function(){
            //login form submission 
            $('#loginForm').submit(function(event){
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url        : base_url+'api/users/login.php',
                    type       : 'POST', 
                    data       : form_data,
                    dataType   : 'json',
                    beforeSend : function(){
                        $('#loginBtn').html('Loading...');
                    },
                    
                    success    : function(data){
                        $('#loginBtn').html('Sign In');
                        if(data.message == 'success'){
                            var loggedUserId = $.trim(data.user_session);
                            if(data.type_id == 1){
                                // go to the individuals account 
                                window.location.href = base_url+'/public/index.php';
                            }

                            if(data.type_id == 2){
                                // go to the individuals account 
                                window.location.href = base_url+'/public/org-index.php';
                            }
                        }

                    }
                });
            });
        });
    </script>
</body>
</html>