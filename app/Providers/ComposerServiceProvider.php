<?php

namespace App\Providers;

use App\Http\ViewComposers\CategoriesViewComposer;
use App\Http\ViewComposers\ProductOrderingViewComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts.partials.ordering', ProductOrderingViewComposer::class);

        View::composer('layouts.partials.front.category', CategoriesViewComposer::class);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
