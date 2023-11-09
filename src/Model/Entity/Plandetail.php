<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Plandetail Entity
 *
 * @property int $id
 * @property int $plan_id
 * @property string $code
 * @property int $item_id
 * @property int|null $qty
 * @property float|null $cost
 * @property float|null $total
 * @property int|null $jan
 * @property int|null $feb
 * @property int|null $mar
 * @property int|null $apr
 * @property int|null $may
 * @property int|null $jun
 * @property int|null $jul
 * @property int|null $aug
 * @property int|null $sep
 * @property int|null $oct
 * @property int|null $nov
 * @property int|null $decm
 * @property \Cake\I18n\FrozenTime $created
 *
 * @property \App\Model\Entity\Plan $plan
 * @property \App\Model\Entity\Item $item
 */
class Plandetail extends Entity
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
        'plan_id' => true,
        'code' => true,
        'item_id' => true,
        'qty' => true,
        'cost' => true,
        'total' => true,
        'jan' => true,
        'feb' => true,
        'mar' => true,
        'apr' => true,
        'may' => true,
        'jun' => true,
        'jul' => true,
        'aug' => true,
        'sep' => true,
        'oct' => true,
        'nov' => true,
        'decm' => true,
        'created' => true,
        'plan' => true,
        'item' => true,
    ];
}
