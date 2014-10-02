<?php namespace Lion;

use Illuminate\Support\Collection;

class Company extends BaseModel { 

    /**
     * Table to work against
     * @var string
     */
    protected $table = 'company';

    /**
     * Soft deleting enabled
     * 
     * @var boolean
     */
    protected $softDelete = true;

    protected $appends = ['entity_type'];

    // protected $guarded = ['id', 'account_id'];

    protected $fillable = [
        'name', 'commercial_name', 'code', 'vat_number',
        'email', 'phone_1', 'phone_2', 'mobile_phone', 'website',
        'billing', 'employees', 'activity_id', 'activity_description', 'status_id',
        'address', 'postcode', 'city', 'state', 'comment', 'image',
        'created_by', 'owned_by'
    ];

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
    }

    public static function getActionsOf($id, $take = '*')
    {
        $company = static::withTrashed()->find($id);

        if ($company)
        {
            $result = new Collection;

            $actions = \DB::table('action_assignment')
                        ->select('*')
                            ->join('action', 'action.id', '=', 'action_assignment.action_id')
                        ->where('action_assignment.assignable_type', 'Lion\Company')
                        ->where('action_assignment.assignable_id', $company->id)
                        ->orderBy('done_at', 'DESC')->take($take)->get();

            foreach ($actions as $action)
                $result->push(Action::find($action->id));


            return $result->reverse();

        }
        return
            new Colection;
    }

    public function delete()
    {
        // $this->people()->delete();

        return parent::delete();
    }

    public function history()
    {
        return $this->morphMany('Lion\Action', 'historiable');
    }

    public function agenda()
    {
        return $this->morphMany('Lion\Task', 'relatable');
    }

    public function tasks()
    {
        return $this->morphMany('Lion\TaskAssignment', 'assignable');
    }

    public function actions()
    {
        return $this->morphMany('Lion\ActionAssignment', 'assignable');
    }

    /**
     * Relationship to people table.
     * 
     * @return belongsTo
     */
    public function people()
    {
        return $this->hasMany('Lion\People', 'company_id');
    }

    public function trashedPeople()
    {
        return $this->people()->withTrashed();
    }

    public function deals()
    {
        return $this->hasMany('Lion\Deal', 'company_id');
    }

    public function trashedDeals()
    {
        return $this->deals()->withTrashed();
    }

    public function billingHistory()
    {
        return $this->hasMany('Lion\CompanyBilling', 'company_id');
    }

    public function status()
    {
        return $this->belongsTo('Lion\Status', 'status_id');
    }

    /**
     * Relationship to CompanyActivity
     * 
     * @return belongsTo
     */
    public function activity()
    {
        return $this->belongsTo('Lion\CompanyActivity', 'activity_id');
    }

    public function getStatusNameAttribute()
    {
        if ($this->status)
            return $this->status->name;
        return 'ninguno';
    } 

}