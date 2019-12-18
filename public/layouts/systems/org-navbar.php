<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <span id="sidebarImg"></span>
            </div>
            <div class="pull-left info">
                <p class="userName"></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active treeview menu-open">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="<?php echo base_url(); ?>public/index.php"><i class="fa fa-circle-o"></i> Dashboard</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-money"></i>
                    <span>Transactions</span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url(); ?>public/paypal/index.php"><i class="fa fa-circle-o"></i> PAYPAL Transactions</a></li>
                    <li><a href="<?php echo base_url(); ?>public/mpesa/index.php"><i class="fa fa-circle-o"></i> MPESA Transactions</a></li>
                </ul>
            </li> 
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-industry"></i>
                    <span>Pay Bills</span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url(); ?>public/bills/index.php"><i class="fa fa-circle-o"></i> Paybills</a></li>
                </ul>
            </li>
            <li class="header">LABELS</li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-bank"></i>
                    <span>Organizations</span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url(); ?>public/organizations/index.php"><i class="fa fa-circle-o"></i> My Organizations</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-check-square"></i>
                    <span>Apps Api</span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url(); ?>public/apps/index.php"><i class="fa fa-circle-o"></i> My Applications</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>