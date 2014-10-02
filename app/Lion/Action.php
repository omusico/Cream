<?php namespace Lion;

use Illuminate\Support\Collection;

class Action extends AssignableModel {

    /**
     * Table name
     * @var string
     */
    public $table = 'action';


    protected $fillable = [
        'action_type', 'title', 'message', 'direction', 'duration',
        'created_by', 'done_at',
    ];

    /**
     * Hidden attributes from JSON
     * @var array
     */
    protected $hidden = ['actionType', 'action_type', 'done_at', 'updated_at', 'created_at', 'assignments'];

    /**
     * Appending attributes to the toJson or toArray function.
     * @var array
     */
    protected $appends = ['done_date', 'done_time', 'action_type_name', 'action_type_icon', 'action_type_color', 'action_type_bg_color', 'user_name', 'related_to'];

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
    }

    public function actionType()
    {
        return $this->belongsTo('Lion\ActionType', 'action_type');
    }

    public function assignments()
    {
        return $this->hasMany('Lion\ActionAssignment');
    }

    public function user()
    {
        return $this->belongsTo('User', 'created_by');
    }

    /**
     * Format date for done_at attribute.
     * @param  $value
     * @return string Formated date.
     */
    public function getDoneDateAttribute($value)
    {
        $datetime = new \DateTime($this->attributes['done_at']);
        return $datetime->format('d M y');
    }

    public function getDoneTimeAttribute($value)
    {
        $datetime = new \DateTime($this->attributes['done_at']);
        return $datetime->format('H:i');;
    }

    /**
     * Gets the action type name based on the historyable_type.
     * @return string Action type name.
     */
    public function getActionTypeNameAttribute()
    {
        if ($this->actionType)
            return $this->actionType->name;

        return '';
    }

    /**
     * Gets the action type name based on the historyable_type.
     * @return string Action type name.
     */
    public function getActionTypeIconAttribute()
    {
        if ($this->actionType)
            return $this->actionType->icon;

        return \Config::get('cream.icons.defaultAction');
    }

    /**
     * Gets the action type name based on the historyable_type.
     * @return string Action type name.
     */
    public function getActionTypeBgColorAttribute()
    {
        if ($this->actionType)
            return $this->actionType->bgcolor;

        return \Config::get('cream.colors.defaultActionText');
    }

    /**
     * Gets the action type name based on the historyable_type.
     * @return string Action type name.
     */
    public function getActionTypeColorAttribute()
    {
        if ($this->actionType)
            return $this->actionType->color;

        return \Config::get('cream.colors.defaultAction');
    }

    public function getUserNameAttribute()
    {
        return $this->user->username;
    }

    public function getRelatedToAttribute()
    {
        if ( ! $this->isRelated())
            return null;

        $result = new Collection;

        foreach ($this->assignments as $assign)
        {
            $result->push($assign->assignable()->first(array('id', 'name')));
        }

        return $result->toArray();
    }

}