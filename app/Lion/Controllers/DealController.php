<?php namespace Lion\Controllers;

use Lion\Controllers\BaseController;
use Lion\Exceptions\ValidateException;
use Lion\Repositories\Deal\DealRepositoryInterface;
use Lion\Repositories\Config\Stage\StageConfigRepositoryInterface;
use Lion\Repositories\Config\Source\SourceConfigRepositoryInterface;
use Lion\Repositories\Config\Status\StatusConfigRepositoryInterface;

class DealController extends \BaseController {

    protected $collections = array(
        'show'      => array('timeline'),
        'create'    => array('datetimepicker'),
        'createWithCompany' => array('datetimepicker'),
        'edit'      => array('datetimepicker'),
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
            'sys/directives/select.company.js',
            'sys/custom/deal.js'
        ),
        'createWithCompany' => array(
            'sys/directives/select.company.js',
            'sys/custom/deal.js'
        ),
        'edit' => array(
            'sys/directives/select.company.js',
            'sys/custom/deal.js'
        ),
    );

    public function __construct(DealRepositoryInterface $deal,
                                StatusConfigRepositoryInterface $status,
                                SourceConfigRepositoryInterface $source,
                                StageConfigRepositoryInterface $stage)
    {
        $this->deal   = $deal;
        $this->status = $status;
        $this->stage  = $stage;
        $this->source = $source;

        \View::share('controller', 'Deal');
        \View::share('entityClass', 'deal');

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

        $deals = $this->deal->getPaginated($items, $orderby, $order, $search, array('name'));

        return \View::make('Deal::index', compact('deals', 'orderby', 'order', 'items', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $stages   = $this->stage->nameList(true);
        $statuses = $this->status->nameList(true);
        $sources  = $this->source->nameList(true);

        return \View::make('Deal::create', compact('sources', 'statuses', 'stages'));
    }

    public function createWithCompany($id)
    {
        return $this->create()->with('company_id', $id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $entity    = $this->deal->find($id);

        return \View::make('Deal::view', compact('entity'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $deal = $this->deal->find($id);

        return $this->create()->with('deal', $deal);
    }

    public function store()
    {
        try 
        {
            $deal = $this->deal->store(\Input::all());

            if (\Input::has('redirect_url'))
                return \Redirect::to(\Input::get('redirect_url'));

            return \Redirect::route('deal.show', $deal->id);
        } 
        catch (ValidateException $e) 
        {
            return \Redirect::route('deal.create')->withErrors($e->get())->withInput();
        }
    }

    public function update($id)
    {
        try 
        {
            $deal = $this->deal->update($id, \Input::all());
            return \Redirect::route('deal.show', $deal->id);
        } 
        catch (ValidateException $e) 
        {
            return \Redirect::route('deal.edit', $id)->withErrors($e->get())->withInput();
        }
    }
    

    public function delete($id)
    {
        $this->deal->delete($id);

        if (is_redirect())
            return redirect_url();

        return \Redirect::route('deal.index');
    }

    // public function trash()
    // {
    //     $deal  = $this->deal->trashed();

    //     return \View::make('Deal::trashed', compact('deal'));
    // }

    public function restore($id)
    {
        $restore = $this->deal->restore($id);

        if (is_redirect())
            return redirect_url();

        return \Redirect::route('deal.trash');
    }

}