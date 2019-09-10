<ul class="side-nav">
    <li class="heading"><?= __('Actions') ?></li>
    <li><?= $this->Html->link(__('List Accounts'), ['action' => 'index']) ?></li>
    <li><?= $this->Html->link(__('List Accounts Transactions'), ['controller' => 'AccountsTransactions', 'action' => 'index']) ?></li>
    <li><?= $this->Html->link(__('New Accounts Transaction'), ['controller' => 'AccountsTransactions', 'action' => 'add']) ?></li>
</ul>