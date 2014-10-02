<?php namespace Lion\Controllers\Config;

use Lion\Controllers\BaseController;
use Lion\Exceptions\ValidateException;
use Lion\Repositories\Config\Status\StatusConfigRepositoryInterface;

class StatusConfigController extends BaseController {

    protected $collections = array(
        'index' => array('sortable')
    );

    protected $assets = array(
        'index' => array(
            'sys/custom/config/status/status.js',
        ),
    );

    public function __construct(StatusConfigRepositoryInterface $status)
    {
        $this->status = $status;

        parent::__construct();
    }

    public function index()
    {
        $statuses = $this->status->all();

        return \View::make('Config::Status.index', compact('statuses'));
    }

    public function store()
    {
        try 
        {
            $status = $this->status->store(\Input::all());
            return \Redirect::route('config.status.index');
        } 
        catch (ValidateException $e) 
        {
            return \Redirect::back()->withErrors($e->get())->withInput();
        }
    }

    public function update()
    {
        try 
        {
            $status = $this->status->update(\Input::get('status_id'), \Input::except('status_id'));
            return \Redirect::route('config.status.index');
        } 
        catch (ValidateException $e) 
        {
            return \Redirect::back()->withErrors($e->get())->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function reorder()
    {
        $this->status->reorder(\Input::has('item') ? \Input::get('item') : array());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->status->delete($id);

        return \Redirect::route('config.status.index');
    }

}
