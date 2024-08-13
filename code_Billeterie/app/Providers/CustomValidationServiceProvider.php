<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class CustomValidationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Validator::extend('cni_format', function ($attribute, $value, $parameters, $validator) {
            // Votre logique de validation pour le format de la CNI
            return preg_match('/^\d{4}-\d{3}-\d{4}$/', $value);
        });
    }
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */

}
