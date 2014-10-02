<?php namespace Services;

class TaskChecker extends
{

    public function __construct()
    {

    }

    public function checkUserTasks($user)
    {
        $repo = App::make('Lion\Repositories\User\UserRepositoryInterface');

        $user = $repo->find($user);

        
    }
}