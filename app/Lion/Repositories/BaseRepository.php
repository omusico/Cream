<?php namespace Lion\Repositories;

abstract class BaseRepository {

    /**
     * Entity path. Here must be set the route to the
     * ORM element that the repository is assigned.
     * For instance: Lion\Tenant.
     * 
     * @var string
     */
    protected $entity = null;

    /**
     * Basic dependences to be included like "with" in the basic
     * queries like find.
     *
     * @var string
     */
    protected $dependences = array();

    /**
     * Array of validators to apply to be applied to the entity.
     * 
     * @var array
     */
    protected $validators = array();

    /**
     * Instances of every $validator
     * 
     * @var array
     */
    protected $validatorInstances = array();

    /**
     * Account object
     * 
     * @var Entity
     */
    protected $account;

    /**
     * Event listeners linked
     * 
     * @var array
     */
    protected $listeners = array();

    /**
     * Fill created and owned fields
     * 
     * @var boolean
     */
    protected $createdAndOwnedBy = false;

    /**
     * Dependencies
     * 
     */
    public function __construct() {

        $this->account = \Auth::user()->account;

        if ($this->validators)
            foreach ($this->validators as $validator)
                array_push($this->validatorInstances, \App::make($validator));

        if ($this->listeners)
        {
            foreach ($this->listeners as $listener)
            {
                $subscriber = new $listener();
                \Event::subscribe($subscriber);
            }
        }
    }

    /**
     * Create a new instance of the managed entity.
     * 
     * @param  array  $with
     * @return Entity
     */
    public function make($with = array())
    {
        $entity = new $this->entity;

        return $entity->newQuery()->with($with);
    }

    /**
     * Create a new instance for being stored
     * 
     * @return Entity
     */
    protected function create()
    {
        return new $this->entity();
    }

    /**
     * Gets an instance by ID
     * 
     * @param  integer|string   $id
     * @param  array            $with
     * @return Entity
     */
    public function find($id, $with = array())
    {
        return $this->make($with)->withTrashed()->find($id);
    }

    /**
     * Gets an instance by ID with all its dependences
     *
     * @param  integer|string  $id
     * @return Entity
     */
    public function findWithDependences($id)
    {
        return $this->find($id, $this->dependences);
    }

    /**
     * Returns a unique entity with determinated fields
     * 
     * @param  integer  $id 
     * @param  string   $fields
     * @return Entity
     */
    public function get($id, $fields = array('*'))
    {
        return $this->make()->where('id', $id)->first($fields);
    }

    /**
     * Get instances by key and value
     * 
     * @param  string $key
     * @param  string $value
     * @param  array  $with
     * @return array
     */
    public function getBy($key, $value, $fields = array('*'), $with = array())
    {
        return $this->make($with)->where($key, $value)->get($fields);
    }

    /**
     * Searches a entity LIKE
     * 
     * @param  string $query  
     * @param  string $field  
     * @param  string $fields
     * @return Entity
     */
    public function search($query, $field = 'name', $fields = array('*'))
    {
        return $this->make()->where($field, 'like', "%$query%")->get($fields);
    }

    /**
     * Return all the instances
     * 
     * @param  array    $with
     * @return arary
     */
    public function all($with = array())
    {
        return $this->make($with)->get();
    }

    /**
     * Return the entity paginated by items and ordered
     * 
     * @param  string   $orderBy
     * @param  string   $order
     * @param  integer  $items
     * @return Entities
     */
    public function getPaginated($items, $orderBy = '', $order = '', $search = '', $searchFields = array('name'))
    {
        $entity = $this->make();

        if (( ! empty($orderBy)) && ( ! empty($order)))
            $entity = $entity->orderBy($orderBy, $order);

        if ( ! empty($search))
        {
            $entity->where(function($query) use ($search, $searchFields) {
                $f = 'where';
                foreach ($searchFields as $field)
                {
                    $query->$f($field, 'LIKE', "%$search%");
                    $f = 'orWhere';
                } 
            });
        }

        return $entity->paginate($items);
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
        return $this->make()->lists($column, $key);
    }

    /**
     * List all the entities ready for a dropdown
     * 
     * @return array
     */
    public function nameList($empty = false)
    {
        $result = $this->lists('name', 'id');

        if ($empty)
            return array('' => '- Seleccione -') + $result;

        return $result;
    }

    /**
     * Return all the instances that have been trashed
     * 
     * @param  array    $with
     * @return arary
     */
    public function trashed($with = array())
    {
        return $this->make($with)->onlyTrashed()->get();
    }

    /**
     * Stores a new entity into the database
     * 
     * @param  Array  $data
     * @return Entity
     */
    public function store(Array $data)
    {
        // Create new entity
        $entity = $this->create();
        $entity->fill($data);

        // Set who's the owner and the creator
        if ($this->createdAndOwnedBy)
        {
            $entity->created_by = \Auth::user()->id;
            $entity->owned_by = $entity->created_by;
        }

        // Validate
        $this->storeValidation($entity);

        $entity->save();

        \Event::fire($this->entity . '.created', array($entity));

        return $entity;
    }

    /**
     * Updates an entity into the database
     * 
     * @param  Array  $data
     * @return Entity
     */
    public function update($id, Array $data)
    {
        // Find the entity, update data
        $entity = $this->make()->find($id);
        $entity->fill($data);

        // Validate
        $this->updateValidation($entity);

        $entity->save();

        return $entity;
    }

    /**
     * Deletes the entity
     * 
     * @param  array    $id
     * @return arary
     */
    public function delete($id)
    {
        return $this->find($id)->delete();
    }

    public function restore($id)
    {
        return $this->find($id)->restore();
    } 

    /**
     * Basic entity storation, just validates
     * 
     * @param Entity  $entity       
     */
    public function storeValidation($entity)
    {
        if ($this->validators)
            foreach ($this->validatorInstances as $validator)
                $validator->validForCreation($entity);
    }

    /**
     * Basic entity update, just validates
     * 
     * @param Entity  $entity
     */
    public function updateValidation($entity)
    {
        if ($this->validators)
            foreach ($this->validatorInstances as $validator)
                $validator->validForUpdate($entity);
    }

}