<ul class="side-nav">
    <li class="heading"><?= __('Menu') ?></li>
    <li><?= $this->Html->link(__('Dashboard'), ['controller' => 'Accounts', 'action' => 'dashboard']) ?></li>
    <li><?= $this->Html->link(__('Open Accounts'), ['controller' => 'Accounts', 'action' => 'add']) ?></li>
    <li><?= $this->Html->link(__('Accounts Details'), ['controller' => 'Accounts', 'action' => 'index']) ?></li>
    <li><?= $this->Html->link(__('Deposit'), ['controller' => 'AccountsTransactions', 'action' => 'add']) ?></li>
    <li><?= $this->Html->link(__('Fund Transfer'), ['controller' => 'AccountsTransactions', 'action' => 'fundTransfer']) ?></li>
    <li><?= $this->Html->link(__('Transaction Report'), ['controller' => 'AccountsTransactions', 'action' => 'index']) ?></li>
</ul>