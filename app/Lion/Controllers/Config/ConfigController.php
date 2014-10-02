<?php namespace Lion\Controllers\Config;

use Lion\Controllers\BaseController;

class ConfigController extends BaseController {

    public function index()
    {
        return \View::make('Config::index');
    }

}