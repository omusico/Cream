<?php namespace Cream\User\Repositories;

interface UserRepositoryInterface {

    public function all();

    public function store(Array $data);

    public function update($id, Array $data);

}