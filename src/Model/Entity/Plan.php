<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Plan Entity
 *
 * @property int $id
 * @property string $title
 * @property string|null $subtitle
 * @property string $prepared_by
 * @property string|null $position
 * @property int $status
 * @property \Cake\I18n\FrozenTime $created
 *
 * @property \App\Model\Entity\Plandetail[] $plandetails
 */
class Plan extends Entity
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
        'title' => true,
        'subtitle' => true,
        'prepared_by' => true,
        'position' => true,
        'status' => true,
        'created' => true,
        'plandetails' => true,
    ];
}
