<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Requests Model
 *
 * @property \App\Model\Table\OfficesTable&\Cake\ORM\Association\BelongsTo $Offices
 * @property \App\Model\Table\FclustersTable&\Cake\ORM\Association\BelongsTo $Fclusters
 * @property \App\Model\Table\DepartmentsTable&\Cake\ORM\Association\BelongsTo $Departments
 * @property \App\Model\Table\OrdersTable&\Cake\ORM\Association\HasMany $Orders
 * @property \App\Model\Table\RequestdetailsTable&\Cake\ORM\Association\HasMany $Requestdetails
 *
 * @method \App\Model\Entity\Request newEmptyEntity()
 * @method \App\Model\Entity\Request newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Request[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Request get($primaryKey, $options = [])
 * @method \App\Model\Entity\Request findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Request patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Request[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Request|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Request saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Request[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Request[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Request[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Request[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RequestsTable extends Table
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

        $this->setTable('requests');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Offices', [
            'foreignKey' => 'office_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Fclusters', [
            'foreignKey' => 'fcluster_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Departments', [
            'foreignKey' => 'department_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Orders', [
            'foreignKey' => 'request_id',
        ]);
        $this->hasMany('Requestdetails', [
            'foreignKey' => 'request_id',
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
            ->integer('office_id')
            ->notEmptyString('office_id');

        $validator
            ->integer('fcluster_id')
            ->notEmptyString('fcluster_id');

        $validator
            ->integer('department_id')
            ->notEmptyString('department_id');

        $validator
            ->scalar('pr_no')
            ->maxLength('pr_no', 255)
            ->requirePresence('pr_no', 'create')
            ->notEmptyString('pr_no');

        $validator
            ->scalar('responsibility_center_code')
            ->maxLength('responsibility_center_code', 255)
            ->allowEmptyString('responsibility_center_code');

        $validator
            ->scalar('purpose')
            ->requirePresence('purpose', 'create')
            ->notEmptyString('purpose');

        $validator
            ->scalar('requester')
            ->maxLength('requester', 55)
            ->requirePresence('requester', 'create')
            ->notEmptyString('requester');

        $validator
            ->scalar('approver')
            ->maxLength('approver', 55)
            ->requirePresence('approver', 'create')
            ->notEmptyString('approver');

        $validator
            ->integer('status')
            ->allowEmptyString('status');

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
        $rules->add($rules->existsIn('office_id', 'Offices'), ['errorField' => 'office_id']);
        $rules->add($rules->existsIn('fcluster_id', 'Fclusters'), ['errorField' => 'fcluster_id']);
        $rules->add($rules->existsIn('department_id', 'Departments'), ['errorField' => 'department_id']);

        return $rules;
    }
}
