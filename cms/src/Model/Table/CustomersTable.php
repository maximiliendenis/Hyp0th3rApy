<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Customers Model
 *
 * @method \App\Model\Entity\Customer newEmptyEntity()
 * @method \App\Model\Entity\Customer newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Customer> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Customer get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Customer findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Customer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Customer> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Customer|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Customer saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Customer>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Customer>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Customer>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Customer> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Customer>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Customer>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Customer>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Customer> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CustomersTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('customers');
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
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->boolean('deleted')
            ->requirePresence('deleted', 'create')
            ->notEmptyString('deleted');

        return $validator;
    }

    public function beforeSave($even, $entity, $options)
    {
        $entity->modified = date('Y-m-d H:i:s');
    }
}