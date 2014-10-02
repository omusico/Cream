@extends ('Config::layout')

@section ('configHeading')
    estados
@stop

@section ('configContent')

    <p>Los estados le ayudan a ordenar y priorizar sus relaciones con sus contactos. Puede editar los estados por defecto, añadir nuevos y/o ordenarlos.</p>

    @if ($statuses->count())

    <ul class="list-group sortable hide-buttons">
        
        @foreach ($statuses as $status)
        <li class="list-group-item" id="item_{{ $status->id }}">
            {{ app_icon_tag('sortable') }}
            <span class="label label-status label-{{ $status->color }}">{{ $status->name }}</span>
            <span class="pull-right">
                <a class="btn btn-primary btn-xs" data-toggle="collapse" href="#editStatus{{$status->id}}">editar</a> <a href="{{ URL::route('config.status.destroy', $status->id) }}" class="btn btn-danger btn-xs" onclick="return confirm('¿Está serguro de que quiere eliminar este elemento?');">eliminar</a>
            </span>

            <div id="editStatus{{$status->id}}" class="collapse" style="margin-top: 15px;">
                {{ Form::open(array('method' => 'PUT', 'route' => 'config.status.update')) }}
                    {{ Form::hidden('status_id', $status->id) }}

                    <div class="form-group">
                        <label for="name">Nombre</label>
                        {{ Form::text('name' . $status->id, $status->name, array('class' => 'form-control', 'required' => 'required')) }}
                    </div>

                    @include ('Config::Status.radios', array('statusId' => $status->id))

                    <button type="submit" class="btn btn-primary">guardar</button>
                    <button type="button" class="btn btn-danger" data-parent="#asdf" data-toggle="collapse" data-target="#editStatus{{$status->id}}">cancelar</button>

                {{ Form::close() }}
            </div>
        </li>
        @endforeach

    </ul>

    <hr>

    @endif

    <div class="well well-small">

        @if ( ! $statuses->count())

        <p>No existe ningún estado en este momento. Considere añadir uno nuevo ahora.</p>

        @endif

        <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#newStatus">
            añadir nuevo
        </button>

        <div id="newStatus" class="collapse {{ Input::old() ? 'in' : '' }}" style="margin-top: 15px;">
            {{ Form::open(array('route' => 'config.status.store')) }}

                <div class="form-group">
                    <label for="name" class="control-label">Nombre</label>
                    {{ Form::text('name', null, array('class' => 'form-control', 'required' => 'required')) }} 
                    {{ $errors->first('name', '<p class="help-block">:message</p>') }}
                </div>

                @include ('Config::Status.radios')

                <button type="submit" class="btn btn-primary">guardar</button>
                <button type="reset" class="btn btn-danger" data-toggle="collapse" data-target="#newStatus">cancelar</button>


            {{ Form::close() }}
        </div>

    </div>

@stop