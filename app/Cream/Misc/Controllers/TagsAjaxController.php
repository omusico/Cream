<?php namespace Cream\Misc\Controllers;

use Cream\Misc\Repositories\TagsAjaxRepositoryInterface;

class TagsAjaxController extends \Controller {

    public function __construct(TagsAjaxRepositoryInterface $tags)
    {
        $this->tags = $tags;
    }

    public function loadTags()
    {
        if ($this->checkEntityInput())
        {
            return $this->tags->getTagsOf(\Input::get('entity'), \Input::get('entity_id'));
        }
    }

    public function storeTag()
    {
        if ($this->checkEntityInput())
        {
            return $this->tags->storeTagOf(\Input::get('entity'), \Input::get('entity_id'), \Input::get('tag'));
        }
    }

    public function deleteTag()
    {
        if ($this->checkEntityInput())
        {
            return $this->tags->deleteTagOf(\Input::get('entity'), \Input::get('entity_id'), \Input::get('tagIndex'));
        }
    }

    protected function checkEntityInput()
    {
        if (( ! \Input::has('entity')) || (! \Input::has('entity_id')))
            return false;

        return true;
    }

}