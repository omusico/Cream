<?php namespace Lion\Repositories\Config\Stage;

use Lion\Repositories\Tenant\TenantRepository;

class StageConfigRepository extends TenantRepository implements StageConfigRepositoryInterface {

    // Element entity path
    protected $entity = 'Lion\DealStage';

    // Entity validation
    protected $validators = ['Lion\Services\Validators\Config\StageValidator'];

    /**
     * Gives the entities ordered by probability
     * 
     * @param  array  $with
     * @return Entity
     */
    public function all($with = array())
    {
        return $this->make()->orderBy('probability', 'ASC')->get();
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
        return $this->make()->orderBy('probability', 'ASC')->lists($column, $key);
    }

    /**
     * Updates an element into the database
     * @param  integer  $id
     * @param  Array    $data
     * @return Entity
     */
    public function update($id, Array $data)
    {
        $new = array(
            'name'        => $data['name' . $id],
            'probability' => $data['probability' . $id],
        );

        return parent::update($id, $new);
    }

}