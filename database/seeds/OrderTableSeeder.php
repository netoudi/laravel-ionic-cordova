<?php

use CodeDelivery\Models\Order;
use CodeDelivery\Models\OrderItem;
use Illuminate\Database\Seeder;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Order::class, 10)->create()->each(function ($o) {
            $maxItem = rand(1, 10);
            for ($i = 0; $i <= $maxItem; $i++) {
                $o->items()->save(factory(OrderItem::class)->make());
            }
        });
    }
}
