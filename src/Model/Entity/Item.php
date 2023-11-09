<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Item Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenTime $created
 * @property int $category_id
 * @property string $description
 * @property int $unit_id
 * @property float|null $cost
 *
 * @property \App\Model\Entity\Category $category
 */
class Item extends Entity
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
        'category_id' => true,
        'description' => true,
        'unit_id' => true,
        'cost' => true,
        'category' => true,
    ];
}
