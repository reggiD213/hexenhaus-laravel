<?php

namespace App\Providers;

use App\Newsfeed;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //global ViewShares
        if (Schema::hasTable('newsfeeds'))
        {
            $newsfeeds = Newsfeed::all();
            view()->share('newsfeeds', $newsfeeds);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //register Helpers
        foreach (glob(app_path().'/Helpers/*.php') as $filename){
            require_once($filename);
        }
    }
}
