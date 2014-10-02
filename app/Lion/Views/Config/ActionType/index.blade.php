@extends ('Config::layout')

@section ('configHeading')
    categorías de acción
@stop

@section ('configContent')

    <p>Las categorías de acción le permiten clasificar sus esfuerzos de ventas en categorías con el objetivo de realizar un seguimiento más efectivo.</p>
    <p>Puede editar las categorías por defecto de la lista de abajo o añadir nuevas tales como: Reunión, Negociación de operación...</p>
    <p>Iconos: <a href="http://fontawesome.io/icons/" class="link">Font Awesome</a> -  introducir el nombre del icono (ejemplo: fa-road)</p>
    <p>Colores: <a href="http://html-color-codes.info/" class="link">HTML Color Codes</a> - recordar introducir el caracter almoadilla (ejemplo: #FFFFFF)</p>

    @if ($actionTypes->count())

    <ul class="list-group sortable hide-buttons">
        
        @foreach ($actionTypes as $type)
        <li class="list-group-item" id="item_{{ $type->id }}">
            {{ app_icon_tag('sortable') }}
            {{ $type->name }} 
            @if ($type->track_duration)
            {{ app_icon_tag('time') }}
            @endif
            <span class="pull-right">
                <a class="btn btn-primary btn-xs" data-toggle="collapse" href="#editType{{$type->id}}">editar</a> <a href="{{ URL::route('config.actiontypes.destroy', $type->id) }}" class="btn btn-danger btn-xs" onclick="return confirm('¿Está serguro de que quiere eliminar este elemento?');">eliminar</a>
            </span>

            <div id="editType{{$type->id}}" class="collapse" style="margin-top: 15px;">
                {{ Form::open(array('method' => 'PUT', 'route' => 'config.actiontypes.update')) }}
                    {{ Form::hidden('action_type_id', $type->id) }}

                    <div class="form-group">
                        <label for="name">Nombre</label>
                        {{ Form::text('name' . $type->id, $type->name, array('class' => 'form-control', 'required' => 'required')) }}
                    </div>

                    <div class="form-group">
                        <label for="icon">Icono</label>
                        {{ Form::text('icon' . $type->id, $type->icon, array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group">
                        <label for="bgcolor">Color de fondo</label>
                        {{ Form::text('bgcolor' . $type->id, $type->bgcolor, array('class' => 'form-control', 'placeholder' => '#404040')) }}
                    </div>

                    <div class="form-group">
                        <label for="color">Color de texto</label>
                        {{ Form::text('color' . $type->id, $type->color, array('class' => 'form-control', 'placeholder' => '#000000')) }}
                    </div>

                    <div class="checkbox">
                        <label>

                            {{ Form::checkbox('track_duration' . $type->id, 'true', $type->track_duration) }} Activar seguimiento de duración en minutos.
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary">guardar</button>
                    <button type="button" class="btn btn-danger" data-parent="#asdf" data-toggle="collapse" data-target="#editType{{$type->id}}">cancelar</button>

                {{ Form::close() }}
            </div>
        </li>
        @endforeach

    </ul>

    <hr>

    @endif

    <div class="well well-small">

        @if ( ! $actionTypes->count())

        <p>No existe ninguna categoría de acción en este momento. Considere añadir una nueva ahora.</p>

        @endif

        <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#newType">
            añadir nueva
        </button>

        <div id="newType" class="collapse {{ Input::old() ? 'in' : '' }}" style="margin-top: 15px;">
            {{ Form::open(array('route' => 'config.actiontypes.store')) }}

                <div class="form-group">
                    <label for="name" class="control-label">Nombre</label>
                    {{ Form::text('name', null, array('class' => 'form-control', 'required' => 'required')) }} 
                    {{ $errors->first('name', '<p class="help-block">:message</p>') }}
                </div>

                <div class="form-group">
                    <label for="icon">Icono</label>
                    {{ Form::text('icon', null, array('class' => 'form-control')) }}
                </div>

                <div class="form-group">
                    <label for="bgcolor">Color de fondo</label>
                    {{ Form::text('bgcolor', null, array('class' => 'form-control', 'placeholder' => '#000000')) }}
                </div>

                <div class="form-group">
                    <label for="color">Color</label>
                    {{ Form::text('color', null, array('class' => 'form-control', 'placeholder' => '#404040')) }}
                </div>

                <div class="checkbox">
                    <label>
                        {{ Form::checkbox('track_duration', 'true') }} Activar seguimiento de duración en minutos.
                    </label>
                </div>

                <button type="submit" class="btn btn-primary">guardar</button>
                <button type="reset" class="btn btn-danger" data-toggle="collapse" data-target="#newType">cancelar</button>


            {{ Form::close() }}
        </div>

    </div>

@stop