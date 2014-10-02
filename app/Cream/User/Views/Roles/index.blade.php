@extends('layout.main')

@section('content')

    <div class="page-header">
        <h1>Roles 
            <small>/ gestionar permisos</small>
            <a href="#" class="btn btn-success pull-right">Nuevo ROL</a>
        </h1> 
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-hover table-hide-buttons">
                <thead>
                    <tr>
                        <th>ROL</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($roles as $role)
                        @if ($role->name == 'Admin')
                            <tr>
                                <td>{{ $role->name }}</td>
                                <td></td>
                            </tr>
                        @else
                            <tr>
                                <td>{{ $role->name }}</td>
                                <td align="right"><a href="#" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-edit"></span> Editar</a></td>
                            </tr>
                        @endif
                    @endforeach

                </tbody>

                <tfoot>
                    
                </tfoot>
            </table>
        </div>

    </div>

@stop