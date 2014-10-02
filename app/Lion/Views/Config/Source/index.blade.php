@extends ('Config::layout')

@section ('configHeading')
    fuentes
@stop

@section ('configContent')

    <p>Una fuente le ayuda a entender qué planes de márketing están maneniendo su empresa.</p>
    <p>Puede utilizar las fuentes por defecto, crear, editar, eliminar o reordenar las existentes.</p>

    @if ($sources->count())

    <ul class="list-group sortable hide-buttons">
        
        @foreach ($sources as $source)
        <li class="list-group-item" id="item_{{ $source->id }}">
            {{ app_icon_tag('sortable') }}
            {{ $source->name }}
            <span class="pull-right">
                <a class="btn btn-primary btn-xs" data-toggle="collapse" href="#editSource{{$source->id}}">editar</a> <a href="{{ URL::route('config.sources.destroy', $source->id) }}" class="btn btn-danger btn-xs" onclick="return confirm('¿Está serguro de que quiere eliminar este elemento?');">eliminar</a>
            </span>

            <div id="editSource{{$source->id}}" class="collapse" style="margin-top: 15px;">
                {{ Form::open(array('method' => 'PUT', 'route' => 'config.sources.update')) }}
                    {{ Form::hidden('source_id', $source->id) }}

                    <div class="form-group">
                        <label for="name">Nombre</label>
                        {{ Form::text('name' . $source->id, $source->name, array('class' => 'form-control', 'required' => 'required')) }}
                    </div>

                    <button type="submit" class="btn btn-primary">guardar</button>
                    <button type="button" class="btn btn-danger" data-parent="#asdf" data-toggle="collapse" data-target="#editSource{{$source->id}}">cancelar</button>

                {{ Form::close() }}
            </div>
        </li>
        @endforeach

    </ul>

    <hr>

    @endif

    <div class="well well-small">

        @if ( ! $sources->count())

        <p>No existe ninguna fuente registrada en este momento. Considere crear algunas fuentes ahora.</p>

        @endif

        <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#newSource">
            añadir nueva
        </button>

        <div id="newSource" class="collapse {{ Input::old() ? 'in' : '' }}" style="margin-top: 15px;">
            {{ Form::open(array('route' => 'config.sources.store')) }}

                <div class="form-group">
                    <label for="name" class="control-label">Nombre</label>
                    {{ Form::text('name', null, array('class' => 'form-control', 'required' => 'required')) }} 
                    {{ $errors->first('name', '<p class="help-block">:message</p>') }}
                </div>

                <button type="submit" class="btn btn-primary">guardar</button>
                <button type="reset" class="btn btn-danger" data-toggle="collapse" data-target="#newSource">cancelar</button>


            {{ Form::close() }}
        </div>

    </div>

@stop