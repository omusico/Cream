<?php namespace Lion\Repositories\Tenant;

use Illuminate\Support\Facades\Auth;
use Lion\Repositories\BaseRepository as B;

abstract class TenantRepository extends B {

    /**
     * Create a new instance of the managed entity related to
     * the current account.
     * 
     * @param  array  $with
     * @return Entitiy
     */
    public function make($with = array())
    {
        $entity = parent::make($with);

        return $entity->where('account_id', $this->account->id);
    }

    /**
     * Create a new instance for being stored and relates it to
     * the current account.
     * 
     * @return Entity
     */
    protected function create() {
        $entity = parent::create();

        $entity->account_id = $this->account->id;

        return $entity;
    }

}