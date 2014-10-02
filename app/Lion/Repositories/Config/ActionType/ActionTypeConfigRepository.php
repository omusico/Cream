<?php namespace Lion\Repositories\Config\ActionType;

use Lion\Repositories\Config\SortableRepository;

class ActionTypeConfigRepository extends SortableRepository implements ActionTypeConfigRepositoryInterface {

    // Element entity path
    protected $entity = 'Lion\ActionType';

    // Entity validation
    protected $validators = ['Lion\Services\Validators\Config\ActionTypeValidator'];

    /**
     * Updates an element into the database
     * @param  integer  $id
     * @param  Array    $data
     * @return Entity
     */
    public function update($id, Array $data)
    {
        $track_duration = isset($data['track_duration' . $id]) ? 1 : 0;

        $new = array(
            'name'              => $data['name' . $id],
            'track_duration'    => $track_duration,
            'icon'              => $data['icon' . $id],
            'color'             => $data['color' . $id],
            'bgcolor'           => $data['bgcolor' . $id]
        );

        return parent::update($id, $new);
    }

}