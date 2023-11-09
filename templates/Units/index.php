<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Units List</h3>
            <div class="card-tools">
                <button id="add" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Add Unit">
                    <i class=""></i> Add Unit
                </button>
            </div>
        </div>
        <div class="card-body">
            <table id="units-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Unit</th>
                    <th>Option</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="units-modal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= $this->Form->create($unit,['id'=>'units-form'])?>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Unit</label>
                        <?= $this->Form->control('name',['class'=>'form-control','label'=>false,'required']) ?>
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