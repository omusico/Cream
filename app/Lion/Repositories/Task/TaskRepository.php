<?php namespace Lion\Repositories\Task;

use Lion\Repositories\BaseRepository;
use Lion\Exceptions\Task\TaskAlreadyDoneException;

class TaskRepository extends BaseRepository implements TaskRepositoryInterface {

    // Element entity path
    protected $entity = 'Lion\Task';

    // Entity validation
    protected $validators = [
        'Lion\Services\Validators\Task\TaskValidator'
    ];

    // Entity listeners
    protected $listeners = array(
        'Lion\Listeners\Task\TaskListener'
    );

    public function perform($id)
    {
        $task = $this->find($id);

        if ($task->done != NULL)
            throw new TaskAlreadyDoneException;

        if ( ! $task->isRelated())
        {
            $this->performWithAction($task->id, -1);
            return $task;
        }

        if ($task->isRelated() && $task->isAction())
            return false;

        \Event::fire('task.done', array($task));

        return $task;
    }

    public function performWithAction($taskId, $actionId)
    {
        $task = $this->find($taskId);
        $task->done = $actionId;
        $task->save();
    }

    public function getMainRelated($element)
    {
        if ( ! is_a($element, $this->entity))
            $element = $this->find($element);

        return $element->getMainRelatedEntity();
    }

    /**
     * Returns an array of tasks
     * 
     * @return Entities
     */
    public function getTasks()
    {
        return array(
            'tasks_late'      => $this->make()->lateTasks()->notDone()->get(),
            'tasks_today'     => $this->make()->todayTasks()->notDone()->get(),
            'tasks_tomorrow'  => $this->make()->tomorrow()->isTask()->notDone()->get(),
            'tasks_this_week' => $this->make()->thisWeek()->isTask()->notDone()->get(),
            'tasks_next_week' => $this->make()->nextWeek()->isTask()->notDone()->get(),
            'tasks_further'   => $this->make()->further()->isTask()->notDone()->get()
        );
    }

    /**
     * Returns an array of tasks
     * 
     * @return Entities
     */
    public function getEvents()
    {
        return array(
            'tasks_late'      => $this->make()->lateEvents()->notDone()->get(),
            'tasks_today'     => $this->make()->todayEvents()->notDone()->get(),
            'tasks_tomorrow'  => $this->make()->tomorrow()->isEvent()->notDone()->get(),
            'tasks_this_week' => $this->make()->thisWeek()->isEvent()->notDone()->get(),
            'tasks_next_week' => $this->make()->nextWeek()->isEvent()->notDone()->get(),
            'tasks_further'   => $this->make()->further()->isEvent()->notDone()->get()
        );
    } 

    /**
     * Stores a new task into the database
     * 
     * @param  Array  $data
     * @return Entity
     */
    public function store(Array $data)
    {
        $task = $this->create();

        $task->fill($data);

        // if (isset($data['entity_type']) && isset($data['entity_id']))
        // {
        //     $task->relatable_type = $data['entity_type'];
        //     $task->relatable_id   = $data['entity_id'];
        // }

        $task = $this->checkType($task, $data);

        $this->storeValidation($task);

        $task->save();

        $this->assignToTask($task, $data);

        return $task;
    }

    /**
     * Updates a task into the database
     *
     * @param   Integer $id
     * @param   Array   $data
     * @return  Entity
     */
    public function update($id, Array $data)
    {
        $task = $this->make()->find($id);

        $task->fill($data);

        $task = $this->checkType($task, $data);

        $this->updateValidation($task);

        $task->save();

        \Lion\TaskAssignment::where('task_id', $task->id)->delete();

        $this->assignToTask($task, $data);

        return $task;
    }

    protected function assignToTask($task, $data)
    {
        if (isset($data['assignment']))
        {
            foreach ($data['assignment'] as $entity => $id)
            {
                if (empty($entity) || empty($id))
                    continue;

                if (strpos($entity, 'Lion') === false)
                    $entity = 'Lion\\' . studly_case($entity);

                $assignment = new \Lion\TaskAssignment(array(
                    'assignable_type'   => $entity,
                    'assignable_id'     => $id
                    ));

                $task->assignments()->save($assignment);
            }
        }
    }

    /**
     * Checks if the type is event
     *    
     * @param  Entity $task
     * @param  Array  $data
     * @return Entity
     */
    protected function checkType($task, Array $data)
    {
        if (array_key_exists('end_date', $data))
        {
            if (empty($data['end_date']))
                $task->end_date = 'invalid';
        }

        return $task;
    }

}