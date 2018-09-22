<?php

namespace FHusquinet\Seoable;

use Illuminate\Support\ServiceProvider;

class SeoableServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            if (! class_exists('CreateSeoMetaDatasTable')) {
                $timestamp = date('Y_m_d_His', time());
                $this->publishes([
                    __DIR__.'/../migrations/create_seo_meta_datas_table.php.stub' => database_path("/migrations/{$timestamp}_create_seo_meta_datas_table.php"),
                ], 'migrations');
            }
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        //
    }
}
