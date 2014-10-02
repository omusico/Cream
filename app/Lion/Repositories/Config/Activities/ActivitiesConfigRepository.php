<?php namespace Lion\Repositories\Config\Activities;

use Lion\Repositories\Tenant\TenantRepository;

class ActivitiesConfigRepository extends TenantRepository implements ActivitiesConfigRepositoryInterface {

    // Element entity path
    protected $entity = 'Lion\CompanyActivity';

    // Entity validation
    protected $validators = ['Lion\Services\Validators\Config\CompanyActivityValidator'];

}