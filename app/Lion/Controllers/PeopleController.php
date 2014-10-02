<?php namespace Lion\Controllers;

use Lion\Controllers\BaseController;
use Lion\Exceptions\ValidateException;
use Lion\Repositories\People\PeopleRepositoryInterface;
use Lion\Repositories\Config\Status\StatusConfigRepositoryInterface;

class PeopleController extends BaseController {

    protected $collections = array(
        'show'      => array('timeline'),
    );

    /**
     * Assets
     * 
     * @var array
     */
    protected $assets = array(
        'show' => array(
            // 'sys/controllers/timeline.js',
            // 'sys/controllers/tags.js'
        ),
        'create' => array(
            'sys/directives/select.company.js'
        ),
        'createWithCompany' => array(
            'sys/directives/select.company.js'
        ),
        'edit' => array(
            'sys/directives/select.company.js'
        ),
    );

    public function __construct(PeopleRepositoryInterface $people,
                                StatusConfigRepositoryInterface $status)
    {
        $this->people = $people;
        $this->status = $status;

        \View::share('controller', 'People');
        \View::share('entityClass', 'people');

        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $orderby = \Input::get('orderby') ? : 'name';
        $order   = \Input::get('order') ? : 'asc';
        $items   = \Input::get('items') ? : 15;
        $search  = \Input::get('search') ? : '';

        $people = $this->people->getPaginated($items, $orderby, $order, $search, array('name', 'state', 'postcode', 'address', 'phone_1', 'phone_2', 'email_1'));

        return \View::make('People::index', compact('people', 'orderby', 'order', 'search'));
    }

    public function show($id)
    {
        $entity = $this->people->find($id);

        return \View::make('People::view', compact('entity'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $statuses   = $this->status->nameList(true);

        return \View::make('People::create', compact('statuses'));
    }

    public function createWithCompany($id)
    {
        return $this->create()->with('company_id', $id);
    }

    public function edit($id)
    {
        $people = $this->people->find($id);

        return $this->create()->with('people', $people);
    }

    public function store()
    {
        try 
        {
            $people = $this->people->store(\Input::all());

            if (\Input::has('redirect_url'))
                return \Redirect::to(\Input::get('redirect_url'));

            return \Redirect::route('people.show', $people->id);
        } 
        catch (ValidateException $e) 
        {
            return \Redirect::route('people.create')->withErrors($e->get())->withInput();
        }
    }

    public function update($id)
    {
        try 
        {
            $people = $this->people->update($id, \Input::all());
            return \Redirect::route('people.show', $people->id);
        } 
        catch (ValidateException $e) 
        {
            return \Redirect::route('people.edit', $id)->withErrors($e->get())->withInput();
        }
    }

    public function delete($id)
    {
        $this->people->delete($id);

        if (is_redirect())
            return redirect_url();

        return \Redirect::route('people.index');
    }

    // public function trash()
    // {
    //     $people  = $this->people->trashed();

    //     return \View::make('People::trashed', compact('people'));
    // }

    public function restore($id)
    {
        $restore = $this->people->restore($id);

        if (is_redirect())
            return redirect_url();

        return \Redirect::route('people.trash');
    }

}