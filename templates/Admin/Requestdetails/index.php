<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Requestdetail> $requestdetails
 */
?>
<div class="requestdetails index content">
    <?= $this->Html->link(__('New Requestdetail'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Requestdetails') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('request_id') ?></th>
                    <th><?= $this->Paginator->sort('item_id') ?></th>
                    <th><?= $this->Paginator->sort('cost') ?></th>
                    <th><?= $this->Paginator->sort('qty') ?></th>
                    <th><?= $this->Paginator->sort('total') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($requestdetails as $requestdetail): ?>
                <tr>
                    <td><?= $this->Number->format($requestdetail->id) ?></td>
                    <td><?= $requestdetail->has('request') ? $this->Html->link($requestdetail->request->id, ['controller' => 'Requests', 'action' => 'view', $requestdetail->request->id]) : '' ?></td>
                    <td><?= $requestdetail->has('item') ? $this->Html->link($requestdetail->item->description, ['controller' => 'Items', 'action' => 'view', $requestdetail->item->id]) : '' ?></td>
                    <td><?= $this->Number->format($requestdetail->cost) ?></td>
                    <td><?= $this->Number->format($requestdetail->qty) ?></td>
                    <td><?= $this->Number->format($requestdetail->total) ?></td>
                    <td><?= h($requestdetail->created) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $requestdetail->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $requestdetail->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $requestdetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $requestdetail->id)]) ?>
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
