<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Requestdetail Entity
 *
 * @property int $id
 * @property int $request_id
 * @property int $item_id
 * @property float $cost
 * @property int $qty
 * @property int $total
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime|null $deleted
 *
 * @property \App\Model\Entity\Request $request
 * @property \App\Model\Entity\Item $item
 */
class Requestdetail extends Entity
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
        'item_id' => true,
        'cost' => true,
        'qty' => true,
        'total' => true,
        'created' => true,
        'modified' => true,
        'deleted' => true,
        'request' => true,
        'item' => true,
    ];
}
