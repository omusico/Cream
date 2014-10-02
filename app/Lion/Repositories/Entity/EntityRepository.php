<?php namespace Lion\Repositories\Entity;

class EntityRepository implements EntityRepositoryInterface {

    /**
     * Returns the entity from database
     * 
     * @param  string   $entity
     * @param  integer  $id
     * @return Entity
     */
    public function getEntity($entity, $id)
    {
        $with = array();

        if ($entity == 'Lion\Company')
            $with = array('People', 'Deals');
        elseif ($entity == 'Lion\People')
            $with = array('Deals');
        elseif ($entity == 'Lion\Deal')
            $with = array('People');

        return $entity::with($with)->find($id);
    }

    /**
     * Search the entities into the databsae
     *
     * @param  string   $query
     * @param  integer  $take
     * @return [type] [description]
     */
    public function searchEntities($query, $take = 2)
    {
        $whereString = '%' . $query . '%';

        $companies  = \Lion\Company::where('name', 'like', $whereString)->take($take)->get(array('id', 'name'));
        $deals      = \Lion\Deal::where('name', 'like', $whereString)->take($take)->get(array('id', 'name'));
        $people     = \Lion\People::where('name', 'like', $whereString)->take($take)->get(array('id', 'name'));

        $result = [
            'companies' => $companies->toArray(),
            'deals' => $deals->toArray(),
            'people' => $people->toArray()
        ];

        return $result;
    }

}