<!-- #entityTags -->

<div id="entityTags" ng-controller="TagsCtrl" ng-init="init('{{ $controller }}', '{{ $entity->id }}')">
    
    <h1>etiquetas</h1>

    <p>
        <div class="btn-group tag-item" ng-repeat="tag in tags">
            <button type="button" class="btn btn-info btn-xs">[[tag]]</button>
            <button type="button" class="btn btn-info btn-xs" ng-click="delete($index)">&times;</button>
        </div>
    </p>

    <p ng-show=" ! tags.length">No ha asignado ninguna etiqueta a esta entidad. Las etiquetas ayudan a categorizar los elementos y permite que sean agrupados en el futuro por filtros de búsqueda. Por ejemplo: "feria 2013, levante, carrocero"</p>

    <div class="input-group">
        {{ Form::text('tag', null, array('class' => 'form-control', 'placeholder' => 'nueva etiqueta', 'ng-model' => 'tagName', 'ng-required' => 'true')) }}
        <span class="input-group-btn">
            <button class="btn btn-info" type="button" ng-click="create()">añadir</button>
        </span>
    </div><!-- /input-group -->
</div>

<!-- /#entityTags -->