@extends ('Action::timeline.createlayout')

@section ('assignments')
@if (($controller != 'People') && ($entity->people->count()))

    <div class="form-group">
        <label for="people" class="col-sm-2 control-label">Contacto:</label>
        <div class="col-sm-10">
            {{ Form::select('people', array('' => '- Ninguno -') + $entity->people->lists('name', 'id'), null, array('class' => 'form-control', 'ng-model' => 'people') )}}
        </div>
    </div>

@endif

@if (($controller != 'Deal') && ($entity->deals->count()))

    <div class="form-group">
        <label for="deal" class="col-sm-2 control-label">Operación:</label>
        <div class="col-sm-10">
            {{ Form::select('deal', array('' => '- Ninguna -') + $entity->deals->lists('name', 'id'), null, array('class' => 'form-control', 'ng-model' => 'deal') )}}
        </div>
    </div>

@endif

@stop