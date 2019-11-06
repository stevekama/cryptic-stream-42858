<?php require_once('../../models/functions.php'); 
require_once('../layouts/systems/header.php'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <span class="profile-username"></span> Profile
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>public/index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url(); ?>public/users/index.php">profile</a></li>
        <li class="active">My profile</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <span id="profileImg"></span>
                    <p id="" class="text-muted text-center"></p>
                    <a href="#" class="btn btn-primary btn-block"><b>Edit Profile</b></a>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
            
            <!-- About Me Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Account Info</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <strong><i class="fa fa-book margin-r-5"></i> Username:</strong>
                    <p class="text-muted profile-username"></p>
                    <hr>
                    <strong><i class="fa fa-map-marker margin-r-5"></i> Email: </strong>
                    <p id="profileEmail" class="text-muted"></p>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
        
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#activity" data-toggle="tab">My Details</a></li>
                    <li><a href="#customer_document" data-toggle="tab">My Docs</a></li>
                    <li><a href="#settings" data-toggle="tab">Account Settings</a></li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <tr>
                                    <th>Full Names: </th>
                                    <td>Stephen Kamau</td>
                                </tr>
                                <tr>
                                    <th>Email Address:</th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Date of birth:</th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Gender:</th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Postal Address</th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Physical Address</th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Country</th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Phone Number</th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Alt Phone Number</th>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="customer_document">
                         <!-- Post -->
                         <div class="table-responsive">
                            <table class="table table-hover">
                                <tr>
                                    <th>ID Number: </th>
                                    <td>31443160</td>
                                </tr>
                            </table>
                         </div>
                    </div>

                    <div class="tab-pane" id="settings">
                        <form class="form-horizontal">
                            <h3>Change Username</h3>
                            <hr>
                            <div class="form-group">
                                <label for="accountUserName" class="col-sm-2 control-label">User Name: </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="accountUserName" placeholder="User Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-info">Update</button>
                                </div>
                            </div>
                        </form>
                        
                        <form class="form-horizontal">
                            <h3>Change Password</h3>
                            <hr>
                            <div class="form-group">
                                <label for="currentPassword" class="col-sm-2 control-label">Current Password</label>

                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="currentPassword" placeholder="Enter Current Password">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="newPassword" class="col-sm-2 control-label">New Password</label>

                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="newPassword" placeholder="New Password">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="confirmPassword" class="col-sm-2 control-label">Confirm Password</label>

                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm Password">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-info">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
<script src="<?php echo base_url(); ?>public/dist/js/pages/profile.js"></script>
<?php require_once('../layouts/systems/footer.php'); ?>