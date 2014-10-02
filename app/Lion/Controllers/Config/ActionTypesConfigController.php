<?php namespace Lion\Controllers\Config;

use Lion\Controllers\BaseController;
use Lion\Exceptions\ValidateException;
use Lion\Repositories\Config\ActionType\ActionTypeConfigRepositoryInterface;

class ActionTypesConfigController extends BaseController {

    protected $collections = array(
        'index' => array('sortable')
    );

    protected $assets = array(
        'index' => array(
            'sys/custom/config/actiontypes/actiontypes.js',
        ),
    );

    public function __construct(ActionTypeConfigRepositoryInterface $actionTypes)
    {
        $this->actionTypes = $actionTypes;

        parent::__construct();
    }

    public function index()
    {
        $actionTypes = $this->actionTypes->all();

        return \View::make('Config::ActionType.index', compact('actionTypes'));
    }

    public function store()
    {
        try 
        {
            $actionType = $this->actionTypes->store(\Input::all());
            return \Redirect::route('config.actiontypes.index');
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
            $actionType = $this->actionTypes->update(\Input::get('action_type_id'), \Input::except('action_type_id'));
            return \Redirect::route('config.actiontypes.index');
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
        $this->actionTypes->reorder(\Input::has('item') ? \Input::get('item') : array());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->actionTypes->delete($id);

        return \Redirect::route('config.actiontypes.index');
    }

}
