<?php namespace Lion\Repositories\Config\Task;

use Lion\Repositories\Config\SortableRepository;

class TaskConfigRepository extends SortableRepository implements TaskConfigRepositoryInterface {

    // Element entity path
    protected $entity = 'Lion\TaskType';

    // Entity validation
    protected $validators = ['Lion\Services\Validators\Config\TaskValidator'];

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
            'action_type' => $data['action_type' . $id]
        );

        return parent::update($id, $new);
    }

}