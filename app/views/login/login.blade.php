@extends('layout.login')

@section('content')

<h4>Acceda a su cuenta</h4>

@if ( Session::get('error') )
    <div class="alert alert-danger">{{{ Session::get('error') }}}</div>
@endif

@if ( Session::get('notice') )
    <div class="alert alert-info">{{{ Session::get('notice') }}}</div>
@endif

{{ Form::open(array('class' => 'form-horizontal')) }}
    
    {{ Form::text('email', null, array('class' => 'form-control input-large', 'placeholder' => 'usuario')) }}
    {{ Form::input('password', 'password', null, array('class' => 'form-control input-large', 'placeholder' => 'contraseña')) }}
    <label class="remember" for="remember"> 
        <input type="checkbox" id="remember" />Recordarme
    </label>
    
    <button type="submit" class="btn btn-primary col-xs-12">Acceder</button>

{{ Form::close() }}

<hr>

<h4>¿Olvidó su contraseña?</h4>

<p>Sin problema, haga {{ link_to_route('user.login.forgot', 'clic aquí') }} para obtener una nueva.</p>

@stop