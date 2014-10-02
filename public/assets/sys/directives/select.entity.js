angular.module('app').directive("selectEntity", function($timeout) {

    var url = 'http://' + window.location.host;

    // URLs donde realizar las peticiones de información de empresas.
    var searchEntitiesUrl  = url + '/ajax/entity/search-entities';
    var loadEntityUrl      = url + '/ajax/entity/get-entity';

    return {
        restrict: 'A',
        replace: true,
        templateUrl: url + '/assets/sys/directives/templates/select.entity.template.html',

        // Si se ha establecido un valor por defecto (existía una empresa), la carga remotamente
        // y la marca como seleccionada por defecto.
        controller: ['$scope', '$element', '$attrs', '$transclude', '$http', '$timeout', function($scope, $element, $attrs, $transclude, $http, $timeout) 
        {
            $entity_type = $element.data('entity_type');
            $entity_id   = $element.data('entity_id');

            $scope.getEntity = function($entity, $id) {
                $scope.entity_type  = $entity;
                $scope.entity_id    = $id;

                data = { 'entity_type' : $entity, 'entity_id' : $id };

                $http.post(loadEntityUrl, data)
                    .success(function (data, status) {
                        $scope.selected_entity = data;

                        if ($element.data('relations'))
                        {
                            // console.log($element.data('relations'));
                            angular.forEach($element.data('relations'), function(value, key) {
                                if (value.assignable_type == 'Lion\\Deal')
                                {
                                    $timeout(function ()
                                       {
                                            $('#assignmentDeal option[value="' + value.assignable_id + '"]').attr("selected", "selected");
                                       } , 0);
                                }
                                if (value.assignable_type == 'Lion\\People')
                                {
                                    $timeout(function ()
                                       {
                                            $('#assignmentPeople option[value="' + value.assignable_id + '"]').attr("selected", "selected");
                                       } , 0);
                                }
                            });
                        }

                        $('#selectedEntity').attr('name', 'assignment[' + $entity + ']');
                    })
                    .error(function (data, status) { alert('Se ha producido un error'); });
            };

            // if asociated to anything:
            if ($entity_type && $entity_id)
            {
                $scope.getEntity($entity_type, $entity_id);
            }

            $scope.search = function() {

                if ($scope.entity_search)
                {
                    $http.post(searchEntitiesUrl, { query: $scope.entity_search })
                        .success(function (data, status) {
                            $scope.search_results_companies = data.companies;
                            $scope.search_results_deals     = data.deals;
                            $scope.search_results_people    = data.people;
                            $scope.search_performed = true;
                        })
                        .error(function (data, status) { alert('Se ha producido un error'); });
                }
                else
                    $scope.resetResults();
            };

            $scope.selectEntity = function ($entity, $id)
            {
                $scope.getEntity($entity, $id);
            };

            $scope.resetResults = function() {
                $scope.search_performed = false;
                $scope.selected_entity          = null;
                $scope.entity_type              = null;
                $scope.entity_id                = null;
                $scope.search_results_companies = {};
                $scope.search_results_deals     = {};
                $scope.search_results_people    = {};
            };

            return;
        }]
    };
});