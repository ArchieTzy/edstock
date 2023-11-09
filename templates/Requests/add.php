<?php $ctr = 0; ?>
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Request</h3>
            <div class="card-tools">
                <?= $this->Html->link('<i class="fas fa-arrow-left"></i>','/requests',['escape'=>false]) ?>
            </div>
        </div>
        <div class="card-body">
            <?= $this->Form->create($request,['id'=>'requests-form'])?>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Office/Department</label>
                        <?= $this->Form->control('office_id',['class'=>'form-control', 'options'=>$offices,'label'=>false]) ?>
                        <label>Purpose</label>
                        <?= $this->Form->control('purpose',['type'=>'textarea','rows'=>'3','class'=>'form-control','label'=>false,'required']) ?>
                        <label>Requesting Officer</label>
                        <?= $this->Form->control('requester',['class'=>'form-control','label'=>false,'required']) ?>
                        <label>Approving Officer</label>
                        <?= $this->Form->control('approver',['class'=>'form-control','label'=>false,'required']) ?>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            Items
                            <div class="card-tools">
                                <a href="" id="search" data-toggle="tooltip" data-placement="bottom" title="Search Items"><i class="fas fa-search"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered" width="100%" id="item-count" style="font-size: small;">
                                <thead>
                                <tr>
                                    <th width="15%">Property No</th>
                                    <th width="10%">Unit</th>
                                    <th width="20%">Description</th>
                                    <th width="25%">Quantity</th>
                                    <th width="15%">Unit Cost</th>
                                    <th width="15%">Total Cost</th>
                                </tr>
                                </thead>
                                <tbody id="items">

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

<!-- Modal -->
<div class="modal fade" id="items-modal" tabindex="-1" role="dialog" aria-labelledby="items-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">Items</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <table id="items-table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Unit</th>
                            <th>Cost</th>
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
                <button type="button" class="btn btn-success" id="select">Select</button>
            </div>
        </div>
    </div>
</div>
