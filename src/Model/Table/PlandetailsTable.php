<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Plandetails Model
 *
 * @property \App\Model\Table\PlansTable&\Cake\ORM\Association\BelongsTo $Plans
 * @property \App\Model\Table\ItemsTable&\Cake\ORM\Association\BelongsTo $Items
 *
 * @method \App\Model\Entity\Plandetail newEmptyEntity()
 * @method \App\Model\Entity\Plandetail newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Plandetail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Plandetail get($primaryKey, $options = [])
 * @method \App\Model\Entity\Plandetail findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Plandetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Plandetail[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Plandetail|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Plandetail saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Plandetail[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Plandetail[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Plandetail[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Plandetail[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PlandetailsTable extends Table
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

        $this->setTable('plandetails');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Plans', [
            'foreignKey' => 'plan_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Items', [
            'foreignKey' => 'item_id',
            'joinType' => 'INNER',
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
            ->integer('plan_id')
            ->notEmptyString('plan_id');

        $validator
            ->scalar('code')
            ->maxLength('code', 55)
            ->requirePresence('code', 'create')
            ->notEmptyString('code');

        $validator
            ->integer('item_id')
            ->notEmptyString('item_id');

        $validator
            ->integer('qty')
            ->allowEmptyString('qty');

        $validator
            ->numeric('cost')
            ->allowEmptyString('cost');

        $validator
            ->numeric('total')
            ->allowEmptyString('total');

        $validator
            ->integer('jan')
            ->allowEmptyString('jan');

        $validator
            ->integer('feb')
            ->allowEmptyString('feb');

        $validator
            ->integer('mar')
            ->allowEmptyString('mar');

        $validator
            ->integer('apr')
            ->allowEmptyString('apr');

        $validator
            ->integer('may')
            ->allowEmptyString('may');

        $validator
            ->integer('jun')
            ->allowEmptyString('jun');

        $validator
            ->integer('jul')
            ->allowEmptyString('jul');

        $validator
            ->integer('aug')
            ->allowEmptyString('aug');

        $validator
            ->integer('sep')
            ->allowEmptyString('sep');

        $validator
            ->integer('oct')
            ->allowEmptyString('oct');

        $validator
            ->integer('nov')
            ->allowEmptyString('nov');

        $validator
            ->integer('decm')
            ->allowEmptyString('decm');

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
        $rules->add($rules->existsIn('plan_id', 'Plans'), ['errorField' => 'plan_id']);
        $rules->add($rules->existsIn('item_id', 'Items'), ['errorField' => 'item_id']);

        return $rules;
    }
}
