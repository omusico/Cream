<?php namespace Lion\Services\Validators\Config;

use Lion\Services\Validators\BaseValidator;
use Lion\Services\Validators\ValidatorInterface;

class StageValidator extends BaseValidator implements ValidatorInterface {

    // Entity rules
    public static $rules = array(
        'account_id'  => 'required',
        
        'name'        => 'required|min:1',
        'probability' => 'required|numeric'
    );

}