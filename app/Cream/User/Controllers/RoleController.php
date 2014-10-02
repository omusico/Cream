<?php namespace Cream\User\Controllers;

use Cream\BaseController;
use Cream\User\Repositories\RoleRepositoryInterface;

class RoleController extends BaseController {

    public function __construct(RoleRepositoryInterface $roles)
    {
        $this->roles = $roles;

        \View::addNamespace('Role', __DIR__.'/../Views/Roles');
    }

    public function index() 
    {
        $roles = $this->roles->all();

        return \View::make('Role::index', compact('roles'));
    }

    public function create()
    {
        return \View::make('Role::create');
    }

}