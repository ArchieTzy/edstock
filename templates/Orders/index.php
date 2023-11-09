<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Orders List</h3>
            <div class="card-tools">
                <?= $this->Html->link('<i class="fas fa-plus"></i>  Add Order','/orders/add',
                ['id'=>'add', 'class'=>'btn btn-primary','data-toggle'=>'tooltip','data-placement'=>'bottom', 'title'=>'Add Order','escape'=>false]) ?>
            </div>
        </div>
        <div class="card-body">
            <table id="orders-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Office</th>
                    <th>Supplier</th>
                    <th>Place of Delivery</th>
                    <th>Approving Officer</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Option</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

