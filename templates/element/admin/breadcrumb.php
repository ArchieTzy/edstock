<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <?php
                $pageTitle = $this->fetch('title');
                if ($pageTitle === 'Admin/Fclusters') {
                    $pageTitle = 'Fund Clusters';
                } elseif ($pageTitle === 'Inventories') {
                    $pageTitle = 'Item Inventory';
                } elseif ($pageTitle === 'Admin/Requests') {
                    $pageTitle = 'Purchase Requests';
                } elseif ($pageTitle === 'Admin/Dashboards') {
                    $pageTitle = 'Dashboard';
                } elseif ($pageTitle === 'Admin/Suppliers') {
                    $pageTitle = 'Suppliers';
                } elseif ($pageTitle === 'Admin/Units') {
                    $pageTitle = 'Units';
                } elseif ($pageTitle === 'Admin/Plans') {
                    $pageTitle = 'Annual Procurement Plan';
                } elseif ($pageTitle === 'Admin/Orders') {
                    $pageTitle = 'Purchase Orders';
                } elseif ($pageTitle === 'Admin/Heads') {
                    $pageTitle = 'Heads';
                } elseif ($pageTitle === 'Admin/Methods') {
                    $pageTitle = 'Procurement Methods';
                } elseif ($pageTitle === 'Admin/Users') {
                    $pageTitle = 'Users';
                } elseif ($pageTitle === 'Admin/Items') {
                    $pageTitle = 'Items';
                } elseif ($pageTitle === 'Admin/Departments') {
                    $pageTitle = 'Departments';
                } 

                ?>
                <h1 class="m-0"><?= !empty(substr($pageTitle, -15)) ? substr($pageTitle, -30) : 'Dashboard' ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><?= $this->Html->link('EdStock', '/') ?></li>
                    <li class="breadcrumb-item active"><?= substr($pageTitle, -30) ?></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
