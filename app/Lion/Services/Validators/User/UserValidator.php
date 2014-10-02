<?php namespace Lion\Services\Validators\User;

use Lion\Services\Validators\BaseValidator;
use Lion\Services\Validators\ValidatorInterface;

class UserValidator extends BaseValidator implements ValidatorInterface {

    // Entity rules
    public static $rules = array(
        'account_id'            => 'required',
        
        'username'              => 'required|between:4,32',
        'email'                 => 'required|email|unique:users',
        'password'              => 'required|alpha_num|between:4,24|confirmed',
        'password_confirmation' => 'between:4,24'
    );

    // Updating rules
    public static $uniqueRules = array(
        'email'    => 'required|email|unique:users,id',
        'password' => ''
    ); 

}