<?php namespace Lion\Services\Validators;

interface ValidatorInterface {

    // Is it valid for being stored?
    public function validForCreation($entity = null, $rules = null);

    // Is it valid for being updated?
    public function validForUpdate($entity = null, $rules = null);

    // Return the errors Array
    public function errors();

}