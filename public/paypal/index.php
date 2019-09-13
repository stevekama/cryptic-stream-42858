<?php require_once('../../models/functions.php'); 
require_once('../layouts/systems/header.php'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Paypal Transactions
        <small>Version 2.0</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>/public/index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url(); ?>/public/paypal/index.php">Paypal Form</a></li>
        <li class="active">Paypal Transactions</li>
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
                    <h3 class="box-title">Transactions</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">  
                    <div class="table-responsive">
                        <table id="payPalTrns" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>App Name</th>
                                <th>Transaction ID</th>
                                <th>Transaction Amount</th>
                                <th>Transaction Status</th>
                                <th>Transaction Date</th>
                            </tr>
                            </thead>
                            <tbody id="paypalTransactionsData">
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>App Name</th>
                                <th>Transaction ID</th>
                                <th>Transaction Amount</th>
                                <th>Transaction Status</th>
                                <th>Transaction Date</th>
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
<script src="<?php echo base_url(); ?>public/dist/js/pages/paypal_transactions.js"></script>
<?php require_once('../layouts/systems/footer.php'); ?>