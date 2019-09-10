<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AccountsTransaction[]|\Cake\Collection\CollectionInterface $accountsTransactions
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <?php echo $this->element('sidebar');?>
    </ul>
</nav>
<div class="accountsTransactions index large-9 medium-8 columns content">
    <h3><?= __('Transactions Report') ?></h3>
    <form class="reportForm">
        <input type="hidden" name="_csrfToken" autocomplete="off" value="<?php echo $token; ?>">
        <table cellpadding="0" cellspacing="0" class="searhTran">
            <thead>
                <tr style="border-bottom: 0px solid white !important;">
                    <td>
                        <?php echo $this->Form->control('account_id', ['options' => $accounts, 'empty' => 'Select Account No', 'label' => false]);?>
                            
                    </td>
                    <td>
                        <input class="input--style-4 from_date" type="text" name="from_date" autocomplete="off">
                    </td>
                    <td>
                        <input class="input--style-4 to_date" type="text" name="to_date" autocomplete="off">
                    </td>
                    <td>
                        <?php echo $this->Form->control('transaction_type', ['options' => $transaction_type, 'empty' => 'Select Type', 'label' => false]);?> 
                    </td>
                </tr>
                <tr style="border-bottom: 0px solid white !important;">
                    <td colspan="4" style="text-align: right">
                        <button class="button checkTran">Report</button>
                    </td>
                </tr>
            </thead>
        </table>
    </form>
    <span class="reportTbl">
        <table cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th scope="col" style="width: 15%"><?= $this->Paginator->sort('Transactions No') ?></th>
                    <th scope="col" style="width: 20%"><?= $this->Paginator->sort('account_no') ?></th>
                    <th scope="col" style="width: 15%"><?= $this->Paginator->sort('transaction') ?></th>
                    <th scope="col" style="width: 20%"><?= $this->Paginator->sort('account_no') ?></th>
                    <th scope="col" style="width: 15%"><?= $this->Paginator->sort('amount') ?></th>
                    <th scope="col" style="width: 15%"><?= $this->Paginator->sort('Date') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($accountsTransactions as $accountsTransaction): 
                    ?>
                <tr>
                    <td><?= h($accountsTransaction->invoice_no) ?></td>
                    <td><?= $accountsTransaction['ac']['account_no'] ?> </td>
                    <td><?= $transaction_type[$accountsTransaction->transaction_type] ?> To</td>
                    <td><?= $accountsTransaction['tm']['account_no'] ?></td>
                    <td><?= $this->Number->format($accountsTransaction->amount)?> &euro;</td>
                    <td><?= h($accountsTransaction->created) ?></td>
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
    </span>
</div>

