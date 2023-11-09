<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Office Entity
 *
 * @property int $id
 * @property string $name
 *
 * @property \App\Model\Entity\Invtransreport[] $invtransreports
 * @property \App\Model\Entity\Procurementplan[] $procurementplans
 * @property \App\Model\Entity\Proptransreport[] $proptransreports
 * @property \App\Model\Entity\Purchaseorder[] $purchaseorders
 * @property \App\Model\Entity\Purchaserequest[] $purchaserequests
 * @property \App\Model\Entity\Requisitionslip[] $requisitionslips
 * @property \App\Model\Entity\Rlsddsp[] $rlsddsps
 * @property \App\Model\Entity\Rpci[] $rpcis
 * @property \App\Model\Entity\Rpcppe[] $rpcppes
 * @property \App\Model\Entity\Rpcsp[] $rpcsps
 * @property \App\Model\Entity\User[] $users
 */
class Office extends Entity
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
        'name' => true,
        'invtransreports' => true,
        'procurementplans' => true,
        'proptransreports' => true,
        'purchaseorders' => true,
        'purchaserequests' => true,
        'requisitionslips' => true,
        'rlsddsps' => true,
        'rpcis' => true,
        'rpcppes' => true,
        'rpcsps' => true,
        'users' => true,
    ];
}
