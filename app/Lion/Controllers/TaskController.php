<?php namespace Lion\Controllers;

use Lion\Controllers\BaseController;
use Lion\Exceptions\ValidateException;
use Lion\Repositories\Task\TaskRepositoryInterface;
use Lion\Exceptions\Task\TaskAlreadyExistsException;
use Lion\Repositories\Config\Task\TaskConfigRepositoryInterface;

class TaskController extends \BaseController {

    protected $collections = array(
        'create'    => array('datetimepicker'),
        'edit'      => array('datetimepicker'),
        'show'   => array('timeline')
    );

    protected $assets = array(
        'create' => array(
            'sys/custom/task.js',
            'sys/directives/select.entity.js'
        ),
        'edit' => array(
            'sys/custom/task.js',
            'sys/directives/select.entity.js'
        )
    );

    public function __construct(TaskRepositoryInterface $task,
                                TaskConfigRepositoryInterface $taskTypes)
    {
        $this->task      = $task;
        $this->taskTypes = $taskTypes;

        \View::share('controller', 'Task');
        \View::share('entityClass', 'task');

        parent::__construct();
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $tasks = $this->task->getTasks();
        $events = $this->task->getEvents();

        return \View::make('Task::index', compact('tasks', 'events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($type)
    {
        $taskTypes = $this->taskTypes->nameList(true);

        return \View::make('Task::create.' . $type, compact('taskTypes'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $entity = $this->task->find($id);
        $related = $this->task->getMainRelated($entity->id);

        return \View::make('Task::view', compact('entity', 'related'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $entity = $this->task->find($id);

        return $this->create($entity->taskOrEvent())->withEntity($entity);
    }

    public function store()
    {
        try 
        {
            $task = $this->task->store(\Input::all());
            return \Redirect::route('task.show', $task->id);
        } 
        catch (ValidateException $e) 
        {
            return \Redirect::back()->withErrors($e->get())->withInput();
        }
    }

    public function update($id)
    {
        try 
        {
            $task = $this->task->update($id, \Input::all());
            return \Redirect::route('task.show', $task->id);
        } 
        catch (ValidateException $e) 
        {
            return \Redirect::back()->withErrors($e->get())->withInput();
        }
    }

    public function perform($id)
    {
        try 
        {
            $perform = $this->task->perform($id);

            if ($perform)
            {
                if ($perform->isRelated())
                {
                    $related = $perform->getMainRelatedEntity();
                    return \Redirect::route($related->entity . '.show', $related->id);
                }
                else
                    return \Redirect::route('task.index');
            }

            $entity = $this->task->find($id);
            return \View::make('Task::perform', compact('entity'));
        } 
        catch (TaskAlreadyDoneException $e)
        {
            return \Redirect::route('task.index');
        }
    }

    public function delete($id)
    {
        $this->task->delete($id);

        if (is_redirect())
            return redirect_url();

        return \Redirect::route('task.index');
    }

    // public function trash()
    // {
    //     $companies          = $this->company->all();
    //     $trashedCompanies   = $this->company->trashed();

    //     return \View::make('Company::trashed', compact('companies', 'trashedCompanies'));
    // }

    public function restore($id)
    {
        $restore = $this->task->restore($id);

        if (is_redirect())
            return redirect_url();

        return \Redirect::route('task.trash');
    }

}