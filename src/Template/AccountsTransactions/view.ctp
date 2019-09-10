<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AccountsTransaction $accountsTransaction
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Accounts Transaction'), ['action' => 'edit', $accountsTransaction->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Accounts Transaction'), ['action' => 'delete', $accountsTransaction->id], ['confirm' => __('Are you sure you want to delete # {0}?', $accountsTransaction->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Accounts Transactions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Accounts Transaction'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Accounts'), ['controller' => 'Accounts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Account'), ['controller' => 'Accounts', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="accountsTransactions view large-9 medium-8 columns content">
    <h3><?= h($accountsTransaction->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Account') ?></th>
            <td><?= $accountsTransaction->has('account') ? $this->Html->link($accountsTransaction->account->id, ['controller' => 'Accounts', 'action' => 'view', $accountsTransaction->account->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Invoice No') ?></th>
            <td><?= h($accountsTransaction->invoice_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($accountsTransaction->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Transaction Type') ?></th>
            <td><?= $this->Number->format($accountsTransaction->transaction_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount') ?></th>
            <td><?= $this->Number->format($accountsTransaction->amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Transfer To') ?></th>
            <td><?= $this->Number->format($accountsTransaction->transfer_to) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Deleted') ?></th>
            <td><?= $this->Number->format($accountsTransaction->deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($accountsTransaction->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($accountsTransaction->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Remakrs') ?></h4>
        <?= $this->Text->autoParagraph(h($accountsTransaction->remakrs)); ?>
    </div>
</div>
