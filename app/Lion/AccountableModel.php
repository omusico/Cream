<?php

class AccountableModel extends BaseModel {

    public function newQuery($excludeDeleted = true)
    {
        $builder = parent::newQuery($excludeDeleted);
        return $builder->default();
    }

    public function scopeDefault($query) {
        return $query->where('account_id', Auth::user()->account_id);
    }

}