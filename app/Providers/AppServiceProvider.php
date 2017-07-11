<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\auth;
use App\Friend;
use App\User;
use App\Volunteer;
use App\Researches;
use App\Initiative;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */

function boot()
{
    Schema::defaultStringLength(191);

    view()->composer('individual/includes.sidebar',function($view){
        $date = date('Y-m-d');
        $user = Auth::user();
        $userIndividual = $user->Individuals;
        $data = array(
            'user' => Auth::user(),
            'userIndividual' => $user->Individuals,
            'myInitiatives' => initiative::where('adminId',$user->id),
            'followers' => friend::where('requested_id', $user->id),
            'following' => friend::where('requester_id', $user->id),
            'researches' => researches::where('ind_id',$userIndividual->id),
            'myUpComingEvents' => volunteer::join('events','volunteers.event_id','=','events.id')->where('volunteers.user_id',$user->id)->where('events.endDate','>=',$date),
            'myArchiveEvents' => volunteer::join('events','volunteers.event_id','=','events.id')->where('volunteers.user_id',$user->id)->where('events.endDate','<',$date),
        );

        $view->with($data);
    });

    view()->composer('institute/includes.sidebar',function($view){
        $date = date('Y-m-d');
        $user = Auth::user();
        $data = array(
            'user' => Auth::user(),
            'followers' => friend::where('requested_id', $user->id),
            'following' => friend::where('requester_id', $user->id),
        );
        $view->with($data);
    });

    view()->composer('Initiative/includes.sidebar',function($view){
        $date = date('Y-m-d');
        $user = Auth::user();
        $data = array(
            'user' => Auth::user(),
            'followers' => friend::where('requested_id', $user->id),
            'following' => friend::where('requester_id', $user->id),
        );
        $view->with($data);
    });
    
}

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
