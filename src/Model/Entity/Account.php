<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Account Entity
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $account_no
 * @property string|null $idntity_file
 * @property float|null $opening_amount
 * @property float|null $amount
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int|null $deleted
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\AccountsTransaction[] $accounts_transactions
 */
class Account extends Entity
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
        'user_id' => true,
        'account_no' => true,
        'idntity_file' => true,
        'opening_amount' => true,
        'amount' => true,
        'created' => true,
        'modified' => true,
        'deleted' => true,
        'user' => true,
        'accounts_transactions' => true
    ];
}
