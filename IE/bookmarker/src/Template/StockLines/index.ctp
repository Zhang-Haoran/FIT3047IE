<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\StockLine[]|\Cake\Collection\CollectionInterface $stockLines
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Stock Line'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Stocks'), ['controller' => 'Stocks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Stock'), ['controller' => 'Stocks', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Jobs'), ['controller' => 'Jobs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Job'), ['controller' => 'Jobs', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="stockLines index large-9 medium-8 columns content">
    <h3><?= __('Stock Lines') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('stock_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('job_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('stock_num') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($stockLines as $stockLine): ?>
            <tr>
                <td><?= $stockLine->has('stock') ? $this->Html->link($stockLine->stock->stock_id, ['controller' => 'Stocks', 'action' => 'view', $stockLine->stock->stock_id]) : '' ?></td>
                <td><?= $stockLine->has('job') ? $this->Html->link($stockLine->job->job_id, ['controller' => 'Jobs', 'action' => 'view', $stockLine->job->job_id]) : '' ?></td>
                <td><?= $this->Number->format($stockLine->stock_num) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $stockLine->stock_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $stockLine->stock_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $stockLine->stock_id], ['confirm' => __('Are you sure you want to delete # {0}?', $stockLine->stock_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
