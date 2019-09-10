<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AccountsTransaction $accountsTransaction
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $accountsTransaction->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $accountsTransaction->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Accounts Transactions'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Accounts'), ['controller' => 'Accounts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Account'), ['controller' => 'Accounts', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="accountsTransactions form large-9 medium-8 columns content">
    <?= $this->Form->create($accountsTransaction) ?>
    <fieldset>
        <legend><?= __('Edit Accounts Transaction') ?></legend>
        <?php
            echo $this->Form->control('account_id', ['options' => $accounts, 'empty' => true]);
            echo $this->Form->control('transaction_type');
            echo $this->Form->control('amount');
            echo $this->Form->control('transfer_to');
            echo $this->Form->control('invoice_no');
            echo $this->Form->control('remakrs');
            echo $this->Form->control('deleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
