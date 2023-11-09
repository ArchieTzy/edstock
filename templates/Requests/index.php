<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Requests List</h3>
            <div class="card-tools">
                <?= $this->Html->link('<i class="fas fa-plus"></i>  Add Request','/admin//requests/add',
                ['id'=>'add', 'class'=>'btn btn-primary','data-toggle'=>'tooltip','data-placement'=>'bottom', 'title'=>'Add Request','escape'=>false]) ?>
            </div>
        </div>
        <div class="card-body">
            <table id="requests-table" class="table table-bordered table-striped" style="font-size: small;">
                <thead>
                    <tr>
                        <th>Office</th>
                        <th>Purpose</th>
                        <th>Requester</th>
                        <th>Approver</th>
                        <th>Request Date</th>
                        <th>Status</th>
                        <th>Option</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
