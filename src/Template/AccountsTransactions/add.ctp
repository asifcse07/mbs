<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AccountsTransaction $accountsTransaction
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <?php echo $this->element('sidebar');?>
    </ul>
</nav>
<div class="accountsTransactions form large-9 medium-8 columns content">
    <?= $this->Form->create($accountsTransaction) ?>
    <fieldset>
        <legend><?= __('Deposit') ?></legend>
        <input type="hidden" name="user_id" value="<?php echo $user_id;?>">
        <input type="hidden" name="transaction_type" value="1">
        <?php
            echo $this->Form->control('invoice_no', ['value' => $invoice_no, 'readOnly' => 'readOnly', 'label' => 'Transaction No']);
            echo $this->Form->control('account_id', ['options' => $accounts, 'empty' => 'Select Account No', 'label' => 'Withdraw From']);
            echo $this->Form->control('amount');
            echo $this->Form->control('transfer_to', ['options' => $accounts, 'empty' => 'Select Account No', 'label' => 'Deposit To']);
            echo $this->Form->control('remakrs');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
