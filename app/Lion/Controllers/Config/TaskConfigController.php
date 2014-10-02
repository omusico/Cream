<?php namespace Lion\Controllers\Config;

use Lion\Controllers\BaseController;
use Lion\Exceptions\ValidateException;
use Lion\Repositories\Config\Task\TaskConfigRepositoryInterface;

class TaskConfigController extends BaseController {

    protected $collections = array(
        'index' => array('sortable')
    );

    protected $assets = array(
        'index' => array(
            'sys/custom/config/task/task.js',
        ),
    );

    public function __construct(TaskConfigRepositoryInterface $task)
    {
        $this->task = $task;

        parent::__construct();
    }

    public function index()
    {
        $repo = \App::make('Lion\Repositories\Config\ActionType\ActionTypeConfigRepositoryInterface');

        $tasks      = $this->task->all();
        $actions    = $repo->nameList(true);

        return \View::make('Config::Task.index', compact('tasks', 'actions'));
    }

    public function store()
    {
        try 
        {
            $task = $this->task->store(\Input::all());
            return \Redirect::route('config.task.index');
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
            $task = $this->task->update(\Input::get('task_id'), \Input::except('task_id'));
            return \Redirect::route('config.task.index');
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
        $this->task->reorder(\Input::has('item') ? \Input::get('item') : array());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->task->delete($id);

        return \Redirect::route('config.task.index');
    }

}
