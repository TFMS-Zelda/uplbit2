<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use App\Services\ProviderOrArticle;
class ProviderOrArticleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ProviderOrArticle::class, function() {
            return new ProviderOfArticle();
        });
        
       
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
