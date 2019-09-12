<?php require_once('../models/functions.php'); 
require_once('layouts/systems/header.php'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Dashboard
    <small>Version 2.0</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <!-- Info boxes -->
  <div id="apps_data" class="row">
  </div>
  <!-- /.row -->

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
        <div class="box-body">
          <div class="table-responsive">
              <table class="table no-margin">
                <thead>
                  <tr>
                    <th>App</th>
                    <th>Transaction ID</th>
                    <th>Transaction Time</th>
                    <th>Product</th>
                    <th>Transaction amount</th>
                    <th>Transaction method</th>
                    <th>Transaction Status</th>
                  </tr>
                </thead>
                <tbody id="loadTransactions">

                </tbody>
              </table>
            </div>
            <!-- /.table-responsive -->
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
<script src="<?php echo base_url(); ?>/public/dist/js/pages/main.js"></script>
<?php require_once('layouts/systems/footer.php'); ?>