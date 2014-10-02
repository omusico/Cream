@extends('layout.main')

@section('content')

    <div class="page-header">
        <h1>Empresa 
            <small>/ {{ isset($company) ? $company->name : 'crear empresa' }}</small>
        </h1> 
    </div>
 
    @if (isset($company))
    {{ Form::model($company, array('route' => array('company.update', $company->id), 'method' => 'PUT')) }}
    @else
    {{ Form::open(array('route' => 'company.store')) }}
    @endif

    <button type="submit" class="btn btn-primary" style="margin-bottom: 10px;">Guardar</button>
    <a href="{{ URL::route('company.index') }}" class="btn btn-danger" style="margin-bottom: 10px;">Cancelar</a>

    <fieldset>
        <legend><h3>Información de contacto</h3></legend>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Nombre fiscal</label>
                    {{ Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Introduzca la razón social')) }}
                    {{ $errors->first('name', '<p class="help-block">:message</p>') }}
                </div>

                <div class="form-group">
                    <label for="commercial_name">Nombre comercial</label>
                    {{ Form::text('commercial_name', null, array('class' => 'form-control', 'placeholder' => 'Introduzca el nombre corporativo')) }}
                    {{ $errors->first('commercial_name', '<p class="help-block">:message</p>') }}
                </div>

                <div class="form-group">
                    <label for="code">Código de cliente</label>
                    {{ Form::text('code', null, array('class' => 'form-control', 'placeholder' => 'Código de cliente')) }}
                    {{ $errors->first('code', '<p class="help-block">:message</p>') }}
                </div>

                <div class="form-group">
                    <label for="vat_number">Código de Identificación Fiscal</label>
                    {{ Form::text('vat_number', null, array('class' => 'form-control', 'placeholder' => 'Número de identificación (CIF)')) }}
                    {{ $errors->first('vat_number', '<p class="help-block">:message</p>') }}
                </div>

                <div class="form-group">
                    <label for="email">E-Mail</label>
                    {{ Form::email('email', null, array('class' => 'form-control', 'placeholder' => 'Introduzca el e-mail@dominio.com')) }}
                    {{ $errors->first('email', '<p class="help-block">:message</p>') }}
                </div>


            </div>

            <div class="col-md-6">
                
                <div class="form-group">
                    <label for="website">Sitio web</label>
                    {{ Form::text('website', null, array('class' => 'form-control', 'placeholder' => 'Introduzca la dirección URL')) }}
                    {{ $errors->first('website', '<p class="help-block">:message</p>') }}
                </div>
                
                <div class="form-group">
                    <label for="phone_1">Teléfono 1</label>
                    {{ Form::text('phone_1', null, array('class' => 'form-control', 'placeholder' => 'Introduzca el teléfono principal')) }}
                    {{ $errors->first('phone_1', '<p class="help-block">:message</p>') }}
                </div>

                <div class="form-group">
                    <label for="phone_2">Teléfono 2</label>
                    {{ Form::text('phone_2', null, array('class' => 'form-control', 'placeholder' => 'Introduzca el teléfono secundario/fax')) }}
                    {{ $errors->first('phone_2', '<p class="help-block">:message</p>') }}
                </div>

                <div class="form-group">
                    <label for="mobile_phone">Teléfono móvil</label>
                    {{ Form::text('mobile_phone', null, array('class' => 'form-control', 'placeholder' => 'Introduzca el móvil de empresa')) }}
                    {{ $errors->first('mobile_phone', '<p class="help-block">:message</p>') }}
                </div>

            </div>
        </div>

    </fieldset>

    <fieldset>
        <legend><h3>Detalles de empresa</h3></legend>

        <div class="row">
            
            <div class="col-md-6">

                <div class="form-group">
                    <label for="billing">Facturación</label>
                    {{ Form::text('billing', null, array('class' => 'form-control', 'placeholder' => 'Introduzca la facturación en Euros')) }}
                    {{ $errors->first('billing', '<p class="help-block">:message</p>') }}
                </div>

                <div class="form-group">
                    <label for="employees">Nº de empleados</label>
                    {{ Form::text('employees', null, array('class' => 'form-control', 'placeholder' => 'Introduzca el nº de trabajadores')) }}
                    {{ $errors->first('employees', '<p class="help-block">:message</p>') }}
                </div>

                <?php
                    if (isset($company))
                    {
                        if (Input::old())
                            $billingRecords = json_encode(Input::old('bill'));
                        else
                            $billingRecords = $company->billingHistory->toJson();
                    }
                    else
                        $billingRecords = '[]';
                ?>

                <div class="form-group" ng-controller="YearBillingCtrl" ng-init='init({{ $billingRecords }})'>
                    <label for="billing">Ventas por años</label>
                    
                    <div class="row" ng-repeat="year in billing">
                        <div class="col-xs-4">
                            {{ Form::selectRange('bill[ [[$index]] ][year]', date('Y') - 5, date('Y'), null, array('class' => 'form-control', 'ng-model' => 'year.year')) }}
                        </div>
                        <div class="col-xs-6">
                            <div class="input-group">
                                {{ Form::text('bill[ [[$index]] ][amount]', null, array('class' => 'form-control', 'placeholder' => 'ventas en euros', 'ng-model' => 'year.amount')) }}
                                <span class="input-group-addon"><span class="glyphicon glyphicon-euro"></span></span>
                            </div>
                        </div>
                        <div class="col-xs-2">
                            <a href class="btn btn-danger btn-block" ng-click="billing.splice($index, 1)">{{ app_icon_tag('trash') }}</a>
                        </div>
                    </div>

                    <a class="btn btn-primary" ng-click="billing.push({'year' : '', 'amount' : ''})">Añadir nuevo</a>

                </div>

            </div>

            <div class="col-md-6">

                <div class="form-group">
                    <label for="activity_id">Actividad</label>
                    {{ Form::select('activity_id', $activities, null, array('class' => 'form-control', 'placeholder' => 'Seleccione una actividad')) }}
                    {{ $errors->first('activity_id', '<p class="help-block">:message</p>') }}
                </div>

                <div class="form-group">
                    <label for="activity_description">Descripción de actividad</label>
                    {{ Form::text('activity_description', null, array('class' => 'form-control', 'placeholder' => 'Descripción de actividad')) }}
                    {{ $errors->first('activity_description', '<p class="help-block">:message</p>') }}
                </div>

                <div class="form-group">
                    <label for="status_id">Estado</label>
                    {{ Form::select('status_id', $statuses, null, array('class' => 'form-control', 'placeholder' => 'Seleccione un estado')) }}
                    {{ $errors->first('status_id', '<p class="help-block">:message</p>') }}
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
    <a href="{{ URL::route('company.index') }}" class="btn btn-danger">Cancelar</a>

    {{ Form::close() }}

@stop