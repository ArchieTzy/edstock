<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Order Entity
 *
 * @property int $id
 * @property int $request_id
 * @property int $office_id
 * @property int $supplier_id
 * @property string|null $po_no
 * @property int $method_id
 * @property string|null $place_of_delivery
 * @property \Cake\I18n\FrozenTime $date_of_delivery
 * @property string $delivery_term
 * @property string $payment_term
 * @property string|null $fund_available
 * @property string|null $ors_burs_no
 * @property \Cake\I18n\FrozenTime $date_of_burs
 * @property \Cake\I18n\FrozenTime|null $deleted
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Office $office
 * @property \App\Model\Entity\Supplier $supplier
 * @property \App\Model\Entity\Request $request
 * @property \App\Model\Entity\Item $item
 * @property \App\Model\Entity\Orderdetail[] $orderdetails
 */
class Order extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'request_id' => true,
        'office_id' => true,
        'supplier_id' => true,
        'po_no' => true,
        'method_id' => true,
        'place_of_delivery' => true,
        'date_of_delivery' => true,
        'delivery_term' => true,
        'payment_term' => true,
        'fund_available' => true,
        'ors_burs_no' => true,
        'date_of_burs' => true,
        'deleted' => true,
        'created' => true,
        'modified' => true,
        'office' => true,
        'supplier' => true,
        'request' => true,
        'item' => true,
        'orderdetails' => true,
    ];
}
