<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Suppliers List</h3>
            <div class="card-tools">
                    <button id="add" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Add Supplier">
                        <i class=""></i> Add Supplier
                    </button>
                </div>
        </div>
        <div class="card-body">
            <table id="suppliers-table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Supplier Name</th>
                        <th>Address</th>
                        <th>TIN No.</th>
                        <th>Option</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="suppliers-modal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= $this->Form->create($supplier, ['id' => 'suppliers-form']) ?>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Supplier Name</label>
                        <?= $this->Form->control('name', ['class' => 'form-control', 'placeholder' => 'Supplier Name', 'label' => false, 'required']) ?>
                        <label>Address</label>
                        <?= $this->Form->control('address', ['class' => 'form-control', 'rows'=>'2', 'placeholder' => 'Address', 'label' => false, 'required']) ?>
                        <label>TIN No.</label>
                        <?= $this->Form->control('tin_no', [
                            'class' => 'form-control',
                            'label' => false,
                            'required' => true,
                            'maxlength' => 15,
                            'placeholder' => 'TIN No.',
                            'message' => 'TIN No. must have 14 digits.'
                        ]) ?>
                        <div id="tin-no-error" class="text-danger"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <?= $this->Form->control('id', ['type' => 'hidden', 'label' => false]) ?>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
<?= $this->Html->script('Suppliers.js') ?>