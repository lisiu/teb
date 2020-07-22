<?php

namespace App\Providers;

use App\DateKeys\Date\DatePolicy;
use App\DateKeys\DateKeysRepository;
use App\DateKeys\EloquentDateKeysRepository;
use App\DateKeys\KeyLettersPolicy;
use App\Provinces\ProvinceRepository;
use App\Provinces\StaticProvinceRepository;
use App\Settings\TebTestDatePolicy;
use App\Settings\TebTestKeyLettersPolicy;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProvinceRepository::class, StaticProvinceRepository::class);
        $this->app->bind(DatePolicy::class, TebTestDatePolicy::class);
        $this->app->bind(KeyLettersPolicy::class, TebTestKeyLettersPolicy::class);
        $this->app->bind(DateKeysRepository::class, EloquentDateKeysRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
