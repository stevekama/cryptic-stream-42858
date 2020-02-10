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
                    <li class="pull-right">
                        <a href="#" class="text-muted">
                            <i class="fa fa-gear"></i>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <h2>Our Merchants:</h2>
                        <div class="box-body table-responsive no-padding">
                            <div class="table-responsive">
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
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_2">
                        <div class="table-responsive">
                            <table id="loadUtilities" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Utility</th>
                                        <th>Buy</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Utility</th>
                                        <th>Buy</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
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
    <div class="modal fade" id="makePaymentModal">
        <div class="modal-dialog">
            <form id="makePaymentForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Make Payment</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" id="paymentUserId">
                        </div>
                        <div class="form-group">
                            <label for="paymentAmount">Amount</label>
                            <input type="text" class="form-control" id="paymentAmount" placeholder="Enter Amount">
                        </div>
                        <div class="form-group">
                            <label for="paymentMethod">Method</label>
                            <?php $method = new Payment_Methods(); ?>
                            <?php $all_methods = $method->find_all_methods(); ?>
                            <select name="method" id="paymentMethod" class="form-control">
                                <option disabled selected>Payment Method</option>
                                <?php $count = $all_methods->rowCount(); ?>
                                <?php if($count > 0){ ?>
                                    <?php while($payment_method = $all_methods->fetch(PDO::FETCH_ASSOC)){?>
                                        <option value="<?php echo htmlentities($payment_method['id']); ?>">
                                            <?php echo htmlentities($payment_method['method']); ?>
                                        </option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" id="makePaymentSubmitBtn" class="btn btn-primary">Make Payment</button>
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
<?php require_once('../layouts/systems/footer.php'); ?>
<script src="<?php echo base_url(); ?>public/dist/js/pages/bills.js"></script>