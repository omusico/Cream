@extends('layout.main')

@section('content')

    <div class="page-header">
        <h1>Empresas 
            <small>/ papelera</small>
        </h1> 
    </div>

    @include('Company::partials.actions')

    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-hover table-responsive table-hide-buttons">
                <thead>
                    <tr>
                        <th>Empresa</th>
                        <td></td>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($trashedCompanies as $company)          
                        <tr>
                            <td><a href="{{ URL::route('company.show', $company->id) }}">{{ $company->name }}</a></td>
                            <td align="right">{{ table_link_to_restore('company', $company->id) }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>

@stop