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
                    <hr>
                    <strong><i class="fa fa-filae-text-o margin-r-5"></i> Notes</strong>
                    <button class="btn btn-primary btn-block">Account Settings</button>
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
                    <li><a href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                        <!-- Post -->
                        <div class="post">
                            <div class="user-block">
                                <span class="username">
                                    Full Names:
                                </span>
                            </div>
                            <!-- /.user-block -->
                            <p>Stephen Kamau</p>
                        </div>
                        <!-- /.post -->
                        
                        <!-- Post -->
                        <div class="post clearfix">
                            <div class="user-block">
                                <span class="username">
                                    Email Address
                                </span>
                            </div>
                            <!-- /.user-block -->
                            <p>stevekamahertz@gmail.com</p>
                        </div>
                        <!-- /.post -->

                        <!-- Post -->
                        <div class="post clearfix">
                            <div class="user-block">
                                <span class="username">
                                    Date of Birth
                                </span>
                            </div>
                            <!-- /.user-block -->
                            <p>1994-09-02</p>
                        </div>
                        <!-- /.post -->

                        <!-- Post -->
                        <div class="post clearfix">
                            <div class="user-block">
                                <span class="username">
                                    Gender
                                </span>
                            </div>
                            <!-- /.user-block -->
                            <p>Male</p>
                        </div>
                        <!-- /.post -->

                        <!-- Post -->
                        <div class="post clearfix">
                            <div class="user-block">
                                <span class="username">
                                    Postal Address
                                </span>
                            </div>
                            <!-- /.user-block -->
                            <p>Male</p>
                        </div>
                        <!-- /.post -->

                        <!-- Post -->
                        <div class="post clearfix">
                            <div class="user-block">
                                <span class="username">
                                    Physical Address
                                </span>
                            </div>
                            <!-- /.user-block -->
                            <p>Male</p>
                        </div>
                        <!-- /.post -->

                        <!-- Post -->
                        <div class="post clearfix">
                            <div class="user-block">
                                <span class="username">
                                    Country
                                </span>
                            </div>
                            <!-- /.user-block -->
                            <p>Male</p>
                        </div>
                        <!-- /.post -->

                         <!-- Post -->
                         <div class="post clearfix">
                            <div class="user-block">
                                <span class="username">
                                    Phone Number
                                </span>
                            </div>
                            <!-- /.user-block -->
                            <p>Male</p>
                        </div>
                        <!-- /.post -->
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="customer_document">
                         <!-- Post -->
                         <div class="post">
                            <div class="user-block">
                                <span class="username">
                                    ID Number:
                                </span>
                            </div>
                            <!-- /.user-block -->
                            <p>31443160</p>
                        </div>
                        <!-- /.post -->
                        
                    </div>

                    <div class="tab-pane" id="settings">
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputName" placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label">Name</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputName" placeholder="Name">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

                                <div class="col-sm-10">
                                    <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSkills" class="col-sm-2 control-label">Skills</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-danger">Submit</button>
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