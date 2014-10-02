<?php namespace Lion\Providers;

use \View;
use Illuminate\Support\ServiceProvider;

class ViewsServiceProvider extends ServiceProvider {

    public function register() {
        
    }

    public function boot()
    {
        View::addNamespace('Action', lion_path() . 'Views/Action');
        View::addNamespace('Company', lion_path() . 'Views/Company');
        View::addNamespace('People', lion_path() . 'Views/People');
        View::addNamespace('Deal', lion_path() . 'Views/Deal');
        View::addNamespace('Misc', cream_path() . 'Misc/Views');
        View::addNamespace('Config', lion_path() . 'Views/Config');
        View::addNamespace('Task', lion_path() . 'Views/Task');
    }

}