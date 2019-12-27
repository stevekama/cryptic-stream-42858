<?php require_once('../../models/functions.php'); 
require_once('../layouts/systems/header.php'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Pay Bills
        <small>Version 2.0</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>/public/index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url(); ?>/public/bills/index.php">Bills</a></li>
        <li class="active">Pay Bills</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Merchants</a></li>
                    <li><a href="#tab_2" data-toggle="tab">Utilities</a></li>
                    <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <h2>Our Merchants:</h2>
                        <div class="box-body table-responsive no-padding">
                            <table id="loadMerchants" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Logo</th>
                                        <th>Merchant</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Pay</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Logo</th>
                                        <th>Merchant</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Pay</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_2">
                        <!-- form start -->
                        <form id="utilitiesForm" role="form">
                            <div class="form-group">
                                <label for="utilitiesService">Select Service</label>
                                <select name="service" id="utilitiesService" class="form-control">
                                    <option selected disabled>Choose a service</option>
                                    <option value="prepaid_tokens">KPLC Prepaid Tokens</option>
                                    <option value="postpaid_bill">KPLC Postpaid Bill</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="utilitiesAccount">Account Number</label>
                                <input type="text" class="form-control" id="utilitiesAccount" name="account" placeholder="Enter the Account Number">
                            </div>
                            <div class="form-group">
                                <label for="utilitiesAmount">Amount</label>
                                <input type="text" class="form-control" id="utilitiesAmount" name="amount" placeholder="Enter Amount">
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="utilitiesAmount">Your Name</label>
                                <input type="text" class="form-control" id="utilitiesName" name="name" placeholder="Enter Your name">
                            </div>
                            <div class="form-group">
                                <label for="utilitiesPhone">Phone Nmber</label>
                                <input type="text" class="form-control" id="utilitiesPhone" name="phone" placeholder="Enter Phone Number">
                            </div>
                            <div class="form-group">
                                <label for="utilitiesEmail">Email Address</label>
                                <input type="text" class="form-control" id="utilitiesEmail" name="email" placeholder="Email Address">
                            </div>
                            <button type="submit" class="btn btn-primary">Proceed Payment</button>    
                        </form>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
<script src="<?php echo base_url(); ?>public/dist/js/pages/bills.js"></script>
<?php require_once('../layouts/systems/footer.php'); ?>