<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

// Define the default $cakeDescription
$cakeDescription = 'EdStock';

// Define the $pageTitle (e.g., set it based on your logic)
$pageTitle = $this->fetch('title');

// Check if $pageTitle is set, and if so, use it as the page title
if ($pageTitle === 'Divprofiles') {
    $title = $cakeDescription . ' : ' . 'Division Profile';
} elseif ($pageTitle === 'Admin/Departments') {
    $title = $cakeDescription . ' : ' . 'Departments';
} elseif ($pageTitle === 'Admin/Officers') {
    $title = $cakeDescription . ' : ' . 'Officers';
} elseif ($pageTitle === 'Admin/Offices') {
    $title = $cakeDescription . ' : ' . 'Offices';
} elseif ($pageTitle === 'Admin/Users') {
    $title = $cakeDescription . ' : ' . 'Users';
} elseif ($pageTitle === 'Admin/Items') {
    $title = $cakeDescription . ' : ' . 'Items';
} elseif ($pageTitle === 'Inventories') {
    $title = $cakeDescription . ' : ' . 'Item Inventory';
} elseif ($pageTitle === 'Admin/Requests') {
    $title = $cakeDescription . ' : ' . 'Purchase Requests';
} elseif ($pageTitle === 'Dashboards') {
    $title = $cakeDescription . ' : ' . 'Dashboard';
} elseif ($pageTitle === 'Admin/Suppliers') {
    $title = $cakeDescription . ' : ' . 'Suppliers';
} elseif ($pageTitle === 'Admin/Units') {
    $title = $cakeDescription . ' : ' . 'Units';
} elseif ($pageTitle === 'Plans') {
    $title = $cakeDescription . ' : ' . 'Annual Procurement Plan';
} elseif ($pageTitle === 'Admin/Fclusters') {
    $title = $cakeDescription . ' : ' . 'Fund Clusters';
} elseif ($pageTitle === 'Admin/Heads') {
    $title = $cakeDescription . ' : ' . 'Heads';
} elseif ($pageTitle === 'Orders') {
    $title = $cakeDescription . ' : ' . 'Purchase Orders';
} elseif ($pageTitle === 'Admin/Methods') {
    $title = $cakeDescription . ' : ' . 'Procurement Methods';
}


?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
       <?= h($title) ?>
   </title>
   <?= $this->Html->meta('icon', $this->Url->image('cake.icon.png', ['fullBase' => true])) ?>

   <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" rel="stylesheet">
   <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

   <?= $this->Html->css(['/plugins/fontawesome-free/css/all.min',
    '/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min',
    '/plugins/toastr/toastr.min',
    '/plugins/daterangepicker/daterangepicker',
    '/plugins/datatables-bs4/css/dataTables.bootstrap4.min',
    '/plugins/datatables-responsive/css/responsive.bootstrap4.min',
    '/plugins/datatables-buttons/css/buttons.bootstrap4.min',
    '/plugins/ekko-lightbox/ekko-lightbox',
    '/dist/css/adminlte.min',
    // '/plugins/ion-rangeslider/ion.rangeSlider.min'
    'style'
]) ?>
<?= $this->Html->script(['/plugins/jquery/jquery.min','app']) ?>

<?= $this->fetch('meta') ?>
<?= $this->fetch('css') ?>
<?= $this->fetch('script') ?>
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?= $this->element('admin/navbar')?>
        <?= $this->element('admin/sidebar')?>

        <div class="content-wrapper">
            <?= $this->element('admin/breadcrumb') ?>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <?= $this->fetch('content') ?>
                    </div>

                </div>
            </section>
        </div>
        <?= $this->element('admin/footer')?>
        <?= $this->element('admin/control-sidebar')?>
    </div>

    <?= $this->Html->script(['/plugins/bootstrap/js/bootstrap.bundle.min',
        '/plugins/bs-custom-file-input/bs-custom-file-input.min',
        '/dist/js/adminlte.min']) ?>
        
    <?= $this->Html->script(['/plugins/bootstrap/js/bootstrap.bundle.min',
        '/plugins/sweetalert2/sweetalert2.min',
        '/plugins/moment/moment.min',
        '/plugins/daterangepicker/daterangepicker',
        '/plugins/toastr/toastr.min',
        '/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min',
        '/plugins/datatables/jquery.dataTables.min',
        '/plugins/datatables-bs4/js/dataTables.bootstrap4.min',
        '/plugins/datatables-responsive/js/dataTables.responsive.min',
        '/plugins/datatables-responsive/js/responsive.bootstrap4.min',
        '/plugins/ekko-lightbox/ekko-lightbox.min',
        '/plugins/moment/moment.min',
        '/dist/js/adminlte.min']) ?>
        <script>
            loadjs(js_url + '<?= $this->fetch('title') ?>' + '.js');
            var date = new Date();
            $('#dtp').datetimepicker({
                defaultDate: new Date(),
                format: 'MM/DD/YYYY'
            });
            $('#drp').daterangepicker({
                startDate: new Date(date.getFullYear(), date.getMonth(), 1),
                format: 'MM/DD/YYYY'
            });
        </script>
    </body>
    </html>