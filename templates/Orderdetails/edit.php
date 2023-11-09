<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Orderdetail $orderdetail
 * @var string[]|\Cake\Collection\CollectionInterface $orders
 * @var string[]|\Cake\Collection\CollectionInterface $items
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $orderdetail->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $orderdetail->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Orderdetails'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="orderdetails form content">
            <?= $this->Form->create($orderdetail) ?>
            <fieldset>
                <legend><?= __('Edit Orderdetail') ?></legend>
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
