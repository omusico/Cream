<?php namespace Lion\Exceptions;

use Lion\Services\Validators\ValidatorInterface;

class ValidateException extends \Exception {

    /**
     * Errors list from validator
     * 
     * @var Array
     */
    protected $errors;

    /**
     * Creates the exception setting the errors
     * 
     * @param ValidatorInterface $validator
     */
    public function __construct(ValidatorInterface $validator)
    {
        $this->errors = $validator->errors();

        parent::__construct();
    }

    /**
     * Returns the list of errors
     * 
     * @return Array
     */
    public function get()
    {
        return $this->errors;
    }

}