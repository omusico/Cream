<?php namespace Lion\Repositories\Action;

use Lion\Repositories\BaseRepository;
use Lion\Repositories\Config\ActionType\ActionTypeConfigRepositoryInterface;

class ActionRepository extends BaseRepository implements ActionRepositoryInterface {

    // Element entity path
    protected $entity = 'Lion\Action';

    // Entity validation
    protected $validators = array(
            'Lion\Services\Validators\Action\ActionValidator',
        );

    protected $controller;
    protected $timelineCount = false;

    public function __construct(ActionTypeConfigRepositoryInterface $actionType)
    {
        $this->actionType = $actionType;
    }

    /**
     * Returns the entity timeline
     * 
     * @param  string   $entity
     * @param  integer  $id
     * @param  string   $items
     * @return Entities
     */
    public function getTimeline($entity, $id, $items = '*')
    {
        $class            = 'Lion\\' . studly_case($entity);
        $this->controller = $class;

        $timeline = $class::getActionsOf($id, $items);

        if (($items != '*') && ($timeline->count() > 2))
            $this->timelineCount = true;

        return $timeline;
    }

    /**
     * Configuration for every action timeslot
     * 
     * @return array
     */
    public function getConfig()
    {
        return array(
            'icons' => array(
                'visit'   => \Config::get('cream.icons.visit'),
                'call'    => \Config::get('cream.icons.call'),
                'email'   => \Config::get('cream.icons.email'),
                'People'  => \Config::get('cream.icons.People'),
                'Deal'    => \Config::get('cream.icons.Deal'),
                'Company' => \Config::get('cream.icons.Company'),
                'in'      => \Config::get('cream.icons.in'),
                'out'     => \Config::get('cream.icons.out'),
            ),
            'action_types' => $this->actionType->nameList(true),
            'showAllButton' => $this->timelineCount,
            'controller'    => $this->controller
        );
    }

    public function store(Array $data)
    {
        $action = $this->create();

        $data['created_by'] = \Auth::user()->id;

        $data['done_at'] = new \Datetime($data['done_at']);

        $action->fill($data);

        $this->storeValidation($action);

        $action->save();

        $data['assignment'] = $this->checkCompany($data['assignment']);

        if (isset($data['assignment']))
        {
            foreach ($data['assignment'] as $entity => $id)
            {
                if (empty($entity) || empty($id))
                    continue;

                if (strpos($entity, 'Lion') === false)
                    $entity = 'Lion\\' . studly_case($entity);

                $assignment = new \Lion\ActionAssignment(array(
                    'assignable_type'   => $entity,
                    'assignable_id'     => $id
                ));

                $action->assignments()->save($assignment);
            }
        }

        return $action;
    }

    public function checkCompany($data)
    {
        // If no company is selected, try to assign it from the deal or people
        if ( ! isset($data['company']) && ! isset($data['Lion\Company']))
        {
            $instances = array();

            if (isset($data['deal']))
            {
                $repo = \App::make('Lion\Repositories\Deal\DealRepositoryInterface');
                $deal = $repo->find($data['deal']);

                array_push($instances, $deal);
            }
            if (isset($data['people']))
            {
                $repo = \App::make('Lion\Repositories\People\PeopleRepositoryInterface');
                $people = $repo->find($data['people']);

                array_push($instances, $people);
            }

            foreach ($instances as $instance)
            {
                if ($instance->company)
                {
                    $data['company'] = $instance->company_id;
                    break;
                }
            } 
        }

        return $data;
    } 

}