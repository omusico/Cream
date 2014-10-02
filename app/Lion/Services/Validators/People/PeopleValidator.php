<?php namespace Lion\Services\Validators\People;

use Lion\Services\Validators\BaseValidator;
use Lion\Services\Validators\ValidatorInterface;

class PeopleValidator extends BaseValidator implements ValidatorInterface {

    // Entity rules
    public static $rules = array(
        'account_id'   => 'required',
        
        'name'         => 'required|min:3',
        'company_id'   => 'numeric|exists:company,id',
        'department'   => 'min:3',
        'position'     => 'min:3',
        
        'email_1'      => 'email',
        'email_2'      => 'email',

        'phone_1'      => 'min:9',
        'phone_2'      => 'min:9',
        'mobile_phone' => 'min:9',

        'address'      => 'min:3',
        'postcode'     => 'min:5',
        'city'         => 'min:3',
        'state'        => 'min:3',
        
        'comment'      => 'min:5',
        'status_id'    => 'numeric',
    );

}