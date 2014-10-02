<?php namespace Lion;

class ActionAssignment extends BaseModel {

    public $table = 'action_assignment';

    public $timestamps = false;

    protected $fillable = [
        'assignable_type', 'assignable_id', 'action_id'
    ];

    public function action()
    {
        return $this->belongsTo('Lion\Action', 'action_id');
    }

    public function assignable()
    {
        return $this->morphTo();
    }
}