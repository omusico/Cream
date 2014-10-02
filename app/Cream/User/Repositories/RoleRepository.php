<?php namespace Cream\User\Repositories;

class RoleRepository implements RoleRepositoryInterface {

    public function all()
    {
        return \Role::all();
    }

    public function allToSelect()
    {
        return array('' => '-- Seleccione --') + \Role::lists('name', 'id');
    }

    public function save()
    {
        
    }

}