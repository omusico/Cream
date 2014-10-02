@extends('layout.main')

@section('content')

    <div class="row siderable">

        <div class="col-md-8 sidebar-left">
            
            <h1>operación 
                <small>/ {{ $entity->name }}
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            acciones <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ URL::route('deal.create') }}">{{ app_icon_tag('Deal') }} nueva</a></li>
                            <li><a href="{{ URL::route('deal.edit', $entity->id) }}">{{ app_icon_tag('edit') }} editar</a></li>

                            <li class="divider"></li>

                            @if ( ! $entity->deleted_at)
                            <li><a href="{{ URL::route($entityClass . '.delete', $entity->id) }}?{{ redirect_var() }}">{{ app_icon_tag('trash') }} eliminar</a></li>
                            @else
                            <li><a href="{{ URL::route($entityClass . '.restore', $entity->id) }}?{{ redirect_var() }}">{{ app_icon_tag('recover') }} restaurar</a></li>
                            @endif
                        </ul>
                    </div>
                </small>
            </h1>

            <!-- DELETED NOTICE -->
            @include('Misc::deleted')

            <!-- #companyInfo -->
            <div id="companyInfo">

                <?php $items = array(
                            'name'              => 'Título',
                            'stageName'         => 'Fase',
                            'probablitiy'       => 'Probabilidad de cierre',
                            'sourceName'        => 'Fuente',
                            'next_step'         => 'Proxima acción',
                            'next_step_due'     => 'Fecha próxima acción',

                        ); ?>

                        <table class="table table-responsive table-striped table-hover">
                            <tbody>
                                @foreach ($items as $key => $value)

                                    @if ($entity->$key)

                                        <tr>
                                            <td align="right" width="40%"><span>{{ $value }}</span>:</td>
                                            <td align="left">{{ $entity->$key }}</td>
                                            
                                        </tr>

                                    @endif

                                @endforeach

                            </tbody>
                        </table>
            </div>
            <!-- /#companyInfo -->

            <!-- TIMELINE -->
            @include ('Action::timeline.timeline')

        </div>

        <div class="col-md-4 sidebar-right">
            @include ('Misc::description')

            <!-- #companyContacts -->
            <div id="companyContacts">
                <h1>contactos</h1>

                @if ( ! $entity->people->count())
                <p>No hay ningún contacto asociado a la operación, considere asociar uno nuevo ahora.</p>
                
                @else

                    @foreach ($entity->people as $person)
                    <div class="person-box">
                        
                            <h4><a href="{{ URL::route('people.show', $person->id) }}">{{ $person->name }}</a></h4>

                            @if (($person->department) || ($person->position))
                                <p>{{ $person->department }} {{ $person->position }}</p>
                            @endif
                            
                            <p>
                            <?php $telFields = array('mobile_phone', 'phone_1', 'phone_2'); ?>
                            @foreach ($telFields as $phone)
                                @if ($person->$phone)
                                <a href="#" class="btn btn-danger btn-sm">{{ icon_tag('phone') }} {{ $person->$phone }}</a> 
                                @endif
                            @endforeach
                        </p>
                            
                        
                    </div>
                    @endforeach
                
                @endif
                <a href="{{ URL::route('people.create.company', $entity->id) }}?redirect={{Crypt::encrypt(Request::fullUrl())}}" class="btn btn-primary">crear contacto</a>
            </div>
            <!-- /#companyContacts -->

            @include ('Misc::tags')
        </div>
    </div>

@stop

@stop