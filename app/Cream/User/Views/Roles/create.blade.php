@extends('layout.main')

@section('content')

    <div class="page-header">
        <h1>Roles 
            <small>/ crear rol</small>
        </h1> 
    </div>

    <div class="row">
        <div class="col-md-12">
            <form role="form">
                <div class="form-group">
                    <label for="name">Nombre del rol</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Introduzca el nombre">
                </div>
                
                <div class="form-group">
                    <label for="permissions">Permisos asignados</label>

                    <div>
                        <label>
                            <input type="checkbox" value="">
                            Option one is this and that&mdash;be sure to include why it's great
                        </label>
                    </div>
                </div>

                
              
                <button type="submit" class="btn btn-default">Guardar</button>
            </form>
        </div>

    </div>

@stop