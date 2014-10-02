<?php namespace Lion\Services\Validators\Task;

use Lion\Services\Validators\BaseValidator;
use Lion\Services\Validators\ValidatorInterface;

class TaskValidator extends BaseValidator implements ValidatorInterface {

    // Entity rules
    public static $rules = array(
        'name'        => 'required|min:3',
        'description' => 'required|min:3',
        'task_type'   => 'numeric',
        'done'        => 'numeric',
        'assined_to'  => 'numeric',
        'start_date'  => 'date|required_with:end_date',
        'end_date'    => 'date'
    );

}