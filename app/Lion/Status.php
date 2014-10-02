<?php namespace Lion;

class Status extends BaseModel {

    public $table = 'status';

    public $timestamps = false;

    protected $fillable = [
        'name', 'color', 'order'
    ];

    /**
     * Relationship with Deal's table
     */
    public function deals()
    {
        return $this->hasMany('Deal', 'status_id');
    }

    /**
     * Relationship with Company's table
     */
    public function company()
    {
        return $this->hasMany('Company', 'status_id');
    }

    /**
     * Relationship with People's table
     */
    public function people()
    {
        return $this->hasMany('People', 'status_id');
    }

}