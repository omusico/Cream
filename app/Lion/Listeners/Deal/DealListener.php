<?php namespace Lion\Listeners\Deal;

use Lion\Listeners\EntityListener;

class DealListener extends EntityListener {

    protected $entity  = 'Lion\Deal';
    
    protected $title   = 'Operación creada';
    
    protected $message = 'Nueva operación creada: {name}';

}