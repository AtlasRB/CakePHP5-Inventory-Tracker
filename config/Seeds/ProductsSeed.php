<?php
declare(strict_types=1);

use Migrations\BaseSeed;

/**
 * Products seed.
 */
class ProductsSeed extends BaseSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/migrations/4/en/seeding.html
     *
     * @return void
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Wireless Mouse',
                'quantity' => rand(1, 1000),
                'price' => rand(1, 10000),
                'deleted' => false,
                'last_updated' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Gaming Keyboard',
                'quantity' => rand(1, 1000),
                'price' => rand(1, 10000),
                'deleted' => false,
                'last_updated' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => '4K Monitor',
                'quantity' => rand(1, 1000),
                'price' => rand(1, 10000),
                'deleted' => false,
                'last_updated' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'External SSD',
                'quantity' => rand(1, 1000),
                'price' => rand(1, 10000),
                'deleted' => false,
                'last_updated' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Bluetooth Headphones',
                'quantity' => rand(1, 1000),
                'price' => rand(1, 10000),
                'deleted' => false,
                'last_updated' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Smart Watch',
                'quantity' => rand(1, 1000),
                'price' => rand(1, 10000),
                'deleted' => false,
                'last_updated' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Portable Speaker',
                'quantity' => rand(1, 1000),
                'price' => rand(1, 10000),
                'deleted' => false,
                'last_updated' => date('Y-m-d H:i:s'),
            ]];

        $table = $this->table('products');
        $table->insert($data)->save();
    }
}
