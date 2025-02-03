<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProductsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProductsTable Test Case
 */
class ProductsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ProductsTable
     */
    protected $Products;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Products',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Products') ? [] : ['className' => ProductsTable::class];
        $this->Products = $this->getTableLocator()->get('Products', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Products);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ProductsTable::validationDefault()
     */
    public function testProduct1Validation(): void
    {
        $product1 = $this->Products->newEntity([
            'id' => 1,
            'name' => 'A',  //Name must be longer than 3 characters
            'quantity' => -1, //Quantity must be more than 0
            'price' => -1,  //Price must be more than 0
            'status' => 'out of stock',
        ]);

        $errors1 = $product1->getErrors();
        $this->assertNotEmpty($errors1, 'Product 1 should fail validation with incorrect data');
    }

    public function testProduct2Validation(): void
    {
        $product2 = $this->Products->newEntity([
            'id' => 2,
            'name' => 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', //Name must be shorter than 50 characters
            'quantity' => 1001, //Quantity must be less than 1000
            'price' => 10001, //Price must be less than 10000
            'status' => 'in stock',
        ]);

        $errors2 = $product2->getErrors();
        $this->assertNotEmpty($errors2, 'Product 2 should fail validation with incorrect data');
    }

    public function testProduct3Validation(): void
    {
        $product3 = $this->Products->newEntity([ //Products with a price > 100 must have a minimum quantity of 10.
            'id' => 3,
            'name' => 'A',
            'quantity' => 5,
            'price' => 100,
            'status' => 'low stock',
        ]);

        $errors3 = $product3->getErrors();
        $this->assertNotEmpty($errors3, 'Product 3 should fail validation with incorrect data');
    }

    public function testProduct4Validation(): void
    {
        $product4 = $this->Products->newEntity([ //Products with a name containing "promo" must have a price < 50.
            'id' => 4,
            'name' => 'A_promo',
            'quantity' => 10,
            'price' => 51,
            'status' => 'in stock',
        ]);

        $errors4 = $product4->getErrors();
        $this->assertNotEmpty($errors4, 'Product 4 should fail validation with incorrect data');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ProductsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
