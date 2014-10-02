<?php namespace Cream\Misc\Repositories;

interface TagsAjaxRepositoryInterface {

    public function getTagsOf($entity, $id);

    public function storeTagOf($entity, $id, $tag);

    public function deleteTagOf($entity, $id, $index);

}