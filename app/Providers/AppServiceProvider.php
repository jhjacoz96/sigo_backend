<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Product;
use App\Models\ExpenseProduct;
use App\Observers\ExpenseProductObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Register observable
        ExpenseProduct::observe(ExpenseProductObserver::class);

        //Register validator
        \Validator::extend('quantity_available', function($attribute, $value, $parameters, $validator)
        {
           $product = Product::find($parameters[0]);
           if  (!$product) return false;
           return $value <= $product->stock;
        });
    }
}
