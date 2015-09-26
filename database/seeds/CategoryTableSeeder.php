<?php

use CodeDelivery\Models\Category;
use CodeDelivery\Models\Product;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Category::class, 20)->create()->each(function ($c) {
            $maxProducts = rand(1, 30);
            for ($i = 0; $i <= $maxProducts; $i++) {
                $c->products()->save(factory(Product::class)->make());
            }
        });
    }
}
