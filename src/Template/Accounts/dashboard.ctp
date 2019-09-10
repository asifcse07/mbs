<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Account[]|\Cake\Collection\CollectionInterface $accounts
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <?php echo $this->element('sidebar');?>
</nav>
<div class="accounts index large-9 medium-8 columns content">
    <h3 style="color : red;"><?= __('Welcome To Mobile Banking Service, Mr.') .  $full_name ?></h3>
    
   <table cellpadding="0" cellspacing="0" class="searhTran" style="width:60%">
        <thead>
            <tr style="border-bottom: 0px solid white !important;">
                <td>
                	<form class="chckblncForm">
	                	<input type="hidden" name="_csrfToken" autocomplete="off" value="<?php echo $token; ?>">
	                    <?php echo $this->Form->control('account_id', ['options' => $accounts, 'empty' => 'Select Account No', 'label' => false]);?>
                    </form>    
                </td>
                <td style="width:30%;">
                	<button class="button checkblnc" style="height: 40px;padding: 10px;border-radius: 7px">Check balance</button>
                </td>
                <td>
                	<input type="text" name="blnc" class="blnc" readonly>
                </td>
        	</tr>
        </thead>	
    </table>
</div>
