@extends ('Task::create.layout')

@section ('heading_type')
nuevo evento
@stop

@section ('dates')

    {{ Form::hidden('type', 'event') }}

    <div class="form-group">
        <label for="date" class="label-control">Fecha inicio</label>

        <div class="input-group date event_way_date" data-date="{{ (isset($entity) ? $entity->start_date : Input::old('start_date') ? : '') }}" data-date-format="dd M yyyy hh:ii" data-link-field="start_date" data-link-format="yyyy-mm-dd hh:ii">
            <?php
                if (Input::old('date'))
                    $dateValue = Input::old('date');
                elseif (isset($entity))
                    $dateValue = $entity->startDatetimeFormated;
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

    <div class="form-group">
        <label for="date" class="label-control">Fecha fin</label>

        <div class="input-group date event_way_date" data-date="{{ (isset($entity) ? $entity->end_date : Input::old('end_date') ? : '') }}" data-date-format="dd M yyyy hh:ii" data-link-field="end_date" data-link-format="yyyy-mm-dd hh:ii">
            <?php
                if (Input::old('date2'))
                    $dateValue = Input::old('date2');
                elseif (isset($entity))
                    $dateValue = $entity->endDatetimeFormated;
                else
                    $dateValue = null;
            ?>

            {{ Form::text('date2', $dateValue, array('class' => 'form-control', 'readonly' => true, 'required')) }}
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
        </div>
        {{ $errors->first('end_date', '<p class="help-block">:message</p>') }}
        <input type="hidden" id="end_date" name="end_date" value="{{ (isset($entity) ? $entity->end_date : Input::old('end_date') ? : '') }}" /><br/>
    </div>
    
@stop