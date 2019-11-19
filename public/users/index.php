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
                    <a href="#" id="editProfilePic" class="btn btn-primary btn-block"><b>Edit Profile</b></a>
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
                                    <td id="customerFullNames"></td>
                                </tr>
                                <tr>
                                    <th>Email Address:</th>
                                    <td id="customerEmailAddress"></td>
                                </tr>
                                <tr>
                                    <th>Date of birth:</th>
                                    <td id="customerDOB"></td>
                                </tr>
                                <tr>
                                    <th>Gender:</th>
                                    <td id="customerGender"></td>
                                </tr>
                                <tr>
                                    <th>Postal Address</th>
                                    <td id="customerPostalAddress"></td>
                                </tr>
                                <tr>
                                    <th>Physical Address</th>
                                    <td id="customerPhysicalAddress"></td>
                                </tr>
                                <tr>
                                    <th>Country</th>
                                    <td id="customerCountry"></td>
                                </tr>
                                <tr>
                                    <th>Phone Number</th>
                                    <td id="customerPhone"></td>
                                </tr>
                                <tr>
                                    <th>Alt Phone Number</th>
                                    <td id="customerAltPhone"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="customer_document">
                         <!-- Post -->
                         <div id='docsDataMessage' class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Document</th>
                                    <th>Pin</th>
                                </tr>
                                </thead>
                                <tbody id='loadDocs'>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Document</th>
                                    <th>Pin</th>
                                </tr>
                                </tfoot>
                            </table>
                         </div>
                    </div>

                    <div class="tab-pane" id="settings">
                        <form id="usernameForm" class="form-horizontal">
                            <h3>Change Username</h3>
                            <hr>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div id="alertMessage"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="accountUserName" class="col-sm-2 control-label">User Name: </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="accountUserName" placeholder="User Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" id="updateUsernameBtn" class="btn btn-info">Update</button>
                                </div>
                            </div>
                        </form>
                        
                        <form id="changePassForm" class="form-horizontal">
                            <h3>Change Password</h3>
                            <hr>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div id="alertPassMessage"></div>
                                </div>
                            </div>

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
                                    <button type="submit" id="updatePassBtn" class="btn btn-info">Submit</button>
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

        <div class="modal fade" id="profileModal">
            <div class="modal-dialog">
                <form id="profileForm" role="form">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title">Change User Profile</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <div id="alertMessageProfile"></div>
                            </div>
                            
                            <div class="form-group">
                                <label for="userProfile">User Profile</label>
                                <input type="file" id="userProfile" name="profile">
                                <p class="help-block">Change user profile details.</p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button type="submit" id="profileBtn" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </form>
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
<script src="<?php echo base_url(); ?>public/dist/js/pages/profile.js"></script>
<?php require_once('../layouts/systems/footer.php'); ?>