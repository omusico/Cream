<?php namespace Lion;

class CompanyBilling extends BaseModel {

    public $table = 'company_billing';

    public $timestamps = false;

    protected $guarded = ['id'];

    public static $rules = array(
        'company_id' => 'required|numeric',
        'year' => 'required|numeric',
        'amount' => 'required|numeric'
    );

}