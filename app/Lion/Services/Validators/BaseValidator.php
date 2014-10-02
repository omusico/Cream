<?php namespace Lion\Services\Validators;

use \Validator as V;
use Lion\Exceptions\ValidateException;

abstract class BaseValidator implements ValidatorInterface {

    /**
     * Contains any error occurred during validation
     * 
     * @var Array
     */
    protected $errors = array();

    /**
     * Custom validation rules
     * 
     * @var Array
     */
    public static $rules = array();

    /**
     * If any of the rules must be unique, set it here for updating
     * validation. It'll repleace the entire rule
     * 
     * @var Array
     */
    public static $uniqueRules = array();

    /**
     * Determines if the entity is valid for a new creation.
     * 
     * @param  Array    $data
     * @param  Array    $rules
     * @return boolean
     */
    public function validForCreation($entity = null, $rules = null)
    {
        if (is_null($entity))
            return;

        if (is_null($rules))
            $rules = static::$rules;

        return $this->validate($entity, $rules);
    }

    /**
     * Determines if the entity is valid for being update.
     * 
     * @param  Array    $data
     * @param  Array    $rules
     * @return boolean
     */
    public function validForUpdate($entity = null, $rules = null)
    {
        if (is_null($entity))
            return;

        if (is_null($rules))
            $rules = $this->buildUpdateRules();
        
        return $this->validate($entity, $rules);
    }

    /**
     * Custom validation object, just receive de data and the rules to match with.
     * 
     * @param  Array    $data
     * @param  Array    $rules
     * @return boolean
     */
    public function validate($entity, $rules)
    {
        $validator = V::make($entity->getAttributes(), $rules);

        if ($validator->fails())
        {
            $this->errors = $validator->messages();

            throw new ValidateException($this);
        }
    }

    /**
     * Simple getter to obtain the errors occurred 
     * 
     * @return Array
     */
    public function errors()
    {
        return $this->errors;
    }

    /**
     * Replaces the unique rules matched with the ones set int he class property $uniqueRules
     * 
     * @return Array
     */
    protected function buildUpdateRules()
    {
        if (static::$uniqueRules)
            return array_merge(static::$rules, static::$uniqueRules);

        return static::$rules;
    }

}