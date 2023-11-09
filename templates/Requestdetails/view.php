<?php $ctr = 0; ?>
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Update Request</h3>
            <div class="card-tools">
                <?= $this->Html->link('<i class="fas fa-arrow-left"></i>','/RequestsArchive',['escape'=>false]) ?>
            </div>
        </div>
        <div class="card-body">
            <?= $this->Form->create($request,['id'=>'requests-form'])?>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Office/Department</label>
                        <?= $this->Form->control('office',['class'=>'form-control','value'=>$request->office->name,'label'=>false,'readonly']) ?>
                        <label>Purpose</label>
                        <?= $this->Form->control('purpose',['type'=>'textarea','class'=>'form-control','label'=>false,'readonly']) ?>
                        <label>Requesting Approval</label>
                        <?= $this->Form->control('requester',['class'=>'form-control','label'=>false,'readonly']) ?>
                        <label>Project Leader</label>
                        <?= $this->Form->control('leader',['class'=>'form-control','label'=>false,'readonly']) ?>
                        <label>Budget Office</label>
                        <?= $this->Form->control('budget',['type'=>'radio','class'=>'form-control',
                            'options'=>$this->Options->status(),'default'=>'0','label'=>false,
                            'templates' => [
                                'inputContainer' => '<div class="radio">{{content}}</div>'
                            ],'disabled']) ?>
                        <label>Executive Office</label>
                        <?= $this->Form->control('eo',['type'=>'radio','class'=>'form-control',
                            'options'=>$this->Options->status(),'default'=>'0','label'=>false,
                            'templates' => [
                                'inputContainer' => '<div class="radio">{{content}}</div>'
                            ],'disabled']) ?>
                        <label>Procurement Office</label>
                        <?= $this->Form->control('po',['type'=>'radio','class'=>'form-control',
                            'options'=>$this->Options->status(),'default'=>'0','label'=>false,
                            'templates' => [
                                'inputContainer' => '<div class="radio">{{content}}</div>'
                            ],'disabled']) ?>

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
                            <table class="table table-striped table-bordered" width="100%" id="item-count">
                                <thead>
                                <tr>
                                    <th>Item No</th>
                                    <th>Qty</th>
                                    <th>Unit</th>
                                    <th>Quantity</th>
                                    <th>Cost</th>
                                    <th>Total</th>
                                </tr>
                                </thead>
                                <tbody id="items">
                                <?php foreach ($requestdetails as $details): ?>
                                    <tr>
                                        <td><?= $ctr + 1 ?></td>
                                        <td><?= $details->item->unit->name ?></td>
                                        <td><?= $details->item->description ?></td>
                                        <td><?= $details->qty ?></td>
                                        <td><?= $details->cost ?></td>
                                        <td><?= $details->total ?></td>
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