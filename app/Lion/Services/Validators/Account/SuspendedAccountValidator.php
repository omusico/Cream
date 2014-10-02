<?php namespace Lion\Services\Validators\Account;

use Lion\Exceptions\ValidateException;
use Lion\Services\Validators\BaseValidator;
use Lion\Services\Validators\ValidatorInterface;

class SuspendedAccountValidator extends BaseValidator implements ValidatorInterface {

    public function validForCreation(Array $data = null, $rules = null)
    {
        $this->errors = ['test' => 'test'];

        throw new ValidateException($this);
    }

    public function validForUpdate(Array $data = null, $rules = null)
    {

    }

}