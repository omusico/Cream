<?php namespace Lion\Repositories\Config\Source;

use Lion\Repositories\Config\SortableRepository;

class SourceConfigRepository extends SortableRepository implements SourceConfigRepositoryInterface {

    // Element entity path
    protected $entity = 'Lion\Source';

    // Entity validation
    protected $validators = ['Lion\Services\Validators\Config\SourceValidator'];

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
        );

        return parent::update($id, $new);
    }

}