<?php namespace Lion\Controllers\Config;

use Lion\Controllers\BaseController;
use Lion\Exceptions\ValidateException;
use Lion\Repositories\Config\Source\SourceConfigRepositoryInterface;

class SourcesConfigController extends BaseController {

    protected $collections = array(
        'index' => array('sortable')
    );

    protected $assets = array(
        'index' => array(
            'sys/custom/config/sources/sources.js',
        ),
    );

    public function __construct(SourceConfigRepositoryInterface $source)
    {
        $this->source = $source;

        parent::__construct();
    }

    public function index()
    {
        $sources = $this->source->all();

        return \View::make('Config::Source.index', compact('sources'));
    }

    public function store()
    {
        try 
        {
            $source = $this->source->store(\Input::all());
            return \Redirect::route('config.sources.index');
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
            $source = $this->source->update(\Input::get('source_id'), \Input::except('source_id'));
            return \Redirect::route('config.sources.index');
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
        $this->source->reorder(\Input::has('item') ? \Input::get('item') : array());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->source->delete($id);

        return \Redirect::route('config.sources.index');
    }

}
