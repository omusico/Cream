<?php namespace Lion\Services\Validators\Deal;

use Lion\Services\Validators\BaseValidator;
use Lion\Services\Validators\ValidatorInterface;

class DealValidator extends BaseValidator implements ValidatorInterface {

    // Entity rules
    public static $rules = array(
        'account_id'     => 'required',
        
        'name'           => 'required|min:3',
        
        'description'    => 'min:5',
        
        'status_id'      => 'numeric',
        'stage_id'       => 'numeric',
        'source_id'      => 'numeric',
        'probability'    => 'numeric',
        'company_id'     => 'numeric',
        'amount'         => 'numeric',
        
        'expected_close' => 'date',
    );

}