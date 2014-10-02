<?php namespace Lion;

class Source extends BaseModel {

    public $table = 'source';

    public $timestamps = false;

    protected $fillable = [
        'name', 'cost', 'order'
    ];

   
    /**
     * Relationship with Company's table
     */
    public function company()
    {
        return $this->hasMany('Company', 'source_id');
    }

    /**
     * Relationship with People's table
     */
    public function people()
    {
        return $this->hasMany('People', 'source_id');
    }

    /**
     * Relationship with Deal's table
     */
    public function deals()
    {
        return $this->hasMany('Deal', 'source_id');
    }

}