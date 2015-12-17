<?php

namespace CodeDelivery\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \CodeDelivery\Repositories\CategoryRepository::class,
            \CodeDelivery\Repositories\CategoryRepositoryEloquent::class
        );

        $this->app->bind(
            \CodeDelivery\Repositories\ClientRepository::class,
            \CodeDelivery\Repositories\ClientRepositoryEloquent::class
        );

        $this->app->bind(
            \CodeDelivery\Repositories\OrderItemRepository::class,
            \CodeDelivery\Repositories\OrderItemRepositoryEloquent::class
        );

        $this->app->bind(
            \CodeDelivery\Repositories\OrderRepository::class,
            \CodeDelivery\Repositories\OrderRepositoryEloquent::class
        );

        $this->app->bind(
            \CodeDelivery\Repositories\ProductRepository::class,
            \CodeDelivery\Repositories\ProductRepositoryEloquent::class
        );

        $this->app->bind(
            \CodeDelivery\Repositories\UserRepository::class,
            \CodeDelivery\Repositories\UserRepositoryEloquent::class
        );

        $this->app->bind(
            \CodeDelivery\Repositories\CupomRepository::class,
            \CodeDelivery\Repositories\CupomRepositoryEloquent::class
        );
    }
}
