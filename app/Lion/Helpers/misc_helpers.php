<?php
function related_string($entity)
{
    $string = '';

    if ($entity instanceof Lion\Company)
        $string = 'empresa ' . $entity->name;

    if ($entity instanceof Lion\Deal)
    {
        $string = '';
        return $deal->name
    }

    return $string;
}