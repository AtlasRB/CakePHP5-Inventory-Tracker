<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\ProductsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\ProductsController Test Case
 *
 * @uses \App\Controller\ProductsController
 */
class ProductsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Products',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \App\Controller\ProductsController::index()
     */
    public function testIndex(): void
    {
        $this->get('/products');

        $this->assertResponseOk();
        $this->assertResponseContains('Products');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \App\Controller\ProductsController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\ProductsController::add()
     */
    public function testAdd(): void
    {
        $data = [
            'name' => 'New Product',
            'quantity' => 11,
            'price' => 11,
            'status' => 'in stock'
        ];

        $this->post('/products/add', $data); // Simulate POST request to add a product

        $this->assertResponseSuccess(); // Ensure successful response
        $this->assertRedirect(['controller' => 'Products', 'action' => 'index']); // Redirects to index
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\ProductsController::edit()
     */
    public function testEdit(): void
    {
        $data = [
            'name' => 'Updated Product',
            'quantity' => 11,
            'price' => 8,
            'status' => 'low stock'
        ];

        $this->put('/products/edit/1', $data);

        $this->assertResponseSuccess();
        $this->assertRedirect(['controller' => 'Products', 'action' => 'index']);
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \App\Controller\ProductsController::delete()
     */
    public function testDelete(): void
    {
        $this->delete('/products/delete/1');

        $this->assertResponseSuccess();
        $this->assertRedirect(['controller' => 'Products', 'action' => 'index']);
    }
}
