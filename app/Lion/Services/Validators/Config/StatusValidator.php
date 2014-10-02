<?php namespace Lion\Services\Validators\Config;

use Lion\Services\Validators\BaseValidator;
use Lion\Services\Validators\ValidatorInterface;

class StatusValidator extends BaseValidator implements ValidatorInterface {

    // Entity rules
    public static $rules = array(
        'account_id' => 'required',
        
        'name'       => 'required|min:2',
        'color'      => 'required',
        'order'      => 'required|numeric',
    );

}