<?php namespace Lion;

use Illuminate\Support\Collection;

class People extends BaseModel {

    public $table = 'people';

    /**
     * Soft deleting enabled
     * 
     * @var boolean
     */
    protected $softDelete = true;

    protected $fillable = [
        'name', 'company_id', 'department', 'position',
        'email_1', 'email_2', 'phone_1', 'phone_2', 'mobile_phone',
        'address', 'postcode', 'city', 'state',
        'image', 'comment', 'status_id',
        'created_by', 'owned_by'
    ];

    protected $appends = ['entity_type'];

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
    }

    public function company()
    {
        return $this->belongsTo('Lion\Company', 'company_id');
    }

    public function tasks()
    {
        return $this->morphMany('Lion\TaskAssignment', 'assignable');
    }

    public function history()
    {
        return $this->morphMany('Lion\Action', 'historiable');
    }

    public function agenda()
    {
        return $this->morphMany('Lion\Task', 'relatable');
    }

    public function related()
    {
        return $this->morphMany('Lion\Action', 'relatable');
    }

    public function deals()
    {
        return $this->belongsToMany('Lion\Deal', 'deal_people', 'people_id', 'deal_id');
    }

    public function status()
    {
        return $this->belongsTo('Lion\Status', 'status_id');
    }

    public function trashedDeals()
    {
        return $this->deals()->withTrashed();
    }

    public static function findActions($id)
    {
        $people = static::find($id);

        if ($people)
            return $people->history;

        return new Illuminate\Support\Collection;
    }

    public static function getActions($person)
    {
        return $person->history;
    }

    public static function getActionsOf($id, $take = '*')
    {
        $people = static::withTrashed()->find($id);

        if ($people)
        {
            $result = new Collection;

            $actions = \DB::table('action_assignment')
                        ->select('*')
                            ->join('action', 'action.id', '=', 'action_assignment.action_id')
                        ->where('action_assignment.assignable_type', 'Lion\People')
                        ->where('action_assignment.assignable_id', $people->id)
                        ->orderBy('done_at', 'DESC')->take($take)->get();

            foreach ($actions as $action)
                $result->push(Action::find($action->id));


            return $result->reverse();

        }
        
        return new Colection;
    }

    public function getStatusNameAttribute()
    {
        if ($this->status)
            return $this->status->name;
        return 'ninguno';
    } 

}