<?php namespace Lion\Repositories\User;

use Lion\Repositories\Tenant\TenantRepository as T;

class UserRepository extends T implements UserRepositoryInterface {

    // Element entity path
    protected $entity = 'User';

    // Entity dependences
    protected $dependences = ['Account'];

    // Entity validation
    protected $validators = [
        'Lion\Services\Validators\User\UserValidator'
    ];

    /**
     * Updates an element into the database
     * @param  integer  $id
     * @param  Array    $data
     * @return Entity
     */
    public function update($id, Array $data)
    {
        $new = array(
            'username' => $data['username' . $id],
            'email'    => $data['email' . $id],
        );

        return parent::update($id, $new);
    }

}