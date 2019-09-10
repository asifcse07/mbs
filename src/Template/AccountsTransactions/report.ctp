
<table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th scope="col" style="width: 15%"><?= $this->Paginator->sort('invoice_no') ?></th>
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
