@extends ('Config::layout')

@section ('configHeading')
    fases de operación
@stop

@section ('configContent')

    <p>Las fases de operación le permiten definir sus procesos de venta. Cada fase tiene asociada una probabilidad que indica qué probabilidades tiene una operación de ser cerrada.</p>
    <p>Utilice las fases por defecto, o puede configurarlas editándolas, añadiendo o eliminando.</p>

    <ul class="list-group hide-buttons">
        
        @foreach ($stages as $stage)

        <?php $class = ($stage->probability == 0 ? 'lost' : ($stage->probability == 100 ? 'won' : '')); ?>

        <li class="list-group-item {{ $class }}">
            <span class="text-muted" style="display: inline-block; width: 40px">{{ $stage->probability }}%</span>
            {{ $stage->name }}

            <span class="pull-right">
                <a class="btn btn-primary btn-xs" data-toggle="collapse" href="#editStage{{$stage->id}}">editar</a>
                @if ( ! $stage->isWonOrLost())
                    <a href="{{ URL::route('config.stages.destroy', $stage->id) }}" class="btn btn-danger btn-xs" onclick="return confirm('¿Está serguro de que quiere eliminar este elemento?');">eliminar</a>
                @endif
                
            </span>

            <div id="editStage{{$stage->id}}" class="collapse" style="margin-top: 15px;">
                {{ Form::open(array('method' => 'PUT', 'route' => 'config.stages.update')) }}
                    {{ Form::hidden('stage_id', $stage->id) }}

                    <div class="form-group">
                        <label for="name">Nombre</label>
                        {{ Form::text('name' . $stage->id, $stage->name, array('class' => 'form-control', 'required' => 'required')) }}
                    </div>

                    @if (($stage->probability != 0) && ($stage->probability != 100))
                    <div class="form-group">
                        <label for="probability">Probabilidad</label>
                        {{ Form::text('probability' . $stage->id, $stage->probability, array('class' => 'form-control', 'required' => 'required', 'placeholder' => '1% - 99%')) }}
                    </div>
                    @endif

                    <button type="submit" class="btn btn-primary">guardar</button>
                    <button type="button" class="btn btn-danger" data-parent="#asdf" data-toggle="collapse" data-target="#editStage{{$stage->id}}">cancelar</button>

                {{ Form::close() }}
            </div>
        </li>
        @endforeach

    </ul>

    <hr>

    <div class="well well-small">

        <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#newStage">
            añadir nueva
        </button>

        <div id="newStage" class="collapse {{ Input::old() ? 'in' : '' }}" style="margin-top: 15px;">
            {{ Form::open(array('route' => 'config.stages.store')) }}

                <div class="form-group">
                    <label for="name" class="control-label">Nombre</label>
                    {{ Form::text('name', null, array('class' => 'form-control', 'required' => 'required')) }} 
                    {{ $errors->first('name', '<p class="help-block">:message</p>') }}
                </div>

                <div class="form-group">
                    <label for="probability">Probabilidad</label>
                    {{ Form::text('probability', null, array('class' => 'form-control', 'required' => 'required', 'placeholder' => '1% - 99%')) }}
                    {{ $errors->first('probability', '<p class="help-block">:message</p>') }}
                </div>

                <button type="submit" class="btn btn-primary">guardar</button>
                <button type="reset" class="btn btn-danger" data-toggle="collapse" data-target="#newStage">cancelar</button>


            {{ Form::close() }}
        </div>

    </div>

@stop