<?php require_once('../models/functions.php'); 
require_once('layouts/systems/org-header.php'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Version 2.0</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>/public/org-index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Main content -->
    <section class="content">
        <div class="row">
           <div class="col-md-4">
               <div class="box box-solid">
                   <div class="box-header with-border">
                       <i class="fa fa-text-width"></i>
                       <h3 class="box-title">E Wallet</h3>
                    </div>
                    <!-- /.box-header -->
                    
                    <div class="box-body">
                        <p>Current Balance</p>
                        <h1>
                            $<span id="customerWallet"></span>
                        </h1>
                        <p></p>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <p><button type="button" id="topUpWalletBtn" class="btn btn-info btn-block btn-flat">Top Up My Wallet</button></p>
                    </div>
                </div> 
                <!-- /.box -->
            </div>
            <!-- ./col -->
            
            <div class="col-md-8">
                <!-- Custom tabs (Charts with tabs)-->
                <div class="nav-tabs-custom">
                    <!-- Tabs within a box -->
                    <ul class="nav nav-tabs pull-right">
                        <li class="active"><a id="area-chart" data-toggle="tab">Area</a></li>
                        <li class="pull-left header"><i class="fa fa-inbox"></i> My Transactions</li>
                    </ul>
                    <div class="tab-content no-padding">
                        <!-- Morris chart - Sales -->
                        <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
                    </div>
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->
        
        <!-- /.row (main row) -->
        <div class="row">
            <section class="col-lg-12 col-md-12 col-sm-12">
                <!-- TABLE: LATEST ORDERS -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Latest Transactions</h3>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">
                        <div id="errorMessageData" class="table-responsive">
                            <table class="table no-margin">
                                <thead>
                                    <tr>
                                        <th>Transaction #</th>
                                        <th>Transaction Time</th>
                                        <th>Product</th>
                                        <th>Amount</th>
                                        <th>Currency</th>
                                        <th>Method</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody id="loadTransactions">
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Transaction #</th>
                                        <th>Transaction Time</th>
                                        <th>Product</th>
                                        <th>Amount</th>
                                        <th>Currency</th>
                                        <th>Method</th>
                                        <th>Status</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </section>
        </div>
        <!--row-->

    </section>
    <!-- /.content -->
</section>
<!-- /.content -->

<?php require_once('layouts/systems/org-footer.php'); ?>