<?php 
    $repo = App::make('Lion\Repositories\Config\ActionType\ActionTypeConfigRepositoryInterface');
    $types = $repo->nameList(true);
?>

<div id="accordion">
    <div id="actionAccordion" class="panel-collapse collapse {{ $controller != 'Task' ? 'out' : 'in' }}">
        <div class="panel-body">
            {{ Form::open(array('name' => 'newAction', 'class' => 'form-horizontal')) }}

                <div class="form-group">
                    <label for="type" class="col-sm-2 control-label">Tipo:</label>
                    <div class="col-sm-10">
                        {{ Form::select('type', $types, null, array('id' => 'action_type', 'class' => 'form-control', 'ng-model' => 'action_type', 'ng-required' => 'true')) }}
                    </div>
                </div>
                

                @yield ('assignments')

               <?php /* @if (($controller != 'People') && ($entity->people->count()))

                    <div class="form-group">
                        <label for="people" class="col-sm-2 control-label">Contacto:</label>
                        <div class="col-sm-10">
                            {{ Form::select('people', array('' => '- Ninguno -') + $entity->people->lists('name', 'id'), null, array('class' => 'form-control', 'ng-model' => 'people') )}}
                        </div>
                    </div>

                @endif

                @if (($controller != 'Deal') && ($entity->deals->count()))

                    <div class="form-group">
                        <label for="deal" class="col-sm-2 control-label">Operación:</label>
                        <div class="col-sm-10">
                            {{ Form::select('deal', array('' => '- Ninguna -') + $entity->deals->lists('name', 'id'), null, array('class' => 'form-control', 'ng-model' => 'deal') )}}
                        </div>
                    </div>

                @endif*/ ?>

                <div class="form-group">
                    <label for="message" class="col-sm-2 control-label">Descripción:</label>
                    <div class="col-sm-10">
                        {{ Form::textarea('message', null, array('class' => 'form-control', 'placeholder' => 'Descripción', 'rows' => 5, 'ng-model' => 'message', 'ng-required' => 'true', 'ng-minlength' => 10)) }}
                        {{ $errors->first('message', '<p class="help-block">:message</p>') }}
                    </div>
                </div>

                <!-- <div class="form-group">
                    <label for="resultable_id" class="col-sm-2 control-label">Resultado:</label>
                    <div class="col-sm-10">
                        <select class="form-control" ng-model="resultable_id" ng-options="r.name for r in resultList">
                            <option value="">- Seleccione -</option>
                        </select>
                    </div>
                </div> -->

                <div class="form-group">
                    
                    <label for="hour" class="col-sm-2 col-xs-12 control-label">Hora:</label>

                    <div class="col-sm-4 col-xs-4">
                        <div class="input-group date form_time" data-date="" data-date-format="dd M yy hh:ii" data-link-field="time" data-link-format="yyyy-mm-dd hh:ii">
                            <input class="form-control" size="16" type="text" value="" id="timefield" readonly>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                        <input type="hidden" id="time" value="" ng-model="time"/><br/>
                    </div>

                    <label for="" class="col-sm-2 col-xs-12 control-label">Duración:</label>
                    <div class="col-sm-4">
                        <div class="input-group">
                            {{ Form::text('duration', null, array('class' => 'form-control', 'placeholder' => 'Duración', 'ng-model' => 'duration', 'ng-required' => 'true')) }}
                            <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                        </div>
                        {{ $errors->first('duration', '<p class="help-block">:message</p>') }}
                    </div>

                </div>
                
                <!-- <div class="form-group">
                    <label for="time" class="col-md-2 control-label">Hora</label>
                    <div class="input-group date form_time col-sm-10" data-date="" data-date-format="hh:ii" data-link-field="time" data-link-format="hh:ii">
                        <input class="form-control" size="16" type="text" value="" readonly>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                    <input type="hidden" id="time" value="" /><br/>
                </div> -->

                <div class="form-group">
                    <label class="col-sm-2 control-label">Dirección:</label>
                    <div class="col-sm-10">
                        <div class="radio-inline">
                            <label>
                                <input type="radio" name="direction" value="out" ng-model="direction"> {{ app_icon_tag('out') }} Saliente
                            </label>
                        </div>
                        <div class="radio-inline">
                            <label>
                                <input type="radio" name="direction" value="in" ng-model="direction"> {{ app_icon_tag('in') }} Entrante
                            </label>
                        </div>
                        {{ $errors->first('direction', '<p class="help-block">:message</p>') }}
                    </div>
                </div>

                

                <a class="btn btn-primary" ng-click="createAction()" ng-disabled="!newAction.$valid">Guardar</a>
                <a data-toggle="collapse" data-parent="#accordion" href="#actionAccordion" class="btn btn-danger">Cancelar</a>

            {{ Form::close() }}
        </div>
    </div>
</div>


