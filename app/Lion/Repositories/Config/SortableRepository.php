<?php namespace Lion\Repositories\Config;

use Lion\Repositories\Tenant\TenantRepository;

abstract class SortableRepository extends TenantRepository {

    /**
     * All the elements by sorted by order
     *  
     * @param  array  $with
     * @return Entity
     */
    public function all($with = array())
    {
        return $this->make()->orderBy('order', 'ASC')->get();
    }

    /**
     * Create a new instance for being stored and sets the order
     * 
     * @return Entity
     */
    protected function create() {
        $entity = parent::create();

        $entity->order = 99;

        return $entity;
    }

    /**
     * Reorder a list into the database
     * 
     * @param  Array $data
     * @return boolean
     */
    public function reorder(Array $data)
    {
        if ( ! $data)
            return false;

        $i = 1;

        foreach ($data as $value)
        {
            $entity = $this->find($value);
            $entity->order = $i;
            $entity->save();

            $i++;
        }

        return true;
    }

    /**
     * Lists all the instances based on column and key
     * 
     * @param  string $column
     * @param  string $key
     * @return array
     */
    public function lists($column, $key = null)
    {
        return $this->make()->orderBy('order', 'ASC')->lists($column, $key);
    }

}