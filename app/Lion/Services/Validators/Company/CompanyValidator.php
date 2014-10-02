<?php namespace Lion\Services\Validators\Company;

use Lion\Services\Validators\BaseValidator;
use Lion\Services\Validators\ValidatorInterface;

class CompanyValidator extends BaseValidator implements ValidatorInterface {

    // Entity rules
    public static $rules = array(
        'account_id'           => 'required',
        
        'name'                 => 'required|min:3',
        'commercial_name'      => 'min:3',
        'code'                 => 'min:1',
        'vat_number'           => 'min:5',
        
        'email'                => 'email',
        'website'              => 'min:3',
        
        'phone_1'              => 'min:9',
        'phone_2'              => 'min:9',
        'mobile_phone'         => 'min:9',
        
        'billing'              => 'numeric',
        'employees'            => 'numeric',
        'activity_id'          => 'numeric|exists:company_activity,id',
        'activity_description' => 'min:3',
        
        'address'              => 'min:3',
        'postcode'             => 'min:5',
        'city'                 => 'min:3',
        'state'                => 'min:3',
        
        'status_id'            => 'numeric',

        // Not validating comment field
    );

}