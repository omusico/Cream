@extends('layout.main')

@section('content')

    <div class="row siderable">

        <div class="col-md-8 sidebar-left">
            
            <h1>contacto 
                <small>/ {{ $entity->name }}
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            acciones <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ URL::route('people.create') }}">{{ app_icon_tag('People') }} nuevo</a></li>
                            <li><a href="{{ URL::route('people.edit', $entity->id) }}">{{ app_icon_tag('edit') }} editar</a></li>
                            
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
            
            <!-- COUNTERS -->
            @include('Misc::counters')

            <!-- #peopleInfo -->
            <div id="peopleInfo">

                <?php $items = array(
                            'name'         => 'Nombre completo',
                            'department'   => 'Departamento',
                            'position'     => 'Cargo',
                            'email_1'      => 'E-Mail primario',
                            'email_2'      => 'E-Mail alternativo',
                            'phone_1'      => 'Teléfono primario',
                            'phone_2'      => 'Teléfono alternativo',
                            'mobile_phone' => 'Teléfono móvil',
                            'web'          => 'Sitio web',
                            'address'           => 'Dirección',
                            'postcode'          => 'Código postal',
                            'city'              => 'Ciudad',
                            'state'             => 'Estado'
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
            <!-- /#peopleInfo -->

            
            <!-- DEALS -->
            @include ('Deal::linked')

            <!-- TIMELINE -->
            @include ('Action::timeline.timeline')

        </div>

        <div class="col-md-4 sidebar-right">
            @if ($entity->company)
            <h2>empresa</h2>

            <div class="person-box">
                        
                <h4>{{ app_icon_tag('Company') }} <a class="link" href="{{ URL::route('company.show', $entity->company->id) }}">{{ $entity->company->name }}</a></h4>
                    
                <p>
                    <?php $telFields = array('mobile_phone', 'phone_1', 'phone_2'); ?>
                    @foreach ($telFields as $phone)
                        @if ($entity->company->$phone)
                        <a href="#" class="btn btn-danger btn-sm">{{ icon_tag('phone') }} {{ $entity->company->$phone }}</a> 
                        @endif
                    @endforeach
                </p>
                    
                
            </div>
            @endif

            @include ('Misc::description')

            @include ('Misc::tags')
        </div>
    </div>

@stop