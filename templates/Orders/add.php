<?php $ctr = 0; ?>
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Order</h3>
            <div class="card-tools">
                <?= $this->Html->link('<i class="fas fa-arrow-left"></i>','/orders',['escape'=>false]) ?>
            </div>
        </div>
        <div class="card-body">
            <?= $this->Form->create($order,['id'=>'orders-form'])?>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label>Office/Department</label>
                        <?= $this->Form->control('office_id',['class'=>'form-control','options'=>$offices,'label'=>false]) ?>
                        <label>Supplier Name</label>
                        <?= $this->Form->control('supplier_id',['class'=>'form-control','options'=>$suppliers,'label'=>false]) ?>
                        <label>Place of Delivery</label>
                        <?= $this->Form->control('office_id',['class'=>'form-control', 'options'=>$offices,'label'=>false,'required']) ?>
                        <label>Conforme</label>
                        <?= $this->Form->control('approver',['class'=>'form-control','label'=>false,'required']) ?>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header">
                            Purchase Requests
                            <div class="card-tools">
                                <a href="" id="search" data-toggle="tooltip" data-placement="bottom" title="Search Purchase Requests"><i class="fas fa-search"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered" width="100%" style="font-size: small;">
                                <thead>
                                <tr>
                                    <th width="15%">Office</th>
                                    <th width="25%">Purpose</th>
                                    <th width="20%">Requester</th>
                                    <th width="20%">Approver</th>
                                    <th width="20%">Request Date</th>
                                </thead>
                                <tbody id="requests">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
        <?= $this->Form->end()?>
    </div>
</div>

<div class="modal fade" id="requests-modal" tabindex="-1" role="dialog" aria-labelledby="requests-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">Purchase Requests</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <table id="requests-table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Office</th>
                            <th>Requester</th>
                            <th>Approver</th>
                            <th>Request Date</th>
                            <th>
                                <div style="text-align:center;">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input custom-control-input-success" type="checkbox" id="customCheckbox">
                                        <label for="customCheckbox" class="custom-control-label"></label>
                                    </div>
                                </div>
                            </th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="select">Select</button>
            </div>
        </div>
    </div>
</div>