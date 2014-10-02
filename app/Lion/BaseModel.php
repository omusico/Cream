<?php namespace Lion;

abstract class BaseModel extends \Eloquent { 

    public static function boot()
    {
        parent::boot();

        static::observe(new \ModelObserver());
    }

    public function getEntityTypeAttribute()
    {
        return get_class($this);
    }

    public function getEntityAttribute()
    {
        return strtolower(str_replace('Lion\\', '', get_class($this)));
    }

}