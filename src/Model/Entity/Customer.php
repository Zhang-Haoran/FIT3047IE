<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Customer Entity
 *
 * @property int $id
 * @property string $fname
 * @property string $lname
 * @property string $contact
 * @property string $phone
 * @property string $mobile
 * @property string $email
 * @property int $cust_type_id
 * @property bool $is_deleted
 *
 * @property \App\Model\Entity\CustType $cust_type
 * @property \App\Model\Entity\Job[] $jobs
 */
class Customer extends Entity
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
        'fname' => true,
        'lname' => true,
        'contact' => true,
        'phone' => true,
        'mobile' => true,
        'email' => true,
        'cust_type_id' => true,
        'is_deleted' => true,
        'cust_type' => true,
        'jobs' => true
    ];
    protected function _getFullName()
    {
    return $this->fname . ' ' . $this->lname;
    }
}