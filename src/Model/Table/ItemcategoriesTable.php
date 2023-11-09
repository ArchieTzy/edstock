<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Itemcategories Model
 *
 * @property \App\Model\Table\ItemsTable&\Cake\ORM\Association\HasMany $Items
 *
 * @method \App\Model\Entity\Itemcategory newEmptyEntity()
 * @method \App\Model\Entity\Itemcategory newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Itemcategory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Itemcategory get($primaryKey, $options = [])
 * @method \App\Model\Entity\Itemcategory findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Itemcategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Itemcategory[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Itemcategory|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Itemcategory saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Itemcategory[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Itemcategory[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Itemcategory[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Itemcategory[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ItemcategoriesTable extends Table
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

        $this->setTable('itemcategories');
        $this->setDisplayField('categoryname');
        $this->setPrimaryKey('id');

        $this->hasMany('Items', [
            'foreignKey' => 'itemcategory_id',
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
            ->scalar('categoryname')
            ->maxLength('categoryname', 55)
            ->requirePresence('categoryname', 'create')
            ->notEmptyString('categoryname');

        return $validator;
    }
}
