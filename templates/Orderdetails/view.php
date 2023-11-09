<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Orderdetail $orderdetail
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Orderdetail'), ['action' => 'edit', $orderdetail->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Orderdetail'), ['action' => 'delete', $orderdetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orderdetail->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Orderdetails'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Orderdetail'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="orderdetails view content">
            <h3><?= h($orderdetail->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Order') ?></th>
                    <td><?= $orderdetail->has('order') ? $this->Html->link($orderdetail->order->id, ['controller' => 'Orders', 'action' => 'view', $orderdetail->order->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Item') ?></th>
                    <td><?= $orderdetail->has('item') ? $this->Html->link($orderdetail->item->description, ['controller' => 'Items', 'action' => 'view', $orderdetail->item->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($orderdetail->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Qty') ?></th>
                    <td><?= $this->Number->format($orderdetail->qty) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($orderdetail->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($orderdetail->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
