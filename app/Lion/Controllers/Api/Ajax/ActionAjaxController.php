<?php namespace Lion\Controllers\Api\Ajax;

use Illuminate\Support\Collection;
use Lion\Exceptions\ValidateException;
use Lion\Repositories\Action\ActionRepositoryInterface;

class ActionAjaxController extends \Controller {
    
    public function __construct(ActionRepositoryInterface $action)
    {
        $this->action = $action;
    }

    public function loadActions()
    {
        $responseCollection = new Collection;

        $actions = $this->action->getTimeline(\Input::get('entity'), \Input::get('entity_id'), \Input::get('items'));
        $config = $this->action->getConfig();

        $responseCollection->put('actions', $actions);
        $responseCollection->put('config', $config);

        return $responseCollection;
    }

    public function storeAction()
    {
        $task = \App::make('Lion\Repositories\Task\TaskRepositoryInterface');
        $action = $this->action->store(\Input::all());

        try {
            if (\Input::get('task_id'))
                $task->performWithAction(\Input::get('task_id'), $action->id);

            return \Response::json('OK');
        } catch (ValidateException $e)
        {
            return \Response::Json($e->get());
        }

        // if ($action instanceof \Lion\Action)
        // {
        //     if (\Input::get('task_id'))
        //         $taks->forcePerform(\Input::get('task_id'));

        //     return $action;
        // }
        // else
        //     return $action;
    }

}