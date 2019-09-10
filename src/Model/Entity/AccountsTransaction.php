<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AccountsTransaction Entity
 *
 * @property int $id
 * @property int|null $account_id
 * @property int|null $transaction_type
 * @property float|null $amount
 * @property int|null $transfer_to
 * @property string|null $invoice_no
 * @property string|null $remakrs
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int|null $deleted
 *
 * @property \App\Model\Entity\Account $account
 */
class AccountsTransaction extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'account_id' => true,
        'transaction_type' => true,
        'amount' => true,
        'transfer_to' => true,
        'invoice_no' => true,
        'remakrs' => true,
        'created' => true,
        'modified' => true,
        'deleted' => true,
        'account' => true
    ];
}
