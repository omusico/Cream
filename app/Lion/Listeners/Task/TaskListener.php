<?php namespace Lion\Listeners\Task;

use Lion\Repositories\Action\ActionRepositoryInterface;

class TaskListener {

    public function __construct()
    {
        $this->action = \App::make('Lion\Repositories\Action\ActionRepositoryInterface');
    }

    public function onTaskDone($event)
    {
        // If the task is related to an entity... Otherwise it does not create an action history
        if ($event->isRelated())
        {
            $title = (isset($event->taskType) ? ($event->action_type_name . ' - ') : '') . $event->name;


            $actionData = [
                'assignment' => $event->assignments->lists('assignable_id', 'assignable_type'),

                'entity'        => $event->relatable_type,
                'entity_id'     => $event->relatable_id,
                'title'         => $title,
                'message'       => $event->description,
                'done_at'       => 'now',
            ];

            $action = $this->action->store($actionData);

            $event->done = $action->id;
            $event->save();
        }
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events)
    {
        $events->listen('task.done',            'Lion\Listeners\Task\TaskListener@onTaskDone');
        // $events->listen('task.doneWithAction',  'Lion\Listeners\Task\TaskListener@onTaskDoneWithAction');
    }

}