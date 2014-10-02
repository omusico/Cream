<?php namespace Lion;

class Account extends BaseModel {

    public $table = 'account';

    protected $guarded = ['id'];

    public function users()
    {
        return $this->hasMany('User', 'account_id');
    }

}