<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Orders Model
 *
 * @property \App\Model\Table\RequestsTable&\Cake\ORM\Association\BelongsTo $Requests
 * @property \App\Model\Table\OfficesTable&\Cake\ORM\Association\BelongsTo $Offices
 * @property \App\Model\Table\SuppliersTable&\Cake\ORM\Association\BelongsTo $Suppliers
 * @property \App\Model\Table\OrderdetailsTable&\Cake\ORM\Association\HasMany $Orderdetails
 *
 * @method \App\Model\Entity\Order newEmptyEntity()
 * @method \App\Model\Entity\Order newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Order[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Order get($primaryKey, $options = [])
 * @method \App\Model\Entity\Order findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Order patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Order[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Order|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Order saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Order[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Order[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Order[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Order[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OrdersTable extends Table
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

        $this->setTable('orders');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Requests', [
            'foreignKey' => 'request_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Offices', [
            'foreignKey' => 'office_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Suppliers', [
            'foreignKey' => 'supplier_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Methods', [
            'foreignKey' => 'method_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Orderdetails', [
            'foreignKey' => 'order_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('request_id')
            ->notEmptyString('request_id');

        $validator
            ->integer('office_id')
            ->notEmptyString('office_id');

        $validator
            ->integer('supplier_id')
            ->notEmptyString('supplier_id');

        $validator
            ->scalar('po_no')
            ->maxLength('po_no', 255)
            ->allowEmptyString('po_no');

        $validator
            ->integer('method_id')
            ->notEmptyString('method_id');

        $validator
            ->scalar('place_of_delivery')
            ->maxLength('place_of_delivery', 255)
            ->allowEmptyString('place_of_delivery');

        $validator
            ->dateTime('date_of_delivery')
            ->requirePresence('date_of_delivery', 'create')
            ->notEmptyDateTime('date_of_delivery');

        $validator
            ->scalar('delivery_term')
            ->maxLength('delivery_term', 255)
            ->requirePresence('delivery_term', 'create')
            ->notEmptyString('delivery_term');

        $validator
            ->scalar('payment_term')
            ->maxLength('payment_term', 255)
            ->requirePresence('payment_term', 'create')
            ->notEmptyString('payment_term');

        $validator
            ->scalar('fund_available')
            ->maxLength('fund_available', 25)
            ->allowEmptyString('fund_available');

        $validator
            ->scalar('ors_burs_no')
            ->maxLength('ors_burs_no', 255)
            ->allowEmptyString('ors_burs_no');

        $validator
            ->dateTime('date_of_burs')
            ->requirePresence('date_of_burs', 'create')
            ->notEmptyDateTime('date_of_burs');

        $validator
            ->dateTime('deleted')
            ->allowEmptyDateTime('deleted');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('request_id', 'Requests'), ['errorField' => 'request_id']);
        $rules->add($rules->existsIn('office_id', 'Offices'), ['errorField' => 'office_id']);
        $rules->add($rules->existsIn('supplier_id', 'Suppliers'), ['errorField' => 'supplier_id']);
        $rules->add($rules->existsIn('method_id', 'Methods'), ['errorField' => 'method_id']);

        return $rules;
    }
}
