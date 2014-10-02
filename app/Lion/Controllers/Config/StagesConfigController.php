<?php namespace Lion\Controllers\Config;

use Lion\Controllers\BaseController;
use Lion\Exceptions\ValidateException;
use Lion\Repositories\Config\Stage\StageConfigRepositoryInterface;

class StagesConfigController extends BaseController {

    public function __construct(StageConfigRepositoryInterface $stage)
    {
        $this->stage = $stage;

        parent::__construct();
    }

    public function index()
    {
        $stages = $this->stage->all();

        return \View::make('Config::Stage.index', compact('stages'));
    }

    public function store()
    {
        try 
        {
            $stage = $this->stage->store(\Input::all());
            return \Redirect::route('config.stages.index');
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
            $stage = $this->stage->update(\Input::get('stage_id'), \Input::except('stage_id'));
            return \Redirect::route('config.stages.index');
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
        $this->stage->reorder(\Input::has('item') ? \Input::get('item') : array());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->stage->delete($id);

        return \Redirect::route('config.stages.index');
    }

}
