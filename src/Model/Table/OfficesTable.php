<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Offices Model
 *
 * @property \App\Model\Table\InvtransreportsTable&\Cake\ORM\Association\HasMany $Invtransreports
 * @property \App\Model\Table\ProcurementplansTable&\Cake\ORM\Association\HasMany $Procurementplans
 * @property \App\Model\Table\ProptransreportsTable&\Cake\ORM\Association\HasMany $Proptransreports
 * @property \App\Model\Table\PurchaseordersTable&\Cake\ORM\Association\HasMany $Purchaseorders
 * @property \App\Model\Table\PurchaserequestsTable&\Cake\ORM\Association\HasMany $Purchaserequests
 * @property \App\Model\Table\RequisitionslipsTable&\Cake\ORM\Association\HasMany $Requisitionslips
 * @property \App\Model\Table\RlsddspsTable&\Cake\ORM\Association\HasMany $Rlsddsps
 * @property \App\Model\Table\RpcisTable&\Cake\ORM\Association\HasMany $Rpcis
 * @property \App\Model\Table\RpcppesTable&\Cake\ORM\Association\HasMany $Rpcppes
 * @property \App\Model\Table\RpcspsTable&\Cake\ORM\Association\HasMany $Rpcsps
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\HasMany $Users
 *
 * @method \App\Model\Entity\Office newEmptyEntity()
 * @method \App\Model\Entity\Office newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Office[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Office get($primaryKey, $options = [])
 * @method \App\Model\Entity\Office findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Office patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Office[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Office|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Office saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Office[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Office[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Office[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Office[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class OfficesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('offices');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Invtransreports', [
            'foreignKey' => 'office_id',
        ]);
        $this->hasMany('Procurementplans', [
            'foreignKey' => 'office_id',
        ]);
        $this->hasMany('Proptransreports', [
            'foreignKey' => 'office_id',
        ]);
        $this->hasMany('Purchaseorders', [
            'foreignKey' => 'office_id',
        ]);
        $this->hasMany('Purchaserequests', [
            'foreignKey' => 'office_id',
        ]);
        $this->hasMany('Requisitionslips', [
            'foreignKey' => 'office_id',
        ]);
        $this->hasMany('Rlsddsps', [
            'foreignKey' => 'office_id',
        ]);
        $this->hasMany('Rpcis', [
            'foreignKey' => 'office_id',
        ]);
        $this->hasMany('Rpcppes', [
            'foreignKey' => 'office_id',
        ]);
        $this->hasMany('Rpcsps', [
            'foreignKey' => 'office_id',
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'office_id',
        ]);
    }
}
