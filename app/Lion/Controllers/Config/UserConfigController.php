<?php namespace Lion\Controllers\Config;

use Lion\Controllers\BaseController;
use Lion\Exceptions\ValidateException;
use Lion\Repositories\User\UserRepositoryInterface;

class UserConfigController extends BaseController {

    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;

        parent::__construct();
    }

    public function index()
    {
        $users = $this->user->all();

        return \View::make('Config::User.index', compact('users'));
    }

    public function store()
    {
        try 
        {
            $user = $this->user->store(\Input::all());
            return \Redirect::route('config.user.index');
        } 
        catch (ValidateException $e) 
        {
            return \Redirect::back()->withErrors($e->get())->withInput();
        }
    }

    public function update()
    {
        try 
        {
            $user = $this->user->update(\Input::get('user_id'), \Input::except('user_id'));
            return \Redirect::route('config.user.index');
        } 
        catch (ValidateException $e) 
        {
            return \Redirect::back()->withErrors($e->get())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        return 'Comprobar permisos antes.';
        
        // $this->user->delete($id);

        // return \Redirect::route('config.user.index');
    }

}
