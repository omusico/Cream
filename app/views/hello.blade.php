@extends ('layout.main')

@section('content')
<br>
<div class="jumbotron">
    <h1>Bienvenido a Cream!</h1>
    <p style="font-weight: 300;">Versión de la aplicación: 0.1b</p>
    <p style="font-weight: 300;">Únicamente de forma temporal, se mostrarán en este apartado las actualizaciones más significativas que va a ir sufriendo la aplicación.</p>
</div>

<div class="well well-sm">
    <h2>Revisión 0.5b</h2>
    <h3><strong>novedades</strong></h3>
    <div class="row">
        <div class="col-md-4">
            <h4>Tareas</h4>
            <p>+ Nueva gestión de tareas operativa</p>
            <h4>Configuración</h4>
            <p>+ Gestión de los tipos de tarea</p>
        </div>
        <div class="col-md-8">
            <h4>Varios</h4>
            <p>+ Mejoras internas y de rendimiento.</p>
            <p>+ Las acciones ahora se pueden asignar a los 3 elementos a la vez (empresa, contacto y operación) para mantener la trazabilidad en el tiempo.</p>
            <p>+ Botones de edición en las vistas de contacto y operación</p>
        </div>
    </div>
</div>

<div class="well well-sm">
    <h2>Revisión 0.1.1b</h2>
    <h3><strong>novedades</strong></h3>
    <div class="row">
        <div class="col-md-4">
            <h4>Configuración</h4>
            <p>+ Listado de fuentes (origen) configurable.</p>
            <p>+ Listado de tipos de acción configurable.</p>
            <p>+ Listado de estados configurable.</p>
            <p>+ Listado de fases de operación configurable.</p>
        </div>
        <div class="col-md-8">
            <h4>Base de datos</h4>
            <p>+ Cambiado el motor por ImnoDB. Hace la base de datos más pesada, sin embargo gana en velocidad y permite las siguientes reestructuraciones.</p>
            <p>+ Reestructuración para elininaciones en cascada.</p>
            <p>+ Reestructuración para asignaciones a nulo automáticas con eliminaciones.</p>
            <p>+ Eliminación de tablas de testeo.</p>
        </div>
    </div>

    <h3><strong>eliminado</strong></h3>
    <div class="row">
        <div class="col-md-8">
            <h4>Elementos</h4>
            <p>- Saludo en contactos. Será reestructurado y añadido de nuevo.</p>
            <p>- Resultados de acciónes (llamada, email y visita). Ahora las acciones pueden ser de un tipo personalizable pero no incluyen resultado. Posible caracteristica futura.</p>
        </div>
    </div>
</div>

@stop