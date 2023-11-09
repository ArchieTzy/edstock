<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Requestdetail $requestdetail
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Requestdetail'), ['action' => 'edit', $requestdetail->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Requestdetail'), ['action' => 'delete', $requestdetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $requestdetail->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Requestdetails'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Requestdetail'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="requestdetails view content">
            <h3><?= h($requestdetail->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Request') ?></th>
                    <td><?= $requestdetail->has('request') ? $this->Html->link($requestdetail->request->id, ['controller' => 'Requests', 'action' => 'view', $requestdetail->request->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Item') ?></th>
                    <td><?= $requestdetail->has('item') ? $this->Html->link($requestdetail->item->description, ['controller' => 'Items', 'action' => 'view', $requestdetail->item->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($requestdetail->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Cost') ?></th>
                    <td><?= $this->Number->format($requestdetail->cost) ?></td>
                </tr>
                <tr>
                    <th><?= __('Qty') ?></th>
                    <td><?= $this->Number->format($requestdetail->qty) ?></td>
                </tr>
                <tr>
                    <th><?= __('Total') ?></th>
                    <td><?= $this->Number->format($requestdetail->total) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($requestdetail->created) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
