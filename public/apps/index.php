<?php require_once('../../models/functions.php'); 
require_once('../layouts/systems/header.php'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Applications
        <small>Version 2.0</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>/public/index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url(); ?>/public/paypal/index.php">Apps</a></li>
        <li class="active">My Applications</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <div class="col-md-12">
            <!-- SEARCH: By App name -->
            <!-- /.box -->

            <!-- TABLE: LATEST ORDERS -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Applications</h3>
                </div>
                <!-- /.box-header -->
                <div id="appsAlertMessage" class="box-body">  
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>App Name</th>
                                <th>App Method</th>
                                <th>App Token</th>
                                <th>Response Url</th>
                            </tr>
                            </thead>
                            <tbody id="apps_data">
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>App Name</th>
                                <th>App Method</th>
                                <th>App Token</th>
                                <th>Response Url</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
<script src="<?php echo base_url(); ?>public/dist/js/pages/apps.js"></script>
<?php require_once('../layouts/systems/footer.php'); ?>