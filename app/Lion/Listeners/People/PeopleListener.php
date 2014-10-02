<?php namespace Lion\Listeners\People;

use Lion\Listeners\EntityListener;

class PeopleListener extends EntityListener {

    protected $entity  = 'Lion\People';
    
    protected $title   = 'Contacto creado';
    
    protected $message = 'Nuevo contacto creado: {name}';

}