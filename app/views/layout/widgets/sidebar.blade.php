<!-- Sidebar -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ URL::to('/') }}">Cream <small>/ {{ Auth::user()->accountName }}</small></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li class="menu-title">Menú</li>
            <li class="active"><a href="{{ URL::to('/') }}">{{ app_icon_tag('dashboard') }} Escritorio</a></li>
            <li><a href="{{ URL::route('company.index') }}">{{ app_icon_tag('Company') }} Empresas</a></li>
            <li><a href="{{ URL::route('people.index') }}">{{ app_icon_tag('People') }} Contactos</a></li>
            <li><a href="{{ URL::route('deal.index') }}">{{ app_icon_tag('Deal') }} Operaciones</a></li>
            <li><a href="{{ URL::route('task.index') }}">{{ app_icon_tag('Task') }} Tareas y eventos</a></li>
            <!-- <li><a href="#"><i class="icon-font"></i> Tareas</a></li> -->
            <!-- <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-collapse"></i> Configuración <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="#">Gestión de resultados</a></li>
                    <li><a href="#">Gestión de saludos</a></li>
                </ul>
            </li> -->
        </ul>

        <ul class="nav navbar-nav navbar-right navbar-user">
            <!--<li class="dropdown messages-dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-envelope"></i> Messages <span class="badge">7</span> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li class="dropdown-header">7 New Messages</li>
                    <li class="message-preview">
                        <a href="#">
                            <span class="avatar"><img src="http://placehold.it/50x50"></span>
                            <span class="name">John Smith:</span>
                            <span class="message">Hey there, I wanted to ask you something...</span>
                            <span class="time"><i class="icon-time"></i> 4:34 PM</span>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li class="message-preview">
                        <a href="#">
                            <span class="avatar"><img src="http://placehold.it/50x50"></span>
                            <span class="name">John Smith:</span>
                            <span class="message">Hey there, I wanted to ask you something...</span>
                            <span class="time"><i class="icon-time"></i> 4:34 PM</span>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li class="message-preview">
                        <a href="#">
                            <span class="avatar"><img src="http://placehold.it/50x50"></span>
                            <span class="name">John Smith:</span>
                            <span class="message">Hey there, I wanted to ask you something...</span>
                            <span class="time"><i class="icon-time"></i> 4:34 PM</span>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="#">View Inbox <span class="badge">7</span></a></li>
                </ul>
            </li>-->
            <!-- <li class="dropdown alerts-dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-bell-alt"></i> Alerts <span class="badge">3</span> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="#">Default <span class="label label-default">Default</span></a></li>
                    <li><a href="#">Primary <span class="label label-primary">Primary</span></a></li>
                    <li><a href="#">Success <span class="label label-success">Success</span></a></li>
                    <li><a href="#">Info <span class="label label-info">Info</span></a></li>
                    <li><a href="#">Warning <span class="label label-warning">Warning</span></a></li>
                    <li><a href="#">Danger <span class="label label-danger">Danger</span></a></li>
                    <li class="divider"></li>
                    <li><a href="#">View All</a></li>
                </ul>
            </li> -->
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ app_icon_tag('create') }} Crear <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="{{ URL::route('company.create') }}">{{ app_icon_tag('Company') }} Empresa</a></li>
                    <li><a href="{{ URL::route('people.create') }}">{{ app_icon_tag('People') }} Contacto</a></li>
                    <li><a href="{{ URL::route('deal.create') }}">{{ app_icon_tag('Deal') }} Operación</a></li>
                    <li class="divider"></li>
                    <li class="disabled"><a href="#">{{ app_icon_tag('user') }} Usuario</a></li>
                </ul>
            </li>
            <li class="dropdown user-dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ app_icon_tag('user') }} {{ Auth::user()->username }} <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li class="disabled"><a href="#"><i class="icon-user"></i> Perfil</a></li>
                    <li><a href="{{ URL::route('config.index') }}">{{ app_icon_tag('config') }} Configuración</a></li>
                    <li class="divider"></li>
                    <li><a href="{{ URL::route('user.login.logout') }}">{{ app_icon_tag('logout') }} Salir</a></li>
                </ul>
            </li>
        </ul>
    </div><!-- /.navbar-collapse -->
</nav>