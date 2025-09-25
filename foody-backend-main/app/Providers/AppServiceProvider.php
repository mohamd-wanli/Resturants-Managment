<?php

namespace App\Providers;

use App\Interfaces\Admin\CategoryInterface;
use App\Interfaces\Admin\EmployeeInterface;
use App\Interfaces\Admin\ProductInterface;
use App\Interfaces\Admin\TableInterface;
use App\Interfaces\AuthInterface;
use App\Interfaces\Chef\OrderInterface as OrderInterfaceChef;
use App\Interfaces\SuperAdmin\BranchInterface;
use App\Interfaces\SuperAdmin\RestaurantInterface;
use App\Interfaces\user\OrderInterface;
use App\Interfaces\Waiter\OrderInterface as OrderInterfaceWaiter;
use App\Repository\Admin\CategoryRepository;
use App\Repository\Admin\EmployeeRepository;
use App\Repository\Admin\ProductRepository;
use App\Repository\Admin\TableRepository;
use App\Repository\AuthRepository;
use App\Repository\Chef\OrderRepository as OrderRepositoryChef;
use App\Repository\SuperAdmin\BranchRepository;
use App\Repository\SuperAdmin\RestaurantRepository;
use App\Repository\User\OrderRepository;
use App\Repository\Waiter\OrderRepository as OrderRepositoryWaiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthInterface::class, function () {
            return new AuthRepository();
        });
        $this->app->bind(OrderInterface::class, function () {
            return new OrderRepository();
        });
        $this->app->bind(OrderInterfaceChef::class, function () {
            return new OrderRepositoryChef();
        });
        $this->app->bind(OrderInterfaceWaiter::class, function () {
            return new OrderRepositoryWaiter();
        });
        $this->app->bind(RestaurantInterface::class, function () {
            return new RestaurantRepository();
        });
        $this->app->bind(BranchInterface::class, function () {
            return new BranchRepository();
        });
        $this->app->bind(CategoryInterface::class, function () {
            return new CategoryRepository();
        });
        $this->app->bind(TableInterface::class, function () {
            return new TableRepository();
        });
        $this->app->bind(EmployeeInterface::class, function () {
            return new EmployeeRepository();
        });
        $this->app->bind(ProductInterface::class, function () {
            return new ProductRepository();
        });

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
