<?php namespace Lion\Repositories\People;

use Lion\Repositories\Tenant\TenantRepository as T;

class PeopleRepository extends T implements PeopleRepositoryInterface {

    // Element entity path
    protected $entity = 'Lion\People';

    // Entity dependences
    protected $dependences = ['Deals', 'Status'];

    // Entity validation
    protected $validators = [
        'Lion\Services\Validators\People\PeopleValidator'
    ];

    // Owned and created auto fill
    protected $createdAndOwnedBy = true;

    // Entity listeners
    protected $listeners = array(
        'Lion\Listeners\People\PeopleListener'
    );

}