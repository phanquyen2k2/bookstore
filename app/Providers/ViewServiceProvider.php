<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
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
        View::composer(['layouts.header', 'layouts.headercart'], function ($view) {
            $authors = Author::take(10)->get();
            $categories = Category::all();
            $view->with('categories', $categories)->with('authors', $authors);
        });
    }
}
