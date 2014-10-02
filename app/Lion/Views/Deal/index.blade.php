@extends('layout.main')

@section('content')

    <div class="page-header">
        <h1>Operaciones 
            <small>/ visualización de operaciones</small>
        </h1> 
    </div>

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default box">
                <div class="panel-heading">
                    <div class="panel-title">
                        <div class="icon">{{ app_icon_tag('Deal') }}</div>
                        listado de operaciones
                    </div>
                </div>

                <div class="panel-body">

                    <p>Mostrando {{ $deals->count() }} operaciones de un total de {{ $deals->getTotal() }}.</p>

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
                                <th>Título</th>
                                <th>Etapa</th>
                                <th>Cantidad (€)</th>
                                <th>Cierre</th>
                                <th class="hidden-xs"></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($deals as $deal)
                                <tr>
                                    <td><a href="{{ URL::route('deal.show', $deal->id) }}">{{ $deal->name }}</a></td>
                                    <td>{{ $deal->stageName }}</td>
                                    <td>{{ $deal->amount }}</td>
                                    <td>{{ $deal->expectedCloseFormated }}</td>
                                    <td  class="hidden-xs" align="right">{{ table_link_to_edit('deal', $deal->id) }}</td>
                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                    <div class="pull-right">
                        {{ $deals->appends(array('search' => $search, 'orderby' => $orderby, 'order' => $order, 'items' => $deals->getPerPage()))->links() }}
                    </div>

                </div>

            </div>
        </div>

    </div>

@stop