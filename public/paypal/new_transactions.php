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
        <li><a href="<?php echo base_url(); ?>/public/paypal/new_transactions.php">Paypal Form</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <div class="col-md-12">
            <!-- TABLE: LATEST ORDERS -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Transactions</h3>
                </div>
                <!-- /.box-header -->
                <form action="<?php echo base_url(); ?>api/paypal_api/checkout.php" method="post" role="form">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="product">Product: </label>
                            <input type="text" name="product" class="form-control" id="product" placeholder="Enter Product">
                        </div>
                        <div class="form-group">
                            <label for="price">Price: </label>
                            <input type="text" name="price" class="form-control" id="price" placeholder="Enter price">
                        </div>
                        <div class="form-group">
                            <label for="currency">Currency: </label>
                            <input type="text" name="currency" class="form-control" id="currency" placeholder="Enter currency">
                        </div>
                        <div class="form-group">
                            <label for="product">Quantity: </label>
                            <input type="text" name="qty" class="form-control" id="quantity" placeholder="Enter quantity">
                        </div>
                        <div class="form-group">
                            <input type="text" name="token" value="" class="form-control" />
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" id="submitPaypalForm" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
<?php require_once('../layouts/systems/footer.php'); ?>