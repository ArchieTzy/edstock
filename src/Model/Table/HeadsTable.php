<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Heads Model
 *
 * @method \App\Model\Entity\Head newEmptyEntity()
 * @method \App\Model\Entity\Head newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Head[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Head get($primaryKey, $options = [])
 * @method \App\Model\Entity\Head findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Head patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Head[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Head|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Head saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Head[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Head[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Head[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Head[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class HeadsTable extends Table
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

        $this->setTable('heads');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->scalar('name')
            ->maxLength('name', 55)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('position')
            ->maxLength('position', 55)
            ->requirePresence('position', 'create')
            ->notEmptyString('position');

        return $validator;
    }
}
