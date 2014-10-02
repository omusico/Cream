<?php namespace Cream\Misc\Repositories;

class TagsAjaxRepository implements TagsAjaxRepositoryInterface {

    public function getTagsOf($entity, $id)
    {
        $tags = $entity::withTrashed()->find($id)->tags;

        if ($tags)
            return explode(',', $tags);
        return
            null;
    }

    public function storeTagOf($entity, $id, $tag)
    {
        $element = $entity::withTrashed()->find($id);
        $tags = array();

        if ($element->tags)
           $tags = explode(',', $element->tags);

        array_push($tags, str_replace(',', '', $tag));

        $element->tags = implode(',', $tags);

        $element->updateUniques();
    }

    public function deleteTagOf($entity, $id, $index)
    {
        $element = $entity::withTrashed()->find($id);
        $tags = explode(',', $element->tags);

        unset($tags[$index]);

        $element->tags = implode(',', $tags);

        $element->updateUniques();
    }

}