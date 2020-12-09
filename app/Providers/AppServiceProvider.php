<?php

namespace App\Providers;
use View;
use Auth;
use App\School;
use App\Promotion;
use App\Configuration;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('path.public', function() {
            return base_path('html');
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        // Using class based composers...
        /*View::composer(
            'profile', 'App\Http\Composers\UserComposer'
        );*/

        // Using Closure based composers...
        View::composer('*', function ($view) {
            $user = Auth::user();
            if($user){
                $promotions = $user->promotions()->get();

                if($user->preferred_promotion){
                    $promotion = Promotion::find($user->preferred_promotion);
                } else {
                    $promotion = $promotions->first();
                }
                $school = $promotion->school()->first();
                $config = Configuration::first();

                View::share('user',$user);
                View::share('promotions',$promotions);
                View::share('promotion',$promotion);
                View::share('school',$school);
                View::share('config',$config);
                View::share('isPage','');
            }
        });

    }
}
