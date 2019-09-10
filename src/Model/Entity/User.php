<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * User Entity
 *
 * @property int $id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $email
 * @property string|null $father_name
 * @property string|null $mother_name
 * @property int|null $gender
 * @property string|null $mobile_no
 * @property \Cake\I18n\FrozenDate|null $dob
 * @property string|null $passcode
 * @property string|null $password
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int $deleted
 *
 * @property \App\Model\Entity\Account[] $accounts
 */
class User extends Entity
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
        'first_name' => true,
        'last_name' => true,
        'email' => true,
        'father_name' => true,
        'mother_name' => true,
        'gender' => true,
        'mobile_no' => true,
        'dob' => true,
        'passcode' => true,
        'password' => true,
        'created' => true,
        'modified' => true,
        'deleted' => true,
        'accounts' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];

    protected function _setPassword($password)
    {
        if (strlen($password) > 0) {
          return (new DefaultPasswordHasher)->hash($password);
        }
    }

    public function initialize(array $config)
    {
        $this->addBehavior('Timestam');

    }
}
