<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Rules\Bytelength;

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
        //
        if (request()->isSecure()) {
            \URL::forceScheme('https');
        }

        // Validator::extend('bytelength', function ($attribute, $value, $parameters, $validator) {
        //     $validator = new Bytelength($parameters[0]);
        //     $obj->message();
        //     return $validator;
        // });    
        // Validator::extend('bytelength', 'App\Rules\Bytelength@passes');
        // Validator::resolver(function($translator,$data,$rules,$messages){
        //     var_dump($rules);exit;
        //     return new Bytelength($translator,$data,$rules,$messages);
        //  });
    }
}
