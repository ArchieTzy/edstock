<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Orderdetail $orderdetail
 * @var \Cake\Collection\CollectionInterface|string[] $orders
 * @var \Cake\Collection\CollectionInterface|string[] $items
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Orderdetails'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="orderdetails form content">
            <?= $this->Form->create($orderdetail) ?>
            <fieldset>
                <legend><?= __('Add Orderdetail') ?></legend>
                <?php
                    echo $this->Form->control('order_id', ['options' => $orders]);
                    echo $this->Form->control('item_id', ['options' => $items]);
                    echo $this->Form->control('qty');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
