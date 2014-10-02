<?php namespace Lion;

class ActionType extends BaseModel {

    public $table = 'action_type';

    public $timestamps = false;

    protected $fillable = [
        'name', 'track_duration', 'order', 'icon', 'color', 'bgcolor'
    ];

    /**
     * Relationship with Deal's table
     */
    public function actions()
    {
        return $this->hasMan('Action', 'action_type_id');
    }

}