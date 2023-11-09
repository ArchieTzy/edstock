<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Category List</h3>
        </div>
        <div class="card-body">
            <table id="categories-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Category Type</th>
                    <th>Option</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="categories-modal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= $this->Form->create($category,['id'=>'categories-form'])?>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Category</label>
                        <?= $this->Form->control('name',['class'=>'form-control','label'=>false,'required']) ?>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4" placeholder="Description" required></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <?= $this->Form->control('id',['type'=>'hidden','label'=>false]) ?>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            <?= $this->Form->end()?>
        </div>
    </div>
</div>
<?= $this->Html->script('Categories.js') ?>