@extends('layout.login')

@section('content')

<h4>Resetear contraseña</h4> 

@if ( Session::get('error') )
    <div class="alert alert-danger">{{{ Session::get('error') }}}</div>
@endif

@if ( Session::get('notice') )
    <div class="alert alert-info">{{{ Session::get('notice') }}}</div>
@endif

<form method="POST" action="{{{ (Confide::checkAction('UserController@do_reset_password'))    ?: URL::to('/user/reset') }}}" accept-charset="UTF-8">
<input type="hidden" name="token" value="{{{ $token }}}">
<input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
    
    <input class="form-control input-large" name="password" type="password" placeholder="contraseña"/>
    <input class="form-control input-large" name="password_confirmation" type="password" placeholder="repetir contraseña"/>
    
    <button type="submit" class="btn btn-primary col-xs-12">Enviar</button>

{{ Form::close() }}

@stop