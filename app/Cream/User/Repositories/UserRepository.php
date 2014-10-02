<?php namespace Cream\User\Repositories;

/**
 * Class UserRepository
 *
 * Repository used to give one more abstract layer between Controller and ORM
 * messages. This particular controller is used to manage the user's data.
 */
class UserRepository implements UserRepositoryInterface {

    /**
     * Returns all users from database
     */
    public function all()
    {
        return \User::all();
    }

    /**
     * Returns a user by ID
     */
    public function find($id)
    {
        return \User::find($id);
    }

    /**
     * Does all the logic required before store a user into the database.
     * Passes validation and checks roles.
     */
    public function store(Array $data)
    {
        $user = new \User();

        $user->username = $data['username'];
        $user->email    = $data['email'];
        $user->password = $data['password'];
        $user->password_confirmation = $data['password_confirmation'];
        $user->account_id = Auth::user()->account_id;

        if ($user->save())
            return $user;
        else
            return $user->errors();
    }

    /**
     * Does all the logic required before store a user into the database.
     * Passes validation and checks roles.
     */
    public function update($id, Array $data)
    {
        $user = \User::find($id);

        $user->username = $data['username'];
        $user->email    = $data['email'];

        if ( ! empty($data['password']))
        {
            $user->password = $data['password'];
            $user->password_confirmation = $data['password_confirmation'];
        }

        if ($user->updateUniques())
            return $user;
        else
            return $user->errors();
    }
}