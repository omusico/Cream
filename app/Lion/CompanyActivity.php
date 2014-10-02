<?php namespace Lion;

class CompanyActivity extends BaseModel {

    public $table = 'company_activity';

    public $timestamps = false;

    protected $guarded = ['id', 'account_id'];

}