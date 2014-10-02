@extends('layout.main')

@section('content')

    <div class="page-header">
        <h1>Empresas 
            <small>/ visualización de cuentas</small>
        </h1> 
    </div>

    {{--@include('Company::partials.actions')--}}

    <div class="row">

        <div class="col-md-12">

            <div class="panel box panel-default">
                
                <div class="panel-heading">
                    <div class="panel-title">
                        <div class="icon">{{ app_icon_tag('Company') }}</div>
                        listado de empresas
                    </div>
                </div>

                <div class="panel-body">

                    <p>Mostrando {{ $companies->count() }} empresas de un total de {{ $companies->getTotal() }}.</p>

                    {{ Form::open(array('method' => 'GET')) }}
                        <div class="input-group">
                            {{ Form::input('search', 'search', Input::get('search'), array('class' => 'form-control')) }}
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="fa fa-search"></i> Buscar!</button>
                            </span>
                        </div><!-- /input-group -->
                    {{ Form::close() }}

                    <table class="table table-striped table-d table-hover table-responsive table-hide-buttons">
                        <thead>
                            <tr>
                                <th>
                                    {{ sortable_table_heading('name', $order, 'Empresa') }}
                                </th>
                                <th>
                                    {{ sortable_table_heading('city', $order, 'Población') }}
                                </th>
                                <th class="hidden-xs"></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($companies as $company)
                                <tr>
                                    <td><a href="{{ URL::route('company.show', $company->id) }}" class="link">{{ $company->name }}</a></td>
                                    <td>{{ $company->city }}</td>
                                    <td align="right" class="hidden-xs">{{ table_link_to_edit('company', $company->id) }}</td>
                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                    <div class="pull-right">
                        {{ $companies->appends(array('search' => $search, 'orderby' => $orderby, 'order' => $order, 'items' => $companies->getPerPage()))->links() }}
                    </div>

                </div>


            </div>
            
            
            
        </div>

    </div>

@stop