<header class="navbar navbar-inverse navbar-static-top" role="banner">
  <div class="container">
    <div class="navbar-header">
      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="../" class="navbar-brand">Cream</a>
    </div>
    <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
      <ul class="nav navbar-nav">
        <li class="active">
          <a href="{{ URL::route('company.index') }}">Empresas</a>
        </li>
        <li>
          <a href="{{ URL::route('people.index') }}">Contactos</a>
        </li>
        <li>
          <a href="../opportunity">Oportunidades</a>
        </li>
        <li>
          <a href="../taks">Tareas</a>
        </li>
        <li>
          <a href="{{URL::previous()}}">Back</a>
        </li>
      </ul>
    </nav>
  </div>
</header>