<?php

namespace App\Providers;

use App\Models\Tag;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        // Share the tags with all views
        $tags = Tag::whereHas('posts', function ($query) {
            $query->inRandomOrder();
        })->with('posts')->limit(25)->get();
        View::share('tags', $tags);

        // Share the all Categories with all views.
        $categories = Category::all();
        View::share('categories', $categories);

        // Use view composer to share notifications if the user is authenticated
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $notifications = Auth::user()->notifications()->get();
                $view->with('notifications', $notifications);
            }
        });
    }
}
