    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Users List</h3>
                <div class="card-tools">
                    <button id="add" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Add User">
                        <i class=""></i> Add User
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table id="users-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Full Name</th>
                            <th>Birthdate</th>
                            <th>TIN No.</th>
                            <th>Plantilla No.</th>
                            <th>Position</th>
                            <th>Role</th>
                            <th>Contact No.</th>
                            <th>Department</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="users-modal">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?= $this->Form->create($user,['id'=>'users-form'])?>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Username</label>
                            <?= $this->Form->control('username',['class'=>'form-control', 'placeholder' => 'Username', 'label'=>false,'required']) ?>
                            <label>Password</label>
                            <?= $this->Form->control('password',['class'=>'form-control', 'placeholder' => 'Password', 'label'=>false,'required']) ?>
                            <label>Full Name</label>
                            <?= $this->Form->control('fullname',['class'=>'form-control', 'placeholder' => 'Full Name', 'label'=>false,'required']) ?>
                            <label>Birthdate</label>
                            <?= $this->Form->control('bdate',['class'=>'form-control', 'label'=>false,'required']) ?>
                            <label>TIN No.</label>
                            <?= $this->Form->control('tin_no', [
                                'class' => 'form-control',
                                'label' => false,
                                'required' => true,
                                'maxlength' => 12,
                                'placeholder' => 'TIN No.',
                                'pattern' => '^\d{9}$|^\d{12}$',
                                'message' => 'TIN No. must have between 9 and 12 digits.'
                            ]) ?>
                            <div id="tin-no-error" class="text-danger"></div>
                            <label>Plantilla No.</label>
                            <?= $this->Form->control('plantilla_no',['class'=>'form-control', 'placeholder' => 'Plantilla No.', 'label'=>false,'required']) ?>
                            <label>Position</label>
                            <?= $this->Form->control('position',['class'=>'form-control', 'placeholder' => 'Position', 'label'=>false,'required']) ?>
                            <label for="role">Role</label>
                            <select class="form-control" id="role" name="role" placeholder="Role" required readonly>
                                <option value="">Select</option>
                                <option value="Super Administrator" <?= ($user->role == 'Super Administrator') ? 'selected' : ''; ?>>Super Administrator</option>
                                <option value="Administrator" <?= ($user->role == 'Administrator') ? 'selected' : ''; ?>>Administrator</option>
                                <option value="User" <?= ($user->role == 'User') ? 'selected' : ''; ?>>User</option>
                            </select>
                            <label>Contact Number</label>
                            <?= $this->Form->control('contact',['class'=>'form-control','label'=>false, 'required']) ?>
                            <label>Department</label>
                            <?= $this->Form->control('department_id',['class'=>'form-control','label'=>false, 'readonly', 'required', 'empty' => 'Select']) ?>
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
    <?= $this->Html->script('Users.js') ?>