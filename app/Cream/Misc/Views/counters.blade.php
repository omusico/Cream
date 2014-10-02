<!-- #counters -->

<div id="counters">
    <div class="row">

        <div class="col-md-4 col-xs-4">
            <div class="well well-sm text-center">
                abierto
                <h4><strong>{{ Lion\Deal::openAmount($entity->deals) }} €</strong></h4>
            </div>
        </div>
        <div class="col-md-4 col-xs-4">
            <div class="well well-sm text-center">
                cerrado
                <h4><strong>{{ Lion\Deal::closedAmount($entity->deals) }} €</strong></h4>
            </div>
        </div>
        <div class="col-md-4 col-xs-4">
            <div class="well well-sm text-center">
                estado
                <h4><strong>{{ $entity->statusName }}</strong></h4>
            </div>
        </div>

        <!-- <div class="col-md-4 col-xs-4">
            <div class="panel panel-counter panel-open">
                <div class="panel-heading">abierto</div>
                <div class="panel-content">{{ Lion\Deal::openAmount($entity->deals) }} €</div>
            </div>
        </div>
        <div class="col-md-4 col-xs-4">
            <div class="panel panel-counter panel-closed">
                <div class="panel-heading">cerrado</div>
                <div class="panel-content">{{ Lion\Deal::closedAmount($entity->deals) }} €</div>
            </div>
        </div>
        <div class="col-md-4 col-xs-4">
            <div class="panel panel-counter panel-status">
                <div class="panel-heading">estado</div>
                <div class="panel-content">Seguimiento</div>
            </div>
        </div> -->

    </div>
</div>
<!-- /#counters -->