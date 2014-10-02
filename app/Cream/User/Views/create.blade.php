@extends('layout.main')

@section('content')

    <div class="page-header">
        <h1>Usuarios 
            <small>/ crear usuario</small>
        </h1> 
    </div>

    <div class="row">
        <div class="col-md-12">
            
            @if (isset($user))
            {{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT')) }}
            @else
            {{ Form::open(array('route' => 'users.store')) }}
            @endif

                <div class="form-group">
                    <label for="username">Nombre de usuario</label>
                    {{ Form::text('username', null, array('class' => 'form-control', 'placeholder' => 'Introduzca el nombre')) }}
                    {{ $errors->first('username', '<p class="help-block">:message</p>') }}
                </div>

                <div class="form-group">
                    <label for="email">E-Mail</label>
                    {{ Form::email('email', null, array('class' => 'form-control', 'placeholder' => 'Introduzca el e-mail')) }}
                    {{ $errors->first('email', '<p class="help-block">:message</p>') }}
                </div>

                <div class="form-group">
                    <label for="name">Contraseña</label>
                    <div class="row">
                        <div class="col-lg-6">
                            {{ Form::input('password', 'password', null, array('class' => 'form-control', 'placeholder' => 'Introduzca la contraseña')) }}
                            {{ $errors->first('password', '<p class="help-block">:message</p>') }}
                        </div>
                        <div class="col-lg-6">
                            {{ Form::input('password', 'password_confirmation', null, array('class' => 'form-control', 'placeholder' => 'Repita la contraseña')) }}
                            {{ $errors->first('password_confirmation', '<p class="help-block">:message</p>') }}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="rol">Rol</label>
                    {{ Form::select('rol', $roles, null, array('class' => 'form-control')) }}
                    {{ $errors->first('rol', '<p class="help-block">:message</p>') }}
                </div>      
              
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ URL::route('users.index') }}" class="btn btn-danger">Cancelar</a>
            {{ Form::close() }}
        </div>

    </div>

@stop