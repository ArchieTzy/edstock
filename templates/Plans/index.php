<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Annual Procurement Plan List</h3>
            <div class="card-tools">
                <a href="" id="add" data-toggle="tooltip" data-placement="bottom" title="Add Unit"><i class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="card-body">
            <table id="plans-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Subtitle</th>
                    <th>Prepared By</th>
                    <th>Position</th>
                    <th>Status</th>
                    <th>Option</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="plans-modal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= $this->Form->create($plan,['id'=>'plans-form'])?>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Title</label>
                        <?= $this->Form->control('title',['class'=>'form-control','label'=>false,'required']) ?>
                        <label>Subtitle</label>
                        <?= $this->Form->control('subtitle',['class'=>'form-control','label'=>false]) ?>
                        <label>Prepared By</label>
                        <?= $this->Form->control('prepared_by',['class'=>'form-control','label'=>false,'required']) ?>
                        <label>Position</label>
                        <?= $this->Form->control('position',['class'=>'form-control','label'=>false,'required']) ?>
                        <label>Status</label>
                        <?= $this->Form->control('status',['type'=>'radio','class'=>'form-control',
                            'options'=>$this->Options->status(),'default'=>'0','label'=>false,
                            'templates' => [
                                'inputContainer' => '<div class="radio">{{content}}</div>'
                            ],]) ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <?= $this->Form->control('id',['type'=>'hidden','label'=>false]) ?>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
            <?= $this->Form->end()?>
        </div>
    </div>
</div>

<div class="modal fade" id="upload-modal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">Upload Document Image</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= $this->Form->create($plan,['type'=>'file','id'=>'upload-form'])?>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Upload document</label>
                        <?= $this->Form->control('document',['type'=>'file','class'=>'form-control',
                            'accept'=>'application/pdf','label'=>false,'required']) ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <?= $this->Form->control('planid',['type'=>'hidden','label'=>false]) ?>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
            <?= $this->Form->end()?>
        </div>
    </div>
</div>
<div class="modal fade" id="view-modal">
    <div class="modal-dialog modal-dm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">View Document Image</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <iframe width='100%' height="456" src='' id="file"></iframe>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" id="delete-file" data-id="">Delete</button>
            </div>
        </div>
    </div>
</div>
