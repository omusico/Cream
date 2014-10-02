<?php namespace Lion\Listeners\Company;

use Lion\Listeners\EntityListener;

class CompanyListener extends EntityListener {

    protected $entity  = 'Lion\Company';
    
    protected $title   = 'Empresa creada';
    
    protected $message = 'Nueva empresa creada: {name}';

}