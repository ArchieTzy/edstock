<?php $title = substr($this->fetch('title'),6); ?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a class="brand-link">
        <?= $this->Html->image('cake.icon.png',['alt'=>'',
        'class'=>'brand-image img-circle elevation-3','style'=>'opacity:.8']) ?>
        <h6 class="brand-text font-weight-light">EdStock</h6>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <?= $this->Html->image('/dist/img/user2-160x160.jpg',['alt'=>'User Image',
                'class'=>'brand-image img-circle elevation-2']) ?>
            </div>
            <div class="info">
                <?php if ($this->request->getSession()->check('Auth.User')) : ?>
                <?php
                $fullname = h($this->request->getSession()->read('Auth.User.fullname'));
$paddingLeft = min(max(strlen($fullname) * 5, 10), 0); // Adjust the values as needed
?>
<a class="d-block" style="padding-left: <?= $paddingLeft ?>px;">
    <?= $fullname ?>
</a>
<?php endif; ?>
</div>
</div>
<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <?php $active = $title == 'Dashboard' ? 'active' : ''; ?>
            <?= $this->Html->link('<i class="nav-icon fas fa-solid fa-chart-line"></i>
                <p>
                Dashboard
                </p>', '/admin/dashboards', ['class' => 'nav-link ' . $active, 'escape' => false]) ?>
            </li>
            <li class="nav-item">
                <?php $active = $title == 'Inventories' ? 'active' : ''; ?>
                <?= $this->Html->link('<i class="nav-icon fas fa-archive"></i>
                    <p>
                    Inventory
                    </p>', '/admin/inventories', ['class' => 'nav-link ' . $active, 'escape' => false]) ?>
                </li>
                <li class="nav-item">
                    <?php $active = $title=='Procurements'?'active':'' ?>
                    <?= $this->Html->link('<i class="fas fa-brands fa-wpforms nav-icon"></i>
                        <p>
                        Procurement
                        </p><i class="right fas fa-angle-right"></i>','',['class'=>'nav-link'.$active,'escape'=>false]) ?>
                        <ul class="nav nav-treeview pl-3">
                            <li class="nav-item">
                                <?php $active = $title=='Annual Procurement Plan'?'active':'' ?>
                                <?= $this->Html->link('<i class="fas fa-brands fa-wpforms nav-icon"></i>
                                    <p>
                                    Annual Procurement Plan
                                    </p>','/admin/plans',['class'=>'nav-link'.$active,'escape'=>false]) ?>
                                </li>
                                <li class="nav-item">
                                    <?php $active = $title=='Purchase Requests'?'active':'' ?>
                                    <?= $this->Html->link('<i class="fas fa-brands fa-wpforms nav-icon"></i>
                                        <p>
                                        Purchase Requests
                                        </p>','/admin/requests',['class'=>'nav-link'.$active,'escape'=>false]) ?>
                                    </li>
                                    <li class="nav-item">
                                        <?php $active = $title=='Purchase Orders'?'active':'' ?>
                                        <?= $this->Html->link('<i class="fas fa-brands fa-wpforms nav-icon"></i>
                                            <p>
                                            Purchase Orders
                                            </p>','/admin/orders',['class'=>'nav-link'.$active,'escape'=>false]) ?>
                                        </li>
                                        <li class="nav-item">
                                            <?php $active = $title=='IAR'?'active':'' ?>
                                            <?= $this->Html->link('<i class="fas fa-brands fa-wpforms nav-icon"></i>
                                                <p>
                                                IAR
                                                </p>','/admin/inspection_acceptances',['class'=>'nav-link'.$active,'escape'=>false]) ?>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <?php $active = $title=='Issuances'?'active':'' ?>
                                        <?= $this->Html->link('<i class="fas fa-paperclip nav-icon"></i>
                                            <p>
                                            Issuances
                                            </p><i class="right fas fa-angle-right"></i>','',['class'=>'nav-link'.$active,'escape'=>false]) ?>
                                            <ul class="nav nav-treeview pl-3">
                                                <li class="nav-item">
                                                    <?php $active = $title=='RIS'?'active':'' ?>
                                                    <?= $this->Html->link('<i class="fas fa-paperclip nav-icon"></i>
                                                        <p>
                                                        RIS
                                                        </p>','/riss',['class'=>'nav-link'.$active,'escape'=>false]) ?>
                                                    </li>
                                                    <li class="nav-item">
                                                        <?php $active = $title=='ICS'?'active':'' ?>
                                                        <?= $this->Html->link('<i class="fas fa-paperclip nav-icon"></i>
                                                            <p>
                                                            ICS
                                                            </p>','/icss',['class'=>'nav-link'.$active,'escape'=>false]) ?>
                                                        </li>
                                                        <li class="nav-item">
                                                            <?php $active = $title=='PAR'?'active':'' ?>
                                                            <?= $this->Html->link('<i class="fas fa-paperclip nav-icon"></i>
                                                                <p>
                                                                PAR
                                                                </p>','/pars',['class'=>'nav-link'.$active,'escape'=>false]) ?>
                                                            </li>
                                                            <li class="nav-item">
                                                                <?php $active = $title=='ITR'?'active':'' ?>
                                                                <?= $this->Html->link('<i class="fas fa-paperclip nav-icon"></i>
                                                                    <p>
                                                                    ITR
                                                                    </p>','/itrs',['class'=>'nav-link'.$active,'escape'=>false]) ?>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <?php $active = $title=='PTR'?'active':'' ?>
                                                                    <?= $this->Html->link('<i class="fas fa-paperclip nav-icon"></i>
                                                                        <p>
                                                                        PTR
                                                                        </p>','/ptrs',['class'=>'nav-link'.$active,'escape'=>false]) ?>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                            <li class="nav-item">
                                                                <?php $active = $title=='Reports'?'active':'' ?>
                                                                <?= $this->Html->link('<i class="fas fa-sharp fa-solid fa-file nav-icon"></i>
                                                                    <p>
                                                                    Reports
                                                                    </p><i class="right fas fa-angle-right"></i>','',['class'=>'nav-link'.$active,'escape'=>false]) ?>
                                                                    <ul class="nav nav-treeview pl-3">
                                                                        <li class="nav-item">
                                                                            <?php $active = $title=='RPCPPE'?'active':'' ?>
                                                                            <?= $this->Html->link('<i class="fas fa-sharp fa-solid fa-file nav-icon"></i>
                                                                                <p>
                                                                                RPCPPE
                                                                                </p>','/rpcppes',['class'=>'nav-link'.$active,'escape'=>false]) ?>
                                                                            </li>
                                                                            <li class="nav-item">
                                                                                <?php $active = $title=='RPCI'?'active':'' ?>
                                                                                <?= $this->Html->link('<i class="fas fa-sharp fa-solid fa-file nav-icon"></i>
                                                                                    <p>
                                                                                    RPCI
                                                                                    </p>','/rpcis',['class'=>'nav-link'.$active,'escape'=>false]) ?>
                                                                                </li>
                                                                                <li class="nav-item">
                                                                                    <?php $active = $title=='Stock Cards'?'active':'' ?>
                                                                                    <?= $this->Html->link('<i class="fas fa-sharp fa-solid fa-file nav-icon"></i>
                                                                                        <p>
                                                                                        Stock Cards
                                                                                        </p>','/admin/stock_cards',['class'=>'nav-link'.$active,'escape'=>false]) ?>
                                                                                    </li>
                                                                                    <li class="nav-item">
                                                                                        <?php $active = $title=='Property Cards'?'active':'' ?>
                                                                                        <?= $this->Html->link('<i class="fas fa-sharp fa-solid fa-file nav-icon"></i>
                                                                                            <p>
                                                                                            Property Cards
                                                                                            </p>','/admin/property_cards',['class'=>'nav-link'.$active,'escape'=>false]) ?>
                                                                                        </li>
                                                                                    </ul>
                                                                                </li>
                                                                                <li class="nav-header">SETTINGS</li>
                                                                                <li class="nav-item">
                                                                                    <?php $active = $title == 'Items' ? 'active' : ''; ?>
                                                                                    <?= $this->Html->link('<i class="nav-icon fas fa-tv"></i>
                                                                                        <p>
                                                                                        Items
                                                                                        </p>', '/admin/items', ['class' => 'nav-link ' . $active, 'escape' => false]) ?>
                                                                                    </li>
                                                                                    <li class="nav-item">
                                                                                        <?php $active = $title=='Division Details'?'active':'' ?>
                                                                                        <?= $this->Html->link('<i class="fas fa-sharp fa-building nav-icon"></i>
                                                                                            <p>
                                                                                            Division Details
                                                                                            </p><i class="right fas fa-angle-right"></i>','',['class'=>'nav-link'.$active,'escape'=>false]) ?>
                                                                                            <ul class="nav nav-treeview pl-3">
                                                                                                <li class="nav-item">
                                                                                                    <?php $active = $title == 'Departments' ? 'active' : ''; ?>
                                                                                                    <?= $this->Html->link('<i class="far fa-circle nav-icon"></i>
                                                                                                    <p>Departments</p>', '/admin/departments', ['class' => 'nav-link ' . $active, 'escape' => false]) ?>
                                                                                                </li>
                                                                                                <li class="nav-item">
                                                                                                    <?php $active = $title == 'Fund Clusters' ? 'active' : ''; ?>
                                                                                                    <?= $this->Html->link('<i class="far fa-circle nav-icon"></i>
                                                                                                    <p>Fund Clusters</p>', '/admin/fclusters', ['class' => 'nav-link ' . $active, 'escape' => false]) ?>
                                                                                                </li>
                                                                                                <li class="nav-item">
                                                                                                    <?php $active = $title == 'Units' ? 'active' : ''; ?>
                                                                                                    <?= $this->Html->link('<i class="far fa-circle nav-icon"></i>
                                                                                                    <p>Units</p>', '/admin/units', ['class' => 'nav-link ' . $active, 'escape' => false]) ?>
                                                                                                </li>
                                                                                                <li class="nav-item">
                                                                                                    <?php $active = $title == 'Categories' ? 'active' : ''; ?>
                                                                                                    <?= $this->Html->link('<i class="far fa-circle nav-icon"></i>
                                                                                                    <p>Categories</p>', '/admin/categories', ['class' => 'nav-link ' . $active, 'escape' => false]) ?>
                                                                                                </li>
                                                                                                <li class="nav-item">
                                                                                                    <?php $active = $title == 'Offices' ? 'active' : ''; ?>
                                                                                                    <?= $this->Html->link('<i class="far fa-circle nav-icon"></i>
                                                                                                    <p>Offices</p>', '/admin/offices', ['class' => 'nav-link ' . $active, 'escape' => false]) ?>
                                                                                                </li>
                                                                                                <li class="nav-item">
                                                                                                    <?php $active = $title == 'Suppliers' ? 'active' : ''; ?>
                                                                                                    <?= $this->Html->link('<i class="far fa-circle nav-icon"></i>
                                                                                                    <p>Suppliers</p>', '/admin/suppliers', ['class' => 'nav-link ' . $active, 'escape' => false]) ?>
                                                                                                </li>
                                                                                                <li class="nav-item">
                                                                                                    <?php $active = $title == 'Procurement Methods' ? 'active' : ''; ?>
                                                                                                    <?= $this->Html->link('<i class="far fa-circle nav-icon"></i>
                                                                                                    <p>Procurement Methods</p>', '/admin/methods', ['class' => 'nav-link ' . $active, 'escape' => false]) ?>
                                                                                                </li>
                                                                                            </ul>
                                                                                        </li>
                                                                                        <li class="nav-item">
                                                                                            <?php $active = $title == 'Heads' ? 'active' : ''; ?>
                                                                                            <?= $this->Html->link('<i class="fas fa-user nav-icon"></i>
                                                                                            <p>Heads</p>', '/admin/heads', ['class' => 'nav-link ' . $active, 'escape' => false]) ?>
                                                                                        </li>

                                                                                        <li class="nav-item">
                                                                                            <?php $active = $title == 'Users' ? 'active' : ''; ?>
                                                                                            <?= $this->Html->link('<i class="fas fa-users nav-icon"></i>
                                                                                            <p>Users</p>', '/admin/users', ['class' => 'nav-link ' . $active, 'escape' => false]) ?>
                                                                                        </li> 

                                                                                    </ul> <!-- Close the <ul> for the first-level menu -->
                                                                                        <!-- /.nav -->
                                                                                    </nav>
                                                                                    <!-- /.sidebar-menu -->
                                                                                </div>
                                                                                <!-- /.sidebar -->
                                                                            </aside>