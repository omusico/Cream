<?php namespace Lion;

abstract class AssignableModel extends BaseModel { 

    public function isRelated()
    {
        return $this->assignments->count();
    }

    public function getRelatedEntityId($assignable_type)
    {
        $result = $this->assignments()->where('assignable_type', $assignable_type)->first();
        return $result ? $result->assignable_id : null;
    }

    /**
     * The main element that the task is related to
     * 
     * @return string
     */
    public function getMainRelatedType()
    {
        if ( ! $this->isRelated())
            return null;

        return $this->assignments()->first()->assignable_type;
    }

    /**
     * The main element that the task is related to
     * 
     * @return string
     */
    public function getMainRelatedId()
    {
        if ( ! $this->isRelated())
            return null;

        return $this->assignments()->first()->assignable_id;
    }

    public function getMainRelated()
    {
        if ( ! $this->isRelated())
            return null;

        return $this->assignments()->first();
    }

    public function getMainRelatedEntity()
    {
        $related = $this->getMainRelated();

        return $related ? $related->assignable : $related;
    }

    public abstract function assignments();

}