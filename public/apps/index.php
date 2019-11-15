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
                    
                    <div class="box-tools pull-right">
                        <button type="button" id="newAppBtn" class="btn btn-sm btn-success">
                            <i class="fa fa-plus"></i> New App
                        </button>
                    </div>
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
    
    <!--New app modal -->
    <div class="modal fade" id="newAppModal">
        <div class="modal-dialog">
            <form id="newAppForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">New Application</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">   
                            <label for="appName">App Name:</label>
                            <input type="text" class="form-control" id="appName" name="name" placeholder="Enter app name">
                        </div> 
                        <div class="form-group">   
                            <label for="appMethod">App Method</label>
                            <select name="method" id="appMethod" class="form-control">
                                <option disabled selected>Choose App Method</option>
                                <option value="PAYPAL">PAYPAL</option>
                                <option value="MPESA">MPESA</option>
                            </select>
                        </div>
                        <div class="form-group">   
                            <label for="appKey">App Key:</label>
                            <input type="text" class="form-control" id="appKey" name="key" placeholder="Enter app key">
                        </div> 
                        <div class="form-group">   
                            <label for="appSecret">App Secret:</label>
                            <input type="text" class="form-control" id="appSecret" name="secret" placeholder="Enter app secret">
                        </div> 
                        <div class="form-group">   
                            <label for="responseUrl">Response URL:</label>
                            <input type="text" class="form-control" id="responseUrl" name="url" placeholder="Enter the url where data will be dumped">
                        </div> 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </form>
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

</section>
<!-- /.content -->
<script src="<?php echo base_url(); ?>public/dist/js/pages/apps.js"></script>
<?php require_once('../layouts/systems/footer.php'); ?>