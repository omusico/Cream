@extends('layout.main')

@section('content')

    <div class="page-header">
        <h1>Tareas 
            <small>/ visualización de tareas</small>
        </h1> 
    </div>

    <div class="row">
        <div class="col-md-6">

            <div class="panel panel-default box">
                <div class="panel-heading">
                    <div class="panel-title">
                        <div class="icon">{{ app_icon_tag('Task') }}</div>
                        listado de tareas
                        <div class="btn-group">
                            <a class="btn btn-primary" href="{{ URL::route('task.create', 'task') }}">{{ app_icon_tag('create') }} crear</a>
                        </div>
                    </div>
                </div>

                <?php $noTasks = true ?>
                
                @foreach ($tasks as $key => $items)
                <div class="list-group tasks">
                    @if ($items->count())
                        <?php $noTasks = false; ?>

                        <div class="list-group-item"><h4>{{ trans('misc.' . $key) }}</h4></div>

                        @foreach ($items as $task)
                            <a href="{{ URL::route('task.show', $task->id) }}" class="list-group-item {{ $key == 'tasks_late' ? 'tasks_late' : '' }}">
                                <strong>{{ $task->startDateFormated }}</strong> - <strong>{{ $task->taskTypeName }}</strong> {{ $task->name }}
                            </a>
                        @endforeach

                    @endif
                </div>
                @endforeach

                @if ($noTasks)
                <div class="panel-body">
                    <p>No hay ninguna tarea programada.</p>
                </div>
                @endif

            </div>
        </div>

        <div class="col-md-6">

            <div class="panel panel-default box">
                <div class="panel-heading">
                    <div class="panel-title">
                        <div class="icon">{{ app_icon_tag('Event') }}</div>
                        listado de eventos
                        <div class="btn-group">
                            <a class="btn btn-primary" href="{{ URL::route('task.create', 'event') }}">{{ app_icon_tag('create') }} crear</a>
                        </div>
                    </div>
                </div>

                <?php $noEvents = true ?>
                
                @foreach ($events as $key => $items)
                <div class="list-group tasks">
                    @if ($items->count())
                        <?php $noEvents = false; ?>

                        <div class="list-group-item"><h4>{{ trans('misc.' . $key) }}</h4></div>

                        @foreach ($items as $event)
                            <a href="{{ URL::route('task.show', $event->id) }}" class="list-group-item {{ $key == 'tasks_late' ? 'tasks_late' : '' }}">
                                <strong>{{ $event->startDateFormated }}</strong> - <strong>{{ $event->taskTypeName }}</strong> {{ $event->name }}
                            </a>
                        @endforeach

                    @endif
                </div>
                @endforeach

                @if ($noEvents)
                <div class="panel-body">
                    <p>No hay ningún evento programado.</p>
                </div>
                @endif

            </div>
        </div>

    </div>

@stop