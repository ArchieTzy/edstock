<?php
$grandtotal = 0;
?>
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Project Procurement Management Plan</h3>
            <div class="card-tools">
                <a href="" data-toggle="tooltip" data-placement="'bottom" title="add items" id="add"><i class="fas fa-plus"></i></a>|
                <?= $this->Html->link('<i class="fas fa-print"></i>','/PPMPDetails/printPlan/'.$plan_id,
                    ['data-toggle'=>'tooltip','data-placement'=>'bottom','title'=>'print','escape'=>false])?>
            </div>
        </div>
        <div class="card-body">
            <table id="plans-table" border="1" class="table table-responsive table-bordered" width="100%" style="font-size: x-small;">
                <thead>
                    <tr>
                        <th rowspan="2" class="text-center font-small">Code No</th>
                        <th rowspan="2" class="text-center font-small">General Description</th>
                        <th rowspan="2" class="text-center font-small">Qty</th>
                        <th rowspan="2" class="text-center font-small">Unit</th>
                        <th rowspan="2" class="text-center font-small">Unit Cost</th>
                        <th rowspan="2" class="text-center font-small">Total Cost</th>
                        <th rowspan="2" class="text-center font-small">Procurement Method</th>
                        <th colspan="12" scope="colgroup" class="text-center font-small">Schedule/Milestone of Activities</th>
                        <th rowspan="2" class="text-center font-small">Option</th>
                    </tr>
                    <tr>
                        <th scope="col" class="font-small">Jan</th>
                        <th scope="col" class="font-small">Feb</th>
                        <th scope="col" class="font-small">Mar</th>
                        <th scope="col" class="font-small">Apr</th>
                        <th scope="col" class="font-small">May</th>
                        <th scope="col" class="font-small">Jun</th>
                        <th scope="col" class="font-small">Jul</th>
                        <th scope="col" class="font-small">Aug</th>
                        <th scope="col" class="font-small">Sep</th>
                        <th scope="col" class="font-small">Oct</th>
                        <th scope="col" class="font-small">Nov</th>
                        <th scope="col" class="font-small">Dec</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($planitems as $item):
                        $total = 0;
                        $subtotal = 0;
                        ?>
                        <?php
                            if(!empty($item['items'])){
                                echo '<tr><td colspan="6" class="text-center" style="background-color: orange;">'.$item["category"].'</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    </tr>';
                                foreach ($item['items'] as $row):
                                    if(!empty($row['qty'])){
                                        $total = $row['cost'] * $row['qty'];
                                        $subtotal += $total;
                                        $grandtotal +=$subtotal;
                                    }
                                    ?>
                                <tr>
                                    <td><?= $row['code'] ?></td>
                                    <td><?= $row['description'] ?></td>
                                    <td><?= number_format($row['qty']) ?></td>
                                    <td><?= $row['unit'] ?></td>
                                    <td><?= number_format($row['cost'],2) ?></td>
                                    <td><?= number_format($row['total'],2) ?></td>
                                    <td><?= $row['method'] ?></td>
                                    <td><?= $row['jan'] ?></td>
                                    <td><?= $row['feb'] ?></td>
                                    <td><?= $row['mar'] ?></td>
                                    <td><?= $row['apr'] ?></td>
                                    <td><?= $row['may'] ?></td>
                                    <td><?= $row['jun'] ?></td>
                                    <td><?= $row['jul'] ?></td>
                                    <td><?= $row['aug'] ?></td>
                                    <td><?= $row['sep'] ?></td>
                                    <td><?= $row['oct'] ?></td>
                                    <td><?= $row['nov'] ?></td>
                                    <td><?= $row['decm'] ?></td>
                                    <td class="text-center">
                                        <div class="text-center">
                                            <a href="" class="edit" data-id="<?= $row['id'] ?>" data-item_id="<?=$row['item_id'] ?>"><i class="fa fa-pencil-alt"></i></a> |
                                            <a href="" class="delete" data-id="<?= $row['id'] ?>" data-item_id="<?=$row['item_id'] ?>"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <tr style="background-color: yellow;">
                                    <td colspan="2" class="text-center"> Subtotal</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><?= number_format($subtotal,2) ?></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                        <?php } ?>
                    <?php endforeach;?>
                <tr style="background-color: orange;">
                    <td colspan="2" class="text-center"> Grand Total</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><?= number_format($grandtotal,2) ?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="plans-modal">
    <div class="modal-dialog modal-lg">
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
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Code No</label>
                                <?= $this->Form->control('code',['class'=>'form-control','label'=>false,'required']) ?>
                                <label>Item</label>
                                <?= $this->Form->control('item',['class'=>'form-control','label'=>false,'readonly']) ?>
                                <?= $this->Form->control('item_id',['type'=>'hidden','label'=>false]) ?>
                                <label>Procurement Method</label>
                                <?= $this->Form->control('method_id',['class'=>'form-control','label'=>false]) ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Jan</label>
                                <?= $this->Form->control('jan',['class'=>'form-control col-sm-4','label'=>false]) ?>
                                <label>Feb</label>
                                <?= $this->Form->control('feb',['class'=>'form-control col-sm-4','label'=>false]) ?>
                                <label>Mar</label>
                                <?= $this->Form->control('mar',['class'=>'form-control col-sm-4','label'=>false]) ?>
                                <label>Apr</label>
                                <?= $this->Form->control('apr',['class'=>'form-control col-sm-4','label'=>false]) ?>
                                <label>May</label>
                                <?= $this->Form->control('may',['class'=>'form-control col-sm-4','label'=>false]) ?>
                                <label>Jun</label>
                                <?= $this->Form->control('jun',['class'=>'form-control col-sm-4','label'=>false]) ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Jul</label>
                                <?= $this->Form->control('jul',['class'=>'form-control col-sm-4','label'=>false]) ?>
                                <label>Aug</label>
                                <?= $this->Form->control('aug',['class'=>'form-control col-sm-4','label'=>false]) ?>
                                <label>Sep</label>
                                <?= $this->Form->control('sep',['class'=>'form-control col-sm-4','label'=>false]) ?>
                                <label>Oct</label>
                                <?= $this->Form->control('oct',['class'=>'form-control col-sm-4','label'=>false]) ?>
                                <label>Nov</label>
                                <?= $this->Form->control('nov',['class'=>'form-control col-sm-4','label'=>false]) ?>
                                <label>Dec</label>
                                <?= $this->Form->control('decm',['class'=>'form-control col-sm-4','label'=>false]) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <?= $this->Form->control('plan_id',['type'=>'hidden','label'=>false,'value'=>$plan_id]) ?>
                <?= $this->Form->control('id',['type'=>'hidden','label'=>false]) ?>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
            <?= $this->Form->end()?>
        </div>
    </div>
</div>

<div class="modal fade" id="items-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Items</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                <?= $this->Form->create($plan,['id'=>'items-form']) ?>
                    <table id="items-table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Unit</th>
                            <th></th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <?= $this->Form->control('plan_id',['type'=>'hidden','label'=>false,'value'=>$plan_id]) ?>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" id="select">Select</button>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
