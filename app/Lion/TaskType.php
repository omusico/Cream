<?php namespace Lion;

class TaskType extends BaseModel {

    public $table = 'task_type';

    public $timestamps = false;

    protected $fillable = [
        'name', 'order', 'action_type'
    ];

    public function tasks()
    {
        return $this->hasMany('Lion\Task', 'task_type');
    }

    public function actionType()
    {
        return $this->belongsTo('Lion\ActionType', 'action_type');
    }
}