<!-- #entityDeals -->

<div class="panel panel-default box" id="entityDeals">

    <div class="panel-heading">
        <div class="panel-title">
            <div class="icon">{{ app_icon_tag('Deal') }}</div> operaciones
            <div class="btn-group">

                <a href="{{ URL::route('deal.create.company', $entity->id) }}?redirect={{Crypt::encrypt(Request::fullUrl())}}" class="btn btn-primary">
                    {{ app_icon_tag('create') }} crear
                </a>
            </div>
        </div>
    </div>

    <div class="panel-body">

        @if ( ! $entity->deals->count())
            
            <p>No hay ninguna operación asociada a este elemento.</p>
            <a href="{{ URL::route('deal.create.company', $entity->id) }}?redirect={{Crypt::encrypt(Request::fullUrl())}}" class="btn btn-primary">cree su primera operación</a>

        @else

            <table class="table table-striped table-hover table-responsive">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Estado</th>
                        <th>Fase</th>
                        <th>Cantidad</th>
                        <th>Fecha de cierre</th>
                    </tr>
                </thead>

                <tbody>
                    
                    @foreach ($entity->deals as $deal)

                    <tr>
                        <td>{{ link_to_deal($deal) }}</td>
                        <td>{{ $deal->statusName }}</td>
                        <td>{{ $deal->stageName }}</td>
                        <td>{{ $deal->amountMoney }}</td>
                        <td>{{ $deal->expectedClose }}</td>
                    </tr>

                    @endforeach
                        
                </tbody>

                <tfoot>
                    
                </tfoot>
            </table>

        @endif

    </div>
</div>
<!-- #entityDeals -->