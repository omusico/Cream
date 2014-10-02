<?php namespace Lion\Controllers\Api\Ajax;

use Lion\Repositories\Entity\EntityRepositoryInterface;

class EntityAjaxController extends \Controller {

    public function __construct(EntityRepositoryInterface $entity)
    {
        $this->entity = $entity;
    }

    public function searchEntities()
    {
        return \Response::Json($this->entity->searchEntities(\Input::get('query')));
    }

    public function getEntity()
    {
        return $this->entity->getEntity(\Input::get('entity_type'), \Input::get('entity_id'));
    }

}