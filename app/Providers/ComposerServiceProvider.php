<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
	    //$categories = \App\Category::all(['name', 'slug']);

	    //view()->share('categories', $categories);
//	    view()->composer('*', function($view) use($categories){
//			$view->with('categories', $categories);
//	    });

	    view()->composer(['layouts.front', 'layouts.painel'], 'App\Http\Views\CategoryViewComposer@compose');
	    view()->composer('layouts.painel', 'App\Http\Views\UserViewComposer@compose');
    }
}
