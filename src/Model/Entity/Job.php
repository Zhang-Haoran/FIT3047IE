<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Job Entity
 *
 * @property int $id
 * @property string $name
 * @property string $job_status
 * @property \Cake\I18n\FrozenDate $job_date
 * @property \Cake\I18n\FrozenTime $booked_date
 * @property float $price
 * @property float $deposit
 * @property string $order_detail
 * @property \Cake\I18n\FrozenTime $e_arrival_time
 * @property \Cake\I18n\FrozenTime $e_setup_time
 * @property \Cake\I18n\FrozenTime $e_pickup_time
 * @property string $additional_note
 * @property int $site_id
 * @property int $event_type_id
 * @property int $customer_id
 * @property int $employee_id
 * @property string $edited_by
 * @property \Cake\I18n\FrozenTime $last_changed
 * @property string $Invoice
 * @property string $job_order
 * @property string $quote
 * @property string $token
 * @property \Cake\I18n\FrozenTime $timeout
 * @property bool $is_deleted
 * @property string $arrive_note
 * @property string $setup_note
 * @property string $pickup_note
 * @property bool $is_pickup
 *
 * @property \App\Model\Entity\Site $site
 * @property \App\Model\Entity\EventType $event_type
 * @property \App\Model\Entity\Customer $customer
 * @property \App\Model\Entity\Employee $employee
 * @property \App\Model\Entity\Contact[] $contacts
 * @property \App\Model\Entity\Image[] $images
 */
class Job extends Entity
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
        'name' => true,
        'job_status' => true,
        'job_date' => true,
        'booked_date' => true,
        'price' => true,
        'deposit' => true,
        'order_detail' => true,
        'e_arrival_time' => true,
        'e_setup_time' => true,
        'e_pickup_time' => true,
        'additional_note' => true,
        'site_id' => true,
        'event_type_id' => true,
        'customer_id' => true,
        'employee_id' => true,
        'edited_by' => true,
        'last_changed' => true,
        'Invoice' => true,
        'job_order' => true,
        'quote' => true,
        'token' => true,
        'timeout' => true,
        'is_deleted' => true,
        'arrive_note' => true,
        'setup_note' => true,
        'pickup_note' => true,
        'is_pickup' => true,
        'site' => true,
        'event_type' => true,
        'customer' => true,
        'employee' => true,
        'contacts' => true,
        'images' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'token'
    ];
}
