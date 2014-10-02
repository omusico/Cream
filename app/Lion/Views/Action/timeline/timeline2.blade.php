<div id="timeline" class="panel box panel-default" ng-controller="TimelineCtrl" ng-init="init('{{ $entityClass }}', '{{ $entity->id }}', 3)">

    <div class="panel-heading">

         <div class="panel-title">
            <div class="icon">{{ app_icon_tag('timeline') }}</div>
            histórico

            <div class="btn-group">
                <a class="btn btn-primary" data-toggle="collapse" data-parent="#accordion" href="#actionAccordion">
                    {{ app_icon_tag('create') }} crear
                </a>
            </div>

        </div>
        
    </div>

    <div class="panel-body">

        <p ng-show="!actions.length">No hay ninguna acción registrada en este elemento. Añada nuevas acciones haciendo clic en el botón "crear nueva" de la barra de herramientas de este apartado.</p>

        @include ('Action::timeline.create')

        <ul class="timeline" ng-show="actions.length">

            <li class="timeslot" ng-repeat="action in actions">
                
                <div class="icon"><i class="fa [[action.action_type_icon]]"></i></div>
                    <div class="task [[action.action_type]]">
                        <span class="left-caret"><span></span></span>
                        <div class="date">
                            {{ app_icon_tag('calendar') }} [[action.done_date]] / 
                            <small><i class="fa fa-[[action.direction-icon]]"></i> [[action.direction]]</small>
                        </div>

                        <div class="top">
                            <div class="pull-right">
                                <span ng-show="action.historiable_type != config.controller">
                                    <a ng-href="[[getRelatedUrl(action.historiable_type, action.historiable_id)]]" class="link">
                                        <i class="fa fa-[[getActionIcon(action.historiable_type)]]"></i>  [[action.history_name]]
                                    </a> 
                                 </span>
                                 <span ng-show="action.relatable_type != NULL && action.relatable_type != config.controller">
                                    <a ng-href="[[getRelatedUrl(action.relatable_type, action.relatable_id)]]" class="link">
                                        <i class="fa fa-[[getActionIcon(action.relatable_type)]]"></i>  [[action.related_name]]
                                    </a> 
                                </span>
                            </div>
                            <strong>[[action.action_type_name]]</strong> 
                            - {{ app_icon_tag('time') }} [[action.duration]] min
                        </div>

                        <div class="content">
                            <p>[[action.message]]</p>
                        </div>

                    </div>

            </li>

        </ul>

        <button class="btn btn-danger" ng-show="config.showAllButton" ng-click="showAll()">Mostrar todas</button>

    </div>

</div>
