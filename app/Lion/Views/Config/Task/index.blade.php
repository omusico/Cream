@extends ('Config::layout')

@section ('configHeading')
    tareas y eventos
@stop

@section ('configContent')

    <p>Las tareas y eventos le permiten trackear tipos de actividades específicas en el calendario.</p>
    <p>Puede editar los tipos de tareas de la lista a continutación. Pruebe a añadir, eliminar, modificar o reordenar.</p>

    @if ($tasks->count())

    <ul class="list-group sortable hide-buttons">
        
        @foreach ($tasks as $task)
        <li class="list-group-item" id="item_{{ $task->id }}">
            {{ app_icon_tag('sortable') }}
            {{ $task->name }}
            <span class="pull-right">
                <a class="btn btn-primary btn-xs" data-toggle="collapse" href="#editTask{{$task->id}}">editar</a> <a href="{{ URL::route('config.task.destroy', $task->id) }}" class="btn btn-danger btn-xs" onclick="return confirm('¿Está serguro de que quiere eliminar este elemento?');">eliminar</a>
            </span>

            <div id="editTask{{$task->id}}" class="collapse" style="margin-top: 15px;">
                {{ Form::open(array('method' => 'PUT', 'route' => 'config.task.update')) }}
                    {{ Form::hidden('task_id', $task->id) }}

                    <div class="form-group">
                        <label for="name">Nombre</label>
                        {{ Form::text('name' . $task->id, $task->name, array('class' => 'form-control', 'required' => 'required')) }}
                    </div>

                    <div class="form-group">
                        <label for="name">Acción relacionada (opcional):</label>
                        {{ Form::select('action_type' . $task->id, $actions, $task->action_type, array('class' => 'form-control')) }}
                    </div>

                    <button type="submit" class="btn btn-primary">guardar</button>
                    <button type="button" class="btn btn-danger" data-parent="#asdf" data-toggle="collapse" data-target="#editTask{{$task->id}}">cancelar</button>

                {{ Form::close() }}
            </div>
        </li>
        @endforeach

    </ul>

    <hr>

    @endif

    <div class="well well-small">

        @if ( ! $tasks->count())

        <p>No existe ninguna fuente registrada en este momento. Considere crear algunas fuentes ahora.</p>

        @endif

        <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#newTask">
            añadir nueva
        </button>

        <div id="newTask" class="collapse {{ Input::old() ? 'in' : '' }}" style="margin-top: 15px;">
            {{ Form::open(array('route' => 'config.task.store')) }}

                <div class="form-group">
                    <label for="name" class="control-label">Nombre</label>
                    {{ Form::text('name', null, array('class' => 'form-control', 'required' => 'required')) }} 
                    {{ $errors->first('name', '<p class="help-block">:message</p>') }}
                </div>

                <div class="form-group">
                    <label for="name">Acción relacionada (opcional):</label>
                    {{ Form::select('action_type', $actions, null, array('class' => 'form-control')) }}
                </div>

                <button type="submit" class="btn btn-primary">guardar</button>
                <button type="reset" class="btn btn-danger" data-toggle="collapse" data-target="#newTask">cancelar</button>


            {{ Form::close() }}
        </div>

    </div>

@stop