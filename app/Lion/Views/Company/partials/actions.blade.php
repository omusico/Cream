<nav class="navbar navbar-default" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Acciones</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav">
            <li><a href="{{ URL::route('company.create') }}"><span class="glyphicon glyphicon-plus"></span> Nueva</a></li>
        </ul>
        <form class="navbar-form" role="search">
            <div class="col-md-3">
                <div class="input-group">
                    <input type="text" class="form-control col-md-3">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="sumbit"><span class="glyphicon glyphicon-search"></span> Ir!</button>
                    </span>
                </div><!-- /input-group -->
            </div>
        </form>
    </div><!-- /.navbar-collapse -->
</nav>

<!-- <ul class="nav nav-pills">
    <li {{ (Request::is('company') ? 'class="active"' : '') }} >
        <a href="{{ URL::route('company.index') }}">
            <span class="badge pull-right">{{ $companies->count() }}</span>
            Resultados
        </a>
    </li>
    <li {{ (Request::is('*deleted*') ? 'class="active"' : '') }} >
        <a href="{{ URL::route('company.trash') }}">
            <span class="badge pull-right">{{ $trashedCompanies->count() }}</span>
            Papelera
        </a>
    </li>
</ul> -->