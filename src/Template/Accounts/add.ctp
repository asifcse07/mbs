<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Account $account
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <?php echo $this->element('sidebar');?>
    
</nav>
<div class="accounts form large-9 medium-8 columns content">
    <?= $this->Form->create($account, ['enctype' => 'multipart/form-data']) ?>
    <input type="hidden" name="_csrfToken" autocomplete="off" value="<?php echo $token; ?>">
    <fieldset>
        <legend><?= __('Open Account') ?></legend>
        <input type="hidden" name="user_id" class="user_id" value="<?php echo $user_id; ?>">
        <?php
            // echo $this->Form->control('account_no', ['value' => $account_no, 'readOnly' => 'readOnly']);
            echo $this->Form->control('opening_amount', ['label' => 'Opening Balance']);
            echo $this->Form->control('idntity_file', ['type' => 'file']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
