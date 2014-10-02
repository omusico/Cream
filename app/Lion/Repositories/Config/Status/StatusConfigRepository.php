<?php namespace Lion\Repositories\Config\Status;

use Lion\Repositories\Config\SortableRepository;

class StatusConfigRepository extends SortableRepository implements StatusConfigRepositoryInterface {

    // Element entity path
    protected $entity = 'Lion\Status';

    // Entity validation
    protected $validators = ['Lion\Services\Validators\Config\StatusValidator'];

    /**
     * Updates an element into the database
     * @param  integer  $id
     * @param  Array    $data
     * @return Entity
     */
    public function update($id, Array $data)
    {
        $new = array(
            'name'  => $data['name' . $id],
            'color' => $data['color' . $id],
        );

        return parent::update($id, $new);
    }

}