<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Orderdetail> $orderdetails
 */
?>
<div class="orderdetails index content">
    <?= $this->Html->link(__('New Orderdetail'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Orderdetails') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('order_id') ?></th>
                    <th><?= $this->Paginator->sort('item_id') ?></th>
                    <th><?= $this->Paginator->sort('qty') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orderdetails as $orderdetail): ?>
                <tr>
                    <td><?= $this->Number->format($orderdetail->id) ?></td>
                    <td><?= $orderdetail->has('order') ? $this->Html->link($orderdetail->order->id, ['controller' => 'Orders', 'action' => 'view', $orderdetail->order->id]) : '' ?></td>
                    <td><?= $orderdetail->has('item') ? $this->Html->link($orderdetail->item->description, ['controller' => 'Items', 'action' => 'view', $orderdetail->item->id]) : '' ?></td>
                    <td><?= $this->Number->format($orderdetail->qty) ?></td>
                    <td><?= h($orderdetail->created) ?></td>
                    <td><?= h($orderdetail->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $orderdetail->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $orderdetail->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $orderdetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orderdetail->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
