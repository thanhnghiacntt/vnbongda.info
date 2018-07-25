<?php
namespace App\Providers;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $models = [
            'User',
            'Category',
        ];

        foreach ($models as $model) {
            $this->app->bind(
               "App\\Repositories\\{$model}RepositoryEloquent",
               "App\\Repositories\\{$model}Repository"
            );
        }
        $this->app->bind(App\Repositories\UserRepository::class, \App\Repositories\UserRepositoryEloquent::class);
    }
}