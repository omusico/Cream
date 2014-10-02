<?php namespace Lion\Repositories\Deal;

use Lion\Repositories\Tenant\TenantRepository as T;

class DealRepository extends T implements DealRepositoryInterface {

    // Element entity path
    protected $entity = 'Lion\Deal';

    // Entity dependences
    protected $dependences = ['Status', 'Stage', 'Source'];

    // Entity validation
    protected $validators = [
        'Lion\Services\Validators\Deal\DealValidator'
    ];

    // Owned and created auto fill
    protected $createdAndOwnedBy = true;

    // Entity listeners
    protected $listeners = array(
        'Lion\Listeners\Deal\DealListener'
    );

}