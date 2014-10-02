<h3>histórico</h3>

<div id="timeline" class="" ng-controller="TimelineCtrl" ng-init="init('{{ $entityClass }}', '{{ $entity->id }}', 3)">

    <div class="well well-small">
        <p ng-show="!actions.length">No hay ninguna acción registrada en este elemento. Añada nuevas acciones haciendo clic en el botón "crear nueva" de la barra de herramientas de este apartado.</p>


        <a class="btn btn-primary" data-toggle="collapse" data-parent="#accordion" href="#actionAccordion">
            {{ app_icon_tag('create') }} crear
        </a>


        @include ('Action::timeline.create')
    </div>
        <ul class="timeline" ng-show="actions.length">

            <li class="timeslot" ng-repeat="action in actions" style="background:[[action.action_type_bg_color]]; color: [[action.action_type_color]]">
                
                <div class="icon"><i class="fa [[action.action_type_icon]]"></i></div>
                <span class="left-caret"><span style="border-color: #f7f7f7 [[action.action_type_bg_color]];"></span></span>
                
                <div class="timeslot-title">
                    <i class="fa fa-[[getActionIcon(action.direction)]]"></i> [[action.action_type_name]] [[action.title]]
                    
                    <div class="timeslot-related" ng-show="action.related_to.length">
                        <span ng-repeat="related in action.related_to"> - 
                            <a ng-href="[[getRelatedUrl(related.entity_type, related.id)]]" style="color: [[action.action_type_color]]">
                                <i class="fa fa-[[getActionIcon(related.entity_type)]]"></i> [[related.name]]
                            </a> 
                        </span>
                    </div>
                </div>

                <div class="timeslot-time">
                    <div class="date">[[action.done_date]]</div>
                    <div class="time">[[action.done_time]]</div>
                </div>

                <div class="timeslot-content">
                    <span class="teaser">[[getTeaser(action.message)]]</span>
                    <span class="timeslot-readmore more" ng-show="action.message.length > 150"> <a href="#" style="color: [[action.action_type_color]]">{{ app_icon_tag('read_more') }} Leer más</a></span>
                    <span class="complete">[[action.message]]</span>
                    <!-- <div class="timeslot-readmore more" ng-show="action.message.length > 100"><a href="#" style="color: [[action.action_type_color]]">{{ app_icon_tag('read_more') }} Leer más</a></div> -->
                </div>

                <div class="pull-right"><small>por <strong>[[action.user_name]]</strong></small></div>

                <!-- <div class="timeslot-readmore" ng-show="!action.title"><a href="#" style="color: [[action.action_type_color]]">{{ app_icon_tag('read_more') }} Leer más</a></div> -->

                <div class="clearfix"></div>

            </li>

        </ul>

        <button class="btn btn-danger" ng-show="config.showAllButton" ng-click="showAll()">Mostrar todas</button>

    <!-- </div> -->

</div>
