<?php namespace Lion\Providers;

use \View;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider {

    public function register() {
        
    }

    public function boot()
    {
        if (\Auth::check())
        {
            \Auth::user()->last_seen = new \DateTime('now');
            \Auth::user()->save();
        }
    }

}