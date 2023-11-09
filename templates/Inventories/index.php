<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Inventory List</h3>
            <div class="card-tools">
                <a href="" id="add" data-toggle="tooltip" data-placement="bottom" title="Add Item"><i class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="card-body">
            <table id="inventories-table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Date Purchased</th>
                        <th>Description</th>
                        <th>Unit</th>
                        <th>Quantity</th>
                        <th>Unit Cost</th>
                        <th>Total Cost</th>
                        <th>Option</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="inventories-modal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= $this->Form->create($inventory, ['id' => 'inventories-form']) ?>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Description</label>
                        <?= $this->Form->control('item_id', ['class' => 'form-control', 'label' => false, 'empty'=>'Select','required', 'readonly']) ?>
                        <label>Unit</label>
                        <?= $this->Form->control('unit', ['class' => 'form-control', 'placeholder' => 'Unit', 'label' => false, 'required']) ?>
                        <label>Quantity</label>
                        <?= $this->Form->text('qty', [
                            'class' => 'form-control',
                            'label' => false,
                            'placeholder' => 'Quantity',
                            'required' => true,
                            'id' => 'qty', // Add an id attribute
                        ]) ?>
                        <label>Unit Cost</label>
                        <?= $this->Form->text('unit_cost', [
                            'class' => 'form-control',
                            'label' => false,
                            'placeholder' => 'Unit Cost',
                            'required' => true,
                            'id' => 'unit_cost', // Add an id attribute
                        ]) ?>
                        <label>Total Cost</label>
                        <?= $this->Form->text('total_cost', [
                            'class' => 'form-control',
                            'label' => false,
                            'required' => true,
                            'id' => 'total_cost', // Add an id attribute
                            'readonly' => true, // Make this field read-only
                        ]) ?>
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
<?= $this->Html->script('Inventories.js') ?>