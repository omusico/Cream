@extends ('layout.main')

@section ('content')

<div class="row siderable">

        <div class="col-md-8 sidebar-left">
            
            <h1>configuración <small>/ 
                    @yield ('configHeading')
                </small>
            </h1>
            
            @yield ('configContent')

        </div>

        <div class="col-md-4 sidebar-right">
            
            <h3>{{ app_icon_tag('config') }} menú de configuración</h3>

            <div class="menu-container">

                <ul class="nav nav-pills nav-stacked nav-config">
                    <li class="{{ Request::is('config') ? 'active' : '' }}">{{ link_to_route('config.index', 'resumen') }}</li>
                    <li class="divider"></li>
                    <li class="{{ Request::is('config/account') ? 'active' : '' }}"><a href="#">detalles de cuenta</a></li>
                    <li class="{{ Request::is('config/user') ? 'active' : '' }}">{{ link_to_route('config.user.index', 'usuarios') }}</li>
                    <li class="divider"></li>
                    <li class="disabled"><a href="#">acciones</a></li>
                    <li class="{{ Request::is('config/task') ? 'active' : '' }}">{{ link_to_route('config.task.index', 'tareas y eventos') }}</li>

                    <!-- Editable lists -->
                    <li class="divider"></li>
                    <li class="{{ Request::is('config/status') ? 'active' : '' }}">{{ link_to_route('config.status.index', 'estados') }}</li>
                    <li class="disabled"><a href="#">etiquetas</a></li>
                    <li class="{{ Request::is('config/stages') ? 'active' : '' }}">{{ link_to_route('config.stages.index', 'fases de operación') }}</li>
                    <li class="{{ Request::is('config/sources') ? 'active' : '' }}">{{ link_to_route('config.sources.index', 'fuentes') }}</li>
                    <li class="{{ Request::is('config/actiontypes') ? 'active' : '' }}">{{ link_to_route('config.actiontypes.index', 'categorías de acción') }}</li>
                    
                    <!-- Various -->
                    <li class="divider"></li>
                    <li class="disabled"><a href="#">documentos compartidos</a></li>

                </ul>

            </div>

        </div>

@stop