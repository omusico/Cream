@extends('layout.main')

@section('content')

    @extends('layout.main')

@section('content')

    <div class="page-header">
        <h1>Contactos 
            <small>/ visualización de contactos</small>
        </h1> 
    </div>

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default box">

                <div class="panel-heading">
                    <div class="panel-title">
                        <div class="icon">{{ app_icon_tag('People') }}</div>
                        listado de contactos
                    </div>
                </div>

                <div class="panel-body">

                    <p>Mostrando {{ $people->count() }} contactos de un total de {{ $people->getTotal() }}.</p>

                    {{ Form::open(array('method' => 'GET')) }}
                        <div class="input-group">
                            {{ Form::input('search', 'search', Input::get('search'), array('class' => 'form-control')) }}
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="fa fa-search"></i> Buscar!</button>
                            </span>
                        </div><!-- /input-group -->
                    {{ Form::close() }}

                    <table class="table table-striped table-hover table-responsive table-hide-buttons">
                        <thead>
                            <tr>
                                <th>{{ sortable_table_heading('name', $order, 'Nombre') }}</th>
                                <th>Empresa</th>
                                <td class="hidden-xs"></td>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($people as $person)                   
                                <tr>
                                    <td><a href="{{ URL::route('people.show', $person->id) }}" class="link">{{ $person->name }}</a></td>
                                    <td>
                                        @if ($person->company)
                                        <a href="{{ URL::route('company.show', $person->company->id) }}" class="link">{{ $person->company->name }}</a>
                                        @else
                                        No asignada
                                        @endif
                                    </td>
                                    <td align="right" class="hidden-xs">{{ table_link_to_edit('people', $person->id) }}</td>
                                </tr>
                            @endforeach

                        </tbody>

                        <tfoot>
                            
                        </tfoot>
                    </table>

                    <div class="pull-right">
                        {{ $people->appends(array('search' => $search, 'orderby' => $orderby, 'order' => $order, 'items' => $people->getPerPage()))->links() }}
                    </div>

                </div>

            </div>

        </div>

    </div>

@stop

@stop