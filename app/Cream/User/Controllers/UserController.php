<?php namespace Cream\User\Controllers;

use Cream\User\Repositories\UserRepositoryInterface;
use Cream\User\Repositories\RoleRepositoryInterface;

class UserController extends \Lion\Controllers\BaseController {

    public function __construct(UserRepositoryInterface $users, RoleRepositoryInterface $roles)
    {
        $this->users = $users;
        $this->roles = $roles;

        \View::addNamespace('User', __DIR__.'/../Views/');
    }

    /**
     * Index. Returns a list of users signed up in the system.
     */
    public function index()
    {
        $users = $this->users->all();

        return \View::make('User::index', compact('users'));
    }

    /**
     * Function to create a new user based on a filling a form.
     */
    public function create()
    {
        $roles = $this->roles->allToSelect();

        return \View::make('User::create', compact('roles'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = $this->users->find($id);
        return $this->create()->with('user', $user);
    }

    /**
     * Stores a new user into the database.
     */
    public function store()
    {
        $user = $this->users->store(\Input::all());

        // Everything went ok, set in flash session to highlight the table row
        if ( $user instanceof \User )
        {
            \Session::flash('newUserId', $user->id);
            return \Redirect::route('users.index');
        }
        else
            return \Redirect::route('users.create')->withErrors($user);
    }

    public function update($id)
    {
        $user = $this->users->update($id, \Input::all());

        if ( $user instanceof \User )
        {
            \Session::flash('newUserId', $user->id);
            return \Redirect::route('users.index');
        }
        else
            return \Redirect::route('users.edit', $id)->withErrors($user);
    }

}