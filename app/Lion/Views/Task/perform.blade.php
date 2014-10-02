@if ($entity->done)

    <p>Tarea ya realizada</p>

@else

    @if (isset($related) && $entity->isAction())

    <p>Esta tipo de esta tarea ha sido establecido como un tipo de acción reportable. Rellene el formulario a continuación para realizarla.</p>

    <div id="timeline" class="" ng-controller="TimelineCtrl" ng-init="init('{{ $entity->relatable_type }}', '{{ $entity->relatable_id }}', 0); initTask({{ $entity->getActionTypeId() }}, {{ $entity->id }}, '{{ $related->entityType }}', {{ $related->id }}, {{ $entity->getRelatedEntityId('Lion\People') ? : '\'\'' }}, {{ $entity->getRelatedEntityId('Lion\Deal') ? : '\'\'' }});">
        @include ('Task::createaction')
    </div>

    @else

    <a href="{{ URL::route('task.perform', $entity->id) }}" class="btn btn-primary">marcar como realizada</a>

    @endif

@endif