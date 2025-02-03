<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Products Model
 *
 * @method \App\Model\Entity\Product newEmptyEntity()
 * @method \App\Model\Entity\Product newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Product> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Product get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Product findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Product patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Product> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Product|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Product saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Product>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Product>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Product>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Product> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Product>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Product>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Product>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Product> deleteManyOrFail(iterable $entities, array $options = [])
 */
class ProductsTable extends Table
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

        $this->setTable('products');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
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
            ->maxLength('name', 50)
            ->requirePresence('name', 'create', 'Name is required')
            ->notEmptyString('name', 'Name is required')
            ->add('name', [
                'length' => [
                    'rule' => ['lengthBetween', 3, 50],
                    'message' => 'Name must be between 3 and 50 characters'
                ],
                'unique' => [
                    'rule' => 'validateUnique',
                    'provider' => 'table',
                    'message' => 'This product name already exists'
                ]
            ]);

        $validator
            ->requirePresence('quantity', 'create', 'Quantity is required')
            ->notEmptyString('quantity', 'Quantity is required')
            ->integer('quantity', 'Quantity must be an integer')
            ->range('quantity', [0, 1000], 'Quantity must be between 0 and 1000');

        $validator
            ->requirePresence('price', 'create', 'Price is required')
            ->notEmptyString('price', 'Price is required')
            ->numeric('price', 'Price must be a valid number')
            ->greaterThan('price', 0, 'Price must be greater than 0')
            ->lessThanOrEqual('price', 10000, 'Price must be 10,000 or less');

        $validator
            ->requirePresence('status', 'create', 'Status is required')
            ->notEmptyString('status', 'Status is required')
            ->inList('status', ['in stock', 'low stock', 'out of stock'], 'Invalid status');

        // Custom Rules
        $validator->add('quantity', 'customPriceRule', [
            'rule' => function ($value, $context) {
                if (isset($context['data']['price']) && $context['data']['price'] > 100) {
                    return $value >= 10;
                }
                return true;
            },
            'message' => 'Products with a price over 100 must have a minimum quantity of 10'
        ]);

        $validator->add('price', 'customPromoRule', [
            'rule' => function ($value, $context) {
                if (isset($context['data']['name']) && stripos($context['data']['name'], 'promo') !== false) {
                    return $value < 50;
                }
                return true;
            },
            'message' => 'Products with "promo" in the name must have a price under 50'
        ]);

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
        $rules->add($rules->isUnique(['name']), ['errorField' => 'name']);

        return $rules;
    }
}
