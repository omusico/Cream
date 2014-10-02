@extends('layout.login')

@section('content')

<h4>Recuperar contraseña</h4> 

@if ( Session::get('error') )
    <div class="alert alert-danger">{{{ Session::get('error') }}}</div>
@endif

@if ( Session::get('notice') )
    <div class="alert alert-info">{{{ Session::get('notice') }}}</div>
@endif

{{ Form::open(array('class' => 'form-horizontal')) }}
    
    <input class="form-control input-large" name="email" id="username" type="text" placeholder="e-mail de registro"/>
    
    <button type="submit" class="btn btn-primary col-xs-12">Enviar</button>

{{ Form::close() }}

@stop