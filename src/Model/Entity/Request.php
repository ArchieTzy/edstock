<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Request Entity
 *
 * @property int $id
 * @property int $office_id
 * @property int $fcluster_id
 * @property int $department_id
 * @property string $pr_no
 * @property string|null $responsibility_center_code
 * @property string $purpose
 * @property string $requester
 * @property string $approver
 * @property int|null $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime|null $deleted
 *
 * @property \App\Model\Entity\Office $office
 * @property \App\Model\Entity\Fcluster $fcluster
 * @property \App\Model\Entity\Department $department
 * @property \App\Model\Entity\Order[] $orders
 * @property \App\Model\Entity\Requestdetail[] $requestdetails
 */
class Request extends Entity
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
        'office_id' => true,
        'fcluster_id' => true,
        'department_id' => true,
        'pr_no' => true,
        'responsibility_center_code' => true,
        'purpose' => true,
        'requester' => true,
        'approver' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'deleted' => true,
        'office' => true,
        'fcluster' => true,
        'department' => true,
        'orders' => true,
        'requestdetails' => true,
    ];
}
