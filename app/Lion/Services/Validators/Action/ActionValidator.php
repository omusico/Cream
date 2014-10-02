<?php namespace Lion\Services\Validators\Action;

use Lion\Services\Validators\BaseValidator;
use Lion\Services\Validators\ValidatorInterface;

class ActionValidator extends BaseValidator implements ValidatorInterface {

    // Entity rules
    public static $rules = array(
        'message'              => 'required|min:3',
        'historiable_type'     => 'required|in:Lion\Company,Lion\People,Lion\Deal',
        'direction'            => 'in:in,out',
        'done_at'              => 'required|date',
        'duration'             => 'numeric'
    );

}