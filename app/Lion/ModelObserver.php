<?php

class ModelObserver {

    public static function saving($model)
    {
        // Fix replaced $model->toArray() for $model->getAttributes()
        // Before it was iterating the whole object properties
        foreach ($model->getAttributes() as $name => $value) {
            if (empty($value))
                $model->{$name} = null;
        }

        // Associate the object to the current user account number.
        /*if ($model instanceof AccountableModel)
            $model->account_id = Auth::user()->account_id;*/

        return true;
    }


    public static function userable($class, $setOwned = true)
    {
        $class::creating(function($model) use ($setOwned) {
            $userId = Auth::user()->id;

            if ($setOwned)
                $model->owned_by = $userId;

            $model->created_by = $userId;

            return true;
        });
    }

} 