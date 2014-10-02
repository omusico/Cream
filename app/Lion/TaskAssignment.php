<?php namespace Lion;

class TaskAssignment extends BaseModel {

    public $table = 'task_assignment';

    public $timestamps = false;

    protected $fillable = [
        'assignable_type', 'assignable_id', 'task_id'
    ];

    public function task()
    {
        return $this->belongsTo('Lion\Task', 'task_id');
    }

    public function assignable()
    {
        return $this->morphTo();
    }
}