@extends ('Config::layout')

@section ('configHeading')
    usuarios
@stop

@section ('configContent')

    <table class="table table-striped table-hover">

        <thead>
            <tr>
                <th>Usuario</th>
                <th>E-Mail</th>
                <th>Equipo</th>
                <th>Rol</th>
                <th>Último acceso</th>
                <th></th>
            </tr>
        </thead>
        
        @foreach ($users as $user)

            <tr>
                <td>{{ $user->username}} </td>
                <td>{{ $user->email }}</td>
                <td></td>
                <td></td>
                <td>{{ $user->last_seen }}</td>
                <td>
                    <button type="button" class="btn btn-primary btn-xs" data-toggle="collapse" data-target="#editUser{{$user->id}}">
                        editar
                    </button>
                </td>
            </tr>

            <tr class="collapse" id="editUser{{$user->id}}">
                <td colspan="6">
                    {{ Form::open(array('method' => 'PUT', 'route' => 'config.user.update')) }}
                        {{ Form::hidden('user_id', $user->id) }}

                        <div class="form-group">
                            <label for="name">Nombre</label>
                            {{ Form::text('username' . $user->id, $user->username, array('class' => 'form-control', 'required' => 'required')) }}
                        </div>

                        <div class="form-group">
                            <label for="name">E-Mail</label>
                            {{ Form::email('email' . $user->id, $user->email, array('class' => 'form-control', 'required' => 'required')) }}
                        </div>

                        <button type="submit" class="btn btn-primary">guardar</button>
                        <button type="button" class="btn btn-danger" data-parent="#asdf" data-toggle="collapse" data-target="#editUser{{$user->id}}">cancelar</button>

                    {{ Form::close() }}
                </td>
            </tr>

        @endforeach

    </table>

    <hr>

    <div class="well well-small">

        <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#newUser">
            añadir nuevo
        </button>

        <div id="newUser" class="collapse {{ Input::old() ? 'in' : '' }}" style="margin-top: 15px;">
            {{ Form::open(array('route' => 'config.user.store')) }}

                <div class="form-group">
                    <label for="username" class="control-label">Nombre</label>
                    {{ Form::text('username', null, array('class' => 'form-control', 'required' => 'required')) }} 
                    {{ $errors->first('username', '<p class="help-block">:message</p>') }}
                </div>

                <div class="form-group">
                    <label for="name">E-Mail</label>
                    {{ Form::email('email', null, array('class' => 'form-control', 'required' => 'required')) }}
                    {{ $errors->first('email', '<p class="help-block">:message</p>') }}
                </div>

                <div class="form-group">
                    <label for="password" class="control-label">Contraseña</label>
                    {{ Form::input('password', 'password', null, array('class' => 'form-control', 'required' => 'required')) }} 
                    {{ $errors->first('password', '<p class="help-block">:message</p>') }}
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="control-label">Confirmar contraseña</label>
                    {{ Form::input('password', 'password_confirmation', null, array('class' => 'form-control', 'required' => 'required')) }} 
                    {{ $errors->first('password_confirmation', '<p class="help-block">:message</p>') }}
                </div>

                <button type="submit" class="btn btn-primary">guardar</button>
                <button type="reset" class="btn btn-danger" data-toggle="collapse" data-target="#newUser">cancelar</button>


            {{ Form::close() }}
        </div>

    </div>

@stop