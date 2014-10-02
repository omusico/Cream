<?php namespace Cream;

use \View;
use Illuminate\Support\ServiceProvider;

class ViewsServiceProvider extends ServiceProvider {

    public function register()
    {
        View::addNamespace('Action', lion_path() . 'Views/Action');
        // View::addNamespace('Company', cream_path() . 'Company/Views');
        View::addNamespace('Company', lion_path() . 'Views/Company');
        View::addNamespace('People', lion_path() . 'Views/People');
        View::addNamespace('Deal', lion_path() . 'Views/Deal');
        View::addNamespace('Misc', cream_path() . 'Misc/Views');
        View::addNamespace('Config', lion_path() . 'Views/Config');
    }

}