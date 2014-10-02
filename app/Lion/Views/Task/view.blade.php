@extends('layout.main')

@section('content')

    <div class="row siderable">

        <div class="col-md-12">
            <h1>tarea 
                <small>/ {{ $entity->name }}
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            acciones <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ URL::route('task.create', 'task') }}">{{ app_icon_tag('Task') }} nueva tarea</a></li>
                            <li class="disabled"><a href="{{ URL::route('task.create', 'event') }}">{{ app_icon_tag('Task') }} nuevo evento</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ URL::route('task.edit', $entity->id) }}">{{ app_icon_tag('edit') }} editar</a></li>
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

            <div class="panel panel-default box">
                <div class="panel-heading">
                    <div class="panel-title">
                        <div class="icon">{{ app_icon_tag('Deal') }}</div>
                        {{ $entity->name }}
                    </div>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <?php $colsize = $entity->taskOrEvent() == 'task' ? 6 : 4; ?>

                        @if ($entity->taskOrEvent() == 'task')

                            <div class="col-md-6 col-xs-6">
                                <div class="well well-sm text-center">
                                    fecha
                                    <h4><strong>{{ $entity->start_date_formated }}</strong></h4>
                                </div>
                            </div>

                        @else

                            <div class="col-md-4 col-xs-4">
                                <div class="well well-sm text-center">
                                    fecha inicio
                                    <h4><strong>{{ $entity->start_datetime_formated }}</strong></h4>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-4">
                                <div class="well well-sm text-center">
                                    fecha fin
                                    <h4><strong>{{ $entity->end_datetime_formated }}</strong></h4>
                                </div>
                            </div>

                        @endif

                        <div class="col-md-{{$colsize}} col-xs-{{$colsize}}">
                            <div class="well well-sm text-center">
                                tipo
                                <h4><strong>{{ $entity->action_type_name }}</strong></h4>
                            </div>
                        </div>
                    </div>

                </div>

                <ul class="list-group no-bg">

                    <li class="list-group-item">
                        {{-- Is it assigned to anything? --}}
                        @if ($entity->assignments->count())
                            <strong>Asociado a:</strong>

                            @foreach ($entity->assignments as $assign)
                            <p>
                                <?php $item = $assign->assignable; ?>
                                <div class="persodn-box">
                                    {{ app_icon_tag(studly_case($item->entity)) }} <a href="{{ URL::route($item->entity . '.show', $item->id) }}" class="link">{{ $item->name }}</a>
                                    @if ($item->entity != 'deal')
                                        <p>
                                        <?php $telFields = array('mobile_phone', 'phone_1', 'phone_2'); ?>
                                        @foreach ($telFields as $phone)
                                            @if ($item->$phone)
                                            {{ icon_tag('phone') }} <a href="#" class="link">{{ $item->$phone }}</a> 
                                            @endif
                                        @endforeach
                                    </p>
                                    @endif


                                    <?php /*@if (($person->department) || ($person->position))
                                        <p>{{ $person->department }} {{ $person->position }}</p>
                                    @endif*/ ?>
               
                                        
                                </div>
                            </p>
                            @endforeach
                        @endif
                    </li>

                    <li class="list-group-item">
                        <strong>Título</strong>: {{ $entity->name }}
                    </li>

                    <li class="list-group-item">
                        <strong>Descripción:</strong> {{ $entity->description }}
                    </li>

                </ul>

            </div>

            <div class="panel panel-default box">
                <div class="panel-heading">
                    <div class="panel-title">
                        <div class="icon">{{ app_icon_tag('Deal') }}</div>
                        realizar tarea
                    </div>
                </div>

                <div class="panel-body">

                    @include('Task::perform')

                </div>
            </div>

        </div>

        <!--<div class="col-md-4">

            @if ($entity->assignments->count())

            <div id="related">
                <h1>asociada a</h1>

                @foreach ($entity->assignments as $assign)
                    <div>{{ $assign->assignable->name }}</div>
                @endforeach
                
            </div>

            @endif

            <div id="actions">
                <h1>acciones</h1>
                
                <a href="{{ URL::route('task.perform', $entity->id) }}" class="btn btn-primary btn-block">acción realizada</a>

            </div>
        </div>-->
    </div>

@stop