<?php namespace Lion;

use Illuminate\Support\Collection;

class Deal extends BaseModel {

    public $table = 'deal';

    /**
     * Soft deleting enabled
     * 
     * @var boolean
     */
    protected $softDelete = true;

    protected $fillable = [
        'name', 'description', 'company_id', 'amount', 'stage_id',
        'probability', 'source_id', 'status_id', 'expected_close',
        'created_by', 'owned_by',
    ];

    protected $appends = ['entity_type'];

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
    }

    public static function closedAmount($deals)
    {
        $total = 0;

        foreach ($deals as $deal)
            if ($deal->stage->isWon())
                $total = $total + (float) $deal->amount;

        return $total;
    }

    public static function openAmount($deals)
    {
        $total = 0;

        foreach ($deals as $deal)
            if (! $deal->stage->isWonOrLost())
                $total = $total + (float) $deal->amount;

        return $total;
    }

    /**
     * Relationship to Company entities
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo('Lion\Company', 'company_id');
    }

    public function tasks()
    {
        return $this->morphMany('Lion\TaskAssignment', 'assignable');
    }

    /**
     * Relationship to Action elements as "historiable"
     * @return Illuminate\Database\Eloquent\Relations\MorphMany
     */
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

    /**
     * Relationship to Status elements
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo('Lion\Status', 'status_id');
    }

    /**
     * Relationship to Stage elements
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function stage()
    {
        return $this->belongsTo('Lion\DealStage', 'stage_id');
    }

    /**
     * Relationship to Source elements
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function source()
    {
        return $this->belongsTo('Lion\Source', 'source_id');
    }

    /**
     * Relationship to People entities
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function people()
    {
        return $this->belongsToMany('Lion\People', 'deal_people', 'deal_id', 'people_id');
    }

    /**
     * [getActionsOf description]
     * @param  [type] $id   [description]
     * @param  string $take [description]
     * @return [type]       [description]
     */
    public static function getActionsOf($id, $take = '*')
    {
        $deal = static::withTrashed()->find($id);

        if ($deal)
        {
            $result = new Collection;

            $actions = \DB::table('action_assignment')
                        ->select('*')
                            ->join('action', 'action.id', '=', 'action_assignment.action_id')
                        ->where('action_assignment.assignable_type', 'Lion\Deal')
                        ->where('action_assignment.assignable_id', $deal->id)
                        ->orderBy('done_at', 'DESC')->take($take)->get();

            foreach ($actions as $action)
                $result->push(Action::find($action->id));


            return $result->reverse();

        }
        
        return new Colection;
    }

    public function getStatusNameAttribute($value)
    {
        if ($this->status)
            return $this->status->name;

        return 'ninguno';
    }

    public function getStageNameAttribute($value)
    {
        if ($this->stage)
            return $this->stage->name;

        return '';
    }

    public function getSourceNameAttribute($value)
    {
        if ($this->source)
            return $this->source->name;

        return '';
    }

    public function getAmountMoneyAttribute($value)
    {
        if ($this->attributes['amount'])
            return $this->amount . ' €';

        return '';
    }

    public function getExpectedCloseFormatedAttribute($value)
    {
        if ($this->attributes['expected_close'])
        {
            $datetime = new \DateTime($this->attributes['expected_close']);
            return $datetime->format('d M Y');
        }

        return '';
    }

}