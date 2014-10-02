@extends('layout.main')

@section('content')

    @extends('layout.main')

@section('content')

    <div class="page-header">
        <h1>Usuarios 
            <small>/ gestionar usuarios</small>
            <a href="{{ URL::route('users.create') }}" class="btn btn-success pull-right">Nuevo usuario</a>
        </h1> 
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-hover table-responsive table-hide-buttons">
                <thead>
                    <tr>
                        <th>Avatar</th>
                        <th>Usuario</th>
                        <th>E-Mail</th>
                        <th>Rol</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $user)
                        @if (Session::get('newUserId') == $user->id)
                        <tr class="success">
                        @else                        
                        <tr>
                        @endif
                            <td></td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td><?php //var_dump($user->roles); ?></td>
                            <td align="right"><a href="{{ URL::route('users.edit', $user->id) }}" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-edit"></span> Editar</a></td>
                        </tr>
                    @endforeach

                </tbody>

                <tfoot>
                    
                </tfoot>
            </table>
        </div>

    </div>

@stop

@stop