@if ($entity->deleted_at)

    <!-- #deleted -->

    <div id="deleted">

        <div class="alert alert-warning">
            <h4>Atención!</h4> 
            <p>Este elemento se encuentra actualmente en la papelera. Se recomienda restaurarlo antes de interactuar con el.</p>
            <p><a href="{{ URL::route($entityClass . '.restore', $entity->id) }}/?{{ redirect_var() }}" class="btn btn-warning">{{ app_icon_tag('recover') }} restaurar ahora</a></p>
        </div>

    </div>

    <!-- /#deleted -->

@endif