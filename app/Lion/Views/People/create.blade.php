@extends('layout.main')

@section('content')

    <div class="page-header">
        <h1>Contacto 
            <small>/ {{ isset($people) ? $people->name : 'crear contacto' }}</small>
        </h1> 
    </div>
 
    @if (isset($people))
    {{ Form::model($people, array('route' => array('people.update', $people->id), 'method' => 'PUT')) }}
    @else
    {{ Form::open(array('route' => 'people.store')) }}
    @include ('layout.widgets.redirect')
    @endif

    <button type="submit" class="btn btn-primary" style="margin-bottom: 10px;">Guardar</button>
    <a href="{{ URL::route('people.index') }}" class="btn btn-danger" style="margin-bottom: 10px;">Cancelar</a>    

    <fieldset>
        <legend><h3>Empresa</h3></legend>

        <div class="form-group">
            <label for="salutation">Buscar empresa</label>
            {{ Form::text('company_id', isset($company_id) ? $company_id : null, array('select-company', 'style' => 'width: 100%', 'ng-change' => 'clear()')) }}
            {{ $errors->first('company_id', '<p class="help-block">:message</p>') }}
        </div>

    </fieldset>

    <fieldset>
        <legend><h3>Información de contacto</h3></legend>
        <div class="row">
            <div class="col-md-6">

                <div class="form-group">
                    <label for="name">Nombre completo</label>
                    {{ Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Introduzca el nombre y apellidos')) }}
                    {{ $errors->first('name', '<p class="help-block">:message</p>') }}
                </div>

                <div class="form-group">
                    <label for="department">Departamento</label>
                    {{ Form::text('department', null, array('class' => 'form-control', 'placeholder' => 'Introduzca el nombre de departamento')) }}
                    {{ $errors->first('department', '<p class="help-block">:message</p>') }}
                </div>

                <div class="form-group">
                    <label for="position">Cargo en departamento</label>
                    {{ Form::text('position', null, array('class' => 'form-control', 'placeholder' => 'Introduzca el cargo que ostenta')) }}
                    {{ $errors->first('position', '<p class="help-block">:message</p>') }}
                </div>

                <div class="form-group">
                    <label for="status_id">Estado</label>
                    {{ Form::select('status_id', $statuses, null, array('class' => 'form-control', 'placeholder' => 'Seleccione un estado')) }}
                    {{ $errors->first('status_id', '<p class="help-block">:message</p>') }}
                </div>


            </div>

            <div class="col-md-6">
                               
                <div class="form-group">
                    <label for="phone_1">Teléfono</label>
                    {{ Form::text('phone_1', null, array('class' => 'form-control', 'placeholder' => 'Introduzca el teléfono principal')) }}
                    {{ $errors->first('phone_1', '<p class="help-block">:message</p>') }}
                </div>

                <div class="form-group">
                    <label for="phone_2">Teléfono alternativo</label>
                    {{ Form::text('phone_2', null, array('class' => 'form-control', 'placeholder' => 'Introduzca el teléfono secundario/fax')) }}
                    {{ $errors->first('phone_2', '<p class="help-block">:message</p>') }}
                </div>

                <div class="form-group">
                    <label for="mobile_phone">Teléfono móvil</label>
                    {{ Form::text('mobile_phone', null, array('class' => 'form-control', 'placeholder' => 'Introduzca el móvil')) }}
                    {{ $errors->first('mobile_phone', '<p class="help-block">:message</p>') }}
                </div>

                <div class="form-group">
                    <label for="email_1">E-Mail</label>
                    {{ Form::email('email_1', null, array('class' => 'form-control', 'placeholder' => 'Introduzca el e-mail principal')) }}
                    {{ $errors->first('email_1', '<p class="help-block">:message</p>') }}
                </div>

                <div class="form-group">
                    <label for="email_2">E-Mail alternativo</label>
                    {{ Form::email('email_2', null, array('class' => 'form-control', 'placeholder' => 'Introduzca el e-mail secundario')) }}
                    {{ $errors->first('email_2', '<p class="help-block">:message</p>') }}
                </div>

            </div>
        </div>

    </fieldset>

    <fieldset>
        <legend><h3>Ubicación</h3></legend>

        <div class="row">
            
            <div class="col-md-6">
                <div class="form-group">
                    <label for="address">Dirección</label>
                    {{ Form::text('address', null, array('class' => 'form-control', 'placeholder' => 'Introduzca la dirección')) }}
                    {{ $errors->first('address', '<p class="help-block">:message</p>') }}
                </div>

                <div class="form-group">
                    <label for="postcode">Código postal</label>
                    {{ Form::text('postcode', null, array('class' => 'form-control', 'placeholder' => 'Introduzca el código postal')) }}
                    {{ $errors->first('postcode', '<p class="help-block">:message</p>') }}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="city">Ciudad</label>
                    {{ Form::text('city', null, array('class' => 'form-control', 'placeholder' => 'Introduzca la ciudad')) }}
                    {{ $errors->first('city', '<p class="help-block">:message</p>') }}
                </div>

                <div class="form-group">
                    <label for="state">Provincia</label>
                    {{ Form::text('state', null, array('class' => 'form-control', 'placeholder' => 'Introduzca la provincia')) }}
                    {{ $errors->first('state', '<p class="help-block">:message</p>') }}
                </div>
            </div>

        </div>

    </fieldset>

    <fieldset>
        <legend><h3>Varios</h3></legend>

        <div class="row">
            
            <div class="col-md-12">
                <div class="form-group">
                    <label for="comment">Observaciones</label>
                    {{ Form::textarea('comment', null, array('class' => 'form-control', 'placeholder' => 'Observaciones adicionales de interés.')) }}
                    {{ $errors->first('comment', '<p class="help-block">:message</p>') }}
                </div>
            </div>

        </div>

    </fieldset>

    <button type="submit" class="btn btn-primary">Guardar</button>
    <a href="{{ URL::route('people.index') }}" class="btn btn-danger">Cancelar</a>

    {{ Form::close() }}

@stop