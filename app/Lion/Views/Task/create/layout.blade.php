@extends ('layout.main')

@section ('content')

<div class="page-header">
    <h1>Tareas 
        <small>/ crear @yield ('heading_type')</small>
    </h1> 
</div>

<!-- #taskLayout -->
<div id="taskLayout">
    
    @if (isset($entity))
        {{ Form::model($entity, ['method' => 'PUT', 'route' => array('task.update', $entity->id)]) }} 
    @else
        {{ Form::open(['route' => 'task.store']) }}
    @endif

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="#" class="btn btn-danger">Cancelar</a>

        <hr>

        <div class="form-group">
            <label for="name" class="label-control">Nombre</label>
            {{ Form::text('name', null, array('class' => 'form-control', 'required')) }}
            {{ $errors->first('name', '<p class="help-block">:message</p>') }}
        </div>

        <div select-entity data-entity_type="{{ isset($entity) ? $entity->getMainRelatedType() : Input::old('entity_type') }}" data-entity_id="{{ isset($entity) ? $entity->getMainRelatedId() : Input::old('entity_id') }}" data-relations='{{ isset($entity) ? $entity->assignments : '' }}'></div>

        <div class="form-group">
            <label for="task_type" class="label-control">Tipo</label>
            {{ Form::select('task_type', $taskTypes, null, array('class' => 'form-control')) }}
            {{ $errors->first('task_type', '<p class="help-block">:message</p>') }}
        </div>

        @yield ('dates')

        <div class="form-group">
            <label for="description" class="label-control">Descripción</label>
            {{ Form::textarea('description', null, array('class' => 'form-control', 'rows' => 4, 'required')) }}
            {{ $errors->first('description', '<p class="help-block">:message</p>') }}
        </div>

        <hr>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ URL::route('task.index') }}" class="btn btn-danger">Cancelar</a>

    {{ Form::close() }}

</div>

<!-- /#taskLayout -->
@stop