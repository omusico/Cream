<?php namespace Lion\Listeners;

abstract class EntityListener {

    /**
     * Name of the entity (company, deal, people...)
     * 
     * @var string
     */
    protected $entity;

    /**
     * Name of the action activity
     * 
     * @var string
     */
    protected $title;

    /**
     * Message of the action
     * 
     * @var string
     */
    protected $message;

    /**
     * Handle user login events.
     */
    public function onEntityCreated($event)
    {
        $action = \App::make('Lion\Repositories\Action\ActionRepositoryInterface');

        $message = str_replace('{name}', $event->name, $this->message);
        $entity = strtolower(str_replace('Lion\\', '', $this->entity));

        $actionData = [
            'assignment'    => array($entity => $event->id),
            'title'         => $this->title,
            'message'       => $message,
            'done_at'       => 'now',
        ];

        $action->store($actionData);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events)
    {
        $entityPath = str_replace('Lion\\', '', $this->entity);

        $events->listen($this->entity . '.created', 'Lion\Listeners\\' . $entityPath . '\\' . $entityPath . 'Listener@onEntityCreated');
    }

}