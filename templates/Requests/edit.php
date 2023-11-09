<?php $ctr = 0; ?>
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Update Request</h3>
            <div class="card-tools">
                <?= $this->Html->link('<i class="fas fa-arrow-left"></i>','/admin/requests',['escape'=>false]) ?>
            </div>
        </div>
        <div class="card-body">
            <?= $this->Form->create($request,['id'=>'requests-form'])?>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Office/Department</label>
                        <?= $this->Form->control('office_id',['class'=>'form-control','options'=>$offices,'label'=>false]) ?>
                        <label>Purpose</label>
                        <?= $this->Form->control('purpose',['type'=>'textarea','class'=>'form-control','label'=>false,'required']) ?>
                        <label>Requester</label>
                        <?= $this->Form->control('requester',['class'=>'form-control','label'=>false,'required']) ?>
                        <label>Approver</label>
                        <?= $this->Form->control('approver',['class'=>'form-control','label'=>false,'required']) ?>
                        <label>Status</label>
                        <?= $this->Form->control('status', [
                            'type' => 'radio',
                            'class' => 'form-control', // Add a custom class for styling
                            'options' => $this->Options->status(),
                            'default' => '0',
                            'label' => false,
                            'templates' => [
                                'inputContainer' => '<div class="radio">{{content}}</div>'
                            ]
                        ]) ?>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            Items
                            <div class="card-tools">
                                <a href="" id="edit-search" data-toggle="tooltip" data-placement="bottom" title="Search Items"><i class="fas fa-search"></i></a>
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
                                <?php foreach ($request->requestdetails as $details): ?>
                                    <tr>
                                        <td><?= $ctr + 1 ?></td>
                                        <td><?= $details->item->unit->name ?></td>
                                        <td><?= $details->item->description ?></td>
                                        <td>
                                            <div class="input-group">
                                                <span class="input-group-prepend">
                                                    <button type="button" class="btn btn-outline-secondary edit-minus" data-field="requestdetails[<?= $ctr ?>][qty]">
                                                        <span class="fa fa-minus"></span>
                                                    </button>
                                                </span>
                                                <input type="number" name="requestdetails[<?= $ctr ?>][qty]" class="form-control input-number" value="<?= $details->qty ?>" min="0">
                                                <input type="hidden" name="requestdetails[<?= $ctr ?>][item_id]" value="<?= $details->item_id ?>">
                                                <input type="hidden" name="requestdetails[<?= $ctr ?>][id]" value="<?= $details->id ?>">
                                                <span class="input-group-append">
                                                    <button type="button" class="btn btn-outline-secondary edit-plus"  data-field="requestdetails[<?= $ctr ?>][qty]">
                                                        <span class="fa fa-plus"></span>
                                                    </button>
                                                </span>
                                            </div>
                                        </td>
                                        <td><input type="number" name="requestdetails[<?= $ctr ?>][cost]" class="form-control cost" value="<?= $details->cost ?>" readonly="readonly"></td>
                                        <td><input type="number" name="requestdetails[<?= $ctr ?>][total]" class="form-control total" value="<?= $details->total ?>" readonly="readonly"></td>

                                    </tr>
                                    <?php
                                    $ctr++;
                                endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <input type="hidden" name="id" id="id" value="<?= $request->id ?>">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
        <?= $this->Form->end()?>
    </div>
</div>

<div class="modal fade" id="edit-items-modal">
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
                <button type="button" class="btn btn-success" id="edit-select">Select</button>
            </div>
        </div>
    </div>
</div>