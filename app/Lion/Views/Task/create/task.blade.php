@extends ('Task::create.layout')

@section ('heading_type')
nueva tarea
@stop

@section ('dates')

    {{ Form::hidden('type', 'task') }}

    <div class="form-group">
        <label for="date" class="label-control">Fecha</label>

        <div class="input-group date task_way_date" data-date="{{ (isset($entity) ? $entity->start_date : Input::old('start_date') ? : '') }}" data-date-format="dd M yyyy" data-link-field="start_date" data-link-format="yyyy-mm-dd">
            <?php
                if (Input::old('date'))
                    $dateValue = Input::old('date');
                elseif (isset($entity))
                    $dateValue = $entity->startDateFormated;
                else
                    $dateValue = null;
            ?>

            {{ Form::text('date', $dateValue, array('class' => 'form-control', 'readonly' => true, 'required')) }}
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
        </div>
        {{ $errors->first('start_date', '<p class="help-block">:message</p>') }}
        <input type="hidden" id="start_date" name="start_date" value="{{ (isset($entity) ? $entity->start_date : Input::old('start_date') ? : '') }}" /><br/>
    </div>
    
@stop