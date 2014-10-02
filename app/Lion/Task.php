<?php namespace Lion;

use Helpers\DateHelper;

class Task extends AssignableModel {

    public $table = 'task';

    protected $softDelete = true;

    protected $fillable = [
        'name', 'description', 'task_type', 'start_date', 'end_date', 'relatable_type', 'relatable_id'
    ];

    public function assignments()
    {
        return $this->hasMany('Lion\TaskAssignment');
    }

    public function taskType()
    {
        return $this->belongsTo('Lion\TaskType', 'task_type');
    }

    public function getEntityName()
    {
        if ($this->isRelated())
            return strtolower(str_replace('Lion\\', '', $this->getMainRelatedType()));

        return null;
    }

    public function getTaskTypeNameAttribute()
    {
        if ($this->taskType)
            return $this->taskType->name;

        return '';
    }

    public function taskOrEvent()
    {
        if ($this->isTask())
            return 'task';
        
        return 'event';
    } 

    public function isTask()
    {
        return is_null($this->end_date);
    }

    public function isEvent()
    {
        return ! $this->isTask();
    }  

    /**
     * Polymorphic relationship relatable. Relates to another element such
     * as people.
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function relatable()
    {
        return $this->morphTo()->withTrashed();
    }

    public function isAction()
    {
        if ($this->taskType) {
            if ($this->taskType->actionType)
                return true;
        }

        return false;
    }

    // public function isRelated()
    // {
    //     return $this->assignments->count();
    // }

    public function getActionTypeId()
    {
        if ($this->isAction())
            return $this->taskType->actionType->id;

        return NULL;
    }

    public function getStartDateFormatedAttribute($value)
    {
        if ($this->attributes['start_date'])
        {
            $datetime = new \DateTime($this->attributes['start_date']);
            return $datetime->format('d M Y');
        }

        return 'sin fecha';
    }

    public function getStartDateTimeFormatedAttribute($value)
    {
        if ($this->attributes['start_date'])
        {
            $datetime = new \DateTime($this->attributes['start_date']);
            return $datetime->format('d M Y H:i');
        }

        return 'sin fecha';
    }

    public function getEndDateTimeFormatedAttribute($value)
    {
        if ($this->attributes['end_date'])
        {
            $datetime = new \DateTime($this->attributes['end_date']);
            return $datetime->format('d M Y H:i');
        }

        return 'sin fecha';
    }

    public function getActionTypeNameAttribute($value)
    {
        if ($this->taskType)
            return $this->taskType->name;

        return 'ninguno';
    }

    /**
     * Only for those entities that are tasks
     * 
     * @param  Query $query
     * @return Query
     */
    public function scopeIsTask($query)
    {
        return $query->whereNull('end_date');
    }

    /**
     * Only for those entities that are tasks
     * 
     * @param  Query $query
     * @return Query
     */
    public function scopeIsEvent($query)
    {
        return $query->whereNotNull('end_date');
    }

    public function scopeNotDone($query)
    {
        return $query->whereNull('done');
    }

    /**
     * Tasks today, separated function because tasks are between 00:00 to 23:59
     * 
     * @param  Query $query
     * @return Query
     */
    public function scopeLateTasks($query)
    {
        $date = new \Helpers\DateHelper();

        return $query->where('start_date', '<', $date->modify('00:00:00')->toString())
                ->isTask();
    }

    /**
     * Events today, separated function because events are between now to 23:59
     * 
     * @param  Query $query
     * @return Query
     */
    public function scopeLateEvents($query)
    {
        $date = new \Helpers\DateHelper();

        return $query->where('start_date', '<', $date->toString())
                ->isEvent();
    }

    /**
     * Tasks today, separated function because tasks are between 00:00 to 23:59
     * 
     * @param  Query $query
     * @return Query
     */
    public function scopeTodayTasks($query)
    {
        $date = new \Helpers\DateHelper();

        return $query->whereBetween('start_date', array(
                    $date->modify('00:00:00')->toString(),
                    $date->modify('23:59:59')->toString()
                ))
                ->isTask();
    }

    /**
     * Events today, separated function because events are between now to 23:59
     * 
     * @param  Query $query
     * @return Query
     */
    public function scopeTodayEvents($query)
    {
        $date = new \Helpers\DateHelper();

        return $query->today()
                ->isEvent();
    }

    /**
     * Elements today
     * 
     * @param  Query $query
     * @return Query
     */
    public function scopeToday($query)
    {
        $date = new \Helpers\DateHelper();

        return $query->whereBetween('start_date', array(
                    $date->toString(),
                    $date->modify('23:59:59')->toString()
                ));
    }

    /**
     * Elements tomorrow
     * 
     * @param  Query $query
     * @return Query
     */
    public function scopeTomorrow($query)
    {
        $date = new \Helpers\DateHelper();

        return $query->whereBetween('start_date', array(
                    $date->modify('tomorrow')->toString(),
                    $date->modify('23:59:59')->toString()
                ));
    }

    /**
     * Elements this week
     * 
     * @param  Query $query
     * @return Query
     */
    public function scopeThisWeek($query)
    {
        $date = new \Helpers\DateHelper();

        return $query
                ->notToday()
                ->notTomorrow()
                ->whereBetween('start_date', array(
                    $date->toString(), 
                    $date->modify('Sunday this week 23:59:59')->toString())
                );
    }

    /**
     * Elements next week
     * 
     * @param  Query $query
     * @return Query
     */
    public function scopeNextWeek($query)
    {
        $date = new \Helpers\DateHelper();

        return $query
                ->notTomorrow()
                ->whereBetween('start_date', array(
                    $date->modify('Monday next week 00:00:00')->toString(), 
                    $date->modify('Sunday this week 23:59:59')->toString())
                );
    }

    /**
     * Elements further next week
     * 
     * @param  Query $query
     * @return Query
     */
    public function scopeFurther($query)
    {
        $date = new \Helpers\DateHelper();
        $date = $date->modify('Sunday next week')->modify('tomorrow');

        return $query
                ->where('start_date', '>=', $date->toString());
    }

    /**
     * Elements not today
     * 
     * @param  Query $query
     * @return Query
     */
    public function scopeNotToday($query)
    {
        $date = new \Helpers\DateHelper();

        return $query->whereRaw('start_date NOT BETWEEN \'' . 
                    $date->modify('today')->toString() . '\' AND \'' . $date->modify('23:59:59')->toString() . '\''
                );
    }

    /**
     * Elements not tomorrow
     * 
     * @param  Query $query
     * @return Query
     */
    public function scopeNotTomorrow($query)
    {
        $date = new \Helpers\DateHelper();

        return $query->whereRaw('start_date NOT BETWEEN \'' . 
                    $date->modify('tomorrow')->toString() . '\' AND \'' . $date->modify('23:59:59')->toString() . '\''
                );
    }
}