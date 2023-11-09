<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Inventory Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenTime $created
 * @property int $item_id
 * @property string $unit
 * @property float $qty
 * @property float $unit_cost
 * @property float $total_cost
 *
 * @property \App\Model\Entity\Item $item
 * @property \App\Model\Entity\Purchaserequest[] $purchaserequests
 */
class Inventory extends Entity
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
        'created' => true,
        'item_id' => true,
        'unit' => true,
        'qty' => true,
        'unit_cost' => true,
        'total_cost' => true,
        'item' => true,
        'purchaserequests' => true,
    ];
}
