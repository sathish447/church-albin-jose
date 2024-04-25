<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Data\Repositories\Role\RoleEloquent;
use App\Data\Repositories\Role\RoleRepository;

use App\Data\Repositories\Permission\PermissionEloquent;
use App\Data\Repositories\Permission\PermissionRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(RoleRepository::class, RoleEloquent::class);
        $this->app->singleton(PermissionRepository::class, PermissionEloquent::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
