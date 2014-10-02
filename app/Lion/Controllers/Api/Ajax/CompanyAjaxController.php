<?php namespace Lion\Controllers\Api\Ajax;

use Lion\Repositories\Company\CompanyRepositoryInterface;

class CompanyAjaxController extends \Controller {
    
    public function __construct(CompanyRepositoryInterface $company)
    {
        $this->company = $company;
    }

    /**
     * Retuns a json response of all companies matching the filter passed.
     * Used to find companies in people.
     * 
     * @return Illuminate\Support\Collection
     */
    public function loadCompanies()
    {
        $companies = $this->company->search(\Input::get('name'), 'name', array('id', 'name'));

        return $companies;
    }

    /**
     * Returns a json response with the company that matches the filter passed.
     * 
     * @return Company
     */
    public function getCompany()
    {
        $company = $this->company->get(\Input::get('id'), array('id', 'name'));

        return $company;
    }

}