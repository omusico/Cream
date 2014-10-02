$(document).ready(function()
{
    $('.form_time').datetimepicker({
        language:  'es',
        // weekStart: 1,
        // todayBtn:  1,
        autoclose: 1,
        // todayHighlight: 1,
        startView: 1,
        minView: 0,
        maxView: 4,
        pickerPosition: 'bottom-left',
        forceParse: 0
        // showMeridian: 1
    });

});

function TimelineCtrl ($scope, $rootScope, $http, $templateCache, $timeout)
{
    var url = 'http://' + window.location.host;

    $scope.url                  = url + '/ajax/action/load-actions';
    $scope.createUrl            = url + '/ajax/action/store-action';
    $scope.data                 = {};
    $scope.showAllActivities    = false;
    $scope.type                 = 'custom';
    
    $scope.init = function(entity, entityId, items)
    {
        $scope.data = { 'entity' : entity.replace('Lion', '').replace('\\', '').toLowerCase(), 'entity_id' : entityId, 'items' : items };

        $scope.load(items);
    };

    $scope.initTask = function(action_id, task_id, entity, entity_id, people, deal)
    {
        $scope.action_type = action_id;
        // $('#action_type').prop('disabled', true);
        $scope.type = 'task';
        $scope.task_id = task_id;
        $scope.people = people;
        $scope.deal = deal;
        $scope.direction = 'out';

        $scope.data = { 'entity' : entity.replace('Lion', '').replace('\\', '').toLowerCase(), 'entity_id' : entity_id, 'items' : 0 };
    }

    // Loads the data and prints it out. Also fires an event to let the app know
    // which action has taken place.
    $scope.load = function(init)
    {
        init = init | false;

        // If initialize
        if (init)
        {
            $scope.resetForm();

            $http.post($scope.url, $scope.data)
                .success(function (data, status) {
                    $scope.actions = data.actions;
                    $scope.config = data.config;

                    $timeout(function() {
                        $(".timeslot-readmore").click(function(e){
                            e.preventDefault();
                            $t = $(this);
                            $t.toggle();
                            $t.siblings(".teaser").toggle();
                            $t.siblings(".complete").toggle();
                        });
                    }, 500)
                    
                })
                .error(function (data, status) {
                    if (data)
                        alert('Se ha producido un error al cargar las acciones.');
                });
        }
    };

    $scope.createAction = function()
    {
        submitData = { 
                        'message'           : $scope.message,
                        'action_type'       : $scope.action_type,
                        'direction'         : $scope.direction,
                        'duration'          : $scope.duration,
                        //'time'              : $('#time').val(),
                        'done_at'           : $('#time').val(),
                        'task_id'           : $scope.task_id,
                        'assignment'        : { }
                    };

        eval('submitData.assignment.' + $scope.data.entity.replace('Lion\\', '').toLowerCase() + ' = $scope.data.entity_id');

        if ($scope.people)
            submitData.assignment.people = $scope.people;

        if ($scope.deal)
            submitData.assignment.deal = $scope.deal;

        $http.post($scope.createUrl, submitData)
            .success(function (data, status) {
                if ($scope.type == 'custom')
                {
                    $scope.load(true);
                    $('#actionAccordion').collapse('toggle');
                    $scope.resetForm();
                }
                else
                    window.location.href = url + '/' + $scope.data.entity + '/' + $scope.data.entity_id;

                $rootScope.$broadcast('actionCreated');          // Loaded for first load
            })
            .error(function (data, status) {
                if (data)
                    alert('Se ha producido un error al guardar la acción.');
            });
    };

    $scope.resetForm = function()
    {
        $('#time').val('');
        $('#timefield').val('');
        // $scope.time = '';
        $scope.direction = 'out';
        $scope.duration = null;
        $scope.message = '';
        $scope.action_type = '';
        $scope.people = '';
        $scope.deal = '';
    }

    $scope.showAll = function()
    {
        $scope.data.items = '*';
        $scope.load(true);
    };

    $scope.getActionIcon = function ($action)
    {
        if (! $action) return;
        tmp = '$scope.config.icons.' + $action.replace('Lion\\', '');
        return eval(tmp);
    }

    $scope.getRelatedUrl = function ($entity, $id)
    {
        if ($entity == null) return '#';
        return 'http://' + window.location.host + '/' + $entity.replace('Lion\\', '').toLowerCase() + '/' + $id;
    }

    $scope.getTeaser = function(message)
    {
        return message.trunc(150);
    } 
}