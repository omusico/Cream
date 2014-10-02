@extends('layout.main')

@section('content')

    <div class="page-header">
        <h1>Operación 
            <small>/ {{ isset($deal) ? $deal->name : 'crear operación' }}</small>
        </h1> 
    </div>
 
    @if (isset($deal))
    {{ Form::model($deal, array('route' => array('deal.update', $deal->id), 'method' => 'PUT')) }}
    @else
    {{ Form::open(array('route' => 'deal.store')) }}
    @include ('layout.widgets.redirect')
    @endif

    <button type="submit" class="btn btn-primary" style="margin-bottom: 10px;">Guardar</button>
    <a href="{{ URL::route('deal.index') }}" class="btn btn-danger" style="margin-bottom: 10px;">Cancelar</a>    

    <fieldset>
        <legend><h3>Empresa</h3></legend>

        <div class="form-group">
            <label for="company_id">Empresa</label>
            {{ Form::text('company_id', isset($company_id) ? $company_id : null, array('select-company', 'style' => 'width: 100%', 'ng-change' => 'clear()')) }}
            {{ $errors->first('company_id', '<p class="help-block">:message</p>') }}
        </div>

    </fieldset>

    <fieldset>
        <legend><h3>Información</h3></legend>
        <div class="row">
            <div class="col-md-6">

                <div class="form-group">
                    <label for="name">Título</label>
                    {{ Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Introduzca un título')) }}
                    {{ $errors->first('name', '<p class="help-block">:message</p>') }}
                </div>

                <div class="form-group">
                    <label for="description">Descripción</label>
                    {{ Form::textarea('description', null, array('class' => 'form-control', 'placeholder' => 'Descripción de operación')) }}
                    {{ $errors->first('description', '<p class="help-block">:message</p>') }}
                </div>

                <div class="form-group">
                    <label for="amount">Cantidad (€)</label>
                    {{ Form::text('amount', null, array('class' => 'form-control', 'placeholder' => 'Cantidad en Euros')) }}
                    {{ $errors->first('amount', '<p class="help-block">:message</p>') }}
                </div>

            </div>

            <div class="col-md-6">
                               
                <div class="form-group">
                    <label for="stage_id">Fase</label>
                    {{ Form::select('stage_id', $stages, null, array('class' => 'form-control')) }}
                    {{ $errors->first('stage_id', '<p class="help-block">:message</p>') }}
                </div>

                <div class="form-group">
                    <label for="probability">Probabilidad de cierre</label>
                    {{ Form::text('probability', null, array('class' => 'form-control', 'placeholder' => '% de probabilidad 0 - 100')) }}
                    {{ $errors->first('probability', '<p class="help-block">:message</p>') }}
                </div>

                <div class="form-group">
                    <label for="status_id">Estado</label>
                    {{ Form::select('status_id', $statuses, null, array('class' => 'form-control')) }}
                    {{ $errors->first('status_id', '<p class="help-block">:message</p>') }}
                </div>

                <div class="form-group">
                    <label for="source_id">Fuente</label>
                    {{ Form::select('source_id', $sources, null, array('class' => 'form-control')) }}
                    {{ $errors->first('source_id', '<p class="help-block">:message</p>') }}
                </div>

                <div class="form-group">
                    <label for="expected_close">Fecha de cierre estimada</label>

                    <div class="input-group date form_date" data-date="{{ (isset($deal) ? $deal->expected_close : Input::old('expected_close') ? : '') }}" data-date-format="dd M yyyy" data-link-field="expected_close" data-link-format="yyyy-mm-dd hh:ii">
                        <?php
                            if (Input::old('date'))
                                $dateValue = Input::old('date');
                            elseif (isset($deal))
                                $dateValue = $deal->expectedCloseFormated;
                            else
                                $dateValue = null;
                        ?>
                        {{ Form::text('date', $dateValue, array('class' => 'form-control', 'readonly' => true)) }}
                        <!-- <input class="form-control" id="expected_close" name="expected_close" size="16" type="text" value="" readonly> -->
                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                    <input type="hidden" id="expected_close" name="expected_close" value="{{(isset($deal) ? $deal->expected_close : Input::old('expected_close') ? : '')}}" /><br/>


                    {{-- Form::text('expected_close', null, array('class' => 'form-control', 'placeholder' => 'dd/mm/aaaa')) --}}
                    {{ $errors->first('expected_close', '<p class="help-block">:message</p>') }}
                </div>

            </div>
        </div>

    </fieldset>

    <button type="submit" class="btn btn-primary">Guardar</button>
    <a href="{{ URL::route('deal.index') }}" class="btn btn-danger">Cancelar</a>

    {{ Form::close() }}

@stop