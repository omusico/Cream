<?php namespace Lion\Controllers;

use Lion\Controllers\BaseController;
use Lion\Exceptions\ValidateException;
use Lion\Repositories\Company\CompanyRepositoryInterface;
use Lion\Repositories\Config\Status\StatusConfigRepositoryInterface;
use Lion\Repositories\Config\Activities\ActivitiesConfigRepositoryInterface;

class CompanyController extends BaseController {

    protected $collections = array(
        'show' => array('timeline')
    );

    /**
     * Assets
     * 
     * @var array
     */
    protected $assets = array(
        // 'show' => array(
        //     'sys/controllers/timeline.js',
        //     // 'sys/controllers/tags.js'
        // ),
        'create' => array(
            'sys/controllers/yearbilling.js'
        ),
        'edit' => array(
            'sys/controllers/yearbilling.js'
        )
    );

    public function __construct(CompanyRepositoryInterface $company, 
                                ActivitiesConfigRepositoryInterface $activities,
                                StatusConfigRepositoryInterface $status)
    {
        $this->company    = $company;
        $this->activities = $activities;
        $this->status     = $status;


        \View::share('controller', 'Company');
        \View::share('entityClass', 'company');

        parent::__construct();
    }

    public function index()
    {
        $orderby = \Input::get('orderby') ? : 'name';
        $order   = \Input::get('order') ? : 'asc';
        $items   = \Input::get('items') ? : 15;
        $search  = \Input::get('search') ? : '';

        $companies = $this->company->getPaginated($items, $orderby, $order, $search, array('name', 'state', 'postcode', 'address', 'phone_1', 'phone_2', 'email'));

        return \View::make('Company::index', compact('companies', 'order', 'orderby', 'items', 'search'));
    }

    public function show($id)
    {
        $entity    = $this->company->findWithDependences($id);

        return \View::make('Company::view', compact('entity'));
    }

    public function create()
    {
        $activities = $this->activities->nameList(true);
        $statuses   = $this->status->nameList(true);

        return \View::make('Company::create', compact('activities', 'statuses'));
    }

    public function edit($id)
    {
        $company = $this->company->find($id);

        return $this->create()->with('company', $company);
    }

    public function store()
    {
        try 
        {
            $company = $this->company->store(\Input::all());
            return \Redirect::route('company.show', $company->id);
        } 
        catch (ValidateException $e) 
        {
            return \Redirect::route('company.create')->withErrors($e->get())->withInput();
        }
    }

    public function update($id)
    {
        try 
        {
            $company = $this->company->update($id, \Input::all());
            return \Redirect::route('company.show', $company->id);
        } 
        catch (ValidateException $e) 
        {
            return \Redirect::route('company.edit', $id)->withErrors($e->get())->withInput();
        }
    }

    public function delete($id)
    {
        $this->company->delete($id);

        if (is_redirect())
            return redirect_url();

        return \Redirect::route('company.index');
    }

    // public function trash()
    // {
    //     $companies          = $this->company->all();
    //     $trashedCompanies   = $this->company->trashed();

    //     return \View::make('Company::trashed', compact('companies', 'trashedCompanies'));
    // }

    public function restore($id)
    {
        $restore = $this->company->restore($id);

        if (is_redirect())
            return redirect_url();

        return \Redirect::route('company.trash');
    }

}