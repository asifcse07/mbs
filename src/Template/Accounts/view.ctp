<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Account $account
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Account'), ['action' => 'edit', $account->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Account'), ['action' => 'delete', $account->id], ['confirm' => __('Are you sure you want to delete # {0}?', $account->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Accounts'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Account'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Accounts Transactions'), ['controller' => 'AccountsTransactions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Accounts Transaction'), ['controller' => 'AccountsTransactions', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="accounts view large-9 medium-8 columns content">
    <h3><?= h($account->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Account No') ?></th>
            <td><?= h($account->account_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Idntity File') ?></th>
            <td><?= h($account->idntity_file) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($account->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User Id') ?></th>
            <td><?= $this->Number->format($account->user_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Deleted') ?></th>
            <td><?= $this->Number->format($account->deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($account->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($account->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Accounts Transactions') ?></h4>
        <?php if (!empty($account->accounts_transactions)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Account Id') ?></th>
                <th scope="col"><?= __('Transaction Type') ?></th>
                <th scope="col"><?= __('Amount') ?></th>
                <th scope="col"><?= __('Transfer To') ?></th>
                <th scope="col"><?= __('Invoice No') ?></th>
                <th scope="col"><?= __('Remakrs') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($account->accounts_transactions as $accountsTransactions): ?>
            <tr>
                <td><?= h($accountsTransactions->id) ?></td>
                <td><?= h($accountsTransactions->account_id) ?></td>
                <td><?= h($accountsTransactions->transaction_type) ?></td>
                <td><?= h($accountsTransactions->amount) ?></td>
                <td><?= h($accountsTransactions->transfer_to) ?></td>
                <td><?= h($accountsTransactions->invoice_no) ?></td>
                <td><?= h($accountsTransactions->remakrs) ?></td>
                <td><?= h($accountsTransactions->created) ?></td>
                <td><?= h($accountsTransactions->modified) ?></td>
                <td><?= h($accountsTransactions->deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'AccountsTransactions', 'action' => 'view', $accountsTransactions->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'AccountsTransactions', 'action' => 'edit', $accountsTransactions->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'AccountsTransactions', 'action' => 'delete', $accountsTransactions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $accountsTransactions->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
